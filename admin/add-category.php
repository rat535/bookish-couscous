<?php include('partials/menu.php'); ?>
<div class="main-content">
   <div class="wrapper">
      <h1>add category</h1>
      <br><br>
     <?php
      
        if(isset($_SESSION['add']))
        {
          echo $_SESSION['add'];
          unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload']))
        {
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }
     ?>
     <br><br>

     

      <form action="" method="POST" enctype="multipart/form-data">
         <table class="tbl-30">
            <tr>
              <td>Tittle: </td>
              <td><input type="text" name="tittle" placeholder="category tittle"></td>
            </tr>

            <tr>
                <td>Select img </td>
                <td><input type="file" name="image"></td>
               
            </tr>

            <tr>
              <td>Feature: </td>
              <td>
                <input type="radio" name="feature" value="Yes">Yes
                <input type="radio" name="feature" value="No">No
              </td>
            </tr>

            <tr>
               
              <td>Active: </td>
                <td>
                   <input type="radio" name="active" value="Yes">Yes
                   <input type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
               <td colspan="2">
                  <input type="submit"  name="submit" value="Add category" class="btn-primary">
               </td>
            </tr>
         </table>
      </form>

      <?php
         if(isset($_POST['submit']))
         {
            $tittle=$_POST['tittle'];

            if(isset($_POST['feature']))
            {
               $feature=$_POST['feature'];
            }
            else
            {
               $feature="No";
            }

            if(isset($_POST['active']))
            {
               $active=$_POST['active'];
            }
            else
            {
               $active="No";
            }
            //print_r($_FILES['image']);
           // die();

           
           if(isset($_FILES['image']['name']))
           {
               $image_name = $_FILES['image']['name'];

               if($image_name !="")
               {

                 $ext=end(explode('.', $image_name));


                 $image_name="food".rand(000,999).'.'.$ext ;

                 $source_path = $_FILES['image']['tmp_name'];

                 $destination_path = "../images/category/".$image_name;
 
                 $upload = move_uploaded_file($source_path, $destination_path);
                 
                 if($upload==false)
                 {
                     $_SESSION['upload'] ="<div class='failure'>Faield to upload image.</div>";
                     header('location:'.SITEURL.'admin/add-category.php');
                     die();
                  }

                  
               }
            }
           else
           {
               $image_name="";
           }

            $sql="INSERT INTO tbl_category SET tittle='$tittle', image_name='$image_name', feature='$feature', active='$active' ";
            
            $res=mysqli_query($conn,$sql);
            
            if($res==true)
            {
               $_SESSION['add']="<div class='sucsess'> category added successfully</div>";
               header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
               $_SESSION['add']="<div class='faliure'> category not addede</div>";
               header('location:'.SITEURL.'admin/add-category.php');
            }
         }
      ?>
   </div>
</div>


<?php include('partials/footer.php'); ?>