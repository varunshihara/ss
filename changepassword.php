<?php

require_once 'header.php';

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'password_current' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new_again' => array(
                'required' => true,
                'min' => 6,
                'matches' => 'password_new'
            )
        ));

        if($validation->passed()) {

            if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
                echo 'Your current password is wrong.';
            } else {
                $salt = Hash::salt(32);
                $user->update(array(
                    'password' => Hash::make(Input::get('password_new'), $salt),
                    'salt' => $salt
                ));

                Session::flash('password', 'Your password has been changed.');
                Redirect::to('changepassword.php');
            }

        } else {
            foreach($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}
?>

<div class="row">

    <div class="col-md-3"></div>
    <div class="col-md-6">
        <?php
        if(Session::exists('password')) {
            echo '<div class="alert alert-success" role="alert">' . Session::flash('password') . '</div><br>';
        }
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Update Info</h3>
            </div>
            <div class="panel-body">
                <form action="" method="post" class="form-group">
                    <label>Current Password :<input type="password" name="password_current" class="form-control"></label>
                    <label>New Password :<input type="password" name="password_new" class="form-control"></label>
                    <label>New Password Again:<input type="password" name="password_new_again" class="form-control"></label>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>

    </div>
    <div class="col-md-3"></div>
</div>