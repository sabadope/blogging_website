<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/like_post.php';

/* HIDE FOR MEANTIME couz it's optional
    $get_id = $_GET['post_id'];
ENDS HERE! */

if(isset($_POST['add_comment'])){

   $admin_id = $_POST['admin_id'];
   $admin_id = filter_var($admin_id, FILTER_SANITIZE_STRING);
   $user_name = $_POST['user_name'];
   $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
   $comment = $_POST['comment'];
   $comment = filter_var($comment, FILTER_SANITIZE_STRING);

   $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ? AND admin_id = ? AND user_id = ? AND user_name = ? AND comment = ?");
   $verify_comment->execute([$get_id, $admin_id, $user_id, $user_name, $comment]);

   if($verify_comment->rowCount() > 0){
      $message[] = 'comment already added!';
   }else{
      $insert_comment = $conn->prepare("INSERT INTO `comments`(post_id, admin_id, user_id, user_name, comment) VALUES(?,?,?,?,?)");
      $insert_comment->execute([$get_id, $admin_id, $user_id, $user_name, $comment]);
      $message[] = 'new comment added!';
   }

}

if(isset($_POST['edit_comment'])){
   $edit_comment_id = $_POST['edit_comment_id'];
   $edit_comment_id = filter_var($edit_comment_id, FILTER_SANITIZE_STRING);
   $comment_edit_box = $_POST['comment_edit_box'];
   $comment_edit_box = filter_var($comment_edit_box, FILTER_SANITIZE_STRING);

   $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE comment = ? AND id = ?");
   $verify_comment->execute([$comment_edit_box, $edit_comment_id]);

   if($verify_comment->rowCount() > 0){
      $message[] = 'comment already added!';
   }else{
      $update_comment = $conn->prepare("UPDATE `comments` SET comment = ? WHERE id = ?");
      $update_comment->execute([$comment_edit_box, $edit_comment_id]);
      $message[] = 'your comment edited successfully!';
   }
}

