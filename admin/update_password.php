<?php
if(!defined("TwibbonKu")){
    header("location: index.php"); 
    exit();
}
if(isset($_POST['update_pass'])){
    $update = json_decode($twibbon->update_password($_SESSION['user'], $_POST['l_password'], $_POST['n_password']), true);
    echo "<script>alert('".$update['msg']."')</script>";
}
?>
            <form method="POST" action="">
                <div class="form-group">
                    <div class="text-center">
                        <img src="./image/admin.png" id="img" class="rounded" alt="Admin Image" width="200px" height="200px">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Password" class="col-sm-2 col-form-label"><b>Last Password :</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="l_password" class="form-control" id="Password" placeholder="Last password.." required="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Password" class="col-sm-2 col-form-label"><b>New Password :</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="n_password" class="form-control" id="Password" placeholder="New Password.." required="">
                    </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="update_pass" class="btn btn-warning form-control"><i class="fa fa-lock"></i> Update Password</button>
                </div>
              </form>