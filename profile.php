<?php

require_once 'header.php';

if(!$username = Input::get('user')) {
    Redirect::to('index.php');
} else {
    if(!$user->find($username)) {
        Redirect::to(404);
    } else {
        $data = $user->data();
    }
    ?>
    <div class="row">

        <div class="col-md-2"></div>

        <div class="col-md-8">
            <h3><?php echo $data->name; ?></h3>
        </div>
        <div class="col-md-2"></div>
    </div>
<?php
}