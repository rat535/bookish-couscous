<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE FOOD </h1>

        <br><br>

        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br><br>
        <?php
           
           if(isset($_SESSION['add']))
           {
               echo $_SESSION['add'];
               unset($_SESSION['add']);
           }

           if(isset($_SESSION['delete']))
           {
               echo $_SESSION['delete'];
               unset($_SESSION['delete']);
           }

           if(isset($_SESSION['upload']))
          {
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
          }

          if(isset($_SESSION['unauthrize']))
          {
              echo $_SESSION['unauthrize'];
              unset($_SESSION['unauthrize']);
          }

          if(isset($_SESSION['update']))
          {
              echo $_SESSION['update'];
              unset($_SESSION['update']);
          }

          
 
        ?>

        <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.NO</th>
                        <th>Tittle</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Feature</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                    <?php
                      //get all values from database
                      $sql="SELECT * FROM tbl_food";
                      $res=mysqli_query($conn,$sql);
                      //count the number of rows
                      
                      $count=mysqli_num_rows($res);
                      
                      $sn=1;
                      if($count>0)
                      {
                          while($row=mysqli_fetch_assoc($res))
                          {
                             $id= $row['id'];
                             $tittle= $row['tittle'];
                             $price= $row['price'];
                             $image_name= $row['image_name'];
                             $feature= $row['feature'];
                             $active= $row['active'];
                                ?>
                                
                                 <tr>
                                   <td><?php echo $sn++; ?></td>
                                   <td><?php echo $tittle; ?></td>
                                   <td><?php echo $price; ?></td>
                                   <td>
                                      <?php
                                         if($image_name=="")
                                         {
                                            echo "<div calss='faliure'>no image </div>"; 
                                         }
                                         else
                                         {
                                            ?>
                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" width="150px">
                                            <?php
                                         }
                                      ?>
                                    </td>
                                    <td><?php echo $feature; ?></td>
                                    <td><?php echo $active;?></td>
                                  <td>
                                        <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-primary">Update</a>
                                        <a href="<?php echo SITEURL ;?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-delete"> delete</a>
                                  </td>
                                 </tr>
                             <?php
                             
                            }
                      }
                      else
                      {
                          echo "<tr><td colsapan='7' class='faliure'>Food not found</td></tr>";
                      }
                    ?>
                   

                </table>
     </div>
</div>

<?php include('partials/footer.php');?>