<?php
require "./admin/function.php";
if(isset($_POST['twibbon'])){
  $twibbon = new Twibbon;
  $select_twibbon = $_POST['twibbon'];
  $json = json_decode($twibbon->upload_photo(), true);
  if($json['status'] == "200"){
?>
<html lang="en">
  <head>
    <title>UMB TWIBBON 2019</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="UMB Twibbon Maker">
    <meta name="description" content="Create UMB Twibbon">
    <meta name="keywords" content="Mercu Buana Twibbon Maker">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Izzeldin Addarda">
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
            <h5 class="card-header text-center"><i class="fa fa-image"></i> UMB TWIBBON MAKER</h5>
            <div class="card-body">
              <div class="form-group">
                <img src="<?php echo $json['0']['file_location']; ?>" id="img1" class="img-fluid" width="600px" height="600px" hidden="true">
                <img src="<?php echo $_POST['twibbon']; ?>" id="img2" class="img-fluid" width="600px" height="600px" hidden="true">
                <center>
                  <h4>Twibbon Berhasil Dibuat</h4>
                  <canvas id="canvas" height="100" width="100"></canvas>
                  <br>
                  <hr width="40%">
                  <a id="download" class="btn btn-success"><i class="fa fa-download"></i> Download Gambar</a>
                  <a href="/" class="btn btn-danger"><i class="fa fa-home"></i> Kembali</a>
                </center>
              </div>
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
  <script>
    window.onload = function () {
        var img1 = document.getElementById('img1');
        var img2 = document.getElementById('img2');
        var canvas = document.getElementById("canvas");
        var context = canvas.getContext("2d");
        var width = img2.width;
        var height = img2.height;
        canvas.width = width;
        canvas.height = height;

        context.drawImage(img1, 0, 1, width, height);
        var image1 = context.getImageData(0, 0, width, height);
        var imageData1 = image1.data;
        context.drawImage(img2, 0, 0, width, height);
        var image2 = context.getImageData(0, 0, width, height);
        var imageData2 = image2.data;
    };
    function downloadCanvas(link, canvasId, filename) {
        link.href = document.getElementById(canvasId).toDataURL();
        link.download = filename;
    }
    document.getElementById('download').addEventListener('click', function() {
        downloadCanvas(this, 'canvas', 'umb_twibbon_<?php echo $_POST['twibbon']; ?>');
    }, false);
  </script>
  </body>
</html>

<?php
  }else{
    echo "<script>alert('".$json['msg']."')</script>";
    echo "<meta http-equiv='refresh' content='0; url= /index.php'>";
  }
}else{
  header("Location: /index.php");
}
?>