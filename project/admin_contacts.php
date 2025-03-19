<?php

include 'components/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (isset($_GET['delete'])) {
   $message_id = $_GET['delete'];
   $delete_query = "DELETE FROM `message` WHERE `id` = '$message_id'";
   $result = mysqli_query($conn, $delete_query);
   if ($result) {
       echo '<script>alert("Message deleted successfully."); window.location.href = "admin_contacts.php";</script>';
   } else {
       echo '<script>alert("Failed to delete message."); window.location.href = "admin_contacts.php";</script>';
   }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_contact.css">

</head>
<body>


<section class="messages">

   <nav class="navbar bg-body-tertiary">
      
      <div style="margin-bottom: 2rem;">
            <a class="btn btn-outline-success me-2" type="button" href="admin/dashboard.php"><&nbsp;HOME</a>
            <h1 class="title">MESSAGES</h1>
         </div>   
      </div>
      
      
   </nav>


   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
   <div class="box">
      <p> id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
      <p> name : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> number : <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> email : <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> message : </p>
      <div style="width: 300px; height: 200px; overflow-y: auto; font-size: 19px; margin-bottom: 1.5rem;">
         <span style="word-wrap: break-word; user-select: text;">
            <?php echo $fetch_message['message']; ?>
         </span>
      </div>
      <div style="text-align: center;">
         <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>
      </div>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">you have no messages!</p>';
   }
   ?>
   </div>

</section>




<!-- custom admin js file link  -->
<script>

let navbar = document.querySelector('.header .navbar');
let accountBox = document.querySelector('.header .account-box');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   accountBox.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   accountBox.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   accountBox.classList.remove('active');
}

document.querySelector('#close-update').onclick = () =>{
   document.querySelector('.edit-product-form').style.display = 'none';
   window.location.href = 'admin_products.php';
}

</script>

</body>
</html>