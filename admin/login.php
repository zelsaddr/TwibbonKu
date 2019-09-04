<?php
session_start();
require "./function.php";
$twibbon = new Twibbon();
$site_settings = $twibbon->show_settings()['0'];
if(isset($_GET['check'])){
  if(isset($_POST['username']) && isset($_POST['password'])){
    $res = $twibbon->sign_in($_POST['username'], $_POST['password']);
    if(json_decode($res, true)['status'] == "200"){
      $_SESSION['user'] = $_POST['username'];
      $_SESSION['pass'] = $_POST['password'];
    }
    echo $res;
  }
}else{
  if(isset($_SESSION['user'])){
    header("Location: /admin/");
  }else{
?>
<html lang="en">
  <head>
  <title><?php echo $site_settings['site_title']; ?> - Login</title>
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
    <style type="text/css">
        table{
           overflow-y:scroll;
           height: 500px;
           display:block;
        }
    </style>
  </head>
  <body style="margin-top:80px; margin-bottom:80px;">
    <div class="container-fluid">
      <div class="mx-auto col-md-6">
          <div class="card">
            <h5 class="card-header text-center"><i class="fa fa-image"></i> UMB TWIBBON MAKER - ADMIN</h5>
            <div class="card-body">
              <form enctype="multipart/form-data">
                <div class="form-group">
                    <div class="text-center">
                        <img src="./image/admin.png" id="img" class="rounded" alt="Admin Image" width="200px" height="200px">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Username" class="col-sm-2 col-form-label"><b>Username :</b></label>
                    <div class="col-sm-10">
                        <input type="username" name="username" class="form-control" id="Username" placeholder="Username.." required="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Password" class="col-sm-2 col-form-label"><b>Password :</b></label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="Password" placeholder="Password.." required="">
                    </div>
                </div>
                <div class="form-group">
                  <button type="button" id="login_click" class="btn btn-success form-control"><i class="fa fa-sign-in"></i> Masuk</button>
                </div>
              </form>
            </div>
            <div class="card-footer">
                <div class="float-left">
                    <small class="text-muted"><i class="fa fa-image"></i> Total Photo : <?php echo $twibbon->total_photo(); ?> </small>
                    <small class="text-muted">| Total Twibbon : <?php echo $twibbon->total_twibbon(); ?> </small>
                </div>
                <div class="float-right">
                    <small class="text-muted">&copy; Developed with <i class="fa fa-heart"></i> by <a href="https://instagram.com/_zelsaddr" target="_blank">Izzeldin Addarda</a></small>
                </div>
            </div>
          </div>
      </div>
  </div>
  <script>
  $(document).ready(function(){
      $("#login_click").click(function(){
        var uname = $("#Username").val();
        var pass = $("#Password").val();
          $.post("./login.php?check", {
              username: uname,
              password: pass
          }, function(data, status){
            var result = $.parseJSON(data);
            if(result['status'] == "200"){
              $("#img").attr("src", "./image/check.gif");
              // alert("Success login.");
              window.location.replace("<?php echo $twibbon->base_url()."/admin/"; ?>");
            }else if(result['status'] == "401"){
              $("#img").attr("src", "./image/wrong.gif");
              // alert("Wrong Password.");
            }else{
              alert("Username not found.");
            }
          });
      });
  });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<?php
  }
}
?>