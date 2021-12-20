<?php include('partials/menu.php');?>
<div class="main-content">
     <div class="wrapper">
         <h1>UPDATE</h1>
         <br><br>

         <?php
           //getting ht id
           if(isset($_GET['id']))
           {
             $id=$_GET['id'];
             //writtinf sql quarry
             $sql="SELECT * FROM tbl_category WHERE id=$id";
             //now runn the sql
             $res=mysqli_query($conn, $sql);

             $count=mysqli_num_rows($res);
             if($count==1)
             {
                //get all the data
                $row=mysqli_fetch_assoc($res);
                $tittle=$row['tittle'];
                $current_image=$row['image_name'];
                $feature=$row['feature'];
                $active=$row['active'];                

             }
             else
             {
                $_SESSION['no-category-found']="<div class='faliure'>no category found</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
             }
           }
           else
           {
              header('location:'.SITEURL.'admin/manage-category.php');
           }
       ?>


          <form action=""  method="POST" enctype="multipart/form-data" >
              <table class="tbl-30">
                  <tr>
                     <td>Tittle: </td>
                     <td>
                       <input type="text" name="tittle" value="<?php echo $tittle; ?>">
                     </td>
                 </tr>

                <tr>
                   <td>Current image:</td>
                   <td>
                      <?php
                         if($current_image != "")
                         {
                           ?>
                           <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>"width="150px" >
                           <?php
                         }
                         else
                         {
                            echo "<div class='faliure'> IMAGE not found</div>";
                         }
                      ?>
                   </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                      <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                   <td>Feature: </td>
                   <td>
                      <input <?php if($feature=="Yes"){echo "checked";} ?> type="radio" name="feature" value="Yes">Yes
                      
                      <input <?php if($feature=="No"){echo "checked";} ?>  type="radio" name="feature" value="No">No
                   </td>
                </tr>

                
                <tr>
                   <td>Active: </td>
                   <td>
                      <input <?php if($active=="Yes"){echo "checked";} ?>  type="radio" name="active" value="Yes">Yes
                      <input <?php if($active=="No"){echo "checked";} ?>  type="radio" name="active" value="No">No
                   </td>
                </tr>

                <tr>
                    <td>
                      <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                      <input type="hidden" name="id" value="<?php echo $id ;?>">
                      <input type="submit" name="submit" value="Update" class="btn-primary">
                   </td>
                </tr>
              </table>
           </form>
           <?php
              if(isset($_POST['submit']))
              {

                 $id=$_POST['id'];
                 $tittle=$_POST['tittle'];
                 $current_image=$_POST['image_name'];
                 $feature=$_POST['feature'];
                 $active=$_POST['active'];

                 //update image if selected
                 if(isset($_FILES['image']['name']))
                 {
                    $image_name=$_FILES['image']['name'];
                    
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
                         header('location:'.SITEURL.'admin/manage-category.php');
                          die();
                      }

                      //remove current image if image is available
                       if($current_image !="")
                      {
                       
                        
                         $remove_path="../images/category/".$current_image;

                         $remove=unlink($remove_path);

                         if($remove==false)
                         {
                            $_SESSION['failed-remove']="<div class='faliure'> falid to uploade image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
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
               

                //writting sql quary
                 $sql2="UPDATE tbl_category SET tittle='$tittle', image_name='$image_name', feature='$feature',  active='$active' WHERE id=$id ";
                 //excutting quary

                $res2=mysqli_query($conn, $sql2);

                if($res2==true)
                 {
                   $_SESSION['update']="<div class='sucsess'>Successfully updated the data</div>";
                   header('location:'.SITEURL.'admin/manage-category.php');
                 }
                else
                {
                   
                   $_SESSION['update']="<div class='faliure'>error to update</div>";
                   header('location:'.SITEURL.'admin/manage-category.php');
                 }
               }
         
            ?>
     </div>
</div>


<?php include('partials/footer.php'); ?>