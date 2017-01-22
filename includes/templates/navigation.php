<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Gregaholic</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <?php
                $query = "SELECT category_id, category_title FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_categories_query)) {
                  $category_id = $row['category_id'];
                  $category_title = $row['category_title'];

                  echo "<li><a href='category.php?category=$category_id'>{$category_title}</a></li>";
                }
              ?>
                <li>
                    <a href="admin">Admin</a>
                </li>
                <?php
                //If the user_role session variable is set(If the user is logged in)
                if(isset($_SESSION['user_role'])) {

                  if(isset($_GET['p_id'])) {
                    $the_post_id = $_GET['p_id']; //If the post GET superglobal is set(if the user is viewing a post in the front end)
                    echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                  }
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
