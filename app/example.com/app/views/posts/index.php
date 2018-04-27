<?php include(APPROOT."/views/includes/header.php"); ?>
HOMEPAGE
<?php
    foreach($data['posts'] as $post): ?>
    <div>
        <?php echo $post->id; ?>
    </div>
    <?php endforeach; ?>
<?php include(APPROOT."/views/includes/footer.php"); ?>