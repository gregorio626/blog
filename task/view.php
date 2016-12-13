<!DOCTYPE html>
<html lang="en">

  <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Task Share | View</title>

      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="css/styles.css" rel="stylesheet">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1 style="text-align: center; padding: 40px 0px;">Unfinished Tasks</h1>
        </div>
      </div>
    </div>
    <?php
    include dirname(__FILE__) . '/scripts/classes/database.class.php';
    $database = new Database();
    $database->query("SELECT * FROM task WHERE task_is_completed = '0' ORDER BY task_due_date DESC LIMIT 5");
    $results = $database->getResultSets();
    ?>
    <div class="container">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Author</th>
            <th>Due Date</th>
            <th>Due time</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($results as $row) {
            $task_title = $row['task_title'];
            $task_description = $row['task_description'];
            $task_author = $row['task_author'];
            $task_due_date = $row['task_due_date'];
            $task_due_time = $row['task_due_time'];

            echo "<tr>";
            echo "<td>$task_title</td>";
            echo "<td>$task_description</td>";
            echo "<td>$task_author</td>";
            echo "<td>$task_due_date</td>";
            echo "<td>$task_due_time</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
      </table>
      <a href="new.php" class="btn btn-success" role="button">Add Task</a>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

  </body>

</html>
