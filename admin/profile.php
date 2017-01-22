<?php include "includes/templates/admin_header.php"; ?>

<?php

if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $query = "SELECT user_firstname, user_lastname,  user_role, username, user_email, user_password FROM users WHERE user_id = '{$user_id}' ";
  $select_user_by_id_query = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_user_by_id_query)) {
    $current_firstname = $row['user_firstname'];
    $current_lastname = $row['user_lastname'];
    $current_role = $row['user_role'];
    $current_username = $row['username'];
    $current_email = $row['user_email'];
    $current_password = $row['user_password'];
  }
}



if(isset($_POST['edit_profile_submit'])) {

  $user_firstname = $_POST['user_firstname_input'];
  $user_lastname = $_POST['user_lastname_input'];
  $user_role = $_POST['user_role_select'];
  $user_username = $_POST['username_input'];
  $user_email = $_POST['user_email_input'];
  $user_password = $_POST['user_password_input'];

  $query = "UPDATE users SET ";
  $query .= "user_firstname = '{$user_firstname}', ";
  $query .= "user_lastname = '{$user_lastname}', ";
  $query .= "user_role = '{$user_role}', ";
  $query .= "username = '{$user_username}', ";
  $query .= "user_email = '{$user_email}', ";
  $query .= "user_password = '{$user_password}' ";
  $query .= "WHERE user_id = '{$user_id}'";

  $update_user_by_id_query = mysqli_query($connection, $query);

  confirmQuery($update_user_by_id_query);

  $_SESSION['username'] = $user_username;
  $_SESSION['firstname'] = $user_firstname;
  $_SESSION['lastname'] = $user_lastname;
  $_SESSION['user_role'] = $user_role;

  header("Location: users.php");
}
?>
    <div id="wrapper">
      <!--Navigation -->
<?php include "includes/templates/admin_navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
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
                            <!-- <label for="user_role_select">Role</label> -->
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

                          <!-- <div class="form-group">
                            <label for="user_password_input">Password</label>
                            <input type="password" class="form-control" name="user_password_input">
                          </div> -->


                          <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_profile_submit" value="Save Profile">
                          </div>

                        </form>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include "includes/templates/admin_footer.php"; ?>
