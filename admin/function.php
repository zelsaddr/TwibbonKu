<?php
class Twibbon
{
    private $dbhost     = "localhost";
    private $dbuser     = ""; // DB USER
    private $dbpass     = ""; // DB PASS
    private $dbname     = ""; // DB NAME
    private $mysql;

    public function __construct()
    {
        $mysql = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname) or die ("! Failed to connect database : Check your database connection details");
        return $this->mysql = $mysql;
    }
    public function sign_in($username, $password)
    {
        $query = mysqli_query($this->mysql, "SELECT * FROM `admin` WHERE username = '".$username."'");
        if(mysqli_num_rows($query) > 0){
            $data = mysqli_fetch_array($query);
            if(password_verify($password, $data['password'])){
                return $this->json_builder("200", "Sign in Successfully");
            }else{
                return $this->json_builder("401", "Wrong password!");
            }
        }else{
            return $this->json_builder("333", "User not found");
        }
    }
    public function upload_twibbon($judul){
        global $_FILES;
        $target_dir = "../twibbon/";
        $target_file = $target_dir . basename($_FILES["file_twibbonku"]["name"]);
        $fname  = basename($_FILES["file_twibbonku"]["name"]);
        $date   = date("d/m/Y");
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if($imageFileType == "png"){
            $check = "SELECT * FROM `twibbon_file` WHERE file_name = '".$fname."'";
            if(mysqli_num_rows(mysqli_query($this->mysql, $check)) > 0){
                return $this->json_builder("500", "Failed to Upload, filename already in database");
            }else{
                if($move = move_uploaded_file($_FILES["file_twibbonku"]["tmp_name"], $target_file)){
                    $query = "INSERT INTO `twibbon_file` (`id`, `file_location`, `file_name`, `date`, `judul`) VALUES ('', '".$target_file."', '".$fname."', '".$date."', '".$judul."')";
                    if(mysqli_query($this->mysql, $query)){
                        return $this->json_builder("200", "Success Upload", array("file_type" => $imageFileType));
                    }else{
                        return $this->json_builder("500", "Failed Insert to database");
                    }
                }else{
                    return $this->json_builder("500", "Failed to upload");
                }
            }
        }else{
            return $this->json_builder("500", "Failed to upload, file extension should be png!");
        }
    }
    public function upload_photo()
    {
        global $_FILES;
        $target_dir = "./photos/";
        $target_file = $target_dir . basename($_FILES["file_fotoku"]["name"]);
        $file_size  = $_FILES["file_fotoku"]["size"];
        $max_size   = 2097152;
        $fname  = basename($_FILES["file_fotoku"]["name"]);
        $date   = date("d/m/Y");
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if($file_size >= $max_size){
            return $this->json_builder("403", "Failed to upload, File too large. File must be less than 2 megabytes. try to compress your photo");
            die();
        }
        if(preg_match("/png|jpeg|jpg/i", $imageFileType)){
            $check = "SELECT * FROM `photo_file` WHERE file_name = '".$fname."'";
            if(mysqli_num_rows(mysqli_query($this->mysql, $check)) > 0){
                $query = mysqli_query($this->mysql, "UPDATE `photo_file` SET `file_location` = '".$target_file."', `file_name` = '".$fname."', `date` = '".$date."' WHERE `photo_file`.`file_name` = '".$fname."'");
                if($query){
                    if($move = move_uploaded_file($_FILES["file_fotoku"]["tmp_name"], $target_file)){
                        return $this->json_builder("200", "Success Upload", array("file_location" => $target_file, "file_type" => $imageFileType));
                    }else{
                        return $this->json_builder("500", "Failed to upload, while moving file");
                    }
                }else{
                    return $this->json_builder("500", "Failed to Upload while updating data in database");
                }
            }else{
                if($move = move_uploaded_file($_FILES["file_fotoku"]["tmp_name"], $target_file)){
                    $query = "INSERT INTO `photo_file` (`id`, `file_location`, `file_name`, `date`) VALUES ('', '".$target_file."', '".$fname."', '".$date."')";
                    if(mysqli_query($this->mysql, $query)){
                        return $this->json_builder("200", "Success Upload", array("file_location" => $target_file, "file_type" => $imageFileType));
                    }else{
                        return $this->json_builder("500", "Failed Insert to database");
                    }
                }else{
                    return $this->json_builder("500", "Failed to upload");
                }
            }
        }else{
            return $this->json_builder("403", "Failed to upload, file extension should be image!");
        }
    }
    public function delete_twibbon($id)
    {
        $query = mysqli_query($this->mysql, "SELECT * FROM `twibbon_file` WHERE id = '".$id."'");
        if(mysqli_num_rows($query) > 0){
            $array = mysqli_fetch_array($query);
            $query = mysqli_query($this->mysql, "DELETE FROM `twibbon_file` WHERE `twibbon_file`.`id` = '".$id."'");
            if($query){
                if(unlink($array['file_location'])){
                    return $this->json_builder("200", "Successfully deleting file.");
                }else{
                    return $this->json_builder("500", "Failed deleting file, error while deleting file");
                }
            }else{
                return $this->json_builder("500", "Failed deleting file, error while running query");
            }
        }
    }
    public function delete_photo($id)
    {
        $query = mysqli_query($this->mysql, "SELECT * FROM `photo_file` WHERE id = '".$id."'");
        if(mysqli_num_rows($query) > 0){
            $array = mysqli_fetch_array($query);
            $query = mysqli_query($this->mysql, "DELETE FROM `photo_file` WHERE `photo_file`.`id` = '".$id."'");
            if($query){
                if(unlink(".".$array['file_location'])){
                    return $this->json_builder("200", "Successfully deleting file.");
                }else{
                    return $this->json_builder("500", "Failed deleting file, error while deleting file");
                }
            }else{
                return $this->json_builder("500", "Failed deleting file, error while running query");
            }
        }
    }
    public function filesize_formatted($path)
    {
        $size = filesize($path);
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
    public function show_twibbon()
    {
        $query = mysqli_query($this->mysql, "SELECT * FROM `twibbon_file`");
        $fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $fetch;
        // $aaa = "";
    }
    public function show_photo()
    {
        $query = mysqli_query($this->mysql, "SELECT * FROM `photo_file`");
        $fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $fetch;
        // $aaa = "";
    }
    public function total_photo()
    {
        $query = mysqli_query($this->mysql, "SELECT * FROM `photo_file`");
        $fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return count($fetch);
    }
    public function total_twibbon()
    {
        $query = mysqli_query($this->mysql, "SELECT * FROM `twibbon_file`");
        $fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return count($fetch);
    }
    public function show_settings()
    {
        $query = mysqli_query($this->mysql, "SELECT * FROM `site_settings`");
        $fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $fetch;
        // $aaa = "";
    }
    public function site_settings($site_title, $site_description, $site_keywords, $home_title, $site_author)
    {
        $query = mysqli_query($this->mysql, "UPDATE `site_settings` SET `site_title`= '".$site_title."',`site_description`='".$site_description."',`site_author`='".$site_author."',`site_keywords`='".$site_keywords."',`home_title`='".$home_title."' WHERE 1");
        if($query){
            return $this->json_builder("200", "Success update site settings");
        }else{
            return $this->json_builder("500", "Failed update, while updating site settings");
        }
    }
    public function update_password($username, $last_password, $new_password)
    {
        $query = mysqli_query($this->mysql, "SELECT * FROM `admin` WHERE username = '".$username."'");
        if(mysqli_num_rows($query) > 0){
            $data = mysqli_fetch_array($query);
            if(password_verify($last_password, $data['password'])){
                $hash = password_hash($new_password, PASSWORD_DEFAULT);
                $query = mysqli_query($this->mysql, "UPDATE `admin` SET `password` = '".$hash."' WHERE `admin`.`username` = '".$username."'");
                if($query){
                    return $this->json_builder("200", "Password updated successfully");
                }else{
                    return $this->json_builder("500", "failed update password while updating.");
                }
            }else{
                return $this->json_builder("401", "Wrong password!");
            }
        }else{
            return $this->json_builder("333", "User not found");
        }
    }
    public function base_url()
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? $url = "https://".$_SERVER['SERVER_NAME'] : $url = "http://".$_SERVER['SERVER_NAME'];
    }
    private function json_builder($status, $msg, array $extend = NULL)
    {
        return json_encode(
            array(
                "status"    => $status,
                "msg"       => $msg,
                $extend != NULL ? $extend : ""
            )
        );
    }
}
?>