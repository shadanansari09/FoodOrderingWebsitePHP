<?php include('partials/menu.php'); ?>

   <!-- Main Content Section Starts -->
   <div class="main-content">
         <div class="wrapper">
            <h1>Manage Order</h1>
            <br /><br /><br />
            <?php 
            if(isset($_SESSION['update']))
            {
               echo $_SESSION['update'];
               unset($_SESSION['update']);
            }
            ?>
            <br><br>
            <table class="tbl-full">
            <thead>
               <tr>
                  <th style="min-width:50px;"> Sr.No</th>
                  <th style="min-width:100px;"> Food</th>
                  <th style="min-width:50px;"> Price</th>
                  <th style="min-width:50px;"> Qty.</th>
                  <th style="min-width:50px;"> Total</th>
                  <th style="min-width:100px;"> Order Date</th>
                  <th style="min-width:100px;"> Status</th>
                  <th style="min-width:150px;"> Cust. Name</th>
                  <th style="min-width:100px;"> Contact</th>
                  <th style="min-width:150px;"> Email</th>
                  <th style="min-width:260px;"> Add.</th>
                  <th > Action</th>
               </tr>
             </thead>
               <?php
                  //create sql query to get data from database
                  $sql= "SELECT * FROM tbl_order";
                  //execute the sql query
                  $res= mysqli_query($conn, $sql);
                  //count the rows
                  $count= mysqli_num_rows($res);

                  $sn= 1; //create a serail number and set its initial value as 1

                  if($count>0)
                  {
                     //order available
                     while($row= mysqli_fetch_assoc($res))
                     {
                        //get all the order details
                        $id= $row['id'];
                        $food= $row['food'];
                        $price= $row['price'];
                        $qty= $row['qty'];
                        $total= $row['total'];
                        $order_date= $row['order_date'];
                        $status = $row['status'];
                        $customer_name= $row['customer_name'];
                        $customer_contact= $row['customer_contact'];
                        $customer_email= $row['customer_email'];
                        $customer_address= $row['customer_address'];

                           ?>
                            <tr style=" border-collapse:separate; border-spacing:20px; border-width:medium;";>
                                 <td><?php echo $sn++; ?>.</td>
                                 <td><?php echo $food;?></td>
                                 <td><?php echo $price;?></td>
                                 <td><?php echo $qty;?></td>
                                 <td><?php echo $total;?></td>
                                 <td><?php echo $order_date;?></td>

                                 <td>
                                    <?php
                                    if($status=="Ordered")
                                    {
                                       echo "<label style= 'color:purple;'>$status</label>";
                                    } 
                                    elseif ($status=="Dispatched") {
                                       echo "<label style= 'color:orange;'>$status</label>";
                                    }
                                    elseif ($status=="Delivered"){
                                       echo "<label style= 'color:green;'>$status</label>";
                                    }
                                    elseif ($status=="Cancelled") {
                                       echo "<label style= 'color:red;'>$status</label>";
                                    }
                                    ?>
                                    </td>
                                       

                                 <td><?php echo $customer_name;?></td>
                                 <td><?php echo $customer_contact;?></td>
                                 <td><?php echo $customer_email;?></td>
                                 <td><?php echo $customer_address;?></td>
                                 <td>
                                 <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a> 
                                 
                              
                              </td>
                              </tr>

                           <?php

                     }
                  }
                  else{
                     //order unavailable
                     echo "<tr><td colspan='12' class='error'>Order not available</td></tr>";
                  }
               ?>

                 
            </table>
        </div>
        </div>
        <!-- Main Content Section Ends -->

        <?php include('partials/footer.php'); ?>