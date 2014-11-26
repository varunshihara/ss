<?php
require_once 'header.php';
// Permissions....

if(!$user->hasPermission('admin')) {
    Redirect::to($_SERVER["DOCUMENT_ROOT"] . 'ss/');
}

// End Permissions....

if(Input::exists()) {
    $db = DB::getInstance();
    if(Input::get('parent-category')=='null') {
        $db->insert('ss_category', array(
            'category' => Input::get('name'),
            'description' => Input::get('description')
        ));
    } else {
        $db->insert('ss_sub_category', array(
            'category_id' => Input::get('parent-category'),
            'sub_category' => Input::get('name'),
            'description' => Input::get('description')
        ));
    }


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
                                <label for="parent-category">Parent Category :</label>
                            </div>
                            <div class="col-sm-9">
                                <select name="parent-category">
                                    <option value="null">Select Parent Category</option>
                                    <?php
                                    $category = new Category();
                                    if($category->exist()){
                                        $data = $category->get();
                                        $count = $category->rows();
                                        for($x = 0; $x<$count; $x++) {
                                            ?>
                                            <option value="<?=$data->results()[$x]->id; ?>"><?=$data->results()[$x]->category; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="description">Description :</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea id="description" name="description" class="form-control"></textarea>
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