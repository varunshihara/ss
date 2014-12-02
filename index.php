<?php
/**
 * Including header file.
 * Contains Navbar.
 */
require_once 'header.php';

/**
 * Session variable to show messages,
 * Like Login Successful.
 */
if(Session::exists('home')) {
    echo '<div class="alert alert-success" role="alert">' . Session::flash('home') . '</div><br>';
}

?>
    <!--<div class="jumbotron">
        <img src="" width="100%" height="300">
        <h1>Images</h1>
    </div>-->
    <!-- Start Slider section -->
    <div class="container">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="images/slider-images/1.jpg" alt="">
            </div>
            <div class="item">
                <img src="images/slider-images/2.jpg" alt="">
            </div>
            <div class="item">
                <img src="images/slider-images/3.jpg" alt="">
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- End Slider section -->


        <h3>Latest Products</h3>

        <?php
        $db = DB::getInstance();
        $items = $db->action('SELECT *', 'ss_item', array("1", "=", "1"), 8);
        $count = $items->count();
        $items = $items->results();
        for($x = 0; $x<$count; $x++) {
        ?>
            <div class="row">
                <?php
                $y=0;
                for($y = 0; $y < 4; $y++) {
                ?>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                    <?php
                    if($x>=$count) {
                        echo '';
                    } else {
                        ?>
                        <div id="over" class="thumbnail">
                            <!--<div class="image">-->
                                <img src="product-images/<?=$items[$x]->image ?>" class="img-responsive">
                            <!--</div>-->
                            <div class="caption">
                                <b><a href="item.php?id=<?=$items[$x]->id ?>"><?=$items[$x]->name ?></a></b>
                                <br>Rs : <?=$items[$x]->price ?>
                                <p><?=$items[$x]->description ?></p>
                                <button class="btn btn-primary btn-block center-block" onclick="cart('<?=$items[$x]->id ?>')">Add to Cart</button>
                            </div>
                        </div>
                        <?php
                    }
                    $x++;
                    ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
<?php
/**
 * Include Footer file
 */
require_once 'footer.php';