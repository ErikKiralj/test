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

if (isset($_POST['new_task'])) {

    $dt = new DateTime();
    $created_at = $dt->format('Y-m-d H:i:s');
    $edited_at = $dt->format('Y-m-d H:i:s');
    $last_edited_by = $username;
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $project_id = mysqli_real_escape_string($db, $_POST['project_id']);

    if (empty($name)) { array_push($errors, "Name is required"); }
    if (empty($description)) { array_push($errors, "Description is required"); }

    if (count($errors) == 0) {
  
        $query = "INSERT INTO tasks (name, description, status, project_id ,created_at, edited_at, last_edited_by) 
                  VALUES('$name','$description','$status','$project_id','$created_at','$edited_at', '$last_edited_by')";
        mysqli_query($db, $query);

        header('location: tasks.php');
    }
  }