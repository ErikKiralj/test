<?php 

$db = mysqli_connect('localhost', 'root', '', 'test');
$username =  $_SESSION['username'] ;
$keyword = "";

if (isset($_POST['search_projects'])){

    $keyword = mysqli_real_escape_string($db, $_POST['keyword']);
    $query = "SELECT * FROM projects WHERE (created_by='$username' OR user_in_charge='$username') AND (name LIKE '%$keyword%' OR description LIKE '%$keyword%' 
    OR created_by LIKE '%$keyword%' OR user_in_charge LIKE '%$keyword%' OR created_at LIKE '%$keyword%' OR edited_at LIKE '%$keyword%') ORDER BY name ASC";
    $result = mysqli_query($db, $query);

}

else {
    
    $db = mysqli_connect('localhost', 'root', '', 'test');
    $username =  $_SESSION['username'] ;
    $query = "SELECT * FROM projects WHERE created_by='$username' OR user_in_charge='$username' ORDER BY name ASC";
    $result = mysqli_query($db, $query);

}
?>