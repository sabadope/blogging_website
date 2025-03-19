<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

include 'components/like_post.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>posts</title>

    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap');

        /* Variables */
        *{
            font-style: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
            scroll-padding-top: 2rem;
            box-sizing: border-box;
        }



        :root{
            --container-color: #1a1e21 ;
            --second-color: #fd8f44;
            --text-color: #172317;
            --bg-color: #fff;
        }

        ::selection{
            color: var(--bg-color);
            background: var(--second-color);
        }

        a{
            text-decoration: none;
        }

        li{
            list-style: none;
        }

        img{
            width: 100%;
        }

        section{
            padding: 3rem 0 2rem;
        }

        .container{
            max-width: 1068px;
            margin: auto;
            width: 100%;
        }

        /* Header */
        header{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 200;
        }

        header.shadow{
            background: var(--bg-color);
            box-shadow: 0 1px 4px hsl(0 4% 14% / 10%);
            transition: 0.4s;
        }
        header.shadow .logo{
            color: var(--text-color);
        }

        .nav{
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 0;
        }

        .logo{
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--bg-color);
        }

        .logo span{
            color: var(--second-color);
        }

        .login{
            padding: 8px 14px;
            text-transform: uppercase;
            font-weight: 500;
            border-radius: 4px;
            background: var(--second-color);
            color: var(--bg-color)
        }

        .login:hover{
            background: hsl(24, 98%, 58%);
            transition: 0.3s;

        }

        /* Home */
        .home{
            width: 100%;
            min-height: 440px;
            background: var(--container-color);
            display: grid;
            justify-content: center;
            align-items: center;
        }
        
        .home-text{
            color: var(--bg-color);
            text-align: center;
        }

        .home-title{
            font-size: 3.5rem;
        }
        .home-subtitle{
            font-size: 1rem;
            font-weight: 400;
        }

        .post-filter{
            display: flex;
            justify-content: center;
            align-items: center;
            column-gap: 1.5rem;
            margin-top: 2rem !important;

        }

        .filter-item{
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
        }

        .active-filter{
            background: var(--second-color);
            color: var(--bg-color);
            border-radius: 4px;
        }

        /* Posts */
        .post{
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(280px,auto));
            justify-content: center;
            gap: 1.5rem;
        }

        .post-box{
            background: var(--bg-color);
            box-shadow: 0 4px 14px hsl(355deg 25% 15% / 10%);
            padding: 15px;
            border-radius: 0.5rem;
        }

        .post-img{
            width: 100%;
            height: 200px;
            object-fit: cover;
            object-position: center;
            border-radius: 0.5rem;
        }

        .category{
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            color: var(--second-color);
        }

        .post-title{
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-color);
            /* To Remain Title in 2 Lines*/
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .post-date{
            display: flex;
            font-size: 0.875rem;
            text-transform: uppercase;
            font-weight: 400;
            margin-top: 4px;
        }

        .post-description{
            font-size: 0.9rem;
            line-height: 2rem;
            margin: 5px 0 10px;
            /* To Remain Title in 3 Lines*/
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .profile{
        display: flex;
        align-items: center;
        gap: 10px; 
        }

        .profile-img{
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center;
            border: 2px solid var(--second-color);
        }

        .profile-name{
            font-size: 0.82rem;
            font-weight: 500;
        }

        .footer{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 0;
        }

        .footer p{
            font-size: 0.93em;
        }

        .social{
            display: flex;
            align-items: center;
            column-gap: 1rem;
        }
        
        .social .bx{
            font-size: 1.4rem;
            color: var(--text-color)
        }

        .social .bx:hover{
            color: var(--second-color);
            transition: 0.3s all linear;
        }

        /* Post Content  */
        .post-header{
            width: 100%;
            height: 500px;
            background: var(--container-color);
        }

        .post-container{
            max-width: 800px;
            margin: auto;
            width: 100%;
        }

        .header-content{
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 4rem !important;
        }

        .back-home{
            color: var(--second-color);
            font-size: 0.9rem;
        }

        .header-title{
        width: 90%;
        font-size: 2.6rem;
        color: var(--bg-color);
        text-align: center;
        margin-bottom: 1rem; 
        }

        .header-img{
        width: 100%;
        height: 420px;
        object-fit: cover; 
        object-position: center;
        }

        .post-content{
            margin-top: 10rem !important;
        }

        .sub-heading{
            font-size: 1.2rem;
        }

        .post-text{
            font-size: 1rem;
            line-height: 1.7rem;
            margin: 1rem 0;
            text-align: justify;
        }

        .share{
            display: flex;
            flex-direction: column;
            align-items: center;
            row-gap: 1rem;
        }

        .share-title{
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width:1060px){
            .container{
                margin: 0 auto;
                width: 95%;

            }
            .home-text{
                width: 100%;
            }
        }
        @media  (max-width:800px){
            .nav{
                padding: 14px 0;
            }
            .post-container{
                margin: 0 auto;
                width: 95% ;
            }
        }

        @media  (max-width:768px){
            .nav{
                padding: 10px 0;
            }
            section{
                padding: 2rem 0;
            }
            .header-content{
                margin-top: 3rem !important;
            }
            .home{
                min-height: 380px;
            }
            .home-title{
                font-size: 3rem;
            }
            .header-title{
            font-size: 2rem; 
            }
            .header-img{
                height: 370px;
            }
            .post-header{
                height: 435px;
            }
            .post-content{
                margin-top: 9rem !important;
            }
        }
        @media  (max-width:570px){
            .post-header{
                height: 390px;
            }
            .header-title{
                width: 100%;
            }
            .header-img{
                height: 340px;
            }
            .footer{
                flex-direction: column;
                row-gap: 1rem;
                padding: 20px 0;
                text-align: center;
            }
        }
        @media  (max-width:396px){
            .home-title{
                font-size: 2rem;
            }
            .home-subtitle{
                font-size: 0.9rem;
            }
            .home{
                min-height: 300px;
            }
            .post-box{
                padding: 10px;
            }
            .header-title{
                font-size: 1.4rem;
            }
            .header-img{
                height: 240px;
            }
            .post-header{
                height: 335px;
            }
            .post-content{
                margin-top: 5rem !important;
            }
            .post-text{
                font-size: 0.875;
                line-height: 1.5rem;
                margin: 10px 0;
            }
        }

        .home {
        background: linear-gradient(to bottom, #131516, #131516), url(../images/newbanner-bg.png) no-repeat;
        min-height: 70vh;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        }

    </style>

</head>
<body>

<header class="header">

   <section class="flex">

      <div class="icons">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
               $count_user_comments->execute([$user_id]);
               $total_user_comments = $count_user_comments->rowCount();
               $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
               $count_user_likes->execute([$user_id]);
               $total_user_likes = $count_user_likes->rowCount();
         ?>
         <a href="user_comments.php" style="color: #a6bcce; font-size: 2.5rem; margin-right: 1.0rem;"><i class="fas fa-comment"></i><span style="margin: 0 0.40rem; color: #a6bcce;">(<?= $total_user_comments; ?>)</span></a>
         <a href="user_likes.php" style="color: #a6bcce; font-size: 2.5rem;"><i class="fas fa-heart"></i><span style="margin: 0 0.40rem; color: #a6bcce;">(<?= $total_user_likes; ?>)</span></a>
      </div>

      <form action="search.php" method="POST" class="search-form">
         <input type="text" name="search_box" class="box" maxlength="100" placeholder="search for books" required>
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars" style="margin-left: 1.2rem;"></div>
         <div id="search-btn" class="fas fa-search" style="margin-left: 1.2rem;"></div>
         <div id="user-btn" class="fas fa-user" style="margin-left: 1.2rem;"></div>
      </div>

      <nav class="navbar">
        <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
        <a href="posts.php"> <i class="fas fa-angle-right"></i> posts</a>
        <a href="all_category.php"> <i class="fas fa-angle-right"></i> category</a>
        <a href="added_blogs.php"> <i class="fas fa-angle-right"></i> blogs</a>
        <a href="added_policies.php"> <i class="fas fa-angle-right"></i> policies</a>
         
      </nav>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name">Hello! <font color="#4834d4"><?= $fetch_profile['name']; ?></font></p>
         <a href="update.php" class="btn">update profile</a>
         <!-- THE DEVELOPER HIDE THIS FEATURES FOR MEANTIME
            <div class="flex-btn">
               <a href="login.php" class="option-btn">login</a>
               <a href="register.php" class="option-btn">register</a>
            </div> 
         ENDS HERE! -->
         <a href="./login.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         <?php
            }else{
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="option-btn">login</a>
         <?php
            }
         ?>
      </div>

   </section>

</header>

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

<div class="box-container">
   <?php
      }else{
   ?>
      <p class="name">login or register!</p>
      <div class="flex-btn">
         <a href="login.php" class="option-btn">login</a>
         <a href="register.php" class="option-btn">register</a>
      </div> 
   <?php
      }
   ?>

      <!-- THE DEVELOPER HIDE THIS FEATURES FOR MEANTIME
         <div class="box">
            <p>authors</p>
            <div class="flex-box">
            <?php
               /*
               $select_authors = $conn->prepare("SELECT DISTINCT name FROM `admin` LIMIT 10");
               $select_authors->execute();
               if($select_authors->rowCount() > 0){
                  while($fetch_authors = $select_authors->fetch(PDO::FETCH_ASSOC)){ 
               */
            ?>
               /*
               <a href="author_posts.php?author= <?= $fetch_authors['name']; ?>" class="links"><?= $fetch_authors['name']; ?></a>
               */
               <?php
            /*} 
            }else{
               echo '<p class="empty">no posts added yet!</p>';
            } */
            ?>  
            <a href="authors.php" class="btn">view all</a> 
            </div>
         </div>
      ENDS HERE! -->
   

