<?php
  if(!isset($_SESSION['user']))
  {
      $_SESSION['no-login-message']="<div class='faliure text-center'>PLease Login To Access.</div>";
      header('location:'.SITEURL.'admin/login.php');

  }
?>