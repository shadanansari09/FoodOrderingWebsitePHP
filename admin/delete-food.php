<?php
//include constants
include('../config/constants.php');
//echo "delete FOOD PAGE";

if(isset($_GET['id']) && isset($_GET['image_name'])  )
{
    //proceed to delete 
   // echo "Process to delete";

   //1. get id and image name
    $id= $_GET['id'];
    $image_name= $_GET['image_name'];


   //2. remove the image if available
//check whthr the image is available or not
if($image_name!="")
  
{
      //image is available and need to be deleted
      //get the image path
    $path = "../images/food/".$image_name;
    //remove image from the folder
    $remove = unlink($path);

    //check whtr the image is removed or not
    if($remove==false)
    {
        //failed to remove the image
        $_SESSION['upload']="<div class='error'>Failed to remove the image</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
        //stop the process
        die();
    }
}
   //3.delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    //execute the query
    $res= mysqli_query($conn, $sql);

    //check whthr the query was executed or not and set session msg respectively
     //4.redirect to manage-food page with session message
    if($res==true)
    {
        //food deleted
        $_SESSION['delete']= "<div class='success'>Food deleted successfully!</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //failed to delete
        $_SESSION['delete']= "<div class='error'>Failed to delete food!</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

  


}
else
{
    //redirect to manage food page
    //echo "redirect";    
    $_SESSION['unauthorize']= "<div class='error'>Unauthorized Access!</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>