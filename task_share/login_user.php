<?php

require "init.php";

$login_username = 'test01';
$login_password = 'abc01';

$query = "SELECT first_name, last_name FROM user WHERE username LIKE '$login_username' and password LIKE '$login_password';";

$result = mysqli_query($connection, $query);


if(mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  $login_first_name = $row['first_name'];
  $login_last_name = $row['last_name'];
  echo "<h1>Hello, " . $login_first_name . " " . $login_last_name . "!</h1>";
} else {
  echo "No info is available :(";
}

?>
