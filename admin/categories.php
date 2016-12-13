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
                        <div class="col-xs-6">
<?php insertCategory();?>
                          <!--Insert Category Form -->
                          <form action="" method="post">
                            <div class="form-group">
                              <label for="category_title">Add Category</label>
                              <input class="form-control" type="text" name="insert_category_title_input">
                            </div>
                            <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="submit_insert_category_form" value="Add Category">
                            </div>
                          </form>
                          <?php //UPDATE CATEGORY FORM
                          if(isset($_GET['edit'])) {
                            include "includes/update_categories.php";
                          }
                          ?>
                        </div>

                        <div class="col-xs-6">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <th>Id</th>
                              <th>Category Title</th>
                            </thead>
                            <tbody>
<?php findAllCategories(); ?>
<?php deleteCategory(); ?>
                            </tbody>
                          </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include "includes/templates/admin_footer.php"; ?>
