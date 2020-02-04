<?php

$id = $_GET['id'];
$db = mysqli_connect('localhost', 'root', '', 'test');

$query = "DELETE FROM tasks WHERE id = $id";
mysqli_query($db, $query);
header('location: /tasks.php');

?>