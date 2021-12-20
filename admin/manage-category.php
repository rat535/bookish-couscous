<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE CATEGORY </h1>
        <br><br><br>

        <?php
          
          if(isset($_SESSION['add']))
          {
              echo $_SESSION['add'];
              unset($_SESSION['add']);
          }

          if(isset($_SESSION['remove']))
          {
              echo $_SESSION['remove'];
              unset($_SESSION['remove']);
          }

          if(isset($_SESSION['delete']))
          {
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
          }

          if(isset($_SESSION['no-category-found']))
          {
              echo $_SESSION['no-category-found'];
              unset($_SESSION['no-category-found']);
          }

          if(isset($_SESSION['update']))
          {
              echo $_SESSION['update'];
              unset($_SESSION['update']);
          }

          
          if(isset($_SESSION['upload']))
          {
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
          }

          
          if(isset($_SESSION['failed-remove']))
          {
              echo $_SESSION['failed-remove'];
              unset($_SESSION['failed-remove']);
          }


        ?>

        
        <br><br>

        <a href="<?php echo SITEURL?>admin/add-category.php" class="btn-primary">Add Category</a>

     <br><br>

         <table class="tbl-full">
             <tr>
                 <th>S.NO</th>
                 <th>tiitle</th>
                  <th>Image</th>
                  <th>feature</th>
                  <th>Active</th>
                  <th>Action</th>
              </tr>

              <?php  
                  $sql="SELECT * FROM tbl_category";
                  
                  $res=mysqli_query($conn,$sql);
                  
                  $count=mysqli_num_rows($res);
                  
                  $sn=1;

                  if($count>0)
                  {
                    while($row=mysqli_fetch_assoc($res))
                    {
                       $id=$row['id'];
                       $tittle=$row['tittle'];
                       $image_name=$row['image_name'];
                       $feature=$row['feature'];
                       $active=$row['active'];
                       
                       
                       ?>
                           <tr>
                              <td><?php echo $sn++;?></td>
                              <td><?php echo $tittle; ?></td>
                              
                              <td>
                                  <?php  
                                      
                                      if($image_name!="")
                                      {
                                          ?>
                                             <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width=100px>
                                          <?php
                                      }
                                      else
                                      {
                                          echo "<div class='faliure'>image not found</div>";
                                      }
                                      
                                  ?>
                              </td>

                              <td><?php echo $feature; ?></td>
                              <td><?php echo $active; ?></td>
                              <td>
                                  <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-primary">Update</a>
                                  <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-delete"> delete</a>
                              </td>
                            </tr>
                        <?php

                    }
                  }
                  else
                  {
                    //whene we dont have data
                    ?>
                       <tr>
                         <td colspan="6"><div class="faliure">no category</div></td>
                       </tr>

                    <?php
                  }
              ?>

              
            
         </table>
    </div>
</div>

<?php include('partials/footer.php');?> 