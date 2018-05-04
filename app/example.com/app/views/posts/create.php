<?php include(APPROOT."/views/includes/header.php"); ?>
<?php if($_SESSION['logged in'] == false){
    redirect("posts/index");
}  ?>
<h1> <?php echo $data['title'] ?> </h1>
    <form method="post" id="blogpost">
        <div class="form-group">
            <input type="text" name="postTitle" class="form-control form-control-lg" value="<?php echo $data['postTitle'] ?>" placeholder="Post Title:" />
        </div>
        <div class="form-group">
            <label for="postContent">Content:</label>
            <textarea class="form-control" form="blogpost" id="postContent" name="postContent" rows="3" maxlength="1000"><?php echo $data['postContent'] ?></textarea>
        </div>
        <input class="btn btn-primary" type="submit" value="Create Post" />
    </form>
<?php include(APPROOT."/views/includes/footer.php"); ?>