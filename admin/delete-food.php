<?php
  include('../config/constant.php');
  if(isset($_GET['id']) && isset($_GET['image_name']))
  {
      $id=$_GET['id'];
      $image_name=$_GET['image_name'];
      //if image is not avialabel
      if($image_name!="")
      {
          //get the path to delete the image
          $path="../images/food/".$image_name;
          //removing the IMAGE
          $remove= unlink($path);
          if($remove==false)
          {
              $_SESSION['upload']="<div class='faliure'> failed to upload</div>";
              header('location'.SITEURL.'admin/manage-food.php');
              die();
          }
       }
       //Delete data from database
       $sql="DELETE FROM tbl_food WHERE id=$id";
       //excuting sql
       $res=mysqli_query($conn, $sql);

       if($res==true)
       {
           $_SESSION['delete']="<div class='sucsess'> deleted successfully </div>";
           header('location:'.SITEURL.'admin/manage-food.php');
       }
       else
       {
          $_SESSION['delete']="<div class='faliure'> error </div>";
          header('location:'.SITEURL.'admin/manage-food.php'); 
       }
   }
  else
  {
      $_SESSION['unauthrize']="<div class='faliure'> failed to delete </div>";
      header('location:'.SITEURL.'admin/manage-food.php');
      
  }
?>