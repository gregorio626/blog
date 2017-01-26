<?php

/*returns the number of users that have been active in the last 60 seconds */
function usersOnline() {

  if(isset($_GET['onlineusers'])) {
    global $connection;

    if(!$connection) {
      session_start(); //start the session
      include("../includes/database.php");

      $session_id = session_id(); //get the id of the current session
      $time = time(); //the current time
      $timeout_seconds = 5;//the amount of time until the user is marked as offline
      $timeout = $time - $timeout_seconds; //the time the user is timed out

      /*See if anyone is online */
      $query = "SELECT * FROM users_online WHERE session_id = '$session_id'";
      $send_query = mysqli_query($connection, $query);
      $count = mysqli_num_rows($send_query);

      if($count == NULL) {
        $query = "INSERT INTO users_online (session_id, time) VALUES ('$session_id', '$time')";
        mysqli_query($connection, $query);
      } else {
        $query = "UPDATE users_online SET time = '$time' WHERE session_id = '$session_id'";
        mysqli_query($connection, $query);
      }

      $query = "SELECT * FROM users_online WHERE time > '$timeout'";
      $users_online_query = mysqli_query($connection, $query);
      echo $users_online_count = mysqli_num_rows($users_online_query);
    } //if(!$connection)
  } //if(isset($_GET['onlineusers']))
}
usersOnline();
/* Confirms a query was successful; */
function confirmQuery($result) {
  global $connection;

  if(!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  }
}



/* Inserts a category row into the database.
 * @location used in admin/categories
 */
function insertCategory() {


  global $connection;
  //INSERT CATEGORY QUERY

  if(isset($_POST['submit_insert_category_form'])) {
    $insert_category_title = $_POST['insert_category_title_input'];

    //The
    if($insert_category_title == "" || empty($insert_category_title)) {
      echo "<h6 style='font-weight: bold; color: red;'>This field should not be empty.</h6>";
    } else {

      $query = "INSERT INTO categories(category_title) VALUES ('{$insert_category_title}')";
      $insert_category_query = mysqli_query($connection, $query);

      confirmQuery($insert_category_query);
    }
  }
}

function findAllCategories() {
  global $connection;

  $query = "SELECT category_id, category_title FROM categories";
  $select_categories = mysqli_query($connection, $query);
  while($row = mysqli_fetch_assoc($select_categories)) {
    $category_id = $row['category_id'];
    $category_title = $row['category_title'];
    echo "<tr>";
    echo "<td>{$category_id}</td>";
    echo "<td>{$category_title}</td>";
    echo "<td><a href='categories.php?delete={$category_id}'>Remove</a></td>";
    echo "<td><a href='categories.php?edit={$category_id}'>Edit</a></td>";
    echo "</tr>";
  }
}




function deleteCategory() {
    global $connection;

    if(isset($_GET['delete'])) {
      $delete_cat_id = $_GET['delete'];
      $query = "DELETE FROM categories WHERE category_id = {$delete_cat_id}";
      $delete_category_query = mysqli_query($connection, $query);
      header("Location: categories.php");
    }
}






?>
