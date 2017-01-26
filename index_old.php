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

  if($post_status == 'published'){
    include  "includes/templates/preview_post.php";
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
