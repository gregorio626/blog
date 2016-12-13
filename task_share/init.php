<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "626.gregoriO";
$db_name = "task_share";

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(!$connection) {
  echo "Error connecting to database---->" . mysqli_connect_error();
} else {
  echo "<h1>Connection Successful!</h1>";
}


?>
