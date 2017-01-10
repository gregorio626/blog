<?php

if(isset($_GET['delete'])) {
  $post_id_to_delete = $_GET['delete'];

  $query = "DELETE FROM posts WHERE post_id = {$post_id_to_delete}";
  $delete_post_query = mysqli_query($connection, $query);
  header("Location: posts.php");
}

?>



<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Title</th>
      <th>Category</th>
      <th>Status</th>
      <th>Image</th>
      <th>Tags</th>
      <th>Comments</th>
      <th>Date</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>

<?php
$query = "SELECT post_id, post_author, post_title, post_category_id, post_status, post_image, post_tags, post_comment_count, post_date FROM posts";
$select_categories = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_categories)) {
  $post_id = $row['post_id'];
  $post_title = $row['post_title'];
  $post_author = $row['post_author'];
  $post_category_id = $row['post_category_id'];
  $post_status = $row['post_status'];
  $post_image = $row['post_image'];
  $post_tags = $row['post_tags'];
  $post_comment_count = $row['post_comment_count'];
  $post_date = $row['post_date'];

echo "<tr>";
echo "<td>$post_id</td>";
echo "<td>$post_author</td>";
echo "<td>$post_title</td>";

/*Get the row(The category that we want to edit) */
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
echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
echo "</tr>";
}

?>
  </tbody>
</table>
