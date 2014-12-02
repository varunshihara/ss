<?php
require_once 'header.php';
//Permissions....


if($user->hasPermission('user')) {
    Redirect::to($_SERVER["DOCUMENT_ROOT"] . 'ss/');
}

// End Permissions....

?>


    <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-10">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="container">
                        <div class="col-sm-10">
                            <div class="panel-title">Edit Category</div>
                        </div>
                        <div class="col-sm-2">
                            <a href="add-category.php" class="btn-sm btn-danger">New</a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <?php
                    if(Input::exists("get")) {
                        ?>
                        <h4>Edit</h4><hr>
                        <form action="#" method="post">
                            <input type="hidden" name="id" value="<?php echo Input::get("id"); ?>">
                            <input type="text" name="category" class="form-control" placeholder="Category" value="<?php echo Input::get("category");?>"><br>
                            <textarea id="description" name="description"><?php echo Input::get("description");?></textarea>
                            <br>
                            <button type="submit" class="btn btn-sm btn-success" name="update">Update</button> <a href="#" class="btn btn-sm btn-danger">Cancel</a>
                        </form>
                        <?php

                        if(Input::exists()) {
                            $db = DB::getInstance();
                            $db->update("ss_category", Input::get("id"), array(
                                'category'=>Input::get('category'),
                                'description'=>Input::get('description')
                            ));
                            Redirect::to("category.php");
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

<?php
/**
 * Including Footer
 */
require_once 'footer.php';
?>