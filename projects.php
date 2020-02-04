<?php 
  session_start(); 
  if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  }
  include_once("partials/navbar.php");
  include('controlers\projects\newProjectController.php');
  include('controlers\projects\updateProjectController.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Projekti</title>
  <link rel="stylesheet" type="text/css" href="css\styles.css">
  <link rel="stylesheet" type="text/css" href="css\popup-form.css">
  <link rel="stylesheet" type="text/css" href="css\popup-form-edit.css">
</head>
<body >
  <h1 class="welcome-msg">Stranica s projektima</h1>
    <div class="open-btn">
      <button class="open-button" onclick="newProjectForm()">
      <strong>Novi projekt</strong>
      </button>
    </div>

    <form  method="POST" action="projects.php">
				<div >
					<input type="text"  placeholder="Unesite ključnu riječ" name="keyword" required="required"/>
					<button class="btn-update" name="search_projects">Pretraži</button>
				</div>
		</form>

    <div id="loginPopup">
      <div class="form-popup" id="popupForm">
        <form method="post" action="projects.php" class="form-container">
          <h2>Novi projekt</h2>
          <br>
          <label for="name">
          <strong>Ime projekta</strong>
          </label>
          <input type="text" id="name" placeholder="Unesite ime projekta" name="name" required>
          <label for="description">
          <strong>Opis projekta</strong>
          </label>
          <input type="text" id="description" placeholder="Unesite opis Projekta" name="description" required>
          <label for="user_in_charge">
          <strong>Zadužena osoba</strong>
          </label>
          <?php 
            $db = mysqli_connect('localhost', 'root', '', 'test');
            $query2 = "SELECT username FROM users";
            $users = mysqli_query($db, $query2);
            echo '<select name="user_in_charge">';
            echo '<option disabled selected value></option>';
            while ($row = $users->fetch_assoc()) {
            echo '<option value="'.$row['username'].'">'.$row['username'].'</option>';
            }
            echo '</select>';
          ?>
          <br>
          <br>
          <button type="submit" name="new_project" class="btn">Spremi projekt</button>
          <button type="button" class="btn cancel" onclick="closenewProjectForm()">Zatvori</button>
        </form>
      </div>
    </div>

<?php 
include('controlers\projects\resultsController.php');
?>

<table>
 <tr>
   <th>Ime projekta</th>
   <th>Opis projekta</th>
   <th>Vrijeme stvaranja</th>
   <th>Vrijeme zadnjeg editiranja</th>
   <th>Stvaratelj</th>
   <th>Zadužena osoba</th>
   <th>Opcije</th>
</tr>

<?php
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    echo '<tr>
    <td>' . $row["name"]. '</td>
    <td>' . $row["description"] . '</td>
    <td>' . $row["created_at"]. '</td>
    <td>' . $row["edited_at"] . '</td>
    <td>' . $row["created_by"] . '</td>
    <td>' . $row["user_in_charge"] . '</td>';
    if($_SESSION['username']==$row["created_by"]){
    echo '<td>
    <div class="inline">
      <button id="'.$row['id'].'" class="btn-update" data-name="'.$row['name'].'" data-id="'.$row['id'].'" data-description="'.$row['description'].'" onclick="editProjectForm('.$row['id'].')">
      Uredi
      </button>
    </div>
    <div class="inline">
    <form method="post" action="controlers\projects\deleteProjectController.php?id='.$row['id'].'" n>
    <input type="hidden" name="id" value="'.$row['id'].'";?>
    <button type="submit" class="btn-delete"">Obriši</button>
    </form>
    </div>
    </td></tr>';
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
        <form method="post" action="projects.php" class="form-container">
          <h2>Uredi projekt</h2>
          <br>
          <label for="name">
          <strong>Ime projekta</strong>
          </label>
          <input type="text" id="edit_name" name="edit_name" required>
          <label for="description">
          <strong>Opis projekta</strong>
          </label>
          <input type="text" id="edit_description" name="edit_description" required>
          <label for="user_in_charge">
          <input id="edit_id" type="hidden" name="edit_id">
          <strong>Zadužena osoba</strong>
          </label>
          <?php 
            $db = mysqli_connect('localhost', 'root', '', 'test');
            $query2 = "SELECT username FROM users";
            $users = mysqli_query($db, $query2);
            echo '<select name="edit_user_in_charge">';
            echo '<option disabled selected value></option>';
            while ($row = $users->fetch_assoc()) {
            echo '<option value="'.$row['username'].'">'.$row['username'].'</option>';
            }
            echo '</select>';
          ?>
          <br>
          <br>
          <button type="submit" name="update_project" class="btn">Spremi promjene</button>
          <button type="button" class="btn cancel" onclick="closeEditProjectForm()">Zatvori</button>
        </form>
      </div>
    </div>

<script src="popupForms.js"></script>
</body>