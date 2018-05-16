<?php include(APPROOT."/views/includes/header.php"); ?>
    <h1><?php echo $data['title'] ?></h1>
    <?php foreach($data['posts'] as $post): ?>
        <div id="post-<?php echo $post->id ?>">
            <?php echo $post->id ?>: <?php echo $post->title ?> <a href="#" data-id="<?php echo $post->id ?>" data-url="<?php echo URLROOT ?>" class="deletion btn btn-danger btn-sm">delete post</a>
        </div>
    <?php endforeach;?>
<?php include(APPROOT."/views/includes/footer.php"); ?>
<script src="<?php echo URLROOT ?>/public/js/main.js"></script>