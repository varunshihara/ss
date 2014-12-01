<?php
require_once '../../core/init.php';

if(isset($_POST['category'])) {
    $category = $_POST['category'];
    if($category != "") {
        $db = DB::getInstance();
        $data = $db->get('ss_category', array('category', '=', $category));
        $id = $data->results()[0]->id;

        $subCategory = $db->get('ss_sub_category', array('category_id', '=', $id));
        $count = $subCategory->count();
        $subCategory = $subCategory->results();
        ?>
        <select name="subCategory" class="form-control">
            <option value="">Select Sub Category</option>
            <?php for($x = 0; $x<$count; $x++) { ?>
            <option value="<?php echo $subCategory[$x]->sub_category; ?>"><?php echo $subCategory[$x]->sub_category; ?></option>
            <?php } ?>
        </select>
<?php
    }
}