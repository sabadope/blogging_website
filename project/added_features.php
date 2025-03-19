<?php

include 'components/connect.php';

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
    <!--CSS File-->
    <link rel="stylesheet" href="css/added_features.css">
    <title>Responsive</title>

    <style>


        /* FAQ Style */
        .container-fluid{
            width: 40%;
            margin: 0 auto;
            margin-top: 100px;
        }

        .container-fluid h2{
            color: hotpink;
            position: relative;
            width: 23rem;

        }
        .container-fluid h2::after{
            content: "";
            position: absolute;
            bottom: 0;
            right: 12px;
            width: 67px;
            height: 2px;
            background-color: hotpink;
        }
        .accordion{
            width: 100%;
            padding: 0 5px;
            border: 2px solid #6db5ff;
            cursor: pointer;
            border-radius: 50px;
            display: flex;
            margin: 10px 0;
            align-items: center;
            
        }
        .accordion .icon{
            margin: 10px 10px;
            width: 30px;
            height: 30px;
            background: url(images/pngwing.com.png) no-repeat 8px 7px #4b9cf2;
            border-radius: 50%;
            float: left;
            transition: all 5.s ease-in;
            
        }
        .accordion h5{
            font-size: 22px;
            margin: 0;
            padding: 3px 0 0 0;
            font-weight: normal;
            color: #1f5c9a;
            text-align: center;
        }
        .panel{
            padding: 0 15px;
            border-left: 1px solid #6db5ff;
            margin-left: 25px;
            font-size: 16px;
            text-align: justify;
            overflow: hidden;
            max-height: 0;
            transition: all .5s ease-in;

        }
        .active .icon{
            background-color: url(images/icons8-add-48.png) no-repeat 8px -25px #4b9cf2;
        }
        .active{
            background-color: #6db5ff;
            color: #fff;
        }
        /* ENDS HERE! */

    </style>
