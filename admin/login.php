<?php
require_once '../init.php';

if($_POST['user'] && $_POST['password']) {
    $database->login($_POST['user'], $_POST['password']);
}
?>
<div class="row">

    <div class="col-md-3"></div>

    <div class="col-md-6">
        <form action="<?=$_SERVER['PHP_SELF']; ?>" method="post" class="form-group">
            <input type="text" name="user" required class="form-control" placeholder="Username"><br>
            <input type="password" name="password" required class="form-control" placeholder="Password"><br>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>

    <div class="col-md-3"></div>
</div>

<?php require_once 'footer.php'; ?>