<?php include('partials/menu.php'); ?>
 <div class="main-content">
     <div class="wrapper">
         <h1>change password</h1>
         <br><br>

         <?php
             if(isset($_GET['id']))
             {
                 $id=$_GET['id'];
             }
          ?>

            <form action="" method="POST">
             
               <table class="tbl-30">
                 <tr>
                     <td>Current password: </td>
                     <td><input type="password" name="current_password" placeholder="current password"></td>
                 </tr>
                 <tr>
                     <td>New Password: </td>
                     <td><input type="password" name="new_password" placeholder="New password"></td>
                 </tr>
                 <tr>
                     <td>Confirm password: </td>
                     <td><input type="password" name="confirm_password" placeholder="confirm password"></td>
                 </tr>
                 <tr>
                     <td colspan="2">
                         <input type="hidden" name="id" value="<?php echo $id; ?>">
                         <input type="submit" name="submit" value="change" class="btn-primary">
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
       $current_password=md5($_POST['current_password']);
       $new_password=md5($_POST['new_password']);
       $confirm_password=md5($_POST['confirm_password']);
       // checking whether the password is in our datra or not
       $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
       //excuting quarry
       $res = mysqli_query($conn,$sql);

       if($res==true)
       {
           $count=mysqli_num_rows($res);
           if($count==1)
           {
             
             if($new_password==$confirm_password)
             {
               //creating quary
               $sql2="UPDATE tbl_admin SET password='$new_password' WHERE id=$id";

               $res2=mysqli_query($conn,$sql2);
               if($res2==true)
               {
                   
                 $_SESSION['pwd-change']="<div class='sucsess'>password changed</div>"; 
                 header('location:'.SITEURL.'admin/manage-admin.php');
               }
               else
               {
                 
                 $_SESSION['pwd-change']="<div class='faliure'>password not changed</div>"; 
                 header('location:'.SITEURL.'admin/manage-admin.php');
               }

             }
             else
             {
                
                
                  $_SESSION['pwd-not-match']="<div class='faliure'>password not match</div>"; 
                 header('location:'.SITEURL.'admin/manage-admin.php');
             }
           }
           else
           {
              $_SESSION['user-not-found']="<div class='faliure'>not found</div>"; 
              header('location:'.SITEURL.'admin/manage-admin.php');
           }
       }
   }
 ?>


<?php include('partials/footer.php'); ?>