<?php

class Database {
    #Hostname
    #public $hostname;

    #Database Name
    #public $database;

    #Database User Name
    #public $db_user;

    #Database User Password
    #public $db_password;

    #Connectting to the Database
    public function __construct($hostname, $db_user, $db_password, $database) {
        mysql_select_db($database,mysql_connect($hostname,$db_user,$db_password)) or die('Unable to Select database.');
    }

    #Logging In Users
    public function login($user = '', $password = '') {
        echo preg_replace('#[^a-z0-9]#i', '', $user);
        echo '<br>' . crypt($password,125);

    }
}
?>