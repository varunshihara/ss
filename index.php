<?php
/**
 * Including header file.
 * Contains Navbar.
 */
require_once 'header.php';

/**
 * Session variable to show messages,
 * Like Login Successful.
 */
if(Session::exists('home')) {
    echo '<div class="alert alert-success" role="alert">' . Session::flash('home') . '</div><br>';
}

/**
 * Checking if user is LoggedIn, to perform the task.
 */
if($user->isLoggedIn()) {
    echo '<a href="#">Hello, ' . $user->data()->username . '</a>';

    /**
     * Checking if user is Admin or Not.
     */

    if($user->hasPermission('admin')) {
        echo '<br> You are admin';
    }

    if($user->hasPermission('seller')) {
        echo '<br> You are seller';
    }
}

/**
 * Include Footer file
 */
require_once 'footer.php';