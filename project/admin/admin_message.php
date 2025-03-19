<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

   
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   
   // Prepare a DELETE query
   $delete_query = $conn->prepare("DELETE FROM `message` WHERE `id` = ?");
   $delete_query->execute([$id]);

   // Redirect to the same page after deleting the message
   header("Location: admin_message.php");
   exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile update</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap');

      :root{
         --purple:#4834d4;
         --red:#c0392b;
         --orange:#f39c12;
         --black:#34495e;
         --white:#fff;
         --light-color:#666;
         --light-white:#ccc;
         --light-bg:#f5f5f5;
         --border:.1rem solid var(--black);
         --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
      }

      *{
         font-family: 'Montserrat', sans-serif;
         margin:0; padding:0;
         box-sizing: border-box;
         outline: none; border:none;
         text-decoration: none;
         transition:all .2s linear;
      }

      *::selection{
         color:var(--white);
         background-color: var(--main-color);
      }

      *::-webkit-scrollbar{
         height: .5rem;
         width: 1rem;
      }

      *::-webkit-scrollbar-track{
         background-color: transparent;
      }

      *::-webkit-scrollbar-thumb{
         background-color: var(--purple);
      }

      html{
         font-size: 62.5%;
         overflow-x: hidden;
      }

      body{
         background-color: var(--light-bg);
      }

      section{
         padding:3rem 2rem;
      }

      .message{
         position: sticky;
         top:0;
         margin:0 auto;
         max-width: 1200px;
         background-color: var(--light-bg);
         padding:2rem;
         display: flex;
         align-items: center;
         justify-content: space-between;
         z-index: 10000;
         gap:1.5rem;
      }
      
      .message span{
         font-size: 2rem;
         color:var(--black);
      }
      
      .message i{
         cursor: pointer;
         color:var(--red);
         font-size: 2.5rem;
      }
      
      .message i:hover{
         transform: rotate(90deg);
      }
      
      .btn,
      .option-btn,
      .delete-btn,
      .white-btn{
         display: inline-block;
         margin-top: 1rem;
         padding:1rem 3rem;
         cursor: pointer;
         color:var(--white);
         font-size: 1.8rem;
         border-radius: .5rem;
         text-transform: capitalize;
      }
      
      .btn:hover,
      .option-btn:hover,
      .delete-btn:hover{
         background-color: var(--black);
      }
      
      .white-btn,
      .btn{
         background-color: var(--purple);
      }
      
      .option-btn{
         background-color: var(--orange);
      }
      
      .delete-btn{
         background-color: var(--red);
      }
      
      .white-btn:hover{
         background-color: var(--white);
         color:var(--black);
      }
      
      @keyframes fadeIn {
         0%{
            transform: translateY(1rem);
            opacity: .2s;
         }
      }

      .messages .box-container{
         display: grid;
         grid-template-columns: repeat(auto-fit, 35rem);
         justify-content: center;
         gap:1.5rem;
         max-width: 1200px;
         margin:0 auto;
         align-items: flex-start;
      }
      
      .messages .box-container .box{
         background-color: var(--white);
         padding:2rem;
         border:var(--border);
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
      }
      
      .messages .box-container .box p{
         padding-bottom: 1.5rem;
         font-size: 2rem;
         color:var(--light-color);
         line-height: 1.5;
      }
      
      .messages .box-container .box p span{
         color:var(--purple);
      }
      
      .messages .box-container .box .delete-btn{
         margin-top: 0;
      }

      .heading{
         margin-bottom: 2rem;
         font-size: 3rem;
         display: flex;
         flex-flow: column;
         align-items: center;
         justify-content: center;
         gap:1rem;
         background: url() no-repeat;
         background-size: cover;
         background-position: center;
         text-align: center;
      }
      
      .heading h3{
         color:var(--black);
         
      }
      
      .heading p{
         font-size: 2.5rem;
         color:var(--light-color);
      }
      
      .heading p a{
         color:var(--purple);
      }
      
      .heading p a:hover{
         text-decoration: underline;
      }
      
      @keyframes fadeIn {
         0%{
            transform: translateY(1rem);
            opacity: .2s;
         }
      }
   </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>

<div class="loader-container">
   <div class="loader">
   <div>
      <ul>
         <li>
         <svg fill="currentColor" viewBox="0 0 90 120">
            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
         </svg>
         </li>
         <li>
         <svg fill="currentColor" viewBox="0 0 90 120">
            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
         </svg>
         </li>
         <li>
         <svg fill="currentColor" viewBox="0 0 90 120">
            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
         </svg>
         </li>
         <li>
         <svg fill="currentColor" viewBox="0 0 90 120">
            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
         </svg>
         </li>
         <li>
         <svg fill="currentColor" viewBox="0 0 90 120">
            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
         </svg>
         </li>
         <li>
         <svg fill="currentColor" viewBox="0 0 90 120">
            <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
         </svg>
         </li>
      </ul>
   </div><span>Loading..</span></div>
   <div class="blur-background"></div>
</div>

<!-- admin profile update section starts  -->

<section class="messages">

   <div class="heading">
      <h3>messages</h3>
   </div>

   <div class="box-container">
      <?php
         $select_message = $conn->query("SELECT * FROM `message`") or die('query failed');
         if($select_message->rowCount() > 0){
            while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
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
            <a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>
         </div>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">you have no messages!</p>';
         }
      ?>
   </div>


</section>

<!-- admin profile update section ends -->









<!-- custom js file link  -->
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

<script>
   // Select the loader and background elements
   const loaderContainer = document.querySelector('.loader-container');
   const blurBackground = document.querySelector('.blur-background');

   // Show the loader and background on page load
   window.addEventListener('load', () => {
   loaderContainer.style.display = 'flex';
   blurBackground.style.display = 'block';
   });

   // Hide the loader and background after 3 seconds
   setTimeout(() => {
   loaderContainer.style.display = 'none';
   blurBackground.style.display = 'none';
   }, 3000);

</script>

</body>
</html>