<!--Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit"class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
      </form><!-- /.search-form -->
        <!-- /.input-group -->
    </div>

    <!-- Login -->
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="login_username" type="text" class="form-control" placeholder="Enter Username">
        </div>
        <div class="input-group">
            <input name="login_password" type="password" class="form-control" placeholder="Enter Password">
            <span class="input-group-btn">
              <button class="btn btn-primary" name="login_submit" type="submit">Submit</button>
            </span>
        </div>
      </form><!-- /.login-form -->
        <!-- /.input-group -->
    </div>


















    <!-- Blog Categories Well -->
    <div class="well">

<?php
  $query = "SELECT * FROM categories";
  $select_sidebar_categories = mysqli_query($connection, $query);
?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
<?php
while($row = mysqli_fetch_assoc($select_sidebar_categories)) {
  $category_id = $row['category_id'];
  $category_title = $row['category_title'];

  echo "<li><a href='category.php?category=$category_id'>{$category_title}</a></li>";
}
?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>
