<?php

// Include constants.php file here
include('../config/constants.php');

// 1. Get the ID of admin to be deleted
$id = $_GET['id'];

// 2. Create SQL query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the query
$res = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if ($res==true)
{
    // Query executed successfully and Admin deleted
    // echo "Admin Deleted";
    // Create session variable to display message
    $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfully </div>";
    // Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    // Failed to delete admin
    // echo "Failed to Delete Admin";
    $_SESSION['delete'] = "<div class='error> Failed to Delete Admin. Try Again Later </div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
// 3. Redirect to Manage Admin page with message (success/error)
?>