<?php 
  session_start(); 
  if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  }
  include_once("partials/navbar.php");
  include('controlers\tasks\newTaskController.php');
  include('controlers\tasks\updateTaskController.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Zadaci</title>
  <link rel="stylesheet" type="text/css" href="css\styles.css">
  <link rel="stylesheet" type="text/css" href="css\popup-form.css">
  <link rel="stylesheet" type="text/css" href="css\popup-form-edit.css">
</head>
<body>
    <h1 class="welcome-msg">Stranica sa zadacima</h1> 
        <div class="open-btn">
            <button class="open-button" onclick="newTaskForm()">
            <strong>Novi zadatak</strong>
            </button>
        </div>

        <form  method="POST" action="tasks.php">
				<div >
					<input type="text"  placeholder="Unesite ključnu riječ" name="keyword" required="required"/>
					<button class="btn-update" name="search_tasks">Pretraži</button>
				</div>
        </form>

        <div id="loginPopup">
          <div class="form-popup" id="popupForm">
            <form method="post" action="tasks.php" class="form-container">
              <h2>Novi zadatak</h2>
              <br>
              <label for="name">
              <strong>Ime zadatka</strong>
              </label>
              <input type="text" id="name" placeholder="Unesite ime zadatka" name="name" required>
              <label for="description">
              <strong>Opis zadatka</strong>
              </label>
              <input type="text" id="description" placeholder="Unesite opis zadatka" name="description" required>
              <label for="status">
              <strong>Status</strong>
              </label>
              <select name="status" required>
                <option disabled selected value></option>
                <option value="U radu">U radu</option>
                <option value="Nije započeto">Nije započeto</option>
                <option value="Riješeno">Riješeno</option>
                <option value="Stornirano">Stornirano</option>
              </select>
              <br>
              <br>
              <label for="project_id">
              <strong>Odabir projekta</strong>
              </label>
              <?php 
                $username = $_SESSION['username'];
                $db = mysqli_connect('localhost', 'root', '', 'test');
                $query2 = "SELECT id, name FROM projects WHERE created_by='$username' OR user_in_charge='$username'";
                $users = mysqli_query($db, $query2);
                echo '<select name="project_id" required>';
                echo '<option disabled selected value></option>';
                while ($row = $users->fetch_assoc()) {
                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                echo '</select>';
              ?>
              <br>
              <br>
              <button type="submit" name="new_task" class="btn">Spremi zadatak</button>
              <button type="button" class="btn cancel" onclick="closenewTaskForm()">Zatvori</button>
            </form>
          </div>
        </div>

<?php 
include('controlers\tasks\resultsController.php');
?>

<table>
 <tr>
   <th>Ime zadatka</th>
   <th>Opis zadatka</th>
   <th>Status zadatka</th>
   <th>Naziv projekta</th>
   <th>Vrijeme stvaranja</th>
   <th>Vrijeme zadnjeg editiranja</th>
   <th>Zadnji editirao</th>
   <th>Opcije</th>
</tr>

<?php
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    echo '<tr>
    <td>' . $row["name"]. '</td>
    <td>' . $row["description"] . '</td>
    <td>' . $row["status"]. '</td>
    <td>' . $row["project_name"] . '</td>
    <td>' . $row["created_at"] . '</td>
    <td>' . $row["edited_at"] . '</td>
    <td>' . $row["last_edited_by"] . '</td>';
    if($_SESSION['username']==$row["created_by"] || $_SESSION['username']==$row["user_in_charge"]){
    echo '<td>
    <div class="inline">
      <button id="'.$row['task_id'].'" class="btn-update" data-name="'.$row['name'].'" data-id="'.$row['task_id'].'" data-description="'.$row['description'].'" onclick="editTaskForm('.$row['task_id'].')">
      Uredi
      </button>
    </div>';
    if($_SESSION['username']==$row["created_by"]){
    echo '<div class="inline">
    <form method="post" action="controlers\tasks\deleteTaskController.php?id='.$row['task_id'].'" n>
    <input type="hidden" name="id" value="'.$row['task_id'].'";?>
    <button type="submit" class="btn-delete"">Obriši</button>
    </form>
    </div>
    </td></tr>';
    }
    }
    else
    {
      echo '<td>Nije dozvoljeno</td></tr>';
    } 
}
  echo "</table>";
}
else {
    echo '<td>Nije pronađen nijedan zapis</td></tr>';
}
?>

    <div id="editPopup">
      <div class="form-popup" id="popupForm">
        <form method="post" action="tasks.php" class="form-container">
          <h2>Uredi zadatak</h2>
          <br>
          <label for="name">
          <strong>Ime zadatka</strong>
          </label>
          <input type="text" id="edit_name" name="edit_name" required>
          <label for="description">
          <strong>Opis zadatka</strong>
          </label>
          <input type="text" id="edit_description" name="edit_description" required>
          <label for="status">
          <strong>Status</strong>
          </label>
          <select name="status" required>
            <option disabled selected value></option>
            <option value="U radu">U radu</option>
            <option value="Nije započeto">Nije započeto</option>
            <option value="Riješeno">Riješeno</option>
            <option value="Stornirano">Stornirano</option>
          </select>
          <br>
          <br>
          <input id="edit_id" type="hidden" name="edit_id">
          <button type="submit" name="update_task" class="btn">Spremi promjene</button>
          <button type="button" class="btn cancel" onclick="closeEditProjectForm()">Zatvori</button>
        </form>
      </div>
    </div>

<script src="popupForms.js"></script>
</body>