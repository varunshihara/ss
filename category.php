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


    <div class="container">

        <div class="row">

            <div class="col-sm-12 col-md-3 col-lg-3 table-bordered">
                <p><b>Sellers</b></p><hr>
                <?php
                $db = DB::getInstance();
                $sellers = $db->get('ss_user', array('`group`', '=', '3'));
                $totalSellers = $sellers->count();
                $sellers = $sellers->results();

                for($x = 0; $x<$totalSellers; $x++) {
                    echo '<label><input type="checkbox" name="seller" value="' . $sellers[$x]->id . '"> ' . $sellers[$x]->name . '</label><br>';
                }
                ?>
            </div>

            <div class="col-sm-12 col-md-8 col-lg-8">

                <?php

                if(Input::exists('get')) {
                    $category = Input::get('category');
                    $result = $db->get('ss_item', array('category', '=', $category));
                    $items = $result->results();
                    $count = $result->count();
                    if($count == 0) {
                        ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="noItems">
                                        <h2>Currently, there is no Items in this category.</h2>
                                    </div>
                                </div>
                            </div>
                        <?php
                    } else {

                        for($x = 0; $x<$count; $x++) {
                            ?>
                            <div class="row">
                                <?php
                                $y=0;
                                for($y = 0; $y < 3; $y++) {
                                    ?>
                                    <div class="col-sm-6 col-md-3 col-lg-4">
                                        <?php
                                        if($x>=$count) {
                                            echo '';
                                        } else {
                                            ?>
                                            <div id="over" class="thumbnail">

                                                    <img src="product-images/<?=$items[$x]->image ?>" width="100%">

                                                <div class="caption">
                                                    <b><a href="item.php?id=<?=$items[$x]->id ?>"><?=$items[$x]->name ?></a></b>
                                                    <br>Rs : <?=$items[$x]->price ?>
                                                    <p><?=$items[$x]->description ?></p>
                                                    <button class="btn btn-primary btn-block center-block" onclick="cart('<?=$items[$x]->id ?>')">Add to Cart</button>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    $x++;
                                }
                                $x--;
                                ?>
                            </div>
                        <?php
                        }
                    }

                }
                ?>

            </div>

        </div>

    </div>


<?php
/**
 * Include Footer file
 */
require_once 'footer.php';