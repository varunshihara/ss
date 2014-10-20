<?php
require_once "header.php";

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'ss_user'
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'email' => array(
                'required' => true,
            ),
            'mobile' => array(
                'required' => true
            )
        ));

        if($validation->passed()) {
            //Session::flash('success', 'You registered successfully!');
            //header('Location: index.php');
            $user = new User();

            $salt = Hash::salt(32);

            try {
                $user->create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'name' => Input::get('name'),
                    'joined' => date('Y-m-d H:i:s'),
                    'group' => 1,
                    'email' => Input::get('email'),
                    'mobile' => Input::get('mobile')
                ));

                Session::flash('home', 'You are Registered Successfully.');
                header('Location: index.php');

            } catch(Exception $e) {
                die($e->getMessage());
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

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Register</h3>
            </div>
            <div class="panel-body">
                <form action="" method="post" class="form-group-lg">
                    <label>Username : <input type="text" name="username" class="form-control" value="<?php echo escape(Input::get('username')); ?>"></label>
                    <label>Choose Password : <input type="password" name="password" class="form-control"></label>
                    <label>Retype Password : <input type="password" name="password_again" class="form-control"></label>

                    <label>Name : <input type="text" name="name" class="form-control" value="<?php echo escape(Input::get('name')); ?>"></label>
                    <label>Email : <input type="email" name="email" class="form-control" value="<?php echo escape(Input::get('email')); ?>"></label>
                    <label>Mobile : <input type="text" name="mobile" class="form-control" value="<?php echo escape(Input::get('mobile')); ?>"></label>

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                    <button type="submit" class="btn btn-primary">Create Account</button>
                </form>
            </div>
        </div>

    </div>
    <div class="col-md-3"></div>
</div>
<?php
require_once "footer.php";
?>