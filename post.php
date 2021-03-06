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

              if(isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];

                $post_view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
                $send_post_view_query = mysqli_query($connection, $post_view_query);


              $query = "SELECT post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_id = $post_id";
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
                    by <a href="index.php"><?php  echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php  echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="image">
                <hr>
                <p><?php  echo $post_content ?></p>
                <hr>
<?php  }


} else {
  header("Location: index.php"); //If the post id GET superglobal is not set
}


?>

                <!-- Blog Comments -->

                <?php

                  /* If the comment form has been submitted */
                  if(isset($_POST['create_comment_submit'])) {



                    $post_id = $_GET['p_id']; //Get the post id (AKA comment_post_id)
                    $comment_author = $_POST['comment_author']; //Submitted Text for comment author
                    $comment_email = $_POST['comment_email']; //Submitted Text for comment author's email address
                    $comment_content = $_POST['comment_content']; //Submitted Text for comment content

                    //Comment form verification(Make sure the author, email, and content values are not empty)
                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                      $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)
                                VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                      $create_comment_query = mysqli_query($connection, $query);
                      if(!$create_comment_query) {
                        die("QUERY FAILED" . mysqli_error($connection));
                      }
                      $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                      $query .= "WHERE post_id = $post_id ";
                      $update_comment_count_query = mysqli_query($connection, $query);

                    } else { //If any of the comment form values were empty...
                      echo "<script>alert('Fields cannot be empty');</script>";
                    }
                  }

                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">

                        <div class="form-group">
                          <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>

                        <div class="form-group">
                          <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                          <label for="comment_content">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment_submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php

                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                $query .=  "AND comment_status = 'approved' ";
                $query .=  "ORDER BY comment_id DESC ";
                $select_comments_query = mysqli_query($connection, $query);
                if(!$select_comments_query) {
                  die("QUERY FAILED" . mysqli_error($connection));
                }
                while($row = mysqli_fetch_assoc($select_comments_query)) {
                  $comment_date = $row['comment_date'];
                  $comment_content = $row['comment_content'];
                  $comment_author = $row['comment_author'];

                  ?>

                  <!-- Comment -->
                  <div class="media">
                      <a class="pull-left" href="#">
                          <img class="media-object" src="https://placehold.it/64x64" alt="">
                      </a>
                      <div class="media-body">
                          <h4 class="media-heading"><?php echo $comment_author; ?>
                              <small><?php echo $comment_date; ?></small>
                          </h4>
                          <?php echo $comment_content; ?>
                      </div>
                  </div><!-- /Comment -->

                <?php
                }
                ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/templates/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/templates/footer.php"; ?>
