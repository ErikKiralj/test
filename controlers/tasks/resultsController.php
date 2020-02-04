<?php 

$db = mysqli_connect('localhost', 'root', '', 'test');
$username =  $_SESSION['username'] ;
$keyword = "";

if (isset($_POST['search_tasks'])){

    $keyword = mysqli_real_escape_string($db, $_POST['keyword']);
    $query = "SELECT tasks.name, tasks.id as task_id ,tasks.description, tasks.status, projects.created_by ,projects.user_in_charge ,projects.id as id, projects.created_by as created_by ,projects.name as project_name, tasks.created_at, tasks.edited_at, tasks.last_edited_by 
    FROM tasks INNER JOIN projects ON tasks.project_id = projects.id
    WHERE (projects.name LIKE '%$keyword%' OR tasks.name LIKE '%$keyword%' OR tasks.description LIKE '%$keyword%' 
    OR tasks.status LIKE '%$keyword%' OR tasks.created_at LIKE '%$keyword%' OR tasks.edited_at LIKE '%$keyword%' OR tasks.last_edited_by LIKE '%$keyword%')
    AND (projects.created_by='$username' OR projects.user_in_charge='$username')";
    $result = mysqli_query($db, $query);

 }

else {

    $db = mysqli_connect('localhost', 'root', '', 'test');
    $query = "SELECT tasks.name, tasks.id as task_id, tasks.description, tasks.status, projects.created_by ,projects.user_in_charge ,projects.id as id, projects.created_by as created_by ,projects.name as project_name, tasks.created_at, tasks.edited_at, tasks.last_edited_by 
    FROM tasks INNER JOIN projects ON tasks.project_id = projects.id
    WHERE projects.created_by='$username' OR projects.user_in_charge='$username'";
    $result = mysqli_query($db, $query);  

}