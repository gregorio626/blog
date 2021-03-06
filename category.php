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


              if(isset($_GET['category'])) {
                $post_category_id = $_GET['category'];
              }

              $query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published' ";
              $select_posts_by_category_id_query = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc($select_posts_by_category_id_query)) {
                $post_id = $row['post_id'];
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
                <!-- Blog post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php  echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    By <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                  <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="image">
                </a>
                <hr>
                <p><?php  echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
<?php  } ?>






            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/templates/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/templates/footer.php"; ?>
