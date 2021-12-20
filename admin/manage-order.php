<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <?php
           if(isset($_SESSION['update']))
           {
               echo $_SESSION['update'];
               unset($_SESSION['update']);
           }
        ?>
  
                <br  /><br  />
                <!-- button to addadmin-->
                <a href="#" class="btn-primary">Add Order</a>
                <table class="tbl-full">
                 <br /><br  />
                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th> Email</th>
                        <th> Address</th>
                        <th>Action</th>
                    </tr>
                    <?php
                      $sql="SELECT * FROM tbl_order ORDER BY  id DESC";
                      $res=mysqli_query($conn,$sql);
                      $count=mysqli_num_rows($res);
                      $sn = 1;
                      if($count>0)
                      {
                         while($row=mysqli_fetch_assoc($res))
                         {
                             $id=$row['id'];   
                             $food=$row['food'];
                             $price=$row['price'];
                             $qty=$row['qty'];
                             $total=$row['total'];
                             $oder_date=$row['oder_date'];
                             $status=$row['status'];
                             $customer_name=$row['customer_name'];
                             $customer_contact=$row['customer_contact'];
                             $customer_email=$row['customer_email'];
                             $customer_address=$row['customer_address'];
                             ?>

                               
                               
                              <tr>
                                  <td><?php echo $sn++; ?></td><br>
                                  <td><?php echo $food; ?></td>
                                  <td><?php echo $price; ?></td>
                                  <td><?php echo $qty;?></td>
                                  <td><?php echo $total; ?></td>
                                  <td><?php echo $oder_date; ?></td>
                                  <td>
                                     <?php
                                        if($status=="ordered")
                                        {
                                            echo "<label>$status</label>";
                                        }
                                        elseif($status=="in-progress")
                                        {
                                            echo "<label style='color:orange'>$status</label>";
                                        }
                                        elseif($status=="delivered")
                                        {
                                            echo "<label style='color:green'>$status</label>";
                                        }
                                        elseif($status=="cancelled")
                                        {
                                            echo "<label style='color:red'>$status</label>";
                                        }

                                     ?>
                                  </td>
                                  <td><?php echo $customer_name; ?></td>
                                  <td><?php echo $customer_contact; ?></td>
                                  <td><?php echo $customer_email; ?></td>
                                  <td><?php echo $customer_address; ?></td>
                                  <td>
                                       <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-primary">Update Order</a>
                                  </td>
                              </tr>

                             <?php
                           } 
                       }
                         
                      else
                      {
                          echo "<tr><td colspan='7' class='faliuer'>Order not availabel</td></tr>";
                      }
                    ?>

                  
                </table>
     </div>
                
</div>

<?php include('partials/footer.php'); ?>