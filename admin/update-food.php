<?php include('partials/menu.php');?>
<?php 
//check whether the id is set or not
if(isset($_GET['id']))
{
    //get all the details
    $id= $_GET['id'];

    //create sql query
    $sql2= "SELECT * FROM tbl_food WHERE id=$id";
    
    //execute the query
    $res2= mysqli_query($conn, $sql2);
    
    //get the value based on query executed
    $row2= mysqli_fetch_assoc($res2);

    //get the individual values of selected food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category= $row2['category_id'];
    $featured= $row2['featured'];
    $active= $row2['active'];
    
}
else{
    //redirct to manage-food
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>

<div class="main-content">
    <div class="wrapper">
     <h1>Update Food</h1> 
     <br><br>

     <form action="" method="POST" enctype="multipart/form-data">

     <table class="tbl-30">
     <tr>
        <td>TITLE:</td>
        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
    </tr>

<tr>
    <td>Description:</td>
    <td>
        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
    
    </td>
</tr>

<tr>
<td>Price: </td>
<td>
    <input type="number" name="price" value="<?php echo $price; ?>">
</td>
</tr>

<tr>
<td>Current Image:</td>
<td>
<?php 
if($current_image=="")
{
    //image unavailable
    echo "<div class='error'>Image not available!</div>";
}
else
{
    ?>
    
        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="120px">
<?php


}


?>   

</td>
</tr>
<tr>
    <td>Select New Image:</td>
    <td><input type="file" name="image" ></td>
</tr>

<tr>
<td>Category:</td>
<td>    
<select name="category">
<?php
$sql ="SELECT * FROM tbl_category WHERE active='Yes'";
//executing query
$res = mysqli_query($conn, $sql);
//count rows
$count= mysqli_num_rows($res);
//check if category is available or not
if($count>0){
    //we have categories
    while($row=mysqli_fetch_assoc($res))
    {
        $category_title=$row['title'];
        $category_id= $row['id'];

       // echo "<option value='$category_id'>$category_title</option>";
       ?>
       
       <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id;?>"><?php echo $category_title; ?></option>
       <?php
    }

    }
else{
    //we do not have categories
    
   echo "<option value='0'>Categories Unavailable</option>";
}

?>
</select> 
</td>
</tr>

<tr>
    <td>Featured:</td>
    <td><input <?php if($featured=="yes"){echo "Checked";} ?> type="radio" name="featured" value="yes">Yes
<input <?php if($featured=="no"){echo "Checked";} ?> type="radio" name="featured" value="no">No 
</td>
</tr>

<tr>
    <td>Active:</td>
    <td><input <?php if($active=="yes") {echo "Checked";} ?> type="radio" name="active" value="yes">Yes
<input <?php if($active=="no") {echo "Checked";} ?> type="radio" name="active" value="no">No </td>
</tr>

<tr>
<td>

<input type="hidden" name="id" value="<?php echo $id; ?>"> 
<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
</td>
<td>
    <input type="submit" class="btn-danger" value="Cancel" formaction="<?php echo SITEURL; ?>admin/manage-food.php">
</td>

</tr>


     </table>

     </form>
     
<?php
if(isset($_POST['submit']))
{
  //  echo "Button Clicked";
  //1. get all the details from the form
$id = $_POST['id'];
$title= $_POST['title'];
$description= $_POST['description'];
$price= $_POST['price'];
$current_image= $_POST['current_image'];
$category= $_POST['category'];

$featured= $_POST['featured'];
$active= $_POST['active'];

  //2.upload the image if selected 

  //check whthr upload button is clicked or not
  if(isset($_FILES['image']['name']))
  {
      //ipload button clicked
      $image_name= $_FILES['image']['name'];//new image name

      //check whthr the file is available or not
      if($image_name!="")
      {
          //image available
          //rename the image
          $ext= end(explode('.', $image_name)); //gets the extension 
          $image_name= "Food-Name-".rand(0000, 9999).'.'.$ext;// this will be renamed image

          //get the source path and destination path
          $src_path = $_FILES['image']['tmp_name']; //Source path
          $dest_path= "../images/food/".$image_name; //Destinattiion path

          //upload the image
          $upload= move_uploaded_file($src_path, $dest_path);

          //check whthr the image is uploaded or not
          if($upload==false)
          {
              $_SESSION['upload']= "<div class='error'>Failed to upload </div>";
              //redirect to manage food
           
           header('location:'.SITEURL.'admin/manage-food.php');
           //stop the process
           die();
          }

          //remove current image if available
          if($current_image!="")
          {
              //current image is available
              //remove the image
              $remove_path= "../images/food/".$current_image;

              $remove= unlink($remove_path);
            
              //check if image removed or not
              if($remove==false)
              {
                  //failed to remove image
                  $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image</div>";
                  //redirect to manage food
                  header('location:'.SITEURL.'admin/manage-food.php');
                  //stop the process
                  die();
              }
          }
          else
          {
              $image_name= $current_image; //default value when image is not selected
          }
      }
      else{
        $image_name= $current_image; //default value when button is not clicked
       }
  }


   //4. update the food in database
        $sql3= "UPDATE tbl_food SET
        title= '$title',
        description= '$description',
        price= $price,
        image_name= '$image_name',
        category_id= '$category',
        featured= '$featured',
        active= '$active'
        WHERE id=$id

        ";

        //execute the sql query
        $res3= mysqli_query($conn, $sql3);

        //check whthr the query is executed or not
        if($res3==true)
        {
            //query executed and Food updated 
            $_SESSION['update']= "<div class='success'>Food updated successfully!</div>";
            //redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            //failed to update food
            $_SESSION['update']= "<div class='error'>Failed to update food!</div>";
            //redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
        }
 
}

?>


    </div>
</div>



<?php 
include('partials/footer.php');
?>