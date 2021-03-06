<?php
require_once 'header.php';
?>

<div class="row">

    <div class="col-md-1"></div>
    <div class="col-md-10">
        <?php
        if(Session::exists('register')) {
            echo '<div class="alert alert-success" role="alert">' . Session::flash('register') . '</div><br>';
        }
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-9">
                        <h3 class="panel-title">Category</h3>
                    </div>
                    <div class="col-sm-3">
                        <center>
                            <a href="add-category.php" class="btn-sm btn-danger">New</a>
                            <a onclick="$('#form').submit();" class="btn-sm btn-danger" style="cursor: pointer;">Delete</a>
                        </center>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form action="#" method="post" id="form">
                    <input type="hidden" name="delete" value="asd">
                    <table class="table table-bordered table-condensed table-hover">
                        <!-- table header -->
                        <tr class="active">
                            <th><input type="checkbox" onclick="$('input[type*=\'checkbox\']').attr('checked', this.checked);"></th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                                <?php
                                /**
                                 * getting category data from database
                                 */
                                $db = DB::getInstance();
                                $data = $db->action('SELECT *', 'ss_category', array('1', '=', '1'));

                                $count = $data->count();

                                for($x = 0; $x<$count; $x++) {
                                ?>
                        <tr>
                            <!-- Output categories -->
                            <td><input type="checkbox" id="<?php echo $data->results()[$x]->id; ?>" name="id" value="<?php echo $data->results()[$x]->id; ?>"></td>
                            <td><label for="<?php echo $data->results()[$x]->id; ?>"><?php echo $data->results()[$x]->category; ?></label></td>
                            <td><label for="<?php echo $data->results()[$x]->id; ?>"><?php echo $data->results()[$x]->description; ?></label></td>
                            <td><a href="edit-category.php?id=<?php echo $data->results()[$x]->id . "&category=" . $data->results()[$x]->category . "&description=" . $data->results()[$x]->description; ?>&#edit">Edit</a></td>
                        </tr>
                        <?php   } ?>
                    </table>
                </form>



            </div>
        </div>

    </div>
    <div class="col-md-1"></div>
</div>

<?php
/**
 * Deleting Category
 */
if(Input::exists()) {
    if(Input::get('delete')) {
        $db->delete('ss_category',array('id', '=', Input::get('id')));
        Redirect::to('category.php');
    }
}

/**
 * Including Footer
 */
require_once 'footer.php';
?>