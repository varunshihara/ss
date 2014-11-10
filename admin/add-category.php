<?php
require_once 'header.php';
// Permissions....

if(!$user->hasPermission('admin')) {
    Redirect::to($_SERVER["DOCUMENT_ROOT"] . 'ss/');
}

// End Permissions....

if(Input::exists()) {
    $db = DB::getInstance();
    $db->insert('ss_category', array(
        'category' => Input::get('name'),
        'description' => Input::get('description')
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

            <form class="form-group" method="post" action="">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-9">
                                <h3 class="panel-title">Add Category</h3>
                            </div>
                            <div class="col-sm-3">
                                <center>
                                    <input type="submit" class="btn btn-sm btn-danger" value="Save">
                                    <a href="category.php" class="btn btn-sm btn-danger">Cancel</a>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="name">Name :</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="name" placeholder="Category Name" class="form-control">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="elm1">Description :</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea id="elm1" name="description" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-1"></div>
    </div>


<?php
require_once 'footer.php';
?>