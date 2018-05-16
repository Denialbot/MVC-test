<?php include(APPROOT."/views/includes/header.php"); ?>
<h1> <?php echo $data['title'] ?> </h1>
<form method="post" id="loginattempt">
        <div class="form-group">
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo $data['username'] ?>" placeholder="Username:" />
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password:" />
        </div>
        <input class="btn btn-primary" type="submit" value="Attempt Login" />
    </form>
<?php include(APPROOT."/views/includes/footer.php"); ?>