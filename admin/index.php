<?php
define("TwibbonKu", "twibbon");
require "./function.php";
session_start();
if(!isset($_SESSION['user'])){
    header("Location: /admin/login.php");
    exit;
}
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: /admin/login.php");
    exit;
}
$twibbon = new Twibbon;
$site_settings = $twibbon->show_settings()['0'];
?>
<html lang="en">
  <head>
    <title><?php echo $site_settings['site_title']; ?> - Admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="<?php echo $site_settings['site_title']; ?>">
    <meta name="description" content="<?php echo $site_settings['site_description']; ?>">
    <meta name="keywords" content="<?php echo $site_settings['site_keywords']; ?>">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="<?php echo $site_settings['site_author']; ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  </head>
  <body style="margin-top:80px; margin-bottom:80px;">
    <div class="container-fluid">
      <div class="mx-auto col-md-8">
          <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <b id="jdl"></b>
                </div>
                <div class="float-right">
                    <a href="/admin/" class="btn btn-success"><i class="fa fa-home"></i> Home</a>
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-list"></i> Menu
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="./?do=upload_twibbon"><i class="fa fa-upload"></i> Upload Twibbon</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./?do=list_twibbon"><i class="fa fa-list"></i> List Twibbon</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./?do=list_photo"><i class="fa fa-image"></i> List Photo</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./?do=site_settings"><i class="fa fa-wrench"></i> Site Settings</a>
                            </li> 
                            <li>
                                <a class="dropdown-item" href="./?do=update_password"><i class="fa fa-lock"></i> Update Password</a>
                            </li>
                        </ul>
                    </div>
                    <a href="./?logout" class="btn btn-danger btn-lg"><i class="fa fa-sign-out"></i></a>
                </div>
            </div>
            <div class="card-body">
              <?php
                if(isset($_GET['do'])){
                    switch($_GET['do']){
                        case 'upload_twibbon':
                            $title = "Upload Twibbon";
                            include "./upload_twibbon.php";
                            break;
                        case 'list_twibbon':
                            $title = "List Twibbon";
                            include "./list_twibbon.php";
                            break;
                        case 'list_photo':
                            $title = "List Photo";
                            include "./list_photo.php";
                            break;
                        case 'site_settings':
                            $title = "Site Settings";
                            include "./site_settings.php";
                            break;
                        case 'update_password':
                            $title = "Update Password";
                            include "./update_password.php";
                            break;
                        case 'delete':
                            $title = "Delete";
                            include "./delete.php";
                            break;
                        default:
                            $title = "Home";
                            include "./home.php";
                    }
                }else{
                    $title = "Home";
                    include "./home.php";
                }
              ?>
            </div>
            <div class="card-footer">
                <div class="float-left">
                    <small class="text-muted"><i class="fa fa-image"></i> Total Photo : <?php echo $twibbon->total_photo(); ?> </small>
                    <small class="text-muted">| Total Twibbon : <?php echo $twibbon->total_twibbon(); ?> </small>
                </div>
                <div class="float-right">
                    <small class="text-muted">&copy; Created with <i class="fa fa-heart"></i> by <a href="https://instagram.com/_zelsaddr" target="_blank">Izzeldin Addarda</a></small>
                </div>
            </div>
          </div>
      </div>
  </div>
  <script>
  $(document).ready(function(){
    $("#jdl").html('<i class="fa fa-image"></i> <?php echo $title; ?>');
    $('#dataTables').DataTable();
  });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
