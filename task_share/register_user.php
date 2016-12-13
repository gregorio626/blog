<?php
require 'init.php';

$user__first_name = 'Test';
$user__last_name = '01';
$user__username = 'test01';
$user__password = 'abc01';

$query = "INSERT INTO user (first_name, last_name, username, password) VALUES ('Test', '01', 'test01', 'abc01')";

if(mysqli_query($connection, $query)) {
  echo "<h1>Successfully registered.</h1>";
} else {
  echo "Error regsitering user---->" . mysqli_error($connection);
}
?>
