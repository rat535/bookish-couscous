<?php include('../config/constant.php'); ?>
<html>
   <head>
      <title>Login page -food-order</title>
      <link rel="stylesheet" href="../css/admin.css">
   </head>
   <body>
       <div class="login">
           <h1 class="text-center">login</h1>
           <br><br>

           <?php
             
             if(isset($_SESSION['login']))
             {
                 echo $_SESSION['login'];
                 unset ($_SESSION['login']);
             }

             if(isset($_SESSION['no-login-message']))
             {
                 echo $_SESSION['no-login-message'];
                 unset ($_SESSION['no-login-message']);
             }
           ?>
           <br><br>

           <!-- form start -->
           <form action="" method="Post" class="text-center">
             Username:
             <input type="text" name="username" placeholder="enter your username"><br><br>
        
             Password:   
             <input type="password" name="password" placeholder="enter your password"><br><br>


             <input type="submit" name="submit" value="LOGIN" class="btn-primary">
           </form><br><br>
           <!-- form ends -->

           <p class="text-center">created by <a href="#">Ratnesh Tiwari</a> </p>
       </div>

   </body>
</html>

<?php
  //after clicking submit 
   if(isset($_POST['submit']))
   {
      $username=$_POST['username'];
      $password=md5($_POST['password']);
     //  writeing sql
     $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
      //  running sql
      $res=mysqli_query($conn,$sql);

      $count=mysqli_num_rows($res);

     if($count==1)
     {
         $_SESSION['login']="<div class='sucsess'>login successfull</div>";
         $_SESSION['user']=$username;
          header('location:'.SITEURL.'admin/');
    }
    else
    {
         $_SESSION['login']="<div class='faliure'> login unsuccessfull retry</div>";
          header('location:'.SITEURL.'admin/login.php');
      }
   }
 ?>     