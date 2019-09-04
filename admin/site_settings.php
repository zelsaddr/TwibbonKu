<?php
if(!defined("TwibbonKu")){
    header("location: index.php"); 
    die();
}
if(isset($_POST['submit'])){
    $upload = json_decode($twibbon->site_settings($_POST['site_title'], $_POST['site_description'], $_POST['site_keywords'], $_POST['home_title'], $_POST['site_author']), true);
    if($upload['status'] == "200"){
        echo "<script>alert('".$upload['msg']."')</script>";
    }else{
        echo "<script>alert('".$upload['msg']."')</script>";
    }
}
?>
            <form action="./?do=site_settings" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="site_title" class="col-sm-2 col-form-label"><b>Judul Website :</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="site_title" class="form-control" id="site_title" placeholder="Twibbon Generator.." required="" value="<?php echo $site_settings['site_title']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="site_description" class="col-sm-2 col-form-label"><b>Description :</b></label>
                    <div class="col-sm-10">
                        <textarea name="site_description" class="form-control" id="site_description" placeholder="Twibbon generator adalah.." required=""><?php echo $site_settings['site_description']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="site_keywords" class="col-sm-2 col-form-label"><b>Keywords :</b></label>
                    <div class="col-sm-10">
                        <textarea name="site_keywords" class="form-control" id="site_keywords" placeholder="Twibbon generator, Twibbon maker, Twibbon" required=""><?php echo $site_settings['site_description']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="home_title" class="col-sm-2 col-form-label"><b>Home Name :</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="home_title" class="form-control" id="home_title" placeholder="Twibbon Generator" required="" value="<?php echo $site_settings['home_title']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="site_author" class="col-sm-2 col-form-label"><b>Author :</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="site_author" class="form-control" id="site_author" placeholder="Izzeldin Addarda" required="" value="<?php echo $site_settings['site_author']; ?>">
                    </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-success form-control"><i class="fa fa-wrench"></i> Update</button>
                </div>
              </form>