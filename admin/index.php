<?php
require_once 'header.php';

//Permissions....

if($user->hasPermission('admin')) {

} elseif($user->hasPermission('seller')) {

} else {
    Redirect::to($_SERVER["DOCUMENT_ROOT"] . 'ss/');
}

// End Permissions....

require_once 'footer.php';