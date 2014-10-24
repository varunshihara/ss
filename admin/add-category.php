<?php
require_once 'header.php';

if(Input::exists()) {
    $db = DB::getInstance();
    $db->insert('ss_category', array(
        'category' => Input::get('name')
    ));

    Session::flash('category', 'New Category created successfully.');
    Redirect::to('add-category.php');
}
?>


    <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-10">

            <?php
            if(Session::exists('category')) {
                echo '<div class="alert alert-success" role="alert">' . Session::flash('category') . '</div><br>';
            }
            ?>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3 class="panel-title">Add Category</h3>
                        </div>
                        <div class="col-sm-3">
                            <center>
                                <a href="add-category.php" class="btn-sm btn-danger">New</a>
                                <a href="#" class="btn-sm btn-danger">Edit</a>
                                <a href="#" class="btn-sm btn-danger">Delete</a>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-group" method="post" action="">
                        <label class="">Name : <input type="text" name="name" placeholder="Category Name" class="form-control"></label>
                        <br>
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-1"></div>
    </div>


<?php
require_once 'footer.php';
?>