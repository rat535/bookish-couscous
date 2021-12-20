<?php include('partials/menu.php'); ?>

<?php
   //check wheter the id is set or not
   if(isset($_GET['id']))
   {
      //Get all the details
      $id=$_GET['id'];
      //sql quary
      $sql2="SELECT * FROM tbl_food WHERE id=$id";
      //excuting qyary
      $res2=mysqli_query($conn, $sql2);

      //getting all the values in the form of array
      $row2=mysqli_fetch_assoc($res2);

      $tittle =$row2['tittle'];
      $description=$row2['description'];
      $price=$row2['price'];
      $current_image=$row2['image_name'];
      $current_category=$row2['category_id'];
      $feature=$row2['feature'];
      $active=$row2['active'];
   }
?>
<div class="main-content">
  <div class="wrapper">
     <h1>UPDATE</h1>
     <br><br><br>


     <form action="" method="POST" enctype="multipart/form-data">
         <table class="tbl-30">
            <tr>
               <td>Tittle: </td>
               <td><input type="text" name="tittle" value="<?php echo $tittle; ?>"></td>
            </tr>

            <tr>
               <td>Description: </td>
               <td><textarea name="description"  cols="30" rows="10" ><?php echo $description; ?></textarea></td>
            </tr>

            <tr>
               <td>Price: </td>
               <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
           </tr>

           <tr>
              <td>Curent image:</td>
              <td>
                  <?php
                     if($current_image=="")
                     {
                        echo "<div class='faliuer'> image not avialabel</div>";
                     }
                     else
                     {
                       ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" alt="<?php echo $tittle; ?>"width="150px">
                       <?php
                     }
                  ?>
              </td>
           </tr>

           <tr>
             <td>New image: </td>
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
                        $category_tittle=$row['tittle'];
                        $category_id=$row['id'];
                        // echo "<option value='$category_id'>$category_tittle</option>";
                        ?>
                        <option <?php if($current_category==$category_id){ echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_tittle; ?></option>
                       <?php
                     }
               

                   }
                   else
                   {
                      echo "<option value='0'> No category </option>";
                     
                   }
                 ?>
                    <option value="0">food</option>
                 </select>
              </td>
           </tr>

           
            <tr>
               <td>Feature: </td>

              <td>
                  <input <?php if($feature=="Yes"){echo "checked" ;}?> type="radio" name="feature" value="Yes">Yes
                  <input <?php if($feature=="No"){echo "checked" ;}?> type="radio" name="feature" value="No">No
              </td>
          </tr>

          
           <tr>
              <td>Active: </td>

              <td>
                <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active=="No"){echo "checked"; }?> type="radio" name="active" value="No">No
              </td>
           </tr>

           <tr>
              <td>
                 <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                 <input type="submit" name="submit" value="update" class="btn-primary">
              </td>
           </tr>

         </table>
     </form>

     <?php
       if(isset($_POST['submit']))
       {
          //Get all the details from form
          $id=$_POST['id'];
          $tittle=$_POST['tittle'];
          $description=$_POST['description'];
          $price=$_POST['price'];
          $current_image=$_POST['current_image'];
          $category=$_POST['category'];
          $feature=$_POST['feature'];
          $active=$_POST['active'];
          //upload the image if selected
          if(isset($_FILES['image']['name']))
          {
             //upload button clicked
             $image_name=$_FILES['image']['name'];
             //check whether the file is availabel or not
             if($image_name !="")
             {

                $ext=end(explode('.', $image_name));


                $image_name="food".rand(000,999).'.'.$ext ;
                //sourcepath
                $src_path = $_FILES['image']['tmp_name'];
                //destination path
                 $dst_path= "../images/food/".$image_name;
                //finally upload the image
                 $upload = move_uploaded_file($src_path, $dst_path);

                 if($upload==false)
                 {
                   $_SESSION['upload']="<div class='faliure'> failed to upload </div>";
                    header('location:'.SITEURL.'admin/add-food.php');
                    die();
                 }

                //Remove current image
                 if($current_image!="")
                 {
                   $remove_path="../images/food".$current_image;
                   $remove=unlink($remove_path);
                   //checking wether the image is uploded or not
                   if($remove==false)
                   {
                      $_SESSION['remove-failed']="<div class='faliure'> error to remove image</div>";
                      header('location:'.SITEURL.'admin/manage-food.php');
                       die();
                   }
                  }
               }
               else
               {
                  $image_name=$current_image; 
               }

            }
          else
          {
            $image_name=$current_image;
          }

          //update the food in database
           $sql3="UPDATE tbl_food SET tittle='$tittle', description='$description', price=$price, image_name='$image_name',category_id='$category',feature='$feature', active='$active' WHERE id=$id";
          $res3=mysqli_query($conn,$sql3);
          if($res3==true)
          {
             
            $_SESSION['update']="<div class='sucsess'> uploded succsessfull</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
          }
          else
          {
             $_SESSION['update']="<div class='faliure'> error to upload</div>";
             header('location:'.SITEURL.'admin/manage-food.php');
          }
         }
       
      ?>
 </div>
</div>

<?php include('partials/footer.php'); ?>