if(isset($_POST['delete_comment'])){
   $delete_comment_id = $_POST['comment_id'];
   $delete_comment_id = filter_var($delete_comment_id, FILTER_SANITIZE_STRING);
   $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
   $delete_comment->execute([$delete_comment_id]);
   $message[] = 'comment deleted successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS File-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Responsive</title>

    <style>
        * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        }

        .modal-content {
        background-color: #fff;

        }

        .tabs {
        position: fixed;
        top: 56%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 850px;
        height: 560px;
        padding: 30px 20px;
        overflow: hidden;
        box-shadow: 0 0 15px 0 #031006;
        }

        .tabs .tab-header {
        float: left;
        width: 180px;
        height: 100%;
        border-right: 1px solid #fff;
        padding: 50px 0;
        
        }

        .tabs .tab-header > div {
        height: 50px;
        line-height: 50px;
        font-size: 16px;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
        padding-left: 10px;
        }

        .tabs .tab-header > div:hover,
        .tabs .tab-header > div.active {
        color: #4834d4;
        }

        .tabs .tab-header div i {
        display: inline-block;
        width: 25px;
        }

        .text-white {
        color: #fff;
        height: auto; /* set a fixed height */
        overflow-y: auto; /* only show vertical scrollbar */
        overflow-x: hidden; /* hide horizontal scrollbar */
        max-height: 500px; /* Change this to whatever height you prefer */
        font-size: 16px;
        
        }

        .tab-content {
        position: relative;
        height: 100%;
        overflow: hidden;
        }

        .tab-content > div {
        position: absolute;
        text-align: center;
        padding: 40px 20px;
        top: -200%;
        transition: all 500ms ease-in-out;
        }

        .tab-content > div.active {
        top: 0;
        }

        .tab-content > div i {
        display: inline-block;
        width: 60px;
        height: 60px;
        line-height: 60px;
        background: #4834d4;
        color: #fff;
        font-size: 28px;
        font-weight: 600;
        text-align: center;
        border-radius: 10%;
        }

        .tab-content > div h2 {
        margin-top: 8px;
        }

        .tab-indicator {
        position: absolute;
        width: 5px;
        height: 50px;
        background: #4834d4;
        left: 197px;
        top: 80px;
        transition: all 500ms ease-in-out;
        }

        .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        }

        .modal-content {
        position: relative;
        margin: auto;
        padding: 0;
        border: none;
        width: 80%;
        max-width: 700px;
        }

        .close {
        color: #aaa;
        position: absolute;
        top: 80px;
        right: -66px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        font-size: 4.5rem;
        }

        .close:hover,
        .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
        }

        /* Set the width of the scrollbar */
        ::-webkit-scrollbar {
        width: 5px;
        }

        /* Set the style of the scrollbar track */
        ::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        }

        /* Set the style of the scrollbar thumb */
        ::-webkit-scrollbar-thumb {
        background-color: #4834d4;
        border-radius: 5px;
        }

        /* Set the style of the scrollbar thumb when hovered */
        ::-webkit-scrollbar-thumb:hover {
        background-color: #555;
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

    <div class="tabs">
        <div class="tab-header">
            <div class="active">
                <i class="fa-regular fa-copyright"></i> Copyright
            </div>
            <div>
                <i class="fa-solid fa-shield-halved"></i> User Conduct
            </div>
            <div>
                <i class="fa-solid fa-user-lock"></i> Privacy Policy
            </div>
            <div>
                <i class="fa-solid fa-circle-exclamation"></i> Liability
            </div>
            
        </div>
        <div class="tab-indicator"></div>
        <div class="tab-content">
        <div class="text-white active" style="overflow-y: scroll;">
                <i class="fa-regular fa-copyright"></i>
                <h2>Copyright and Ownership</h2>
                <p style="text-align: left; margin-top: 3.5rem;">All content and materials provided on this website, including but not limited to text, graphics, logos, images, and software, are the property of Hoopoelink Company and are protected by international copyright laws. Users may not reproduce, distribute, or modify any content on this website without the express written permission of Hoopoelink Company.
                <br><br><font size="3.5rem;"><b>Intellectual Property Rights</b></font>
                <br><br>In addition to copyrights, you may want to mention any other intellectual property rights that apply to the content on your website, such as trademarks, patents, or trade secrets.
                <br><br><font size="3.5rem;"><b>User-Generated Content</b></font>
                <br><br>If users are allowed to post content on your website, it's important to include a clause that addresses ownership of that content. You may want to specify that users retain ownership of their own content, but that they grant Hoopoelink Company a license to use and display that content on the website.
                <br><br><font size="3.5rem;"><b>DMCA Compliance</b></font>
                <br><br>You may want to include information about how your website complies with the Digital Millennium Copyright Act (DMCA), which provides a mechanism for copyright owners to request that infringing content be removed from websites.
                <br><br><font size="3.5rem;"><b>Fair Use</b></font>
                <br><br>You may want to include a clause that explains the concept of fair use, which allows for limited use of copyrighted materials without permission for purposes such as criticism, commentary, news reporting, teaching, scholarship, or research.
                <br><br><font size="3.5rem;"><b>Infringement Notification</b></font>
                <br><br>You may want to include information about how users can notify Hoopoelink Company if they believe that content on the website infringes on their intellectual property rights.
                <br><br><br><br><font size="2rem;"><b>By using this website, you agree to be bound by these terms and conditions. If you do not agree to these terms and conditions, you may not access or use this website. Hoopoelink Company reserves the right to modify this agreement at any time, without notice. It is the responsibility of the user to review this agreement periodically for any changes.</b></font>

                <br><br><font size="2rem;"><b>If you have any questions or concerns about this agreement, please inform us at [info@hoopoelink.com].</b></font>

                <br><br><font size="2rem;"><b>Thank you for using Web-based Book Archiving for Hoopoelink Company.</font></b></p>
        </div>
        <div class="text-white">
                <i class="fa-solid fa-shield-halved"></i>
                <h2>User Conduct</h2>
                <p style="text-align: left; margin-top: 3.5rem;">Users of this website must agree to use the site for lawful purposes only. Users may not upload, post, or transmit any content that is illegal, defamatory, or otherwise offensive. Users are responsible for ensuring that any content they submit does not violate the rights of any third parties. <br><br>Users of the Hoopoelink Company website are expected to conduct themselves in a responsible and respectful manner at all times. Users may not use the website to engage in any activity that is illegal, harmful, or infringes on the rights of others. Prohibited activities include, but are not limited to:
                <br><br><font size="3.5rem;"><b>Harassment or Discrimination</b></font>
                <br><br>Users may not use the website to harass, bully, or discriminate against any other person or group of people on the basis of race, gender, sexual orientation, religion, or any other characteristic protected by law.
                <br><br><font size="3.5rem;"><b>Unauthorized Access or Use</b></font>
                <br><br>Users may not attempt to gain unauthorized access to any part of the website, or use the website in a manner that exceeds their authorized access.
                <br><br><font size="3.5rem;"><b>Spamming or Malware</b></font>
                <br><br>Users may not use the website to send spam or other unsolicited messages, or to distribute malware or other harmful software.
                <br><br><font size="3.5rem;"><b>Impersonation or Misrepresentation</b></font>
                <br><br>Users may not impersonate any other person or entity, or misrepresent their affiliation with any other person or entity.
                <br><br><font size="3.5rem;"><b>Content Restrictions</b></font>
                <br><br>Users may not post or distribute any content that is illegal, harmful, or infringes on the rights of others. Prohibited content includes, but is not limited to: content that is defamatory, obscene, or pornographic; content that infringes on any intellectual property rights; and content that contains viruses, malware, or other harmful software.
                <br><br><font size="3.5rem;"><b>Compliance with Laws</b></font>
                <br><br>Users are expected to comply with all applicable laws and regulations in their use of the website. Hoopoelink Company reserves the right to suspend or terminate user accounts that engage in prohibited activities or violate the terms and conditions of the website.
                <br><br><br><br><font size="2rem;"><b>By using this website, you agree to be bound by these terms and conditions. If you do not agree to these terms and conditions, you may not access or use this website. Hoopoelink Company reserves the right to modify this agreement at any time, without notice. It is the responsibility of the user to review this agreement periodically for any changes.</b></font>

                <br><br><font size="2rem;"><b>If you have any questions or concerns about this agreement, please inform us at [info@hoopoelink.com].</b></font>

                <br><br><font size="2rem;"><b>Thank you for using Web-based Book Archiving for Hoopoelink Company.</b></font></p>
        </div><div class="text-white">
                <i class="fa-solid fa-user-lock"></i>
                <h2>Privacy Policy</h2>
                <p style="text-align: left; margin-top: 3.5rem;">Hoopoelink Company respects the privacy of its users and is committed to protecting their personal information. The company's privacy policy is available on the website and outlines how user information is collected, used, and protected.
                <br><br><font size="3.5rem;"><b>Information We Collect</b></font>
                <br><br>We collect the following types of information from our users:

                <br><br><b>Personal Information -</b> This includes information such as your name, email address, and other contact information that you provide when you register for an account or submit a form on our website.
                <br><br><b>Usage Information -</b> We may collect information about how you use our website, such as the pages you visit and the links you click on.
                <br><br><b>Cookies - We may use</b> cookies or similar technologies to collect information about your browsing behavior on our website.
                <br><br><font size="3.5rem;"><b>How We Use Your Information</b></font>
                <br><br>We use your personal information for the following purposes:

                <br><br><b>To provide and improve our services to you.</b>
                <br><br><b>To communicate with you about our services and promotions.</b>
                <br><br><b>To personalize your experience on our website.</b>
                <br><br><b>To comply with legal or regulatory requirements.</b>
                <br><br>We may also use your information in an aggregated or anonymized form for research or analytical purposes.
                <br><br><font size="3.5rem;"><b>How We Protect Your Information</b></font>
                <br><br>We take reasonable measures to protect your personal information from unauthorized access, use, or disclosure. These measures may include physical, technical, and administrative safeguards.
                <br><br><font size="3.5rem;"><b>Sharing Your Information</b></font>
                <br><br>We may share your personal information with third-party service providers who perform services on our behalf, such as payment processing, email marketing, or website analytics. We may also share your information with law enforcement or regulatory authorities when required by law.
                <br><br><font size="3.5rem;"><b>Your Choices and Rights</b></font>
                <br><br>You have the right to access, correct, or delete your personal information that we have collected. You can also opt out of receiving marketing communications from us at any time.
                <br><br><font size="3.5rem;"><b>Updates to this Privacy Policy</b></font>
                <br><br>We may update this privacy policy from time to time. We will notify you of any material changes to the policy by posting a notice on our website.

                By using our website, you consent to the collection, use, and sharing of your personal information as described in this privacy policy.

                <br><br><br><br><font size="2rem;"><b>By using this website, you agree to be bound by these terms and conditions. If you do not agree to these terms and conditions, you may not access or use this website. Hoopoelink Company reserves the right to modify this agreement at any time, without notice. It is the responsibility of the user to review this agreement periodically for any changes.</b></font>

                <br><br><font size="2rem;"><b>If you have any questions or concerns about this agreement, please inform us at [info@hoopoelink.com].</b></font>

                <br><br><font size="2rem;"><b>Thank you for using Web-based Book Archiving for Hoopoelink Company.</font></b></p>
        </div><div class="text-white">
                <i class="fa-solid fa-circle-exclamation"></i>
                <h2>Liability Limitations</h2>
                <p style="text-align: left; margin-top: 3.5rem;">Hoopoelink Company provides the website and its contents on an "as is" and "as available" basis. Users access and use the website at their own risk. The company makes no representations or warranties of any kind, express or implied, including but not limited to the accuracy, reliability, or suitability of the information and materials provided on the website.

                <br><br>Hoopoelink Company shall not be liable for any damages, including but not limited to lost profits or data, that may result from the use of this website or the inability to use this website. The company shall not be liable for any content posted by users on the website. Users are solely responsible for the content they post and the consequences of such postings.

                <br><br>Hoopoelink Company does not warrant that the website will be uninterrupted or error-free, nor does it warrant the accuracy, completeness, or reliability of any information or content provided on the website. The company disclaims all warranties, express or implied, including but not limited to implied warranties of merchantability and fitness for a particular purpose.

                <br><br>In no event shall Hoopoelink Company be liable for any direct, indirect, incidental, special, or consequential damages arising out of or in connection with the use or inability to use the website, even if the company has been advised of the possibility of such damages.

                <br><br>By using our website, users agree to release Hoopoelink Company, its affiliates, and their respective officers, directors, employees, and agents from any and all claims, damages, or liabilities arising out of or in connection with the use of the website.
            
                <br><br><br><br><font size="2rem;"><b>By using this website, you agree to be bound by these terms and conditions. If you do not agree to these terms and conditions, you may not access or use this website. Hoopoelink Company reserves the right to modify this agreement at any time, without notice. It is the responsibility of the user to review this agreement periodically for any changes.</b></font>

                <br><br><font size="2rem;"><b>If you have any questions or concerns about this agreement, please inform us at [info@hoopoelink.com].</b></font>

                <br><br><font size="2rem;"><b>Thank you for using Web-based Book Archiving for Hoopoelink Company.</font></b></p></p>

        </div>
        
    </div>


    <script type="text/javascript">
        function _class(name) {
            return document.getElementsByClassName(name);
        }

        let tabPanes = _class("tab-header")[0].getElementsByTagName("div");

        for(let i = 0; i < tabPanes.length; i++) {
            tabPanes[i].addEventListener("click", function() {
                _class("tab-header")[0].getElementsByClassName("active")[0].classList.remove("active");

                tabPanes[i].classList.add("active");

                _class("tab-indicator")[0].style.top = `calc(80px + ${i*50}px)`;

                _class("tab-content")[0].getElementsByClassName("active")[0].classList.remove("active");

                _class("tab-content")[0].getElementsByTagName("div")[i].classList.add("active");
            });
        }
    </script>

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