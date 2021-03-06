<?php

error_reporting(-1);
ini_set('display_errors', 'On');

?>

<?php include "includes/database.php"; ?>
<?php include "includes/templates/header.php"; ?>

    <!-- Navigation -->
<?php include "includes/templates/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

              <?php

                if(isset($_POST['submit'])) {
                  $search = $_POST['search'];
                  //The query used to grab posts with specific tags
                  $query = "SELECT post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_status='published' AND post_tags LIKE '%$search%' ";
                  //Send query to database
                  $search_query = mysqli_query($connection, $query);

                  if(!$search_query) {
                    die("QUERY FAILED" . mysqli_error($connection));
                  }

                  $count = mysqli_num_rows($search_query);

                  if($count == 0) {
                    echo "<h1>NO RESULTS</h1>";
                  } else {

                                    while($row = mysqli_fetch_assoc($search_query)) {
                                      $post_title = $row['post_title'];
                                      $post_author = $row['post_author'];
                                      $post_date = $row['post_date'];
                                      $post_image = $row['post_image'];
                                      $post_content = $row['post_content'];

                                      ?>


                                    <h1 class="page-header">
                                        Page Heading
                                        <small>Secondary Text</small>
                                    </h1>

                                    <!-- First Blog Post -->
                                    <h2>
                                        <a href="#"><?php  echo $post_title ?></a>
                                    </h2>
                                    <p class="lead">
                                        by <a href="index.php"><?php  echo $post_author ?></a>
                                    </p>
                                    <p><span class="glyphicon glyphicon-time"></span><?php  echo $post_date ?></p>
                                    <hr>
                                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                                      <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="image">
                                    </a>                                    <hr>
                                    <p><?php  echo $post_content ?></p>
                                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                    <hr>
                              <?php
                                    }

                                  }
                                }

                              ?>






            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/templates/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/templates/footer.php"; ?>
