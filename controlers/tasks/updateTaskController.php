<?php

$name = "";
$description = "";
$status = "";
$project_id = "";
$created_at = "";
$edited_at = "";
$last_edited_by = "";
$username = $_SESSION['username'];
$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'test');
$dt = new DateTime();

if (isset($_POST['update_task'])) {

  $project_id = mysqli_real_escape_string($db, $_POST['edit_id']);
  $name = mysqli_real_escape_string($db, $_POST['edit_name']);
  $description = mysqli_real_escape_string($db, $_POST['edit_description']);
  $edited_at = $dt->format('Y-m-d H:i:s');
  $status = mysqli_real_escape_string($db, $_POST['status']);
  $last_edited_by = $username;

  if (empty($name)) { array_push($errors, "Project name is required"); }
  if (empty($description)) { array_push($errors, "Description is required"); }
  
  if (count($errors) == 0) {
      $query = "UPDATE tasks SET name = '$name', description = '$description', status = '$status' , edited_at = '$edited_at', last_edited_by = '$last_edited_by' WHERE id = $project_id";        
      $result = mysqli_query($db, $query);
      header('location: /tasks.php');
  }

}

?>