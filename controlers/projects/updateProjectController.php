<?php

$name = "";
$user_in_charge = "";
$description = "";
$created_at = "";
$edited_at = "";
$created_by = "";
$username = $_SESSION['username'];
$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'test');
$dt = new DateTime();

if (isset($_POST['update_project'])) {
  $id = mysqli_real_escape_string($db, $_POST['edit_id']);
  $name = mysqli_real_escape_string($db, $_POST['edit_name']);
  $description = mysqli_real_escape_string($db, $_POST['edit_description']);
  $edited_at = $dt->format('Y-m-d H:i:s');
  $user_in_charge = mysqli_real_escape_string($db, $_POST['edit_user_in_charge']);

  if (empty($name)) { array_push($errors, "Project name is required"); }
  if (empty($description)) { array_push($errors, "Description is required"); }
  
  if (count($errors) == 0) {
      $query = "UPDATE projects SET name = '$name', description = '$description', edited_at = '$edited_at', user_in_charge = '$user_in_charge' WHERE id = $id";        
      $result = mysqli_query($db, $query);
      header('location: /projects.php');
  }

}

?>