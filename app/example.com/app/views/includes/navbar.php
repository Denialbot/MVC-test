<div class="menu"><?php  ?>
    <?php session_start() ?>
    <a class="menulink" href="<?php echo URLROOT ?>/posts/index">Main</a>
    <?php
    if($_SESSION['logged in'] == true){
    echo '<a class="menulink" href="'.URLROOT.'/posts/dashboard">Admin Control</a>';
    echo '<a class="menulink" href="'.URLROOT.'/posts/create">New Post</a>';
     //echo '<a class="menulink" href="'.URLROOT.'/posts/dashboard">Log Out</a>'; borde Login/ Logout vara under separat controller?
    }
    ?>
</div>