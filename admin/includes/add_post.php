<?php
  if(isset($_POST['create_post'])) {

    $post_title = mysql_real_escape_string($_POST['post_title_input']); //The title of the post
    $post_author = $_POST['post_author_input']; //The author of the post
    $post_category_id = $_POST['post_category_id_input']; //The id of the post's category
    $post_status = $_POST['post_status_input']; //draft or published
    $post_image = $_FILES['post_image_input']['name']; //The name of the post image's file
    $post_image_tmp = $_FILES['post_image_input']['tmp_name']; //The location within the tmp/ folder, that our post image is located at before it is moved to our images folder
    $post_tags = $_POST['post_tags_input']; //The tags(Used to search for the post)
    $post_content = mysql_real_escape_string($_POST['post_content_input']); //The actual content that the reader reads(The post's article itself)
    $post_date = date('d-m-y'); //The Day the post was created
    $post_comment_count = 4;  //The number of comments the post has

    move_uploaded_file($post_image_tmp, "../images/$post_image"); //Move the file from the tmp folder, to our actual folder we have to store the images

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)
              VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}')";

    $insert_post_query = mysqli_query($connection, $query);

    confirmQuery($insert_post_query);

    header("Location: posts.php");
  }
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="post_title_input">Post Title</label>
    <input type="text" class="form-control" name="post_title_input">
  </div>

  <div class="form-group">
    <label for="post_category_id_input">Post Category Id</label>
    <input type="text" class="form-control" name="post_category_id_input">
  </div>

  <div class="form-group">
    <label for="post_author_input">Post Author</label>
    <input type="text" class="form-control" name="post_author_input">
  </div>

  <div class="form-group">
    <label for="post_status_input">Post Status</label>
    <input type="text" class="form-control" name="post_status_input">
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
    <textarea class="form-control" name="post_content_input" id="" cols="30" rows="10" ></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>

</form>
