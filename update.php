<?php

require_once 'header.php';

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

        if($validation->passed()) {

            try {
                $user->update(array(
                    'name' => Input::get('name'),
                    'email' => Input::get('email'),
                    'mobile' => Input::get('mobile'),
                    'address' => Input::get('address')
                ));

                Session::flash('update', 'Your details have been updated.');
                Redirect::to('update.php');

            } catch(Exception $e) {
                die($e->getMessage());
            }

        } else {
            foreach($validation->errors() as $error) {
                echo $error . '<br>';
            }
        }
    }
}
?>

<div class="row">

    <div class="col-md-3"></div>
    <div class="col-md-6">
        <?php
        if(Session::exists('update')) {
            echo '<div class="alert alert-success" role="alert">' . Session::flash('update') . '</div><br>';
        }
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Update Info</h3>
            </div>
            <div class="panel-body">
                <form action="" method="post" class="form-group">
                    <label class="form-group">Name :<input type="text" name="name" value="<?php echo escape($user->data()->name); ?>" class="form-control"></label><br>
                    <label class="form-group">Email :<input type="text" name="email" value="<?php echo escape($user->data()->email); ?>" class="form-control"></label><br>
                    <label class="form-group">Mobile :<input type="text" name="mobile" value="<?php echo escape($user->data()->mobile); ?>" class="form-control"></label><br>
                    <label class="form-group">Address :<input type="text" name="address" value="<?php echo escape($user->data()->address); ?>" class="form-control"></label><br>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
    <div class="col-md-3"></div>
</div>