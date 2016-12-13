<?php
error_reporting(-1);
ini_set('display_errors', 'On');

//Credentials needed to connect to database
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "626.gregoriO";
$db['db_name'] = "cms";

//define constants after making sure the constant's names are uppercase
foreach($db as $key => $value) {
  define(strtoupper($key), $value);
}

//Connect to the database
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//Make sure we have a good connection
if($connection) {
  //echo "We are connected";
}

?>