</div>

          
<!-- Post -->
<section class="container" style="background: linear-gradient(to bottom, #131516, #131516), url(../images/newbanner-bg.png) no-repeat;">
    <!-- Post Content -->
    <div class="post-header">
        <div class="header-content post-container">
            <!-- Title -->
            <h1 class="header-title" style="margin-bottom: 3.5rem; font-size: 35px;">The Art of Info-Tecture: Designing Clear and Effective Information Architecture</h1>
            <!-- Post Image -->
            <img src="img/blogs2_img_default.png" alt="" class="header-img">
        </div>
    </div>
    
    <!-- Post -->
    <div class="post-content post-container">
        <h2 class="sub-heading" style="font-size: 25px;">Introduction:</h2>
        <p class="post-text" style="font-size: 16px; line-height: 2rem;">Information architecture, or info-tecture, is the practice of organizing and structuring information in a clear and understandable way. It involves designing navigation systems, categorizing information, and creating an intuitive user experience. In this guide, we will explore the basics of info-tecture, including its importance, principles, and best practices.</p>
        <br><br><br><h2 class="sub-heading" style="font-size: 25px;">1. Understanding Information Architecture:</h2>
        <p class="post-text" style="font-size: 16px; line-height: 2rem;">Information architecture is all about organizing information in a way that makes sense to the user. It involves creating a hierarchy of information, grouping related content, and defining the relationships between different pieces of information. The goal of info-tecture is to create a seamless and intuitive user experience that allows users to find the information they need quickly and easily.</p>
        <br><br><br><h2 class="sub-heading" style="font-size: 25px;">2. Principles of Information Architecture:</h2>
        <p class="post-text" style="font-size: 16px; line-height: 2rem;">To design effective info-tecture, there are several key principles to keep in mind. First, the organization should be logical and intuitive, with content grouped in a way that makes sense to the user. Second, the navigation should be clear and consistent, with labels that accurately describe the content they lead to. Third, the information should be easily scannable, with headings, subheadings, and other visual cues that guide the user's attention.</p>
        <br><br><br><h2 class="sub-heading" style="font-size: 25px;">3. Best Practices for Information Architecture:</h2>
        <p class="post-text" style="font-size: 16px; line-height: 2rem;">When designing info-tecture, there are several best practices to follow. First, conduct user research to understand the needs and preferences of your target audience. This will help you design an organization and navigation system that meets their expectations. Second, create a clear and concise labeling system that accurately describes the content it leads to. Third, use visual cues such as icons, colors, and typography to help guide the user's attention.</p>
        <br><br><br><h2 class="sub-heading" style="font-size: 25px;">4. Creating Effective Navigation:</h2>
        <p class="post-text" style="font-size: 16px; line-height: 2rem;">Navigation is a crucial component of info-tecture. It involves creating a system of links and labels that allow users to move between different parts of the website. When designing navigation, keep it simple and consistent. Use clear and descriptive labels, and limit the number of options to avoid overwhelming the user.</p>
        <br><br><br><h2 class="sub-heading" style="font-size: 25px;">5. Content Organization:</h2>
        <p class="post-text" style="font-size: 16px; line-height: 2rem;">Organizing content is another important aspect of info-tecture. Group related content together, and create a clear hierarchy that allows users to quickly understand the relationship between different pieces of information. Use headings and subheadings to break up long blocks of text and make the content more scannable.</p>
        <br><br><br><h2 class="sub-heading" style="font-size: 25px;">6. Creating a Searchable Website:</h2>
        <p class="post-text" style="font-size: 16px; line-height: 2rem;">In addition to navigation and content organization, creating a searchable website is another key aspect of info-tecture. Ensure that your website's search function is easy to find and use. Use a search bar that is prominently placed and clearly labeled. Make sure that the search results are accurate and relevant to the user's query.</p>
        
    </div> 

    <!--Share -->
    <div class="share post-container">
        <span class="share-title" style="margin: 4.5rem 0; text-align: center; font-size: 16px;">Share this article</span>
        <div class="social" style="margin-top: -2.5rem; margin-bottom: .5rem; font-size: 20px; gap: 2.5rem;">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
        </div>
    </div>
</section>

          


<!-- JQuery Link -->
<script src="https://code.jquery.com/jquery-3.6.4.js"integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="crossorigin="anonymous"></script>
<!-- Link JS -->
<script src="js/main.js"></script>
<script src="js/script.js"></script>

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