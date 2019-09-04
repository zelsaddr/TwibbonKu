<?php
session_start();
require "./admin/function.php";
$twibbon = new Twibbon;
$site_settings = $twibbon->show_settings()['0'];
?>
<html lang="en">
  <head>
  <title><?php echo $site_settings['site_title']; ?></title>
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
      <div class="mx-auto col-md-8">
          <div class="card">
          <div class="card-header">
              <b><i class="fa fa-image"></i> <?php echo $site_settings['home_title']; ?></b>
                <div class="float-right">
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-list"></i> Follow Me
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="https://instagram.com/_zelsaddr"><i class="fa fa-instagram"></i> ig/@_zelsaddr</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="https://fb.com/www.zeldin.go.id"><i class="fa fa-facebook"></i> fb/www.zeldin.go.id</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="https://zeldin.me/"><i class="fa fa-globe"></i> zeldin.me</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <form action="./twibbon.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <post id="img"></post>
                  </div>
                <div class="form-group">
                  <select id="twibbon" name="twibbon" class="form-control" required="">
                    <option selected disabled hidden>Pilih Twibbon :</option>
                    <?php 
                      $list = $twibbon->show_twibbon();
                      foreach($list as $row){
                    ?>
                    <option value="<?php echo $row['file_location']; ?>"><?php echo $row['judul']; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="file_fotoku" required>
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-success form-control"><i class="fa fa-wrench"></i> Buat Twibbonku!</button>
                </div>
              </form>
            </div>
            <div class="card-footer">
                <div class="float-left">
                    <small class="text-muted"><i class="fa fa-image"></i> Total Photo Uploaded : <?php echo $twibbon->total_photo(); ?> </small>
                    <small class="text-muted">| Total Twibbon : <?php echo $twibbon->total_twibbon(); ?> </small>
                </div>
                <div class="float-right">
                    <small class="text-muted">&copy; Developed with <i class="fa fa-heart"></i> by <a href="https://instagram.com/_zelsaddr" target="_blank">Izzeldin Addarda</a></small>
                </div>
            </div>
          </div>
          </div>
      </div>
  </div>
  <script>
    $(document).ready(function(){
      $("#img").hide();
      $("#twibbon").on('change', do_preview);
    });
    function do_preview(){
      var twibbon = $("#twibbon").val();
      $("#img").show();
      $("#preview_img").remove();
      $("#img").append("<center id='preview_img'><p>Preview :</p><img src='"+ twibbon +"' width='200px' height='200px' class='img-thumbnail' border='2'></center>")
      $("img").hover(
            function(){$(this).animate({width: "400px", height:"400px"}, 1000);},        
            function(){$(this).animate({width: "200px", height:"200px"}, 1000);}
        );
    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
