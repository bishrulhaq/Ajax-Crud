<?php

define('DB_SERVER', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_NAME', '');

$con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($con->connect_errno) {
    printf("Connect failed: %s\n", $con->connect_error);
    exit();
}
