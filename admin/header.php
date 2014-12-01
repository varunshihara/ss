<?php

if(file_exists('../config.php')) {
    require_once '../config.php';
} else {
    echo("Missing Configuration File.");
}
require_once($_SERVER["DOCUMENT_ROOT"] . 'ss/core/init.php');

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('../login.php');
} elseif($user->hasPermission('user')) {
    Redirect::to('../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Steel Shoppers</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="script/ajax.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/modal.css">
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "textarea#description",
            theme: "modern",
            height: 200,

            content_css: "css/content.css",
            toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });
    </script>

</head>

<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Steel Shoppers</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catalog <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="category.php">Category</a></li>
                        <li><a href="item.php">Items</a></li>
                    </ul>
                </li>
                <li><a href="users.php">Accounts </a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sell <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Orders</a></li>
                        <li><a href="#">Sellers</a></li>
                        <li><a href="#">Customers</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php
                if($user->isLoggedIn()) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user->data()->username; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="<?php echo HTTP_SERVER; ?>changepassword.php">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo HTTP_SERVER; ?>update.php">Settings</a></li>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <li>
                    <?php
                    if($user->isLoggedIn()) {
                        echo '<a href="' . HTTP_SERVER . 'logout.php"><span class="glyphicon glyphicon-log-out"></span></a>';
                    } else {
                        echo '<a href="' . HTTP_SERVER . 'login.php"><span class="glyphicon glyphicon-log-in"></span></a>';
                    }
                    ?>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">