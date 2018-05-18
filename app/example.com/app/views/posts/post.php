<?php include(APPROOT."/views/includes/header.php"); ?>
<h1><?php echo $data['postTitle'] ?></h1>
<?php if($data['hasimage'] == 1): ?>
    <div><img src="<?php echo URLROOT ?>/uploads/<?php echo $data['imagename'] ?>" alt="Related Image" ></img></div>
<?php endif ?>
<p><?php echo $data['content'] ?></p>
<h2>Comments</h2>
<?php foreach($data['comments'] as $comment):?>
    <div class="indexbox">
        <h6><?php echo $comment->poster?></h6>
        <p>
            <?php echo $comment->comment ?>
        </p>
    </div>
<?php endforeach ?>
<?php if($data['loggedin']):?>
    <?php if($data['canedit']):?>
        <a href="<?php echo URLROOT ?>/posts/edit/<?php echo $data['postid'] ?>">Edit Post</a> 
    <?php endif ?>
    <form method="post" id="commentattempt">
    <div class="form-group">
        <label for="Comment">New Comment:</label>
        <textarea class="form-control" form="commentattempt" id="newcomment" name="newcomment" rows="3" maxlength="255"></textarea>
    </div>
    <input class="btn btn-primary" type="submit" value="Post Comment" />
    </form>
<?php endif ?>
<?php include(APPROOT."/views/includes/footer.php"); ?>