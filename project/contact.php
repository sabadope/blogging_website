<?php

include 'components/connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if(isset($_POST['send'])){

   $name = $conn->quote($_POST['name']);
   $email = $conn->quote($_POST['email']);
   $number = $_POST['number'];
   $msg = $conn->quote($_POST['message']);

   $select_message = $conn->query("SELECT * FROM `message` WHERE name = $name AND email = $email AND number = '$number' AND message = $msg") or die('query failed');

   if($select_message->rowCount() > 0){
      $message[] = 'message sent already!';
   }else{
      $conn->query("INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', $name, $email, '$number', $msg)") or die('query failed');
      $message[] = 'message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/contact.css">

</head>
<body>


<div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">home</a> / contact </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box">
      <input type="email" name="email" required placeholder="enter your email" class="box">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea> <!-- max. 91 words -->
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>


<!-- custom js file link  -->
<script>

let userBox = document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () =>{
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   userBox.classList.remove('active');
}

window.onscroll = () =>{
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   if(window.scrollY > 60){
      document.querySelector('.header .header-2').classList.add('active');
   }else{
      document.querySelector('.header .header-2').classList.remove('active');
   }
}

</script>

</body>
</html>