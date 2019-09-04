<?php
if(!defined("TwibbonKu")){
    header("location: index.php"); 
    exit();
}
if(isset($_GET['opt'])){
    switch($_GET['opt']){
        case 'twibbon':
            if(isset($_GET['id'])){
                $json = json_decode($twibbon->delete_twibbon($_GET['id']), true);
                echo "<script>alert('".$json['msg']."')</script>";
                echo "<meta http-equiv='refresh' content='0; url= /admin/?do=list_twibbon'>";
            }else{
                echo "?";
            }
            break;
        case 'photo':
            if(isset($_GET['id'])){
                $json = json_decode($twibbon->delete_photo($_GET['id']), true);
                echo "<script>alert('".$json['msg']."')</script>";
                echo "<meta http-equiv='refresh' content='0; url= /admin/?do=list_photo'>";
            }else{
                echo "?";
            }
            break;
        default:
            echo "?";
            break;
    }
}else{
    echo "?";
}
?>