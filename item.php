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

$db = DB::getInstance();
if(Input::exists('get')) {
    $id = Input::get('id');
    $result = $db->get('ss_item', array('id', '=', $id));
    $item = $result->results();
    $count = $result->count();
    ?>
    <div class="container">

        <div class="row">

            <div class="col-sm-12 col-md-3 col-lg-5">
                <img src="product-images/<?=$item[0]->image ?>" width="100%">
            </div>

            <div class="col-sm-12 col-md-8 col-lg-7">
                <h1><?=$item[0]->name ?></h1>
                <div class="row">
                    <div class="col-sm-3">
                        <p><?=$item[0]->description ?></p>
                        <p><b>Price : </b>Rs.<?=$item[0]->price ?></p>
                        <?php
                        $name = $db->get('ss_user', array('id', '=', $item[0]->seller_id));
                        ?>
                        <p><b>Seller : </b><?=$name->results()[0]->name ?></p>
                        <div class="btn-buy">
                            <form action="cart.php" method="post">
                                <input type="hidden" name="id" value="<?=$item[0]->id ?>">
                                <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                            </form>
                            <br>
                            <form action="#" method="post">
                                <input type="hidden" name="id" value="<?=$item[0]->id ?>">
                                <button class="btn btn-success btn-block">Buy</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}

if(Input::exists()) {
    $GLOBALS['cart'] = Input::get('id');
}
/**
 * Include Footer file
 */
require_once 'footer.php';