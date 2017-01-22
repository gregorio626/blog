<?php
if(isset($_GET['delete'])) {
  $post_id_to_delete = $_GET['delete'];
  $query = "DELETE FROM posts WHERE post_id = {$post_id_to_delete}";
  $delete_post_query = mysqli_query($connection, $query);
}
?>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
  </thead>
<tbody>

<?php
$query = "SELECT user_id, username, user_password, user_firstname, user_lastname, user_email, user_image, user_role FROM users";
$select_users_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_users_query)) {
  $user_id = $row['user_id'];
  $username = $row['username'];
  $user_password = $row['user_password'];
  $user_firstname = $row['user_firstname'];
  $user_lastname = $row['user_lastname'];
  $user_email = $row['user_email'];
  $user_image = $row['user_image'];
  $user_role = $row['user_role'];

echo "<tr>";
echo "<td>$user_id</td>";
echo "<td>$username</td>";
echo "<td>$user_firstname</td>";
echo "<td>$user_lastname</td>";
echo "<td>$user_email</td>";
echo "<td";
if($user_role == 'admin') {
  echo " style='font-weight: bold;'";
}
echo ">" . ucfirst($user_role) . "</td>";


echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
echo "<td><a href='users.php?delete_user={$user_id}'>Delete</a></td>";
echo "</tr>";
}
?>
  </tbody>
</table>

<?php
/* DELETE A USER */
if(isset($_GET['delete_user'])) {
  $user_id_to_delete = $_GET['delete_user'];
  $query = "DELETE FROM users WHERE user_id = {$user_id_to_delete}";
  $delete_user_query = mysqli_query($connection, $query);

  header("Location: users.php"); //reload the page without the 'delete' GET superglobal
}

/* CHANGE THE USERS ROLE TO SUBSCRIBER */
if(isset($_GET['change_to_admin'])) {
  $user_id_to_update = $_GET['change_to_admin'];
  $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id_to_update}";
  $change_user_to_admin_query = mysqli_query($connection, $query);

  header("Location: users.php"); //reload the page without the 'change_to_admin' GET superglobal
}
/* CHANGE THE USERS ROLE TO SUBSCRIBER */
if(isset($_GET['change_to_subscriber'])) {
  $user_id_to_update = $_GET['change_to_subscriber'];
  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id_to_update}";
  $change_user_to_subscriber_query = mysqli_query($connection, $query);

  header("Location: users.php"); //reload the page without the 'change_to_subscriber' GET superglobal
}
 ?>
