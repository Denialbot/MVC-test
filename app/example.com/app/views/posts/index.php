<?php include(APPROOT."/views/includes/header.php"); ?>
<h1> <?php echo $data['title'] ?> </h1>
<?php
    foreach($data['posts'] as $post): ?>
    <div class="indexbox">
        <h6><?php echo $post->title; ?></h6>
        <p>
            <?php
                if(strlen($post->post) < 20){
                    echo $post->post;
                } else{
                    echo substr($post->post,0,15);
                }
            ?>
        </p>
        <a href="<?php echo URLROOT ?>/posts/post/<?php echo $post->id; ?>">read more...</a>
    </div>
    <?php endforeach; ?>
<?php include(APPROOT."/views/includes/footer.php"); ?>