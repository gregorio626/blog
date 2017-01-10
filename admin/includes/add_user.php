<?php
  if(isset($_POST['create_user_submit'])) {

    $user_firstname = $_POST['user_firstname_input'];
    $user_lastname = $_POST['user_lastname_input'];
    $user_role = $_POST['user_role_select'];
    $user_username = $_POST['username_input'];
    $user_email = $_POST['user_email_input'];
    $user_password = $_POST['user_password_input'];

    // $post_image = $_FILES['post_image_input']['name']; //The name of the post image's file
    // $post_image_tmp = $_FILES['post_image_input']['tmp_name']; //The location within the tmp/ folder, that our post image is located at before it is moved to our images folder
    // $image_location = "../images/" . $post_image;
    //
    // move_uploaded_file($post_image_tmp, $image_location); //Move the file from the tmp folder, to our actual folder we have to store the images
    //
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";
    $query .= "VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$user_username}', '{$user_email}', '{$user_password}')";

    $insert_user_query = mysqli_query($connection, $query);

    confirmQuery($insert_user_query);

    header("Location: users.php");
  }
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="user_firstname_input">Firstname</label>
    <input type="text" class="form-control" name="user_firstname_input">
  </div>

  <div class="form-group">
    <label for="user_lastname_input">Lastname</label>
    <input type="text" class="form-control" name="user_lastname_input">
  </div>

  <div class="form-group">
    <!-- <label for="user_role_select">Role</label> -->
    <select class="form-control" name="user_role_select" id="">
      <option value="subscriber">Select Role</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>

  <div class="form-group">
    <label for="username_input">Username</label>
    <input type="text" class="form-control" name="username_input">
  </div>

  <div class="form-group">
    <label for="user_email_input">Email</label>
    <input type="email" class="form-control" name="user_email_input">
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
    <input class="btn btn-primary" type="submit" name="create_user_submit" value="Add User">
  </div>

</form>
