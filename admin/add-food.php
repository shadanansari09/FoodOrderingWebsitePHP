<?php include('partials/menu.php'); ?>

<div class="main-content">

<div class="wrapper">
<h1>ADD FOOD</h1>


<br> <br>
<?php
if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
unset($_SESSION['upload']);

}
?>

<form action="" method="POST" enctype="multipart/form-data">

<table class="tbl-30">
    <tr>
        <td>TITLE:</td>
        <td><input type="text" name="title" placeholder="Title of the food"></td>
    </tr>

<tr>
    <td>Description:</td>
    <td>
        <textarea name="description" cols="30" rows="5" placeholder="description of the food"></textarea>
    
    </td>
</tr>

<tr>
<td>Price: </td>
<td>
    <input type="number" name="price">
</td>
</tr>

<tr>
<td>Select Image:</td>
<td>
    <input type="file" name="image">
</td>
</tr>

<tr>
<td>Category:</td>
<td>    
<select name="category">
<?php 

//create php code to display categories from database
//1.create sql to get all active categories from database
$sql ="SELECT * FROM tbl_category WHERE active='Yes'";
//executing query
$res = mysqli_query($conn, $sql);

//count rows to check whether we have cateegories or not

$count= mysqli_num_rows($res);

//if count is greater than 0 we have categories else we do not have categories
if($count>0){
    //we have categories
    while($row=mysqli_fetch_assoc($res))
    {
        //lets get the details of the category
        $id= $row['id'];
        $title=  $row['title'];
        ?>
        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
        <?php
    }
}
else{
    //we do not have categories
    ?>
    <option value="0">No categories to display</option>
    <?php
}

//2. display categories in the dropdown menu

?>

      </select></td>
</tr>

<tr>
    <td>Featured:</td>
    <td><input type="radio" name="featured" value="yes">Yes
<input type="radio" name="featured" value="no">No 
</td>
</tr>

<tr>
    <td>Active:</td>
    <td><input type="radio" name="active" value="yes">Yes
<input type="radio" name="active" value="no">No </td>
</tr>

<tr>
    <td colspan="2">
        <input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
</tr>

</table>



</form>

<?php
//check whether the button is clicked or not
if(isset($_POST['submit']))
{
    //add the food in database
   // echo "clicked";

    //1.get the data from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    //check whether the radio button for featured and active are checked or not
    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];
    }
    else
    {
        $featured= "No"; //this is default value now
    }

    if(isset($_POST['active']))
    {
        $active = $_POST['active'];
    }
    else
    {
        $active = "No"; //this is default value now
    }

    //2.upload the image if selected
    //check whthr the select image button is clicked or not
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
            $image_name= "food-name-".rand(0000,9999).".".$ext; //new img name


             //B.upload the image
             //get the src and destination path

             //src path is the current location of the img
             $src= $_FILES['image']['tmp_name'];

             //destination pth for the image to be uploaded
             $dst= "../images/food/".$image_name;
             
             //finally upload the foood imaage
             $upload= move_uploaded_file($src, $dst);

             //chck whthr img uploaded or not
             if($upload==false)
             {
                 //failed to uploadthe img
                 //redirect to add food page wth error msg
                 $_SESSION['upload']="<div class='error'>failed to upload the image </div>";
                 header('location:'.SITEURL.'admin/add-food.php');
                 //stop process
                 die();
             }

         }

        }
    else{
        $image_name = ""; //setting the default value as blank
    
    }

    //3.insert the data into database

    //create a SQL query to save or add food
    $sql2="INSERT  INTO tbl_food SET
    title= '$title',
    description= '$description',
    price = $price,
    image_name= '$image_name',
    category_id= $category,
    featured= '$featured',
    active= '$active'

    ";

        //execute the query
        $res2= mysqli_query($conn, $sql2);

        //check whether data inserted or not
         //4.redirect with msg to manage food page
        if($res2==true)
        {
            //data inserted successfully
            $_SESSION['add']= "<div class='success'>Food Added Successfully </div> "; 
            header('location:'.SITEURL.'admin/manage-food.php');

        }
else{
    //failed to insert data
            $_SESSION['add']= "<div class='error'>Failed to add Food </div> "; 
            header('location:'.SITEURL.'admin/manage-food.php');
}

   

}


?>

</div>
</div>

<?php include('partials/footer.php'); ?>