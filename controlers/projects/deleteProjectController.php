<?php

$id = $_GET['id'];
$db = mysqli_connect('localhost', 'root', '', 'test');

$query = "DELETE FROM projects WHERE id = $id";
mysqli_query($db, $query);
header('location: /projects.php');

?>