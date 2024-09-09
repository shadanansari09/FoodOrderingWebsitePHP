<?php include('front-partials/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            
            //display all the categories
            $sql= "SELECT * FROM tbl_category WHERE active='Yes'";

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

                           <h3 class="float-text red"><?php echo $title; ?></h3>
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
            <div class="img-size"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('front-partials/footer.php'); ?>