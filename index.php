<?php


require_once 'header.php';
if(Session::exists('home')) {
    echo '<div class="alert alert-success" role="alert">' . Session::flash('home') . '</div><br>';
}


if($user->isLoggedIn()) {
    echo '<a href="#">Hello, ' . $user->data()->username . '</a>';

    if($user->hasPermission('admin')) {
        echo '<br> You are admin';
    }
}
require_once 'footer.php';