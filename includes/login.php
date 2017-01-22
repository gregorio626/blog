<?php include "database.php"; ?>
<?php session_start(); //Tell the server to prepare the session ?>

<?php

if(isset($_POST['login_submit'])) {
  $username = $_POST['login_username']; //The string the user entered into the username input
  $password = $_POST['login_password']; //The string the user entered into the password input

  /** Clean up the data to prevent SQL injections **/
  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT user_id, username, user_password, user_firstname, user_lastname, user_role FROM users WHERE username = '{$username}' ";
  $select_user_by_username_query = mysqli_query($connection, $query);

  if(!$select_user_by_username_query) {
    die("QUERY FAILED" . mysqli_error($connection));
  }

  while($row = mysqli_fetch_assoc($select_user_by_username_query)) {
    $db_user_id = $row['user_id']; //The id of the user attempting to login
    $db_username = $row['username']; //The username of the user attempting to login
    $db_user_password = $row['user_password']; //The password of the user attempting to login
    $db_user_firstname = $row['user_firstname']; //The firstname of the user attempting to login
    $db_user_lastname = $row['user_lastname']; //The lastname of the user attempting to login
    $db_user_role = $row['user_role']; //The role of the user attempting to login
  }

  $password = crypt($password, $db_user_password);

    if($username == $db_username && $password == $db_user_password) {
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;

      header("Location: ../admin");

    } else {
      header("Location: ../index.php");
    }
}
?>
