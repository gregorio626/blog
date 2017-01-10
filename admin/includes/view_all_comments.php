<?php

if(isset($_GET['delete'])) {
  $post_id_to_delete = $_GET['delete'];

  $query = "DELETE FROM posts WHERE post_id = {$post_id_to_delete}";
  $delete_post_query = mysqli_query($connection, $query);
}

?>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Status</th>
      <th>In Response To</th>
      <th>Date</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>

<?php
$query = "SELECT comment_id, comment_post_id, comment_author, comment_content, comment_email, comment_status, comment_date FROM comments";
$select_comments = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_comments)) {
  $comment_id = $row['comment_id'];
  $comment_post_id = $row['comment_post_id'];
  $comment_author = $row['comment_author'];
  $comment_content = $row['comment_content'];
  $comment_email = $row['comment_email'];
  $comment_status = $row['comment_status'];
  $comment_date = $row['comment_date'];

  $comment_status_color = ($comment_status === 'approved') ? 'green' : 'red';

echo "<tr>";
echo "<td>$comment_id</td>";
echo "<td>$comment_author</td>";
echo "<td>$comment_content</td>";



// /*Get the row(The category that we want to edit) */
// $query = "SELECT category_title FROM categories WHERE category_id = {$post_category_id}";
// $select_categories_by_id_query = mysqli_query($connection, $query);
//
// /*For each result(Should only ever be one row fetched anyways) */;
// while($row = mysqli_fetch_assoc($select_categories_by_id_query)) {
//   $category_title = $row['category_title'];
//   echo "<td>{$category_title}</td>";
// }

echo "<td>$comment_email</td>";
echo "<td style='color: $comment_status_color'>{$comment_status}</td>";


$query = "SELECT post_id, post_title FROM posts WHERE post_id = $comment_post_id";
$select_post_id_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_post_id_query)) {
  $post_id = $row['post_id'];
  $post_title = $row['post_title'];

  echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
}



echo "<td>$comment_date</td>";
echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
echo "</tr>";
}

?>

  </tbody>
</table>








<?php
/* DELETE A COMMENT */
if(isset($_GET['delete'])) {
  $comment_id_to_delete = $_GET['delete'];

  $query = "DELETE FROM comments WHERE comment_id = {$comment_id_to_delete}";
  $delete_comment_query = mysqli_query($connection, $query);

  header("Location: comments.php"); //reload the page without the delete GET superglobal
}
/* APPROVE A COMMENT */
if(isset($_GET['approve'])) {
  $approve_comment_id = $_GET['approve'];

  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approve_comment_id}";
  $approve_comment_query = mysqli_query($connection, $query);

  header("Location: comments.php"); //reload the page without the delete GET superglobal
}

/* UNAPPROVE A COMMENT */
if(isset($_GET['unapprove'])) {
  $unapprove_comment_id = $_GET['unapprove'];

  $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$unapprove_comment_id}";
  $unapprove_comment_query = mysqli_query($connection, $query);

  header("Location: comments.php"); //reload the page without the delete GET superglobal
}
 ?>
