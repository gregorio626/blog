<?php include "includes/database.php"; ?>
<?php include "includes/templates/header.php"; ?>

    <!-- Navigation -->
<?php include "includes/templates/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <dv class="col-md-8">

              <?php

              if(isset($_GET['p_id']) && isset($_GET['author'])) {
                $the_post_id = $_GET['p_id'];
                $the_post_author = $_GET['author'];
              }

              $query = "SELECT post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_author = '{$the_post_author}'";
              $select_post_by_id_query = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc($select_post_by_id_query)) {
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
                    All posts by <?php  echo $post_author ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php  echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="image">
                <hr>
                <p><?php  echo $post_content ?></p>
                <hr>
<?php  } ?>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/templates/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/templates/footer.php"; ?>
