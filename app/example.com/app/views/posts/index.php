<?php include(APPROOT."/views/includes/header.php"); ?>
<h1> <?php echo $data['title'] ?> </h1>
<?php
    foreach($data['posts'] as $post): ?>
    <div>
        <?php echo $post->id; ?>
    </div>
    <?php endforeach; ?>
<?php include(APPROOT."/views/includes/footer.php"); ?>