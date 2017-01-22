<?php
  if(isset($_POST['create_post_submit'])) {

    //Get the information
    $post_title = mysqli_real_escape_string($connection, $_POST['post_title_input']); //The title of the post
    $post_author = mysqli_real_escape_string($connection, $_POST['post_author_input']); //The author of the post
    $post_category = mysqli_real_escape_string($connection, $_POST['post_category_input']); //The id of the post's category
    $post_status = $_POST['post_status_input']; //draft or published
    $post_image = $_FILES['post_image_input']['name']; //The name of the post image's file
    $post_image_tmp = $_FILES['post_image_input']['tmp_name']; //The location within the tmp/ folder, that our post image is located at before it is moved to our images folder
    $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags_input']); //The tags(Used to search for the post)
    $post_content = mysqli_real_escape_string($connection, $_POST['post_content_input']); //The actual content that the reader reads(The post's article itself)
    $post_date = date('d-m-y'); //The Day the post was created

    $image_location = "../images/" . $post_image;
    move_uploaded_file($post_image_tmp, $image_location); //Move the file from the tmp folder, to our actual folder we have to store the images

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES ('{$post_category}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

    $insert_post_query = mysqli_query($connection, $query);

    confirmQuery($insert_post_query);

    $post_id = mysqli_insert_id($connection); //returns the id of the last row created in the database
    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>Edit Post</a></p>";

  }
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="post_title_input">Post Title</label>
    <input type="text" class="form-control" name="post_title_input">
  </div>

  <div class="form-group">
    <label for="selectCategory">Post Category</label>
    <select class="form-control" name="post_category_input" id="selectCategory">

      <?php
      $query = "SELECT category_id, category_title FROM categories";
      $select_all_categories_query = mysqli_query($connection, $query);

      confirmQuery($select_all_categories_query);

      while($row = mysqli_fetch_assoc($select_all_categories_query)) {
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
        echo "<option value='$category_id'>{$category_title}</option>";
      }
      ?>

    </select>
  </div>

  <div class="form-group">
    <label for="post_author_input">Post Author</label>
    <input type="text" class="form-control" name="post_author_input">
  </div>

  <div class="form-group">
    <select name="post_status_input" id="">
      <option value="draft">Post Status</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>

    </select>
  </div>

  <div class="form-group">
    <label for="post_image_input">Post Image</label>
    <input type="file" name="post_image_input" id="post_image_input">
  </div>

  <div class="form-group">
    <label for="post_tags_input">Post Tags</label>
    <input type="text" class="form-control" name="post_tags_input">
  </div>

  <div class="form-group">
    <label for="post_content_input">Post Content</label>
    <textarea class="form-control" name="post_content_input" cols="30" rows="10" ></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post_submit" value="Publish Post">
  </div>

</form>
