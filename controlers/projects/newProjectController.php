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

if (isset($_POST['new_project'])) {

    $dt = new DateTime();
    $created_at = $dt->format('Y-m-d H:i:s');
    $edited_at = $dt->format('Y-m-d H:i:s');
    $created_by = $username;
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $user_in_charge = mysqli_real_escape_string($db, $_POST['user_in_charge']);

    if (empty($name)) { array_push($errors, "Name is required"); }
    if (empty($description)) { array_push($errors, "Description is required"); }

    if (count($errors) == 0) {
  
        $query = "INSERT INTO projects (name, description, created_at, edited_at, created_by, user_in_charge) 
                  VALUES('$name','$description','$created_at','$edited_at','$created_by','$user_in_charge')";
        mysqli_query($db, $query);

        header('location: projects.php');
    }
  }