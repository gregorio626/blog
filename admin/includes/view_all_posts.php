<?php

if(isset($_GET['delete'])) {
  $post_id_to_delete = $_GET['delete'];

  $query = "DELETE FROM posts WHERE post_id = {$post_id_to_delete}";
  $delete_post_query = mysqli_query($connection, $query);
  header("Location: posts.php");
}

if(isset($_GET['reset'])) {
  $post_id = $_GET['reset'];

  $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $post_id) . " ";
  $reset_views_query = mysqli_query($connection, $query);
  header("Location: posts.php");
}

?>


<?php

if(isset($_POST['checkBoxArray'])) {
  foreach($_POST['checkBoxArray'] as $postValueId) {
    $bulk_options = $_POST['bulk_options'];

    switch ($bulk_options) {
      case 'published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
        $update_to_published_status_query = mysqli_query($connection, $query);
        confirmQuery($update_to_published_status_query);
        break;
      case 'draft':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
        $update_to_draft_status_query = mysqli_query($connection, $query);
        confirmQuery($update_to_draft_status_query);
        break;
      case 'delete':
        $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
        $delete_post_query = mysqli_query($connection, $query);
        confirmQuery($delete_post_query);
        break;
      case 'clone':
        $query = "SELECT post_title, post_category_id, post_author, post_image, post_tags, post_content FROM posts WHERE post_id = '{$postValueId}'";
        $select_post_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_post_query)) {
          $post_title = $row['post_title'];
          $post_category_id = $row['post_category_id'];
          $post_author = $row['post_author'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_content = $row['post_content'];
        }
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', 'draft')";
        $copy_post_query = mysqli_query($connection, $query);
        if(!$copy_post_query) {
          die("QUERY FAILED" . mysqli_error($connection));
        }
        break;
      default:
        break;
    }
  }
}

?>
<form action="" method="post">
  <table class="table table-bordered table-hover">



    <div class="col-xs-4" id="bulkOptionsContainer">
      <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
      </select>
    </div>

    <div class="col-xs-4">
      <input type="submit" name="submit" class="btn btn-success" value="Apply"/>
      <a class="btn btn-primary" href="posts.php?source=add_post"> Add New</a>
    </div>


    <thead>
      <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
        <th># Views</th>
      </tr>
    </thead>
    <tbody>

  <?php
  $query = "SELECT post_id, post_author, post_title, post_category_id, post_status, post_image, post_tags, post_comment_count, post_date, post_views_count FROM posts ORDER BY post_id DESC";
  $select_posts_query = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_posts_query)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_views_count = $row['post_views_count'];

  echo "<tr>";
  ?>
  <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
  <?php
  echo "<td>$post_id</td>";
  echo "<td>$post_author</td>";
  echo "<td>$post_title</td>";

  /*Get the row(The category) */
  $query = "SELECT category_title FROM categories WHERE category_id = {$post_category_id}";
  $select_categories_by_id_query = mysqli_query($connection, $query);

  /*For each result(Should only ever be one row fetched anyways) */;
  while($row = mysqli_fetch_assoc($select_categories_by_id_query)) {
    $category_title = $row['category_title'];
    echo "<td>{$category_title}</td>";
  }


  echo "<td>$post_status</td>";
  echo "<td><img style='width: 100px;' src='../images/" . $post_image . "' alt='image'></td>";
  echo "<td>$post_tags</td>";
  echo "<td>$post_comment_count</td>";
  echo "<td>$post_date</td>";
  echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
  echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
  echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
  echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
  echo "</tr>";
  }

  ?>
    </tbody>
  </table>

</form>
