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
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

   <style>


      .home{
      background: linear-gradient(to bottom, #131516, #131516), url(../images/newbanner-bg.png) no-repeat;
      min-height: 70vh;
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;

         }

         .home .content{
            text-align: center;
            width: 80rem;

         }

         .home .content h1 {
            font-size: 4.0rem;
            color:var(--white);
            text-transform: uppercase;
         }

         .home .content p{
            font-size:1.8rem;
            color:var(--light-white);
            padding: 1.5rem 0;
            line-height: 1.5;
         }

         .home .content .white-btn {
         display: inline-block;
         margin-top: 1rem;
         padding:1rem 3rem;
         cursor: pointer;
         color:var(--white);
         font-size: 1.8rem;
         border-radius: .5rem;
         text-transform: capitalize;
         }

         .white-btn,
         .btn{
            background-color: #4834d4;
         }

         .white-btn:hover{
         background-color: var(--white);
         color:var(--black);
         }


         /* media queries  */

         @media (max-width:991px){

         html{
            font-size: 55%;
         }

         }

         @media (max-width:768px){

         #menu-btn{
            display: inline-block;
         }

         .header .header-2 .flex .navbar{
            position: absolute;
            top:99%; left:0; right:0;
            background-color: var(--white);
            border-top: var(--border);
            border-bottom: var(--border);
            clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
         }

         .header .header-2 .flex .navbar.active{
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
         }

         .header .header-2 .flex .navbar a{
            display: block;
            font-size: 2.5rem;
            margin:2rem;
         }

         .home .content h3{
            font-size: 3.5rem;
         }

         }

         @media (max-width:450px){

         html{
            font-size: 50%;
         }

         .heading h3{
            font-size: 3.5rem;
         }

         .title{
            font-size: 3rem;
         }

         }

         .home .row .content h3{
         color: var(--black);
         font-size: 4.5rem; 
         text-align: left;
      }
      .home .row .content p{
         color: var(--light-color);
         font-size: 2rem; 
         line-height: 1.50;
         padding: 1rem 0;
         text-align: left;
      }

         #shelf {
      display: flex;
      justify-content: center;
      padding-top: 3rem;
      }

      /* BOOK BINDINGS */
      .book-bg {
      overflow: hidden;
      height: 32rem;
      margin: 2px;
      cursor: pointer;
      transition: margin 0.3s ease-in-out, box-shadow 0.3s ease-in-out,
         transform 0.3s ease-in-out;
      filter: grayscale(25%);
      border-radius: 4px;
      background: grey;
      box-shadow: 0 0.5rem 1rem 0rem rgba(0, 0, 0, 0.4);
      border-top-style: solid;
      border-top-width: 1px;
      border-image: linear-gradient(
         to right,
         #333,
         #333 15%,
         antiquewhite 30%,
         antiquewhite 70%,
         #333 85%,
         #333
      );
      border-image-slice: 1;
      order: 200;
      }
      .book-bg:hover {
      box-shadow: 0 0.5rem 3rem -0.5rem rgba(0, 0, 0, 0.4);
      z-index: 10;
      margin-top: -15px;
      transform: scale(1.03, 1.03);
      }
      /* END BOOK BINDINGS */

      /* BOOK WIDTHS */
      .graphic {
      width: 6rem;
      }
      .data {
      width: 5rem;
      }
      .photo {
      width: 5rem;
      }
      .landscape {
      width: 6rem;
      }
      .writing {
      width: 4rem;
      }
      .web {
      width: 5rem;
      }
      /* END BOOK WIDTHS */

      /* TITLE SHADOWS */
      .book h1,
      h2,
      h3,
      h4,
      h5 {
      text-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.8);
      }
      .web .book h1,
      h3 {
      text-shadow: 0 0 0.25rem rgba(0, 0, 0, 0.6);
      }
      /* END TITLE SHADOWS */

      /* DEFAULT BOOK ATTRIBUTES */
      .book {
      display: flex;
      height: 100%;
      width: 100%;
      box-shadow: inset -0.35rem 0 0.5rem rgba(0, 0, 0, 0.4),
         inset 0.35rem 0 0.5rem rgba(0, 0, 0, 0.4);
      justify-content: center;
      align-items: center;
      writing-mode: vertical-rl;
      }
      .contents {
      opacity: 0;
      }
      /* END DEFAULT BOOK ATTRIBUTES */

      /* GRAPHIC DESIGN */
      .graphic .book {
      align-items: center;
      background: radial-gradient(
            ellipse at top,
            rgba(0, 0, 0, 0.35),
            rgba(0, 0, 0, 0.75)
         ),
         radial-gradient(ellipse at bottom, rgba(70, 70, 70, 0.5), transparent);
      font-family: "Unica One", cursive;
      color: darkorange;
      }
      /* END GRAPHIC DESIGN */

      /* DATA VISUALIZATION */
      .data .book {
      background: radial-gradient(
            ellipse at top,
            rgba(50, 10, 87, 0.55),
            rgba(0, 0, 0, 0.75)
         ),
         radial-gradient(ellipse at bottom, rgba(70, 70, 70, 0.5), transparent);
      font-family: "Smooch Sans", sans-serif;
      color: rgb(221, 206, 206);
      }
      /* END DATA VISUALIZATION */

      /* PHOTOGRAPHY */
      .photo .book {
      background: radial-gradient(
            ellipse at top,
            rgba(189, 147, 189, 0.55),
            rgba(0, 0, 0, 0.85)
         ),
         radial-gradient(ellipse at bottom, rgba(185, 154, 154, 0.5), transparent);
      font-family: "Nothing You Could Do", cursive;
      color: #212121;
      }
      /* END PHOTOGRAPHY */

      /* LANDSCAPE DESIGN */
      .landscape .book {
      background: radial-gradient(
            ellipse at top,
            rgba(2, 95, 18, 0.55),
            rgba(0, 0, 0, 0.75)
         ),
         radial-gradient(ellipse at bottom, rgba(70, 70, 70, 0.5), transparent);
      font-family: "Fredericka the Great", cursive;
      color: rgb(247, 229, 192);
      }
      /* END LANDSCAPE DESIGN */

      /* CREATIVE WRITING */
      .writing .book {
      background: radial-gradient(
            ellipse at top,
            rgba(94, 15, 6, 0.76),
            rgba(0, 0, 0, 0.75)
         ),
         radial-gradient(ellipse at bottom, rgba(70, 70, 70, 0.5), transparent);
      font-family: "Lora", serif;
      color: rgb(216, 191, 191);
      }
      /* END CREATIVE WRITING */

      /* WEB DESIGN */
      .web .book {
      background: radial-gradient(
            ellipse at top,
            rgba(255, 255, 255, 0.63),
            rgba(0, 0, 0, 0.75)
         ),
         radial-gradient(ellipse at bottom, rgba(70, 70, 70, 0.5), transparent);
      font-family: "Inconsolata", monospace;
      color: #333;
      }
      /* END WEB DESIGN */

      /* OPEN BOOK */
      .book-bg.active {
      box-shadow: 0 0.5rem 3rem -0.5rem rgba(0, 0, 0, 0.4);
      position: absolute;
      width: 61rem;
      height: 32rem;
      margin-top: -22px;
      z-index: 10;
      border-top-width: 0;
      }
      .contents {
      display: flex;
      position: absolute;
      }
      .book-bg.active .contents {
      background-color: antiquewhite;
      position: fixed;
      opacity: 100;
      width: calc(100% - 50px);
      height: calc(100% - 50px);
      border-left-style: double;
      border-right-style: double;
      border-left-width: 4px;
      border-right-width: 4px;
      border-color: rgb(92, 92, 92);
      border-top-style: solid;
      border-top-width: 1px;
      border-top-color: antiquewhite;
      border-bottom-style: groove;
      border-bottom-color: rgb(155, 153, 153);
      border-bottom-width: 2px;
      color: #333;
      writing-mode: horizontal-tb;
      font-family: "Nothing You Could Do", cursive;
      }
      .page {
      display: flex;
      flex-direction: column;
      width: calc(50% - 4rem);
      height: calc(100% - 4em);
      margin: 2rem;
      }
      .page h1,
      h3 {
      text-shadow: none;
      }
      .is-grid {
      display: grid;
      gap: 5px;
      grid-template: "1fr 1fr 1fr" "1fr 1fr 1fr" "1fr 1fr 1fr";
      }
      .illus {
      border: 5px solid white;
      flex: 1;
      background-size: cover;
      }
      .text {
      margin: 1rem;
      }
      #page-shading {
      position: absolute;
      width: 100%;
      height: 100%;
      background: linear-gradient(
         to right,
         rgba(30, 30, 30, 0.1),
         transparent 25%,
         transparent 30%,
         rgba(30, 30, 30, 0.3) 48%,
         rgba(30, 30, 30, 0.4) 50%,
         transparent 50%,
         rgba(30, 30, 30, 0.3) 70%,
         transparent
      );
      }
      .book-bg.active #book-shading {
      position: absolute;
      width: 100%;
      height: 100%;
      background: linear-gradient(
         to right,
         transparent,
         transparent 43%,
         rgba(30, 30, 30, 0.3) 44%,
         rgba(30, 30, 30, 0.5) 45%,
         rgba(30, 30, 30, 0.4) 50%,
         rgba(30, 30, 30, 0.65) 55%,
         rgba(30, 30, 30, 0.3) 56%,
         transparent 57%,
         transparent
      );
      }
      /* END OPEN BOOK */

      /* BACK ARROW */
      #back svg {
      position: absolute;
      border: none;
      width: 2rem;
      right: 0.25rem;
      top: 0.125rem;
      z-index: 10;
      opacity: 85%;
      filter: drop-shadow(0px 0px 2px black);
      }
      #back svg:hover {
      opacity: 100%;
      filter: drop-shadow(0px 0px 2px whitesmoke);
      }
      /* BACK ARROW */




      .waves {
      position: relative;
      width: 100%;
      height: 15vh;
      margin-bottom: -7px;
      /*Fix for safari gap*/
      min-height: 100px;
      max-height: 150px;
      }

      

      /* Animation */

      .parallax > use {
      animation: move-forever 25s cubic-bezier(0.55, 0.5, 0.45, 0.5) infinite;
      }

      .parallax > use:nth-child(1) {
      animation-delay: -2s;
      animation-duration: 7s;
      }

      .parallax > use:nth-child(2) {
      animation-delay: -3s;
      animation-duration: 10s;
      }

      .parallax > use:nth-child(3) {
      animation-delay: -4s;
      animation-duration: 13s;
      }

      .parallax > use:nth-child(4) {
      animation-delay: -5s;
      animation-duration: 20s;
      }

      @keyframes move-forever {
      0% {
         transform: translate3d(-90px, 0, 0);
      }

      100% {
         transform: translate3d(85px, 0, 0);
      }
      }

      /* /* Shrinking for mobile */
      @media (max-width: 768px) {
      .waves {
         height: 40px;
         min-height: 40px;
      }

      
      }

      /* UPDATED BUTTONS */
      .btn_generative {
         position: fixed;
         left: 81%;
         margin-top: 41.5%;
         border: 0 0 5px #9917FF, 0 0 10px #9917FF, 0 0 15px #9917FF;
         width: 11.8em;
         height: 4em;
         border-radius: 3em;
         display: flex;
         justify-content: center;
         align-items: center;
         gap: 12px;
         background: #1C1A1C;
         cursor: pointer;
         transition: all 450ms ease-in-out;
         z-index: 1999;

         /* Apply glowing border animation */
         animation: glowing-border 3s ease-in-out infinite; /* Animation duration 3s, repeats infinitely */
      }

      /* Glowing border animation */
      @keyframes glowing-border {
         0% {
            box-shadow: 0 0 5px #9917FF, 0 0 10px #9917FF, 0 0 15px #9917FF;
         }
         50% {
            box-shadow: 0 0 15px #683FEA, 0 0 30px #683FEA, 0 0 45px #683FEA;
         }
         100% {
            box-shadow: 0 0 5px #9917FF, 0 0 10px #9917FF, 0 0 15px #9917FF;
         }
      }

      .sparkle {
         fill: #AAAAAA;
         transition: all 800ms ease;
      }

      .text {
         font-weight: 600;
         color: #AAAAAA;
         font-size: medium;
      }

      .btn_generative:hover {
         background: linear-gradient(0deg,#A47CF3,#683FEA);
         box-shadow: inset 0px 1px 0px 0px rgba(255, 255, 255, 0.4),
         inset 0px -4px 0px 0px rgba(0, 0, 0, 0.2),
         0px 0px 0px 4px rgba(255, 255, 255, 0.2),
         0px 0px 180px 0px #9917FF;
         transform: translateY(-2px);
      }

      .btn_generative:hover .text {
         color: white;
      }

      .btn_generative:hover .sparkle {
         fill: white;
         transform: scale(1.2);
      }

      /* If you want to target the new button specifically */
      #generateBtnNew {
         /* Any specific styles for the new button */
         background-color: #2A2A2A;  /* Example: a slightly different background */
      }
 

   </style>

