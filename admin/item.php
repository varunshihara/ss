<?php
require_once 'header.php';
//Permissions....


if(!$user->hasPermission('admin')) {
    Redirect::to($_SERVER["DOCUMENT_ROOT"] . 'ss/');
}

// End Permissions....

?>


    <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-10">

            <?php
            if(Session::exists('item')) {
                echo '<div class="alert alert-success" role="alert">' . Session::flash('item') . '</div><br>';
            }
            ?>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3 class="panel-title">Items</h3>
                        </div>
                        <div class="col-sm-3">
                            <center>
                                <a href="add-item.php" class="btn-sm btn-danger">New</a>
                                <a onclick="$('#form').submit();" class="btn-sm btn-danger" style="cursor: pointer;">Delete</a>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="#" method="post" id="form">
                        <input type="hidden" name="delete" value="asd">
                        <table class="table table-bordered table-condensed table-hover">
                            <tr class="active">
                                <th><input type="checkbox" onclick="$('input[type*=\'checkbox\']').attr('checked', this.checked);"></th>
                                <th>Image</th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $db = DB::getInstance();
                            $data = $db->action('SELECT *', 'ss_item', array('1', '=', '1'));

                            $count = $data->count();

                            for($x = 0; $x<$count; $x++) {
                                ?>
                                <!-- Output items -->
                                <tr>
                                    <!-- id (checkbox)-->
                                    <td><input type="checkbox" id="<?php echo $data->results()[$x]->id; ?>" name="id" value="<?php echo $data->results()[$x]->id; ?>"></td>
                                    <!-- image -->
                                    <td>
                                        <label for="<?php echo $data->results()[$x]->id; ?>">
                                            <img src="../product-images/<?php echo $data->results()[$x]->image; ?>" width="150">
                                        </label>
                                    </td>
                                    <!-- item name -->
                                    <td><label for="<?php echo $data->results()[$x]->id; ?>"><?php echo $data->results()[$x]->name; ?></label></td>
                                    <!-- price -->
                                    <td><label for="<?php echo $data->results()[$x]->id; ?>"><?php echo $data->results()[$x]->price; ?> Rs</label></td>
                                    <!-- category -->
                                    <td><label for="<?php echo $data->results()[$x]->id; ?>"><?php echo $data->results()[$x]->category; ?></label></td>
                                    <!-- edit -->
                                    <td><a href="?id=<?php echo $data->results()[$x]->id . "&name=" . $data->results()[$x]->name . "&price=" . $data->results()[$x]->price . "&category=" . $data->results()[$x]->category . "&description=" . $data->results()[$x]->description; ?>&#edit">Edit</a></td>
                                </tr>
                            <?php   } ?>
                        </table>
                    </form>

                    <!-- Edit Popup Modal -->
                    <div class="modall" id="edit">
                        <div class="modal-container">
                            <?php
                            if(Input::exists("get")) {
                                ?>
                                <h4>Edit</h4><hr>
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="hidden" name="id" value="<?php echo Input::get("id"); ?>" class="form-control">
                                            <label>Name : <input type="text" name="name" value="<?php echo Input::get("name"); ?>" class="form-control" required></label><br>
                                            <label>Price : <input type="text" name="price" value="<?php echo Input::get("price"); ?>" class="form-control" required></label><br>
                                            <label>Category : <select name="category" class="form-control" required>
                                                <option>Select Category</option>
                                                <?php
                                                $db = DB::getInstance();
                                                $data = $db->action('SELECT *', 'ss_category', array('1', '=', '1'));
                                                $count = $data->count();
                                                for($x = 0; $x<$count; $x++) {
                                                    ?>
                                                    <option value="<?php echo $data->results()[$x]->category; ?>"><?php echo $data->results()[$x]->category; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select></label>
                                            <label>
                                                Change / Add Image : <input type="file" class="form-control" name="file">
                                            </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Description : <textarea id="description" name="description"><?php echo Input::get("description");?></textarea></label>
                                            <button type="submit" class="btn btn-sm btn-success" name="update">Update</button> <a href="#" class="btn btn-sm btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                                <?php

                                if(Input::exists()) {
                                    // Upload file Starts.........

                                    $allowedExts = array("gif", "jpeg", "jpg", "png", "psd");
                                    if(isset($_FILES['file'])):
                                        $temp = explode(".", $_FILES["file"]["name"]);
                                        $extension = end($temp);



                                        if ((($_FILES["file"]["type"] == "image/gif")
                                                || ($_FILES["file"]["type"] == "image/jpeg")
                                                || ($_FILES["file"]["type"] == "image/jpg")
                                                || ($_FILES["file"]["type"] == "image/pjpeg")
                                                || ($_FILES["file"]["type"] == "image/x-png")
                                                || ($_FILES["file"]["type"] == "image/png"))
                                            && ($_FILES["file"]["size"] < 2000000000)
                                            && in_array($extension, $allowedExts)) {
                                            if ($_FILES["file"]["error"] > 0) {
                                                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                                            } else {
                                                //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                                                //echo "Type: " . $_FILES["file"]["type"] . "<br>";
                                                //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                                                //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                                                $image = Input::get('id') . '.' .$extension;
                                                if (file_exists("../product-images/" . $image)) {
                                                    echo $image . " already exists. ";
                                                } else {
                                                    move_uploaded_file($_FILES["file"]["tmp_name"], "../product-images/$image");
                                                }
                                            }
                                        } else {
                                            echo "Invalid file";
                                            echo "Type: " . $_FILES["file"]["type"] . "<br>";
                                        }

                                    else:
                                        echo "Invalid fille";
                                    endif;
                                    // Upload file Ends.........
                                    $db = DB::getInstance();
                                    $db->update("ss_item", Input::get("id"), array(
                                        'name' => Input::get('name'),
                                        'price' => Input::get('price'),
                                        'category'=>Input::get('category'),
                                        'description'=>Input::get('description'),
                                        'image' => $image
                                    ));

                                    Redirect::to("../product-images/index.php?image=$image");
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-1"></div>
    </div>


<?php
/**
 * Deleting Items
 */
if(Input::exists()) {
    if(Input::get('delete')) {
        $db->delete('ss_item',array('id', '=', Input::get('id')));
        Redirect::to("item.php");
    }
}

/**
 * Including Footer
 */
require_once 'footer.php';
?>