<?php
  include('../config/constant.php');
  //get the value
   $id=$_GET['id'];
  //writting query
  $sql = "DELETE FROM tbl_admin WHERE id=$id";
  //running the quary
  $res = mysqli_query($conn,$sql);
  //checking admin is deleted or not 
  if($res==TRUE)
  {
      $_SESSION['delete']="<div class='sucsess'>successfully deleted</div>";
      //redirecting to manage admin page
      header("location:".SITEURL.'admin/manage-admin.php');
  }
  else
  {
      $_SESSION['delete']="<div class='faliure'>delete unsuccessful</div> ";
      //redirecting to manage admin page
      header("location:".SITEURL.'admin/manage-admin.php');
  }

?>