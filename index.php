<?php include('front-partials/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->
        <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>


    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
            
            //display all the categories
            $sql= "SELECT * FROM tbl_category WHERE active='Yes' && featured='Yes' LIMIT 3";

            //execute the query
            $res= mysqli_query($conn, $sql);
            //count rows
            $count= mysqli_num_rows($res);

            //check whether categories are available or not
            if($count>0)
            {
                //categories available
                while($row = mysqli_fetch_assoc($res))
                {
                    //get the data from database
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name= $row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                            //check if image is available or not
                            if($image_name=="")
                            {
                                //image unavailable
                                echo "<div class='error'>Image Unavailable!</div>";
                            }
                            else{
                                //Image available
                                ?>
                          <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-size img-curve">
                                 <?php
                            }
                            
                            ?>

                           <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
                    <?php
                }
            }
            else
            {
                //categories unavailable
                echo "<div class='error'>Categories Unavailable!</div>";
            }

            
            ?>

           

            
            <div class="clearfix"></div>

        </div>
        <p class="text-center">
        <a href="<?php echo SITEURL;?>categories.php">see more</a>
        </p>
    </section>

    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

        <?php
        //gettint food from database that are active and featured
        
        //create sql query
        $sql2= "SELECT * FROM tbl_food WHERE active='Yes' && featured='Yes' LIMIT 6";

        //executing the sql query
        $res2= mysqli_query($conn, $sql2);

        //counting the rows
        $count2= mysqli_num_rows($res2);

        //check whther food available or not
        if($count2>0)
        {
            //food available
            while($row2= mysqli_fetch_assoc($res2))
            {
                $id= $row2['id'];
                $title=$row2['title'];
                $price= $row2['price'];
                $description= $row2['description'];
                $image_name= $row2['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                    <?php
                    //check whther image available or not
                    if($image_name=="")
                    {
                        //unavailable
                        echo "<div class='error'>Image Unavailable</div>";
                    }
                    else{
                        //available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                        <?php

                    }
                    ?>

                        
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?>Rs.</p>
                        <p class="food-detail">
                        <?php echo $description; ?>
                        </p>
                        <br>
                            
                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>


                <?php
            }
        }
        else{
            //food unavailable
            echo "<div class='error'>NO FOODS TO DISPLAY</div>";
        }
        ?>


           
          


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
   <?php include('front-partials/footer.php'); ?>