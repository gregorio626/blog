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
$per_page = 5;

if(isset($_GET['page'])) {
  $page_num = $_GET['page'];
} else {
  $page_num="";
}

if($page_num == "" || $page_num == 1) {
  $page_1 = 0;
} else {
  $page_1 = ($page_num * $per_page) - $per_page;
}

$query = "SELECT * FROM posts WHERE post_status = 'published'"; //get all posts
$find_count = mysqli_query($connection, $query); //execute the query
$count = mysqli_num_rows($find_count); //get the number of posts queried(the total number of posts in the db)
$count = ceil($count / $per_page);

$query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_status FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";
$select_all_posts_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_all_posts_query)) {
  $post_id = $row['post_id'];
  $post_title = $row['post_title'];
  $post_author = $row['post_author'];
  $post_date = $row['post_date'];
  $post_image = $row['post_image'];
  $post_content = substr($row['post_content'], 0, 100);
  $post_status = $row['post_status'];

  include  "includes/templates/preview_post.php";
}

?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/templates/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>

        <ul class="pager">

          <?php

          for($i = 1; $i <= $count; $i++) {
            if($i == $page_num) {
              echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            } else {
              echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
          }

          ?>
        </ul>
<?php include "includes/templates/footer.php"; ?>
