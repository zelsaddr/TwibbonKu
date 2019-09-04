<?php
if(!defined("TwibbonKu")){
    header("location: index.php"); 
    exit();
}
?>
<center>
    <div class="form-group">
        <img class="img-thumbnail" src="./image/admin2.png" width="250px" height="250px">
    </div>
    <h1>Hello <?php echo $_SESSION['user']; ?>!</h1>
</center>