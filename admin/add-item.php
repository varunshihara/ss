<?php

require_once 'header.php';
//Permissions....

if($user->hasPermission('user')) {
    Redirect::to($_SERVER["DOCUMENT_ROOT"] . 'ss/');
}

// End Permissions....
if(Input::exists()) {

    $db = DB::getInstance();

    if(Input::get('subCategory') == "") {
        //If sub category is not set.
        $db->insert('ss_item', array(
            'name' => Input::get('name'),
            'price' => Input::get('price'),
            'description' => Input::get('description'),
            'category' => Input::get('category'),
            'seller_id' => $user->data()->id
        ));

    } else {
        //If sub category is set

    }

    // Upload file Starts.........

    $lastId = $db->lastId();
    $allowedExts = array("gif", "jpeg", "jpg", "png", "psd");
    if(isset($_FILES['file'])):
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);

        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/JPG")
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

                $image = $lastId . '.' .$extension;
                if (file_exists("../product-images/" . $image)) {
                    Session::flash('imageFile', 'Image already exists : ' . $image);
                } else {
                    move_uploaded_file($_FILES["file"]["tmp_name"], "../product-images/$image");

                    $db->update('ss_item', $lastId, array(
                        'image' => $image
                    ));
                }
            }
        } else {
            Session::flash('imageFile', 'Invalid file type : ' . $_FILES["file"]["type"]);
            /*echo "Invalid filee";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";*/
        }

    else:
        echo "Invalid file";
    endif;
// Upload file Ends.........

    Session::flash('item', 'New Item added successfully.');
    Redirect::to('add-item.php');
}
?>


    <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-10">

            <?php
            if(Session::exists('imageFile')) {
                print_r('<div class="alert alert-danger" role="alert">' . Session::flash('imageFile') . '</div><br>');
            } elseif(Session::exists('item')) {
                echo '<div class="alert alert-success" role="alert">' . Session::flash('item') . '</div><br>';
            }
            ?>

            <form class="form-group" method="post" action="#" enctype="multipart/form-data">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-9">
                                <h3 class="panel-title">Add Item</h3>
                            </div>
                            <div class="col-sm-3">
                                <center>
                                    <input type="submit" class="btn btn-sm btn-danger" value="Save">
                                    <a href="item.php" class="btn btn-sm btn-danger">Cancel</a>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <label class="label">Item Name : <input type="text" name="name" placeholder="Item Name" class="form-control"></label>
                        <label class="label">Description : <input type="text" name="description" placeholder="Description" class="form-control"></label>
                        <label class="label">Price : <input type="text" name="price" placeholder="Price" class="form-control"></label>
                        <label class="label">
                            <select name="category" id="category" class="form-control" onchange="subCat()">
                                <option value="">Select Category</option>
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
                        </label>
                        <label class="label" id="subCategory"></label> <br>
                        <label>Add Image : <input type="file" name="file" class=""></label>

                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-1"></div>
    </div>


<?php
require_once 'footer.php';
?>