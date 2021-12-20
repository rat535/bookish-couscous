<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>ADD FOOD</h1>
    <br><br>

    <?php
       
        if(isset($_SESSION['upload']))
        {
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }
    ?>


    <form action="" method="POST" enctype="multipart/form-data">
     <table calss="tbl-30">
        <tr>
          <td>Tittle: </td>
          <td><input type="text" name="tittle" placeholder="enter tittle"></td>
        </tr>

        <tr>
            <td>Description: </td>
            <td><textarea name="description"  cols="30" rows="10" placeholder="description about food"></textarea></td>
        </tr>

        <tr>
            <td>Price: </td>
            <td><input type="number" name="price"></td>
        </tr>

        <tr>
            <td>Select Image: </td>
            <td><input type="file" name="image"></td>
        </tr>

        <tr>
            <td>Category: </td>
            <td>
              <select name="category">
                 <?php 
                    $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                    $res=mysqli_query($conn, $sql);
                    $count=mysqli_num_rows($res);
                    if($count>0)
                    {
                       while($row=mysqli_fetch_assoc($res))
                       {
                           $id=$row['id'];
                           $tittle=$row['tittle'];
                           ?>
                           <option value="<?php echo $id; ?>"><?php echo $tittle; ?></option>
                           <?php
                       }
                    }
                    else
                    {
                        ?>
                         <option value="0">No category found</option>
                        <?php
                    }
                 ?>
               
              </select>
            </td>
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
                <input type="radio" name="actve" value="No">No
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add" class="btn-primary">
            </td>
        </tr>
     </table>
    </form>

    <?php
      //checking the submit btn clioked or not
      if(isset($_POST['submit']))
      {
        //get the data from form
         $tittle=$_POST['tittle'];
         $description=$_POST['description'];
         $price=$_POST['price'];
         $category=$_POST['category'];
         //for feature and active
         if(isset($_POST['feature']))
         {
             $feature=$_POST['feature'];
         }
         else
         {
             $feature="NO";
         }
         if(isset($_POST['active']))
         {
             $active=$_POST['active'];
         }
         else
         {
             $active="No";
         }
         //uploading the image
         if(isset($_FILES['image']['name']))
         {
              $image_name=$_FILES['image']['name'];

              $ext=end(explode('.', $image_name));


              $image_name="food".rand(000,999).'.'.$ext ;
             //sourcepath
             $src = $_FILES['image']['tmp_name'];
             //destination path
             $dst = "../images/food/".$image_name;
             //finally upload the image
             $upload = move_uploaded_file($src, $dst);
             //see wether the image is uploaded or not
              if($upload==false)
              {
                 $_SESSION['upload']="<div class='faliure'> failed to upload </div>";
                 header('location:'.SITEURL.'admin/add-food.php');
              }
          }
          else
         {
             $image_name="";
         }

         //insert data into data base
         $sql2="INSERT INTO tbl_food SET tittle='$tittle', description='$description', price=$price, image_name='$image_name', category_id=$category, feature='$feature', active='$active' ";
         $res2=mysqli_query($conn,$sql2);

         if($res2==true)
         {
             $_SESSION['add']="<div class='sucsess'>Added successfully</div>";
             header('location:'.SITEURL.'admin/manage-food.php');
         }
         else
         {
            
            $_SESSION['add']="<div class='faliure'> not Added error</div>";
             header('location:'.SITEURL.'admin/manage-food.php');
         }

        
        }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>