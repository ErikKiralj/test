<?php 
  session_start(); 
  if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  }
  include_once('partials\navbar.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Glavna stranica</title>
  <link rel="stylesheet" type="text/css" href="css\styles.css">
</head>
<body >
  <h1 class="welcome-msg">Dobrodošli na glavnu stranicu <?php echo $_SESSION['username']; ?></h1>
</body>
</html>