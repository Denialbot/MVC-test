<div class="menu"><?php  ?>
    <?php session_start() ?>
    <a class="menulink" href="<?php echo URLROOT ?>/posts/index">Main</a>
    <?php
    if($_SESSION['logged in'] == true){
        echo '<a class="menulink" href="'.URLROOT.'/posts/dashboard">Admin Control</a>';
        echo '<a class="menulink" href="'.URLROOT.'/posts/create">New Post</a>';
        echo '<a class="menulink forceright" href="'.URLROOT.'/posts/logout">Log Out</a>';
    }
    else{
        echo '<a class="menulink forceright" href="'.URLROOT.'/posts/login">Log In</a>';
        echo '<a class="menulink" href="'.URLROOT.'/posts/register">Register</a>';
    }
    ?>
</div>