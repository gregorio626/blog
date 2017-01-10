<?php

//Check if the get variable declaring the post to be edited, is set
if(isset($_GET['p_id'])) {
  $current_post_id = $_GET['p_id'];
}

$query = "SELECT post_id, post_title, post_category_id, post_author, post_status, post_image, post_content, post_tags, post_date, post_comment_count FROM posts WHERE post_id = '{$current_post_id}'";
$select_current_post_query = mysqli_query($connection, $query);

/*Loop through each row queried */
while($row = mysqli_fetch_assoc($select_current_post_query)) {
  $old_post_title = $row['post_title']; //The title of the post
  $old_post_category_id = $row['post_category_id'];
  $old_post_author = $row['post_author']; //The author
  $old_post_status = $row['post_status']; //Draft, published, pending, removed?
  $old_post_image = $row['post_image']; //The image name
  $old_post_content = $row['post_content']; //The actual content that the users read
  $old_post_tags = $row['post_tags']; //the tags(used for searches)
  $old_post_date = $row['post_date'];
  $old_post_comment_count = $row['post_comment_count'];
}

//if the form is submitted
if(isset($_POST['update_post_submit'])) {
  /*Grab all of our values from the form */
  $post_title = $_POST['post_title']; //The title of the post
  $post_category_id = $_POST['post_category']; //The id of the category that our post falls under
  $post_author = $_POST['post_author']; //The post author
  $post_status = $_POST['post_status']; //Draft, published, pending, removed?
  $post_image = $_FILES['post_image']['name']; //The image name
  $post_image_tmp = $_FILES['post_image']['tmp_name']; //The temporary location of the image
  $post_content = $_POST['post_content']; //The actual content that the users read
  $post_tags = $_POST['post_tags']; //the tags(used for searches)

  move_uploaded_file($post_image_tmp, "../images/" . $post_image); //Move the image from temporary folder to our images folder

  //If we are not changing the image, we want to just use the image currently in the row as of before the update
  if(empty($post_image)) {
    $query = "SELECT post_image FROM posts WHERE post_id = $current_post_id";
    $select_post_image_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_post_image_query)) {
      $post_image = $row['post_image'];
    }
  }
  /*Update post query*/
  $query = "UPDATE posts SET ";
  $query .= "post_title = '{$post_title}', ";
  $query .= "post_category_id = '{$post_category_id}', ";
  $query .= "post_author = '{$post_author}', ";
  $query .= "post_status = '{$post_status}', ";
  $query .= "post_image = '{$post_image}', ";
  $query .= "post_tags = '{$post_tags}', ";
  $query .= "post_content = '{$post_content}' ";
  $query .= "WHERE post_id = {$current_post_id}";


  $update_post_query = mysqli_query($connection, $query);
  confirmQuery($update_post_query);
  header("Location: posts.php");
}

?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input value="<?php echo $old_post_title; ?>" type="text" class="form-control" name="post_title">
  </div>

  <div class="form-group">
    <?php
    $query = "SELECT category_title FROM categories WHERE category_id = '{$old_post_category_id}' LIMIT 1";
    $get_old_post_category_title_by_id = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($get_old_post_category_title_by_id);
    $old_post_category_title = $row['category_title'];
    ?>
    <p><strong>Current Category: <?php echo $old_post_category_title; ?></strong></p>

    <label for="selectCategory">Post Category</label>
    <select class="form-control" name="post_category" id="selectCategory">
      <?php

      $query = "SELECT category_id, category_title FROM categories";
      $select_all_categories_query = mysqli_query($connection, $query);
      confirmQuery($select_all_categories_query);

      while($row = mysqli_fetch_assoc($select_all_categories_query)) {
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
        if($category_id != $old_post_category_id) {
          echo "<option value='$category_id'>{$category_title}</option>";
        } else {
          echo "<option value='$category_id' selected>{$category_title}</option>";
        }
      }

      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input value="<?php echo $old_post_author; ?>" type="text" class="form-control" name="post_author">
  </div>

  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input value="<?php echo $old_post_status; ?>" type="text" class="form-control" name="post_status">
  </div>

  <div class="form-group">
    <img width="100" src="../images/<?php echo $old_post_image; ?>" alt="">
    <label for="post_image">Post Image</label>
    <input type="file" name="post_image" id="post_image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $old_post_tags; ?>" type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10" ><?php echo $old_post_content; ?></textarea>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <p><strong>Date Created:</strong> <?php echo $old_post_date; ?></p>
    </div>
    <div class="col-sm-6">
      <p><strong>Number of Comments:</strong> <?php echo $old_post_comment_count; ?> </p>
    </div>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post_submit" value="Update Post">
  </div>

</form>
