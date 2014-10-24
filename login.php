<?php
require_once "header.php";

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validation->passed()) {
            //Log user In


            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if($login) {
                if($user->hasPermission('admin')) {
                    Redirect::to('admin/index.php');
                } else {
                    Redirect::to('index.php');
                }

            } else {
                echo 'Sorry, Login Failed.';
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
                if(Session::exists('register')) {
                echo '<div class="alert alert-success" role="alert">' . Session::flash('register') . '</div><br>';
                }
            ?>

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-group-lg">
                        <label>Username : <input type="text" name="username" class="form-control" value="<?php echo escape(Input::get('username')); ?>"></label>
                        <label>Password : <input type="password" name="password" class="form-control"></label>
                        <label>Remember me : <input type="checkbox" name="remember"></label>

                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                        <button type="submit" class="btn btn-success">Let me in</button>
                    </form>
                    <hr>
                    <center><a href="register.php" class="btn btn-danger">Create a new account.</a></center>
                </div>
            </div>

        </div>
        <div class="col-md-3"></div>
    </div>
<?php
require_once "footer.php";
?>