</head>
<body>

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
      <a href="#home"> <i class="fas fa-angle-right"></i> home</a>
         <a href="#category"> <i class="fas fa-angle-right"></i> category</a>
         <a href="#posts"> <i class="fas fa-angle-right"></i> posts</a>
         <a href="#about"> <i class="fas fa-angle-right"></i> about</a>
         <a href="#service"> <i class="fas fa-angle-right"></i> services</a>
         <a href="#banner"> <i class="fas fa-angle-right"></i> blogs</a>
         <a href="#faqs"> <i class="fas fa-angle-right"></i> faqs</a>
         <a href="#team"> <i class="fas fa-angle-right"></i> team</a>
         <a href="#contact"> <i class="fas fa-angle-right"></i> contacts</a>
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


<!-- UPDATED BUTTON GENERATE -->
<a href="http://127.0.0.1:8000/" target="_blank">
    <button class="btn_generative" id="generateBtnNew">
        <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1" class="sparkle">
            <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z"></path>
        </svg>

        <span class="text">Generate</span>
    </button>
</a>
<!-- END -->


<section class="home" id="home">

   <div class="content" style="width: 90%;">
      <h1 style="color: #fff; font-size: 3.7rem;">Practicality at its Finest: A Simple, Yet Effective Web-Based Book Archiving With a Strong Emphasis on Web Design and Development Contents</h1>
      <p style="color: #c8c3bc;">A Capstone project of UI/UX student, in partial fulfillment of the requirements for the Associate <br>in Computer Technology Degree. </p>
      <a href="#about" class="white-btn" style="color: #fff;">Learn more</a>

   </div>
   

