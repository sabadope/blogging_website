<?php
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
?>

<header class="header">

   <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>

   <div class="profile">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <h3 style="font-size: 2.7rem;"><font color="#a6bcce">welcome!</font></h3>
      <p style="padding:1.5rem; border-radius: .5rem; font-size: 1.8rem; border:var(--border); margin:1rem 0; background-color: #1e2021;"><font color="#a8a095"><?= $fetch_profile['name']; ?></font></p>
      
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i> <span>home</span></a>
      <a href="add_posts.php"><i class="fas fa-pen"></i> <span>add posts</span></a>
      <a href="view_posts.php"><i class="fas fa-eye"></i> <span>view posts</span></a>
      <a href="users_accounts.php"><i class="fas fa-user"></i> <span>accounts</span></a>
      <a href="admin_message.php"><i class="fas fa-envelope"></i> <span>message</span></a>
      <a href="../components/admin_logout.php" style="color:var(--red);" onclick="return confirm('logout from the website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
   </nav>

   <!-- THE DEVELOPER HIDE THIS FEATURES FOR MEANTIME
      <div class="flex-btn">
         <a href="admin_login.php" class="option-btn">login</a>
         <a href="register_admin.php" class="option-btn">register</a>
      </div>
   ENDS HERE! -->

</header>

<div id="menu-btn" class="fas fa-bars"></div>