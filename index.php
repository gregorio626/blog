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

              $query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_status FROM posts ";
              $select_all_posts_query = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);
                $post_status = $row['post_status'];

                if($post_status !== 'published'){
                  echo "<h1 class='text-center'>No Post Here, sorry!</h1>";
                } else { //Display the post
                  ?>
                  <h1 class="page-header">
                      Page Heading
                      <small>Secondary Text</small>
                  </h1>
                  <!-- Blog post -->
                  <h2>
                      <a href="post.php?p_id=<?php echo $post_id; ?>"><?php  echo $post_title; ?></a>
                  </h2>
                  <p class="lead">
                      by <a href="index.php"><?php  echo $post_author; ?></a>
                  </p>
                  <p><span class="glyphicon glyphicon-time"></span><?php  echo $post_date; ?></p>
                  <hr>
                  <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="image">
                  <hr>
                  <p><?php  echo $post_content; ?></p>
                  <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                  <hr>
<?php  } }?>






            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/templates/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/templates/footer.php"; ?>
