<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
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

        <!-- Add category form starts here -->
        <form action="" method="POST" enctype="multipart/form-data">
        <table class=tbl-30>
        <tr>
            <td>Title</td>
            <td>
                <input type="text" name="title" placeholder="Category Title">
            </td>
        </tr>

        <tr>
            <td>Select Image: </td>
            <td>
                <input type="file" name='image'>
            </td>
        </tr>

        <tr>
            <td>Featured</td>
            <td>
                <input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
        </td>
        </tr>

        <tr>
            <td>Active</td>
            <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
            </td>
        </tr>

        </table>
        </form>
        <!-- Add category form ends here -->

        <?php

        //Check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            // echo "Clicked";

            // 1. Get the value from category form
            $title = $_POST['title'];

            // For radio input type, we need to check whether the buytton is selected or not
            if(isset($_POST['featured']))
            {
                // Get the value from form
                $featured = $_POST['featured'];
            }
            else{
                // Set the default value
                $featured = "No";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else{
                $active = "No";
            }

            // Check whether the image is selected or not and set the value for image name accordingly
            // print_r($_FILES['image']);
            // die(); //Break the code here

            if(isset($_FILES['image']['name']))
            {
                 //get the details of the selected image 
                 $image_name= $_FILES['image']['name'];
        
        
                 //check whthr the image is slected or not and upload only if selected 
                 if($image_name!="")
                 {
                     //image is selected
                     //A.rename the image
                     //get the extension of selected image
                    $ext=  end(explode('.',$image_name));
        
                    //create new name for image
                    $image_name= "food_category_".rand(0000,9999).".".$ext; //new img name
        
        
                     //B.upload the image
                     //get the src and destination path
        
                     //src path is the current location of the img
                     $src= $_FILES['image']['tmp_name'];
        
                     //destination pth for the image to be uploaded
                     $dst= "../images/category/".$image_name;
                     
                     //finally upload the foood imaage
                     $upload= move_uploaded_file($src, $dst);
        
                     //chck whthr img uploaded or not
                     if($upload==false)
                     {
                         //failed to uploadthe img
                         //redirect to add food page wth error msg
                         $_SESSION['upload']="<div class='error'>failed to upload the image </div>";
                         header('location:'.SITEURL.'admin/add-category.php');
                         //stop process
                         die();
                     }
        
                 }
        
                }
            else{
                $image_name = ""; //setting the default value as blank
            
            }

            // 2. Create SQL query to insert category into database
            $sql = "INSERT INTO tbl_category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            ";

            // 3. Execute the query and save in database
            $res = mysqli_query($conn, $sql);

            // 4. Check whether the query executed or not and data added or not
            if($res==true)
            {
                // Query executed and category added
                $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                // Redirect to Manage Category page
                header('location:'.SITEURL.'admin/manage-category.php');   
            }
            else
            {
                // Failed to add category
                $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
                // Redirect to Manage Category page
                header('location:'.SITEURL.'admin/add-category.php'); 
            }
        }

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>