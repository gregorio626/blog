<?php  include "includes/database.php"; ?>
 <?php  include "includes/templates/header.php"; ?>


<?php

if(isset($_POST['submit'])) {
  //Grab the input values from the registration form
  $username = $_POST['username'];
  $email    = $_POST['email'];
  $password = $_POST['password'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];

  /*Check to see if the fields are empty */
  if(!empty($username) && !empty($email) && !empty($password) && !empty($firstname) && !empty($lastname)) {
    /* Secure the input */
    $username = mysqli_real_escape_string($connection, $username);
    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $firstname = mysqli_real_escape_string($connection, $firstname);
    $lastname = mysqli_real_escape_string($connection, $lastname);


    $query = "SELECT randSalt FROM users"; //get the default value from the database
    $select_randsalt_query = mysqli_query($connection, $query);

    if(!$select_randsalt_query) { //if the query failed
      die("QUERY FAILED" . mysqli_error($connection));
    }

    $row = mysqli_fetch_array($select_randsalt_query); //get the queried default value for randSalt
    $salt = $row['randSalt']; //The random salt
    $hashed_password = crypt($password, $salt); //encrpt password

    $query = "INSERT INTO users (username, user_email, user_password, user_role, user_firstname, user_lastname) ";
    $query .= "VALUES('{$username}', '{$email}', '{$hashed_password}', 'subscriber', '{$firstname}', '{$lastname}')";
    $register_user_query = mysqli_query($connection, $query);
    if(!$register_user_query) {
      die("QUERY FAILED " . mysqli_error($connection) . ' ' . mysqli_errno($connection));
    }

    $message = "Your registration has been submitted";
  } else {
    $message = "Fields cannot be empty";
  }

} else {
  $message = "";
}

?>

    <!-- Navigation -->

    <?php  include "includes/templates/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                      <h6 class="text-center"><?php echo $message; ?></h6>
                      <div class="form-group">
                          <label for="firstname" class="sr-only">Firstname</label>
                          <input type="text" name="firstname" id="firstname" class="form-control" placeholder="John">
                      </div>
                      <div class="form-group">
                          <label for="lastname" class="sr-only">Lastname</label>
                          <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Smith">
                      </div>
                      <div class="form-group">
                          <label for="username" class="sr-only">Username</label>
                          <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                      </div>
                      <div class="form-group">
                          <label for="email" class="sr-only">Email</label>
                          <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                      </div>
                      <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                      </div>
                      <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/templates/footer.php";?>
