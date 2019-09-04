<?php
if(!defined("TwibbonKu")){
    header("location: index.php"); 
    die();
}
if(isset($_POST['submit'])){
    $upload = json_decode($twibbon->upload_twibbon($_POST['title']), true);
    if($upload['status'] == "200"){
        echo "<script>alert('".$upload['msg']."')</script>";
    }else{
        echo "<script>alert('".$upload['msg']."')</script>";
    }
}
?>
            <form action="./?do=upload_twibbon" method="post" enctype="multipart/form-data">
                <div class="form-group text-center">
                    <p><i>Contoh Twibbon : </i></p>
                    <img src="https://twibbon.blob.core.windows.net/twibbon/2016/282/c7c53ba1-4955-497b-9096-333ed18e37fe.png" width="250px" height="250px" class="img-rounded">
                    <hr width="50%">
                    <p><b>Note : </b><i>File harus berbentuk png!</i></p>
                </div>
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Judul Twibbon" required="">
                </div>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="file_twibbonku" required>
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-success form-control"><i class="fa fa-upload"></i> Upload Twibbonku!</button>
                </div>
              </form>