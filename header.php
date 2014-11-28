<?php
require_once 'core/init.php';
$user = new User();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Steel Shoppers</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
    <script type="text/javascript" src="engine1/jquery.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
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
                <?php


                $category = new Category();

                if($category->exist()){
                    $data = $category->get()->results();

                    //var_dump($data);
                    $count = $category->rows();
                    for($x = 0; $x<$count; $x++) {
                        $id = $data[$x]->id;
                        $subCategory = $category->subCategory($id)->results();
                        if(empty($subCategory)) {
                    ?>

                    <li>
                        <a href="category.php?category=<?php echo $data[$x]->category; ?>"><?php echo $data[$x]->category; ?></a>
                    </li>
                    <?php
                        } else {
                            ?>
                            <li class="dropdown">
                                <a href="category.php?category=<?php echo $data[$x]->category; ?>"  class="dropdown-toggle" data-toggle="dropdown"><?php echo $data[$x]->category; ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php
                                    $subCount = $category->subRows();
                                    for($y = 0; $y<$subCount; $y++) {
                                        echo '<li><a href="#">' . $subCategory[$y]->sub_category . '</a></li>';
                                    }
                                    ?>
                                    <li class="divider"></li>
                                    <li><a href="category.php?category=<?php echo $data[$x]->category; ?>">See all <?php echo $data[$x]->category; ?></a></li>
                                </ul>
                            </li>
                            <?php
                        }
                    }

                }
                ?>
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
                        <li><a href="changepassword.php">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="update.php">Settings</a></li>
                    </ul>
                </li>
                <?php
                }
                ?>
                <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"><span class="badge" id="cart"></span></span></a></li>
                <li>
                    <?php
                    if($user->isLoggedIn()) {
                        echo '<a href="logout.php"><span class="glyphicon glyphicon-log-out"></span></a>';
                    } else {
                        echo '<a href="login.php"><span class="glyphicon glyphicon-log-in"></span></a>';
                    }
                    ?>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<?php
/*$subCategory = $category->subCategory('7');
if($subCategory->count()) {
    echo($subCategory->results()[0]->sub_category);
} else {
    echo "Success";
}*/
?>