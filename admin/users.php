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
            if(Session::exists('users')) {
                echo '<div class="alert alert-success" role="alert">' . Session::flash('users') . '</div><br>';
            }

            $db = DB::getInstance();

            /**
             * to change user role
             */
            if(Input::exists() && Input::get('group')) {
                $db->update("`ss_user`", Input::get('id'), array(
                    'group' => Input::get('group')
                ));
                //echo $db->error();
            }

            /**
             * Admins data
             */
            $admin = $db->action('SELECT *', 'ss_user', array('`group`', '=', '2'));
            $countAdmin = $admin->count();

            /**
             * Seller's data
             */
            $seller = $db->action('SELECT *', 'ss_user', array('`group`', '=', '3'));
            $countSeller = $seller->count();

            /**
             * Customer's Data
             */
            $customer = $db->action('SELECT *', 'ss_user', array('`group`', '=', '1'));
            $countCustomer = $customer->count();

            /**
             * All Users
             */
            $all = $db->action('SELECT *', 'ss_user', array('1', '=', '1'));
            $countAll = $all->count();


            ?>


            <div class="row">
                <div class="col-sm-7">
                    <h3>Users</h3>
                </div>
                <div class="col-sm-5">
                    <center>
                        <a href="users.php">All <span class="badge"><?php echo $countAll; ?></span></a>&nbsp; | &nbsp;
                        <a href="users.php?role=admin">Admin <span class="badge"><?php echo $countAdmin; ?></span></a>&nbsp; | &nbsp;
                        <a href="users.php?role=seller">Seller <span class="badge"><?php echo $countSeller; ?></span></a>&nbsp; | &nbsp;
                        <a href="users.php?role=customer">User <span class="badge"><?php echo $countCustomer; ?></span></a>
                        <a onclick="$('#form').submit();" class="btn-sm btn-danger" style="cursor: pointer;">Delete</a>
                    </center>
                </div>
            </div>

            <form action="#" method="post" id="form">
                <table class="table table-bordered table-condensed table-hover">
                    <tr class="active">
                        <th><input type="checkbox" onclick="$('input[type*=\'checkbox\']').attr('checked', this.checked);"></th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if(Input::exists('get')) {
                        $role = Input::get('role');
                        if($role == 'admin') {
                            $data = $db->action('SELECT *', 'ss_user', array('`group`', '=', '2'));
                            $y = $countAdmin;
                        } elseif($role == 'seller') {
                            $data = $db->action('SELECT *', 'ss_user', array('`group`', '=', '3'));
                            $y = $countSeller;
                        } elseif($role == 'customer') {
                            $data = $db->action('SELECT *', 'ss_user', array('`group`', '=', '1'));
                            $y = $countCustomer;
                        } else {
                            $data = $all;
                            $y = $countAll;
                        }
                    } else {
                        $data = $all;
                        $y = $countAll;
                    }

                    for($x = 0; $x<$y; $x++) {
                        ?>

                        <tr>

                            <td><input type="checkbox" id="<?php echo $data->results()[$x]->id; ?>" name="id" value="<?php echo $data->results()[$x]->id; ?>"></td>

                            <td><label for="<?php echo $data->results()[$x]->id; ?>"><?php echo $data->results()[$x]->username; ?></label></td>

                            <td><label for="<?php echo $data->results()[$x]->id; ?>"><?php echo $data->results()[$x]->name; ?></label></td>

                            <td><label for="<?php echo $data->results()[$x]->id; ?>"><?php echo $data->results()[$x]->email; ?></label></td>

                            <td>
                                <form method='post' action='users.php'>
                                    <input type="hidden" name="id" value="<?=$data->results()[$x]->id ?>">
                                <?php
                                if($data->results()[$x]->group == 1) {
                                    echo "<select name='group' onchange='this.form.submit()'>
                                                <option value='1'>User</option>
                                                <option value='2'>Admin</option>
                                                <option value='3'>Seller</option>
                                            </select>";
                                } elseif($data->results()[$x]->group == 2) {
                                    echo "<select name='group' onchange='this.form.submit()'>
                                                <option value='2'>Admin</option>
                                                <option value='1'>User</option>
                                                <option value='3'>Seller</option>
                                            </select>";
                                } elseif($data->results()[$x]->group == 3) {
                                    echo "<select name='group' onchange='this.form.submit()'>
                                            <option value='3'>Seller</option>
                                            <option value='2'>Admin</option>
                                            <option value='1'>User</option>
                                        </select>
                                    ";
                                }
                                ?>
                                </form>
                            </td>

                            <td><a href="#">Edit</a></td>
                        </tr>
                    <?php   } ?>
                </table>
            </form>

        </div>
        <div class="col-md-1"></div>
    </div>
<?php
require_once 'footer.php';
?>