</head>
<body>

    <!-- ==== Top Bar START ==== -->
    <!-- THE DEVELOPER HIDE THIS FEATURES FOR MEANTIME
        <div class="top-bar">
        
            <div class="cont-info">
                <p><i class="fa-solid fa-envelope-open-text"></i> jv23hotohot.com</p>
                <p><i class="fa-solid fa-phone"></i> +63 9164820464</p>
            </div>

                <div class="social-icon">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                </div>

        </div>
    ENDS HERE! -->
    <!-- ==== Top Bar END ==== -->

    <!-- ============================================================================================== -->
   
    <!-- === Header section START ==== -->
    
        <header> 
            <!--
                <div class="logo">
            <a href="#"><img src="img/company-logo.png" alt="company-logo"></a>
            </div>
            -->

            <!--
            <nav>
                <ul id="ResMenu">
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#service">Services</a></li>
                    <li><a href="#portfolio">Our Work</a></li>
                    <li><a href="#team">Our Team</a></li>
                    <li><a href="#contact" class="glob-btn">Contact Us <i class="fa-solid fa-arrow-right"></i></a></li>
                </ul>
            </nav>  
            -->
            
            <!-- Responsive Menu Button -->
            <div id="MenuBtn"></div>
            
        </header>
    
    <!-- === Header section END === -->

    <!-- ======================================================================================================= -->

    <!-- ==== Home Section START ==== -->
    <!-- THE DEVELOPER HIDE THIS FEATURES FOR MEANTIME
        <section id="home">
            <video src="img/MBA Video.mp4" loop muted autoplay type="video.mp4"></video>

            <div class="home-row">

                left-col
                <div class="left-col">
                    <h3>One of the Best Digital agency</h3>
                    <h1>Convert your ideas into brands with us.</h1>
                    <p>we are an I company that helps you grow your business through intuitive and modren technology</p>
                    
                    <a href="#" class="glob-btn">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                righ-col
                <div class="right-col">
                    Just For Background Image 
                </div>

            </div>

        </section>
    ENDS HERE! -->
    <!---==== Home Section END ====-->

    <!-- ====================================================================================================== -->

    <!-- === Feature Section START === -->
    <section id="feature" class="padding">

        <h3 class="sub-heading center">Features</h3>
        <h2 class="heading center">Learn, Grow, and Succeed That's our Priority</h2>
        <p class="sub-para center">Preserving literary legacies for future generations about web design and development.</p>

        <div class="feature-row">

            <!-- Feature Item 1-->
            <div class="feature-box">
                <i class="fa-solid fa-magnifying-glass-chart"></i>
                <h3>Easy to Navigate</h3>
                <p>Simplify your reading experience.</p>
            </div>
             <!-- Feature Item 2-->
            <div class="feature-box">
                 <i class="fa-regular fa-lightbulb"></i>
                 <h3>Minimalist Theme</h3>
                 <p>Experience the beauty of simplicity.</p>
                </div>
            <!-- Feature Item 3-->
            <div class="feature-box">
                <i class="fa-solid fa-chart-gantt"></i>
                <h3>Exclusive Contents</h3>
                <p>UI/UX Designing and Web Development.</p>
            </div>

        </div>


    </section>
    <!-- Feature Section END ==== -->

    <!-- ============================================================================================== -->

    <!-- === Bookshelf Section START === -->
    <section class="home" id="category" style="margin-top: 3rem;">

        <div class="row">

            <div class="content" style="width: 60rem; margin-right: 10rem;">
                <h3 style="color: #fff">Unlock the Power of a Well-Organized Book Archiving</h3>
                <p style="color: #c8c3bc">A Comprehensive Guide to UI Design and Web Development Best Practices. Learn how efficient archiving can elevate your work.</p>
                <a href="all_category.php" class="btn" style="width: 29%; margin-top: 2rem; background-image: initial; background-color: #3323a4; color: white;" onmouseover="this.style.backgroundColor='#fff'; this.style.color='black';" onmouseout="this.style.backgroundColor='#3323a4'; this.style.color='white';">Browse Book</a>
            </div>
        </div>

        <div id='shelf'>
            <a href="posts.php" class='book-bg graphic'>
                <div class='book flex-column'>
                <div id='book-shading'></div>
                <h5 style='margin-left: 0px; line-height:10%'>Fundamentals of</h5>
                <h1 style='margin-left: 45px; line-height: 1%'>Graphic Design</h1>
                <div class='contents'>
                    <div id='back'>
                    <svg viewBox="0 0 512 512" width="100" title="chevron-circle-left">
                    <path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z" />
                    </svg>
                    </div>
                    <div class='page'>
                    <div>
                    <h1>Graphic Design</h1>
                    <p class='text'>&emsp;Primitivism gothic art situationist international neoclassicism neo-impressionism multiculturalism postmodernism primitivism, postmodern art dada hyperrealism existentialism neue slowenische kunst renaissance.</p>
                    </div>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1618004912476-29818d81ae2e?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE1NTI1MjY&ixlib=rb-1.2.1&q=80)'>
                    </div>
                    </div>
                    <div class='page'>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1659034638032-3a0e9b7ac8d0?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE0NTUzMjM&ixlib=rb-1.2.1&q=80)'>
                    </div>
                    <div>
                    <p class='text'>&emsp;Modernipsum dolor sit amet renaissance situationist international metaphysical art, deformalism manierism op art social realism neo-minimalism. Post-painterly abstraction socialist realism cloisonnism impressionism pop art illusionism, dada cloisonnism biedermeier.</p>
                    </div>
                    </div>
                    <div id='page-shading'></div>
                </div>
                </div>
            </a>
            <a href="posts.php" class='book-bg data'>
                <div class='book'>
                <div id='book-shading'></div>
                <h1>Data Visualization, a Primer</h1>
                <div class='contents'>
                    <div id='back'><svg viewBox="0 0 512 512" width="100" title="chevron-circle-left">
                    <path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z" />
                    </svg></div>
                    <div class='page'>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1642516303080-431f6681f864?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MDU5MzU&ixlib=rb-1.2.1&q=80)'>
                    </div>
                    <div>
                    <h1 style='margin-top: 1rem'>Data Visualization</h1>
                    <p class='text'>&emsp;Rig Veda qui dolorem ipsum quia dolor sit amet vanquish the impossible shores of the cosmic ocean Rig Veda venture?</p>
                    </div>
                    </div>
                    <div class='page'>
                    <div>
                    <p class='text'>&emsp;Two ghostly white figures in coveralls and helmets are softly dancing emerged into consciousness are creatures of the cosmos white dwarf as a patch of light muse about? Intelligent beings the only home we've ever known explorations.</p>
                    </div>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1584291527935-456e8e2dd734?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MDQyMTY&ixlib=rb-1.2.1&q=80)'>
                    </div>
                    </div>
                    <div id='page-shading'></div>
                </div>
                </div>
            </a>
            <a href="posts.php" class='book-bg photo'>
                <div class='book'>
                <div id='book-shading'></div>
                <h3>HTML / CSS and JAVASCRIPT</h3>
                <div class='contents'>
                    <div id='back'><svg viewBox="0 0 512 512" width="100" title="chevron-circle-left">
                    <path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z" />
                    </svg></div>
                    <div class='page is-grid'>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1659974751348-81f2acd062cc?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MzAxNTU&ixlib=rb-1.2.1&q=80); grid-column: 1 / 4'></div>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1659256955381-4e6636e3aa56?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MzAxMzI&ixlib=rb-1.2.1&q=80); grid-row: 2 / 4'></div>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1542382156909-9ae37b3f56fd?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MzA3NTU&ixlib=rb-1.2.1&q=80); grid-column: 2 / 4; grid-row: 2 / 4'></div>
                    </div>
                    <div class='page is-grid'>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1649554007580-aeba20951028?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MzA1NjU&ixlib=rb-1.2.1&q=80); grid-column: 1 / 3; grid-row: 1 / 3'></div>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1661546135630-bae33b1bf310?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MzA1NjU&ixlib=rb-1.2.1&q=80); grid-row: 1 / 3'></div>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1660296444901-253891bb61c0?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MzA4Mjc&ixlib=rb-1.2.1&q=80); grid-column: 1 / 3'></div>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1660219927145-40fb8403995b?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MzAxNTU&ixlib=rb-1.2.1&q=80)'></div>
                    </div>
                    <div id='page-shading'></div>
                </div>
                </div>
            </a>
            <a href="posts.php" class='book-bg landscape'>
                <div class='book flex-column'>
                <div id='book-shading'></div>
                <h5 style='margin-left: 0px; margin-top: -27%; line-height:10%'>An Introduction to</h5>
                <h1 style='margin-left: 45px; line-height: 1%'>Landscape Design</h1>
                <div class='contents'>
                    <div id='back'>
                    <svg viewBox="0 0 512 512" width="100" title="chevron-circle-left">
                    <path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z" />
                    </svg>
                    </div>
                    <div class='page'>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1610989653808-2303456a25e6?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MDYxNzU&ixlib=rb-1.2.1&q=80)'>
                    </div>
                    </div>
                    <div class='page'>
                    <div>
                    <h1>Landscape Design</h1>
                    <p class='text'>&emsp;Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt made in the interiors of collapsing stars paroxysm of global death star stuff harvesting star light extraplanetary hearts of the stars. Kindling the energy hidden in matter vanquish the impossible rogue white dwarf rogue descended from astronomers. Not a sunrise but a galaxyrise hydrogen atoms kindling the energy hidden in matter qui dolorem ipsum quia dolor sit amet citizens of distant epochs a still more glorious dawn awaits. Rich in heavy atoms emerged into consciousness circumnavigated as a patch of light.</p>
                    </div>
                    </div>
                    <div id='page-shading'></div>
                </div>
                </div>
            </a>
            <a href="posts.php" class='book-bg writing'>
                <div class='book'>
                <div id='book-shading'></div>
                <h3>Creative Writing,</h3>
                <h4> for Dummies</h4>
                <div class='contents'>
                    <div id='back'><svg viewBox="0 0 512 512" width="100" title="chevron-circle-left">
                    <path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z" />
                    </svg></div>
                    <div class='page'>
                    <div>
                    <h3 style='text-align: center'>Creative</h3>
                    <p class='text'>&emsp;Something incredible is waiting to be known vastness is bearable only through love star stuff harvesting star light a billion trillion hearts of the stars quis nostrum exercitationem ullam corporis suscipit laboriosam. Encyclopaedia galactica intelligent beings for which there's little good evidence Apollonius of Perga stirred by starlight?</p>
                    <p class='text'>&emsp;The carbon in our apple pies autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur laws of physics courage of our questions sed quia non numquam eius modi tempora incidunt.</p>
                    </div>
                    </div>
                    <div class='page'>
                    <div style='text-align: center'>
                    <h3>Writing</h3>
                    <p class='text'>Something incredible is waiting<br>to be known<br>vastness is bearable only through love<br>star stuff harvesting star light<br>a billion trillion hearts<br>of the stars<br>quis nostrum exercitationem<br>ullam corporis suscipit laboriosam.<br>Encyclopaedia galactica intelligent beings<br>ship of the imagination<br>with pretty stories<br>for which there's little good evidence<br>Apollonius of Perga<br>stirred by starlight?</p>
                    </div>
                    </div>
                    <div id='page-shading'></div>
                </div>
                </div>
            </a>
            <a href="posts.php" class='book-bg web'>
            <div class='book'>
            <div id='book-shading'></div>
            <h1>Web Design</h1>
            <h3>&nbsp;1.0</h3>
            <div class='contents'>
                <div id='back'><svg viewBox="0 0 512 512" width="100" title="chevron-circle-left">
                    <path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z" />
                    </svg></div>
                <div class='page'>
                    <h1>Web Design</h1>
                    <p class='text'>&emsp;Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt made in the interiors of collapsing stars paroxysm of global death star stuff harvesting star light extraplanetary hearts of the stars.</p>
                    <p class='text'>&emsp;Kindling the energy hidden in matter vanquish the impossible rogue white dwarf rogue descended from astronomers. Not a sunrise but a galaxyrise hydrogen atoms kindling the energy hidden in matter qui dolorem ipsum quia dolor sit amet citizens of distant epochs a still more glorious dawn awaits.</p>
                </div>
                <div class='page'>
                    <div class='illus' style='background-image: url(https://images.unsplash.com/photo-1608760000795-547e78bfc003?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NjE3MDgyMTI&ixlib=rb-1.2.1&q=80)'>
                    </div>
                </div>
                <div id='page-shading'></div>
            </div>
            </div>
            </a>
        </div>
        </div>
    </section>
    <!-- Bookshelf Section END ==== -->
    
    <!-- ============================================================================================== -->

    <section class="posts-container" id="posts" style="margin-top: 3.5rem;">

        <h1 class="heading">Latest posts</h1>

        <div class="box-container" style="margin-top: 2.5rem;">

            <?php
                $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ? LIMIT 6 ");
                $select_posts->execute(['active']);
                if($select_posts->rowCount() > 0){
                    while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
                    
                    $post_id = $fetch_posts['id'];

                    $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
                    $count_post_comments->execute([$post_id]);
                    $total_post_comments = $count_post_comments->rowCount(); 

                    $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
                    $count_post_likes->execute([$post_id]);
                    $total_post_likes = $count_post_likes->rowCount();

                    $confirm_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
                    $confirm_likes->execute([$user_id, $post_id]);
            ?>
            <form class="box" method="post">
                <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                <input type="hidden" name="admin_id" value="<?= $fetch_posts['admin_id']; ?>">
                <div class="post-admin">
                    <i class="fas fa-user"></i>
                    <div>
                    <a href="author_posts.php?author=<?= $fetch_posts['name']; ?>"><?= $fetch_posts['name']; ?></a>
                    <div><?= $fetch_posts['date']; ?></div>
                    </div>
                </div>
                
                <?php
                    if($fetch_posts['image'] != ''){  
                ?>
                <img src="uploaded_img/<?= $fetch_posts['image']; ?>" class="post-image" alt="">
                <?php
                }
                ?>
                <div class="post-title"><?= $fetch_posts['title']; ?></div>
                <div class="post-content content-150"><?= $fetch_posts['content']; ?></div>
                <a href="view_post.php?post_id=<?= $post_id; ?>" class="inline-btn">read more</a>
                <a href="category.php?category=<?= $fetch_posts['category']; ?>" class="post-cat"> <i class="fas fa-tag"></i> <span><?= $fetch_posts['category']; ?></span></a>
                <div class="icons">
                    <a href="view_post.php?post_id=<?= $post_id; ?>"><i class="fas fa-comment" style="color: #a6bcce;"></i><span>(<?= $total_post_comments; ?>)</span></a>
                    <button type="submit" name="like_post"><i class="fas fa-heart" style="color: #a6bcce;"<?php if($confirm_likes->rowCount() > 0){ echo 'color:var(--red);'; } ?>  "></i><span>(<?= $total_post_likes; ?>)</span></button>
                </div>
            
            </form>
            <?php
                }
            }else{
                echo '<p class="empty">no posts added yet!</p>';
            }
            ?>
        </div>

        <div class="more-btn" style="text-align: center; margin-top: 2.5rem; margin-bottom: 8rem;">
            <a href="posts.php" class="inline-btn">view all posts</a>
        </div>

    </section>

    <!-- ============================================================================================== -->

    <!--- ==== About Section START === -->
    <section id="about">
        <div class="about-row">

            <div class="img-col">
                <img src="img/about-img.png" alt="About (image)">
            </div>

            <div class="info-col">
                <h3 class="sub-heading">About Us</h3>
                <h2 class="heading">We Provide Simple, Yet Powerful Tool for Book Archiving.</h2>
                <p class="sub-para">Unlock the power of digital organization with our easy-to-use guide to web-based book archiving. Learn how to store, categorize, and manage your educational materials online with ease. This approach not only simplifies access to your resources but also ensures your materials are always organized, searchable, and available whenever you need them.</p>

                <div class="useful-links">

                    <div class="filters">
                        <button class="active-btn" id="Btn1" style="background-image: initial; background-color: #3323a4; color: #fff;" onmouseover="this.style.backgroundColor='#fff'; this.style.color='black';" onmouseout="this.style.backgroundColor='#3323a4'; this.style.color='white';">What We Do?</button>
                        <button class="active-btn" id="Btn2" style="background-image: initial; background-color: #3323a4; color: #fff;" onmouseover="this.style.backgroundColor='#fff'; this.style.color='black';" onmouseout="this.style.backgroundColor='#3323a4'; this.style.color='white';">Our Mission</button>
                        <button class="active-btn" id="Btn3" style="background-image: initial; background-color: #3323a4; color: #fff;" onmouseover="this.style.backgroundColor='#fff'; this.style.color='black';" onmouseout="this.style.backgroundColor='#3323a4'; this.style.color='white';">Our Vision</button>
                    </div>

                    <!-- Button 1-->
                    <div class="filter-info" id="Btn1Filter">
                        <p style="margin-bottom: 1.5rem;">Our team specializes in two key areas: UI design and web development learning materials. We collaborate with clients to preserve digital content while creating engaging, high-quality educational resources focused on web development and UI/UX design.</p>
                        <div class="icon-list">
                            <p><i class="fa-solid fa-square-check"></i> 1+ Project Completed</p>
                            <p><i class="fa-solid fa-square-check"></i> Over 1+ year in UI design and Web development Industry</p>
                            <p><i class="fa-solid fa-square-check"></i> Collaborated with one company on a specific project </p>
                        </div>
                    </div>
                    <!-- Button 2 -->
                    <div class="filter-info" id="Btn2Filter">
                        <p style="margin-bottom: 1.5rem;">Our mission is to empower individuals and organizations by creating impactful, high-quality learning materials in UI/UX design and web development. We are committed to helping our clients preserve key concepts while delivering engaging, accessible resources that inspire growth, innovation, and mastery in the digital design and development space.</p>
                        <div class="icon-list">
                            <p><i class="fa-solid fa-square-check"></i> Fast and reliable response times to technical issues</p>
                            <p><i class="fa-solid fa-square-check"></i> Collaborative and team-oriented approach to problem-solving</p>
                            <p><i class="fa-solid fa-square-check"></i> Strong emphasis on communication and transparency with clients</p>
                        </div>
                    </div>

                    <!-- Button 3 -->
                    <div class="filter-info" id="Btn3Filter">
                        <p style="margin-bottom: 1.5rem;">Our vision is to be a leading force in shaping the future of digital education, by creating innovative, accessible, and transformative learning experiences that bridge the gap between design and development. We envision a world where individuals and organizations can easily master the skills needed to thrive in the evolving digital landscape.</p>
                        <div class="icon-list">
                            <p><i class="fa-solid fa-square-check"></i> Digital Experience</p>
                            <p><i class="fa-solid fa-square-check"></i> Trusted Business Solution Provider</p>
                            <p><i class="fa-solid fa-square-check"></i> Tailor solutions to each client's unique needs</p>
                        </div>
                    </div>


                </div>

                <!-- OPTIONAL BUTTON 
                    <a href="#" class="glob-btn">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                -->
            </div>

        </div>

    </section>
    <!-- === About Section END === -->

    <!-- ============================================= -->

    <!-- ==== Services Seciton ==== -->
    <section id="service" class="padding">

        <!--- First col -->
        <div class="first-col">

            <div class="ser-info">
                <h3 class="sub-heading">About Our Services</h3>
                <h2 class="heading">End-To-End Digital & IT Solutions.</h2>
                <p class="sub-para" style="margin-top: 1.5rem;">Maximizing the potential of your digital presence with our expert solutions. Our team offers a range of digital services to help your business reach its full potential. Let us turn your digital dreams into reality.</p>
            </div>

            <div class="feature-box">
                <i class="fa-brands fa-app-store"></i>
                <h3>App Development</h3>
                <p>Our team creates cutting-edge applications for iOS and Android devices, ensuring optimal performance and user engagement.</p>
            </div>

            <div class="feature-box">
                <i class="fa-brands fa-uncharted"></i>
                <h3>Web Development</h3>
                <p>We build high-quality, responsive websites that are visually stunning and easy to navigate, from simple landing pages to complex e-commerce platforms.</p>
            </div>

        </div>

        <!-- Second Col -->
        <div class="second-col">

            <div class="feature-box">
                <i class="fa-solid fa-palette"></i>
                <h3>UI-UX Design</h3>
                <p>Our designers create engaging and intuitive interfaces that improve the user experience and conversion rates, using data-driven testing for maximum usability and satisfaction.</p>
            </div>

            <div class="feature-box">
                <i class="fa-solid fa-clapperboard"></i>
                <h3>Usability Testing</h3>
                <p>We identify and fix any issues with your website or application, ensuring a seamless user experience and engagement through various testing methodologies.</p>
            </div>

            <div class="feature-box">
                <i class="fa-solid fa-chart-bar"></i>
                <h3>Info-Tecture</h3>
                <p>Our services organize and structure your website or application for maximum user engagement and conversion rates, using a user-centric approach to design and testing.</p>
            </div>


        </div>

        <div class="second-col">

            <div class="feature-box">
                <i class="fa-brands fa-figma"></i>
                <h3>Wireframing</h3>
                <p>Our wireframing services help bring your digital ideas to life through visual representation, ensuring that your website or app design is functional and effective.</p>
            </div>

            <div class="feature-box">
                <i class="fa-solid fa-circle-half-stroke"></i>
                <h3>Color Theory</h3>
                <p>Our color theory expertise ensures that the colors used in your digital design are visually appealing, harmonious, and effectively communicate your brand message.</p>
            </div>

            <div class="feature-box">
                <i class="fa-solid fa-font"></i>
                <h3>Typography</h3>
                <p>Our typography services focus on selecting and arranging typefaces to make your digital content both aesthetically pleasing and easy to read, helping to enhance user engagement.</p>
            </div>


        </div>


    </section>
    <!-- ==== Services Seciton END ==== -->

    <!-- ============================================= -->

    <!-- ===== Banner Section START ==== -->
    <section id="banner" style="background: linear-gradient(to bottom, #131516, #131516), url("images/newbanner2-bg.png") no-repeat;background: url("../images/newbanner2-bg.png");">
        <div class="cols" style="margin-left: 4rem;">
            <h1 style="width: 70vh;">Unlock the secrets of success with our must-read collection of blogs.</h1>
        </div>
        <a href="added_blogs.php" style="margin-right: 4.5rem;" class="glob-btn">Learn More <i class="fa-solid fa-arrow-right"></i></a>
    </section>
    <!-- ===== Banner Section END ==== -->

    <!-- ============================================================================= -->

    <!-- ===== Portfolio Section START ===== -->
    <!-- HIDE FOR MEANTIME
    <section id="portfolio" class="padding">
        <h3 class="sub-heading center">Portfolio</h3>
        <h2 class="heading center">Let our work speak for itself!</h2>
        <p class="sub-para center">Experience the power of our exceptional work - explore our portfolio now.</p>

        <div class="portfolio-row">

            
            <div class="img-box">
                <div class="img">
                    <img src="img/portfolio/ui_ux_design.png" alt="Portfolio Image">
                </div>
                <div class="img-info">
                    <h3>WorkPress</h3>
                    <p>Project Source</p>
                    <a href="#"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                </div>
            </div>
            
            <div class="img-box">
                <div class="img">
                    <img src="img/portfolio/portfolio-2.jpg" alt="Portfolio Image">
                </div>
                <div class="img-info">
                    <h3>WorkPress</h3>
                    <p>Project Source</p>
                    <a href="#"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                </div>
            </div>
            
            
            <div class="img-box">
                <div class="img">
                    <img src="img/portfolio/portfolio-3.jpg" alt="Portfolio Image">
                </div>
                <div class="img-info">
                    <h3>WordPress</h3>
                    <p>Project Source</p>
                    <a href="#"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                </div>
            </div>

        </div>


    </section>
    ENDS HERE! -->

    <!-- NEW FEATURES -->
        <div class="container-fluid" id="faqs" style="margin-bottom: 8.5rem; width: 125vh">
            <h3 class="sub-heading center">FAQS</h3>
            <h3 class="heading center">Clarifying Your Queries: Your Questions, Our Answers</h3>
            <br>
            <br>
            <div class="accordion">
                <div class="icon"></div>
                <h5 style="color: #d4d1cb;">What is the purpose of this web-based book archiving system?</h5>
            </div>
            <div class="panel">
                <p>This tool is designed to help users easily organize and access their web development and UI/UX design learning materials. It ensures seamless storage of digital books, articles, and resources, providing quick access whenever needed.</p>
            </div>

            <div class="accordion">
                <div class="icon"></div>
                <h5 style="color: #d4d1cb;">How does this system organize content?</h5>
            </div>
            <div class="panel">
                <p>The system allows users to archive and categorize their learning materials in one central location. Whether it’s books, tutorials, or resources, users can efficiently store and retrieve relevant materials for both web development and UI/UX design, keeping everything organized and easily accessible.</p>
            </div>

            <div class="accordion">
                <div class="icon"></div>
                <h5 style="color: #d4d1cb;">What makes this tool simple and effective?</h5>
            </div>
            <div class="panel">
                <p>This tool is designed with user-friendliness in mind. The intuitive interface requires no steep learning curve, and the organization features—such as categories, tags, and search filters—make it easy to locate any archived material within seconds.</p>
            </div>

            <div class="accordion">
                <div class="icon"></div>
                <h5 style="color: #d4d1cb;">Is it possible to organize my materials in specific categories?</h5>
            </div>
            <div class="panel">
                <p>Absolutely! The system allows you to categorize your materials based on topics, such as "Web Development," "UI/UX Design," "Frontend," "Backend," etc. You can also add custom tags to further personalize and organize your collection.</p>
            </div>

            <div class="accordion">
                <div class="icon"></div>
                <h5 style="color: #d4d1cb;">Can I search for specific materials within my collection?</h5>
            </div>
            <div class="panel">
                <p>Yes, the system includes a powerful search function. You can search by title, author, tags, or any custom criteria you set, enabling you to quickly find the exact learning material you need.</p>
            </div>
        </div>
    <!-- ENDS HERE! -->

    <!-- ===== Portfolio Section END ===== -->

    <!-- ========================================================================== -->

    <!-- === Our Team Section START === -->

    <section class="home" id="team">
        <div id="team" class="padding" style="background-color: #131516; padding: 1%; padding-top: 5rem; padding-bottom: 2.5rem;">
            <h3 class="sub-heading center">Team</h3>
            <h3 class="heading center">Introducing Ours</h3>
            <p class="sub-para center">Our Website's Innovators, Visionaries, and the Stars Behind Our Successful Website</p>

            <!-- Filter Text Links with Dividers -->
            <div class="filter-buttons center" style="margin-top: 15px;">
                <span class="filter-btn-team" data-filter="programmer">Programmer</span> 
                <span class="divider">|</span>
                <span class="filter-btn-team" data-filter="content-creator">Content Creator</span> 
                <span class="divider">|</span>
                <span class="filter-btn-team" data-filter="resource-person">Resource Person</span>
            </div>

            <!-- Team Members Section -->
            <div class="team-row" style="display: flex;">

                <!-- Person-1 (Programmer) -->
                <div class="img-box programmer">
                    <div class="img">
                        <img src="img/team/icon_id.png" alt="">
                        <div class="icons">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="img-info">
                        <h3>Jayssen</h3>
                        <p>Front-End</p>
                    </div>
                </div>

                <!-- Person-2 (Programmer) -->
                <div class="img-box programmer">
                    <div class="img">
                        <img src="img/team/sabado_id.png" alt="">
                        <div class="icons">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="img-info">
                        <h3>Fertony Jr.</h3>
                        <p>Project Manager</p>
                    </div>
                </div>

                <!-- Person-3 (Programmer) -->
                <div class="img-box programmer">
                    <div class="img">
                        <img src="img/team/icon_id.png" alt="">
                        <div class="icons">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="img-info">
                        <h3>Keiran</h3>
                        <p>Back-End</p>
                    </div>
                </div>

                <!-- Person-2 (Content Creator) -->
                <div class="img-box content-creator">
                    <div class="img">
                        <img src="img/team/icon_id.png" alt="">
                        <div class="icons">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="img-info">
                        <h3>Charles Adrian</h3>
                        <p>Content Strategist</p>
                    </div>
                </div>

                <!-- Person-2 (Content Creator) -->
                <div class="img-box content-creator">
                    <div class="img">
                        <img src="img/team/icon_id.png" alt="">
                        <div class="icons">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="img-info">
                        <h3>Mary Rose</h3>
                        <p>Content Moderator</p> 
                    </div>
                </div>

                <!-- Person-2 (Content Creator) -->
                <div class="img-box content-creator">
                    <div class="img">
                        <img src="img/team/sabado_id.png" alt="">
                        <div class="icons">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="img-info">
                        <h3>Fertony Jr.</h3>
                        <p>Researcher</p> 
                    </div>
                </div>

                <!-- Person-3 (Resource Person) -->
                <div class="img-box resource-person">
                    <div class="img">
                        <img src="img/team/icon_id.png" alt="">
                        <div class="icons">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="img-info">
                        <h3>John Sidrick</h3>
                        <p>Tech-Support</p>
                    </div>
                </div>

                <!-- Person-3 (Resource Person) -->
                <div class="img-box resource-person">
                    <div class="img">
                        <img src="img/team/icon_id.png" alt="">
                        <div class="icons">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="img-info">
                        <h3>Charles Ardian</h3>
                        <p>Tech-Support</p>
                    </div>
                </div>

                <!-- Person-3 (Resource Person) -->
                <div class="img-box resource-person">
                    <div class="img">
                        <img src="img/team/icon_id.png" alt="">
                        <div class="icons">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="img-info">
                        <h3>John Lenard</h3>
                        <p>Tech-Support</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- === Our Team Section END ==== -->

    <!-- ==========================================================-->

    <!-- === Contact Section START-->
    <section id="contact" class="padding">

        <div class="contact-row">

            <!-- Left Col-->
            <div class="left-col">
                <h3 class="sub-heading">Contact</h3>
                <h2 class="heading">Want to start Project? <br> with Us</h2>
                <p class="sub-para">Got a question, a proposal, or just want to say hi? We'd love to hear from you! Send us a message and let's start a conversation<br><br>We're all ears! Get in touch with our team and let's bring your vision to life.</p>
                
                <!-- Email Box-->
                <div class="cont-box">
                    <div class="icon">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div class="info">
                        <h4>Email:</h4>
                        <p>info@hoopoelink.com</p>
                    </div>
                </div>

                <!-- Phone Box-->
                <div class="cont-box">
                    <div class="icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="info">
                        <h4>Phone:</h4>
                        <p>(+966)-50722-2677  |  (+966)-50533-3974</p>
                        
                    </div>                
                </div>

                <!-- Location Box-->
                <div class="cont-box">
                    <div class="icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="info">
                        <h4>Location:</h4>
                        <p>Amerah Hub, 12363, Al Mohammadiyyah, Riyadh, KSA 12363</p>
                    </div>                
                </div>                
            
            </div>

            <!-- Right col-->

            <div class="right-col">
            <form action="" method="post">
                <h3 style="font-size: 20px; text-align: center; font-family: poppins;">Say something!</h3>
                <input type="text" name="name" required placeholder="enter your name" class="box">
                <input type="email" name="email" required placeholder="enter your email" class="box">
                <input type="number" name="number" required placeholder="enter your number" class="box">
                <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea> <!-- max. 91 words -->
                <input type="submit" style="margin-bottom: 1rem;" value="send message" name="send" class="btn">
            </form>
            </div>

        </div>

    </section>

    <!-- === Contact Section END =====-->

    <!-- =======================================-->

    <!-- footer Section START-->
    <!-- THW DEVELOPER HIDE THIS FEATURES FOR MEANTIME
        <footer class="padding">
            
            <div class="footer-row">

                1st Col 
                <div class="footer-col">
                    <img src="img/company-logo-green.png" alt="Company Logo">
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit minus saepe aliquam labore hic exercitationem, esse magni veritatis doloremque, placeat perferendis! Consectetur ipsum magni nesciunt temporibus maxime consequuntur autem optio.
                    </p>
                </div>

                2nd Col
                <div class="footer-col">
                    <h2>Ouick Links</h2>
                    <div class="divider"></div>

                    <div class="icon-list">
                        <a href="#"><i class="fa-solid fa-angle-right"></i> Home</a>
                        <a href="#"><i class="fa-solid fa-angle-right"></i> About</a>
                        <a href="#"><i class="fa-solid fa-angle-right"></i> Services</a>
                        <a href="#"><i class="fa-solid fa-angle-right"></i> Contact</a>
                        <a href="#"><i class="fa-solid fa-angle-right"></i> Portfolio</a>

                    </div>
                </div>

                3rd Col
                <div class="footer-col">
                    <h2>Ouick SocialMedia</h2>
                    <div class="divider"></div>

                    <div class="icon-list">
                        <a href="#"><i class="fa-solid fa-angle-right"></i> Twitter</a>
                        <a href="#"><i class="fa-solid fa-angle-right"></i> Facebook</a>
                        <a href="#"><i class="fa-solid fa-angle-right"></i> Youtube</a>
                        <a href="#"><i class="fa-solid fa-angle-right"></i> Instagram</a>
                        <a href="#"><i class="fa-solid fa-angle-right"></i> LinkedId</a>

                    </div>
                </div>

                4th Col
                <div class="footer-col">
                    <h2>Contact-Info</h2>
                    <div class="divider"></div>

                    <div class="icon-list">
                        <a href="#"><i class="fa-solid fa-phone"></i> +63 03942939429</a>
                        <a href="#"><i class="fa-solid fa-envelope-open-text"></i> sodjoajdoaijdi@gmail.com</a>
                        <a href="#"><i class="fa-solid fa-location-dot"></i> joasjfja, jasjakofaof</a>
                    </div>
                </div>

            </div>

            <div class="credit">
                <p>&copy; CopyRight 2023 Desgined By <a href="http://msani.yzx">MohammaddSani</a></p>
            </div>

        </footer>
    ENDS HERE! -->
    <!-- footer Section END-->

    



    <!-- FontAwesome JS File (Icon File) -->
    <script src="https://kit.fontawesome.com/45a62183ec.js" crossorigin="anonymous"></script>
    <!-- Main JS File -->
    <script src="js/logic.js"></script>
    <script src="js/accordion.js"></script>

</body>
</html>