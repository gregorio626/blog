                          <!--Edit Category Form -->
                          <form action="" method="post">
                            <div class="form-group">
                              <label for="update_category_title">Edit Category</label>





<?php

if(isset($_GET['edit'])) {
  $id_of_category_to_edit = $_GET['edit'];

  /*Get the row(The category that we want to edit) */
  $query = "SELECT category_title FROM categories WHERE category_id = {$id_of_category_to_edit}";
  $select_category_by_id_query = mysqli_query($connection, $query);

  /*For each result(Should only ever be one row fetched anyways) */;
  while($row = mysqli_fetch_assoc($select_category_by_id_query)) {
    $old_category_title = $row['category_title'];
    ?>






    <input value="<?php if(isset($old_category_title)) { echo $old_category_title;} ?>" class="form-control" name="new_category_title_input" type="text">






<?php
  }
}
?>






<?php //UPDATE QUERY
/*Check to see if the form's submit button has been clicked */
if(isset($_POST['update_category'])) {
  $new_category_title = $_POST['new_category_title_input'];
  $query = "UPDATE categories SET category_title = '{$new_category_title}' WHERE category_id = {$id_of_category_to_edit}";
  $update_category_query = mysqli_query($connection, $query);

  //MCheck to see if the query was successful
  if(!$update_category_query) {
    die('QUERY FAILED ' . mysqli_error($connection));
  }
}

?>






                            </div>
                            <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="update_category" value="Update">
                            </div>
                          </form>
