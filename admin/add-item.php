<?php

require_once 'header.php';
//Permissions....

if(!$user->hasPermission('admin')) {
    Redirect::to($_SERVER["DOCUMENT_ROOT"] . 'ss/');
}

// End Permissions....
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
            && ($_FILES["file"]["size"] < 20000000)
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
            echo "Invalid filee";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
        }

    else:
        echo "Invalid file";
    endif;
// Upload file Ends.........

    $db = DB::getInstance();
    $db->insert('ss_item', array(
        'name' => Input::get('name'),
        'price' => Input::get('price'),
        'description' => Input::get('description'),
        'category' => Input::get('category'),
        'seller_id' => $user->data()->id,
        'image' => $image
    ));


    Session::flash('item', 'New Item added successfully.');
    Redirect::to("add-item.php");
}
?>


    <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-10">

            <?php
            if(Session::exists('item')) {
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
                            <select name="category" class="form-control">
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