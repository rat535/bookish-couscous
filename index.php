<?php include('partials-font/menu.php'); ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
              <input type="search" name="search" placeholder="Search for Food.." required>
              <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
       
       if(isset($_SESSION['order']))
       {
           echo $_SESSION['order'];
           unset($_SESSION['order']);
       }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
             //creating the sql to display category from data base
             $sql="SELECT * FROM tbl_category WHERE active='Yes' AND feature='Yes' ";
             $res=mysqli_query($conn,$sql);
             //for counting the rows
             $count=mysqli_num_rows($res);
             if($count>0)
             {
                 while($row=mysqli_fetch_assoc($res))
                 {
                     $id=$row['id'];
                     $tittle=$row['tittle'];
                     $image_name=$row['image_name'];
                     ?>
                       
                       <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                          <div class="box-3 float-container">
                             <?php
                               if($image_name=="")
                               {
                                   echo "<div class='faliuer'> No image</div>";
                               }
                               else
                               {
                                 ?>
                                 <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                 <?php 
                               }
                             ?>


                              <h3 class="float-text text-white"><?php echo $tittle; ?></h3>
                          </div>
                      </a>

                     <?php

                 }
             }
             else
             {
                 echo "<div class'faliure'> No category founnd</div>";
             }
            ?>

          

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
               // geting all the dat afrom database 
               $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND feature='Yes'";
               $res2=mysqli_query($conn,$sql2);
               //count the data 
               $count=mysqli_num_rows($res2);
               //checking wheteher food is avialabel or not
               if($count>0)
               {
                  while($row=mysqli_fetch_assoc($res2))
                  {
                      $id=$row['id'];
                      $tittle=$row['tittle'];
                      $price=$row['price'];
                      $description=$row['description'];
                      $image_name=$row['image_name'];
                      ?>
                        
                        
                        <div class="food-menu-box">
                          <div class="food-menu-img">
                              <?php
                                 //check wether the imahe is av availabel or not
                                 if($image_name =="")
                                 {
                                    echo "<div class=='faliuer'> no image availabel</div>";

                                 }
                                 else
                                 {
                                   ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="food" class="img-responsive img-curve">
                                   <?php
                                 }
                              ?>
                           </div>

                          <div class="food-menu-desc">
                             <h4><?php echo $tittle; ?></h4>
                             <p class="food-price">₹<?php echo $price; ?></p>
                             <p class="food-detail">
                                 <?php echo $description; ?>
                             </p>
                              <br>

                              <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                           </div>
                       </div>
                      <?php
                  }
               }
               else
               {
                   echo "<div class='faliure'> no food avialabel </div>";
               }
            ?>


            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

 <?php include('partials-font/footer.php');?>