<?php
error_reporting(-1);
ini_set('display_errors', 'On');

include dirname(__FILE__) . '/classes/database.class.php';

$database = new Database();

$database->query("INSERT INTO task (task_title, task_description, task_author, task_due_date, task_due_time) VALUES (:title, :description, :author, :dueDate, :dueTime)");
$title = $_POST['taskTitle'];
$desc = $_POST['taskDescription'];
$author = $_POST['taskAuthor'];
$dueDate = $_POST['taskDueDate'];
$dueTime = $_POST['taskDueTime'];

$database->bind(':title', $title);
$database->bind(':description', $desc);
$database->bind(':author', $author);
$database->bind(':dueDate', $dueDate);
$database->bind(':dueTime', $dueTime);

$database->execute();

header('Location: ../view.php');
?>
