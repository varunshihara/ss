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
    <script>
        $(document).ready(function(){
            $("#over").css("border", "1px solid #fff");

            $("#over").mouseover(function(){
                $(this).css({"border":"1px solid #f1f1f1", "boxShadow":"1px 1px 3px #f1f1f1"});
            });

            $("#over").mouseout(function(){
                $(this).css({"border":"1px solid #fff", "boxShadow":"0px 0px 0px"});
            });
        });
    </script>

    <div class="container">

        <div class="row">

            <div class="col-sm-12 col-md-3 col-lg-3 table-bordered">
                <p>Side bar</p>
            </div>

            <div class="col-sm-12 col-md-8 col-lg-8">

                <div class="jumbotron">
                <!--Image Slider here-->
                </div>

                <?php
                $db = DB::getInstance();
                if(Input::exists('get')) {
                    $category = Input::get('category');
                    $result = $db->get('ss_item', array('category', '=', $category));
                    $items = $result->results();
                    $count = $result->count();
                    for($x = 0; $x<$count; $x++) {

                        ?>
                        <div class="row">
                            <?php
                            for($y = 0; $y < 4; $y++) {
                            ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <?php
                                    if($x>=$count) {
                                        echo '';
                                    } else {
                                        ?>
                                        <div id="over">
                                            <img src="product-images/<?=$items[$x]->image ?>" width="100%"><br>
                                            <div><a href="item.php?id=<?=$items[$x]->id ?>"><?=$items[$x]->name ?></a></div>
                                            <div><hr><b>Rs : <?=$items[$x]->price ?></b><hr></div>
                                            <div><?=$items[$x]->description ?><hr></div>
                                            <div><button class="btn btn-success btn-block">Add to Cart</button></div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            $x++;
                            }
                            ?>
                        </div>
                        <?php
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