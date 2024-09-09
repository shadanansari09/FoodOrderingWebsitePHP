<?php include('front-partials/menu.php'); ?>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

.submit {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.submit a{
  text-decoration:none;
  color:black;
  font-weight:bold;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.form {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>

<div class="container">
    <div class="form">

        <form action="">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Your name..">
            
            <label for="contact_no">Contact No</label>
            <input type="text" name="contact_no" placeholder="Your no..">
            
            <label for="message">Message</label>
            <textarea name="message" placeholder="Write something.." style="height:200px"></textarea>
            
            <button class="submit">
              <a href="https://www.facebook.com/hukumfooddelivery/">
              Submit
            </a>
            </button>
        
        </form>
    </div>
</div>

</body>


<?php include('front-partials/footer.php'); ?>