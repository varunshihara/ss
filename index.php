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
    <div id="wowslider-container1">
        <div class="ws_images">
            <ul>
                <li><img src="data1/images/1.jpg" alt="1" title="" id="wows1_0"/></li>
                <li><img src="data1/images/2.jpg" alt="2" title="" id="wows1_1"/></li>
                <li><img src="data1/images/3.jpg" alt="3" title="" id="wows1_2"/></li>
                <li><img src="data1/images/4.jpg" alt="4" title="" id="wows1_3"/></li>
            </ul>
        </div>
        <div class="ws_bullets">
            <div>
                <a href="#" title="1"><img src="data1/tooltips/1.jpg" alt="1"/>1</a>
                <a href="#" title="2"><img src="data1/tooltips/2.jpg" alt="2"/>2</a>
                <a href="#" title="3"><img src="data1/tooltips/3.jpg" alt="3"/>3</a>
                <a href="#" title="4"><img src="data1/tooltips/4.jpg" alt="4"/>4</a>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="engine1/wowslider.js"></script>
    <script type="text/javascript" src="engine1/script.js"></script>
    <!-- End Slider section -->

    <div class="container">
        <h3>Latest Products</h3>
        <div class="row">
            <?php
            $db = DB::getInstance();
            $items = $db->action('SELECT *', 'ss_item', array("1", "=", "1"), 4);
            $items = $items->results();
            for($x = 0; $x<4; $x++) {
            ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div id="over" class="over">
                    <div class="image">
                        <img src="product-images/<?=$items[$x]->image ?>" width="100%">
                    </div>
                    <div class="info">
                        <a href="item.php?id=<?=$items[$x]->id ?>"><?=$items[$x]->name ?></a>
                        <!--<div><hr><b>Rs : <?/*=$items[$x]->price */?></b><hr></div>-->
                        <?=$items[$x]->description ?><hr>
                        <button class="btn btn-primary btn-block" onclick="cart('<?=$items[$x]->id ?>')">Add to Cart</button>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php
/**
 * Include Footer file
 */
require_once 'footer.php';