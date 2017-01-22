<?php

if(isset($_GET['edit_user'])) {
  $current_user_id = $_GET['edit_user'];
  /* Populate all of the form inputs with the current values from the database */
  $query = "SELECT user_firstname, user_lastname, user_role, username, user_email, user_password FROM users WHERE user_id = $current_user_id";
  $select_user_by_id_query = mysqli_query($connection, $query);

  /*Loop through each row queried */
  while($row = mysqli_fetch_assoc($select_user_by_id_query)) {
    $current_firstname = $row['user_firstname'];
    $current_lastname = $row['user_lastname'];
    $current_role = $row['user_role'];
    $current_username = $row['username'];
    $current_email = $row['user_email'];
    $current_password = $row['user_password'];
  }

}
  if(isset($_POST['edit_user_submit'])) {

    $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname_input']);
    $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname_input']);
    $user_role = mysqli_real_escape_string($connection, $_POST['user_role_select']);
    $user_username = mysqli_real_escape_string($connection, $_POST['username_input']);
    $user_email = mysqli_real_escape_string($connection, $_POST['user_email_input']);
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password_input']);

    $query = "SELECT randSalt FROM users"; //get the default value from the database
    $select_randsalt_query = mysqli_query($connection, $query);
    if(!$select_randsalt_query) { //if the query failed
      die("QUERY FAILED" . mysqli_error($connection));
    }
    $row = mysqli_fetch_array($select_randsalt_query); //get the queried default value for randSalt
    $salt = $row['randSalt']; //The random salt
    $hashed_password = crypt($user_password, $salt); //encrpt password


    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$user_username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$hashed_password}' ";
    $query .= "WHERE user_id = {$current_user_id}";

    $update_user_by_id_query = mysqli_query($connection, $query);

    confirmQuery($update_user_by_id_query);
  }
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="user_firstname_input">Firstname</label>
    <input type="text" class="form-control" name="user_firstname_input" value="<?php echo $current_firstname; ?>">
  </div>

  <div class="form-group">
    <label for="user_lastname_input">Lastname</label>
    <input type="text" class="form-control" name="user_lastname_input" value="<?php echo $current_lastname; ?>">
  </div>

  <div class="form-group">
    <label for="user_role_select">Role</label>
    <select class="form-control" name="user_role_select" id="">
      <option value="<?php echo $current_role; ?>"><?php echo ucfirst($current_role); ?></option>
      <?php
        if($current_role == 'admin') {
          echo "<option value='subscriber'>Subscriber</option>";
        } else {
          echo "<option value='admin'>Admin</option>";
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="username_input">Username</label>
    <input type="text" class="form-control" name="username_input" value="<?php echo $current_username; ?>">
  </div>

  <div class="form-group">
    <label for="user_email_input">Email</label>
    <input type="email" class="form-control" name="user_email_input" value="<?php echo $current_email; ?>">
  </div>

  <!-- <div class="form-group">
    <label for="post_image_input">Post Image</label>
    <input type="file" name="post_image_input" id="post_image_input">
  </div> -->

  <div class="form-group">
    <label for="user_password_input">Password</label>
    <input type="password" class="form-control" name="user_password_input">
  </div>


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user_submit" value="Save Changes">
  </div>

</form>
