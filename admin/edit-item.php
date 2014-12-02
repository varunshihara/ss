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

            <?php
            if(Session::exists('item')) {
                echo '<div class="alert alert-success" role="alert">' . Session::flash('item') . '</div><br>';
            }
            ?>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="container">
                        <div class="col-sm-10">
                            <div class="panel-title">Items</div>
                        </div>
                        <div class="col-sm-2">
                            <a href="add-item.php" class="btn-sm btn-danger">New</a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
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
                                    <label>Category : <select name="category" id="category" class="form-control" required  onchange="subCat()">
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
                                        </select>
                                    </label><br>
                                    <label id="subCategory"></label> <br>
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
                                if($_FILES['file']['type'] == "") {
                                    $db = DB::getInstance();
                                    $db->update("ss_item", Input::get("id"), array(
                                        'name' => Input::get('name'),
                                        'price' => Input::get('price'),
                                        'category'=>Input::get('category'),
                                        'sub_category'=>Input::get('subCategory'),
                                        'description'=>Input::get('description')
                                    ));
                                } else {
                                    $temp = explode(".", $_FILES["file"]["name"]);
                                    $extension = end($temp);

                                    if ((($_FILES["file"]["type"] == "image/gif")
                                            || ($_FILES["file"]["type"] == "image/jpeg")
                                            || ($_FILES["file"]["type"] == "image/jpg")
                                            || ($_FILES["file"]["type"] == "image/x-png")
                                            || ($_FILES["file"]["type"] == "image/png"))
                                        && ($_FILES["file"]["size"] < 100000000)
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
                                                unlink("../product-images/" . $image);
                                                move_uploaded_file($_FILES["file"]["tmp_name"], "../product-images/$image");
                                                $db = DB::getInstance();
                                                $db->update("ss_item", Input::get("id"), array(
                                                    'name' => Input::get('name'),
                                                    'price' => Input::get('price'),
                                                    'category'=>Input::get('category'),
                                                    'sub_category'=>Input::get('subCategory'),
                                                    'description'=>Input::get('description'),
                                                    'image' => $image
                                                ));
                                            } else {
                                                move_uploaded_file($_FILES["file"]["tmp_name"], "../product-images/$image");
                                                $db = DB::getInstance();
                                                $db->update("ss_item", Input::get("id"), array(
                                                    'name' => Input::get('name'),
                                                    'price' => Input::get('price'),
                                                    'category'=>Input::get('category'),
                                                    'sub_category'=>Input::get('subCategory'),
                                                    'description'=>Input::get('description'),
                                                    'image' => $image
                                                ));

                                                /*Redirect::to("../product-images/index.php?image=$image");*/
                                            }
                                        }
                                    } else {
                                        echo "Invalid file";
                                        echo "Type: " . $_FILES["file"]["type"] . "<br>";
                                    }
                                }

                            else:
                                echo "Invalid fille";
                            endif;
                            // Upload file Ends.

                        }
                    } else {
                        Redirect::to('item.php');
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