</section>

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


<?php include 'added_features.php'; ?>


<!--Waves Container-->
<div>
   <svg
      class="waves"
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 24 150 28"
      preserveAspectRatio="none"
      shape-rendering="auto"
   >
      <defs>
      <path
         id="gentle-wave"
         d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"
      />
      </defs>
      <g class="parallax">
      <use
         xlink:href="#gentle-wave"
         x="48"
         y="0"
         fill="rgba(255,255,255,0.7"
      />
      <use
         xlink:href="#gentle-wave"
         x="48"
         y="3"
         fill="rgba(255,255,255,0.5)"
      />
      <use
         xlink:href="#gentle-wave"
         x="48"
         y="5"
         fill="rgba(255,255,255,0.3)"
      />
      <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
      </g>
   </svg>
</div>
<!--Waves end-->
<!--Content starts-->
<div class="content flex" style="background-color: #fff">
   <p style="padding-top: 2.5rem; padding-bottom: 2.5rem; text-align: center; font-size: 2rem; font-family:Rubik; font-weight: 400">&copy; Built and Design by <font color="#4834d4">UI/UX Student</font>&nbsp;|&nbsp;Powered by <font color="#4834d4">Hoopoelink</font></p>
</div>
<!--Content ends-->



<script src="js/script.js"></script>

<script>
   $(".book-bg").click(function () {
   $(this).addClass("active");
   });

   $("#back svg").click(function () {
   event.stopPropagation();
   $(".book-bg").removeClass("active");
   });
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