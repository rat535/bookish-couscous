<?php include('partials/menu.php'); ?>
  <div class="main-content">
     <div class="wrapper">
        <h1>update</h1>
        <br><br>

        <?php
           //get the id
           $id=$_GET['id'];
           //excute sql
           $sql="SELECT * FROM tbl_admin WHERE id=$id";
           //run the sql
           $res=mysqli_query($conn,$sql);

           if($res==true)
           {
              $count=mysqli_num_rows($res);
              if($count==1)
              {
                 $rows=mysqli_fetch_assoc($res);
                 $full_name=$rows['full_name'];
                 $username=$rows['username'];
              }
              else
              {
                header("location:".SITEURL.'admin/manage-admin.php');
              }
           }
         ?>
        <form action="" method="POST">
           <table class="tbl-30">
              <tr>
                 <td>Full name: </td>
                 <td><input type="text" name="full_name" value="<?php echo $full_name ;?>"></td>
              </tr>

              <tr>
                  <td>Username: </td>
                  <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
              </tr>

              <tr>
                 <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="update" class="btn-primary">
                 </td>
              </tr>
           </table>
        </form>
     </div>
 </div>

 <?php
   if(isset($_POST['submit']))
   {
      $id=$_POST['id'];
      $full_name=$_POST['full_name'];
      $username=$_POST['username'];
      //writting sql
      $sql="UPDATE tbl_admin SET full_name='$full_name',username='$username' WHERE id='$id'";
      $res = mysqli_query($conn,$sql);
      if($res==true)
      {
         $_SESSION['update']="<div class='sucsess'>Admin update succsessfull<div>";
         header("location:".SITEURL.'admin/manage-admin.php');
      }
      else
      {
         $_SESSION['update']="<div class='delete'>not updated<div>";
         header("location:".SITEURL.'admin/manage-admin.php');
      }
   }
 ?>


<?php include('partials/footer.php');?>