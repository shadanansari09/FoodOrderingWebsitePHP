<?php include('partials/menu.php'); ?>

         <!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
            <br><br>

            <?php
                if(isset($_SESSION['add'])) //Checking whether the Session is set or not
                {
                    echo $_SESSION['add']; //Diplay the Session message if set
                    unset($_SESSION['add']); //Remove Session message
                }
            ?>

            <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name: </td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
            </tr>
            <tr>
                <td>Username: </td>
                <td><input type="text" name="username" placeholder="Your Username"></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" placeholder="Your Password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
        
    </div>
</div>
         <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>

<?php
    // Process the value from form and save it in Database

    // Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // echo"Done";

        // 1.Get the data from form
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']); // Password is encrypted by md5

    // 2.SQL Query to save the data into database
    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";

    // 3.Executing query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
 
    // 4.Check whether the (Query is executed) data is inserted or not and display appropriate message 
    if($res==TRUE)
    {
        // Data Inserted
        //echo "Data Inserted";
        //Create a session variable to display message
        $_SESSION['add'] = "<div class='success'> Admin Added Successfully </div>";
        // Redirect page to Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    } 
    else
    {
        //Failed to Insert Data
        //echo "Failed to Insert Data";
        //Create a session variable to display message
        $_SESSION['add'] = "Failed to Add Admin";
        // Redirect page to Add Admin
        header("location:".SITEURL.'admin/add-admin.php');
    }

    }
?>