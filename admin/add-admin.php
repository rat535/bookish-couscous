<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br><br>
        <?php 
          if(isset($_SESSION['add']))
          {
              echo $_SESSION['add'];
              unset($_SESSION['add']);
          }

        
        ?>

        <br><br><br>


       
        <form action="" method="POST">

        
          <table class="tbl-30">
              <tr>
                  <td>full name</td>
                  <td><input type="text" name="full_name" placeholder="enter the name"></td>
             </tr>

             <tr>
                  <td>username</td>
                  <td><input type="text" name="username" placeholder="enter username"></td>
             </tr>

              <tr>
                  <td>password</td>
                 <td><input type="password" name="password" placeholder="enter password"></td>
              </tr>

             <tr>
                 <td colspan="2">
                     <input type="submit" name="submit" value="add admin" class="btn-primary">
                 </td>
             </tr>
          </table>
        
        </form>

    </div>
</div>

<?php include('partials/footer.php');?>

<?php  
    if (isset($_POST['submit']))
   {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password =md5($_POST['password']);

        $sql = "INSERT INTO tbl_admin SET full_name='$full_name', username='$username', password='$password'";
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
     
     
     
     if($res==TRUE){
         //echo"data inserted";
         $_SESSION['add'] = "Admin added successfully";
         // location to manage admin
         header("location:".SITEURL.'admin/manage-admin.php');
        }
     else{
         //echo"data not inserted";

         $_SESSION['add'] = "Admin  not added";
         header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>