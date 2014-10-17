<?php
#Enable/Disable Error Reporting
error_reporting(1);

#Hostname
define("HOST", "localhost");

#Database User Name
define("USER", "root");

#Database User Password
define("PASSWORD", "");

#Database Name
define("DATABASE", "steelshoppers_db");

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");

define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!


#Instaintiating Database Class
$database = new Database(HOST, USER, PASSWORD, DATABASE);

?>