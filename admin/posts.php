<?php include "includes/templates/admin_header.php"; ?>
    <div id="wrapper">
      <!--Navigation -->
<?php include "includes/templates/admin_navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
<?php
/*Make sure that the source variable is at least blank */
if(isset($_GET['source'])) {
  $source = $_GET['source'];
} else {$source = '';}

switch($source) {
  /* /admin/posts.php?source=add_post */
  case 'add_post';
    include "includes/add_post.php";
    break;
  case 'edit_post';
    include "includes/edit_post.php";
    break;
  /* /admin/posts.php */
  default;
    include "includes/view_all_posts.php";
    break;
}
?>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include "includes/templates/admin_footer.php"; ?>
