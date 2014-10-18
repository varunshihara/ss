<?php
require_once 'core/init.php';

$user = DB::getInstance()->update('ss_user', 3, array(
    'password' => 'updatedpassword'
));
?>