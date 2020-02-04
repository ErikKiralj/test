<?php 
include('controlers\sessions\registrationController.php');
if (isset($_SESSION['username'])) {
	$_SESSION['msg'] = "Allready logged in";
	header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  	<title>Registracija</title>
  	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css\styles.css">
</head>
<body>
<div class="container login-container">
	<div class="row">
		<div class="col-lg-8 login-form-2">
			<h2 style="text-align:center; color: white">Registracija</h2>
		<form method="post" action="register.php">
			<div class="form-group">
				<input class="form-control" type="text" name="username" placeholder="Korisničko ime">
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="password_1" placeholder="Lozinka">
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="password_2" placeholder="Potvrda lozinke">
			</div>
			<div class="form-group">
				<button type="submit" class="btnSubmit" name="user_registration">Registracija</button>
			</div>
			<div class="form-group">
			<p style="text-align:center; color: white">
				Imate račun? <a style="color: black" href="login.php">Prijava</a>
			</p>
			</div>
			<br>
			<div>
			<?php include('errors.php'); ?>
			</div>
		</form>
		</div>
	</div>
</div>
</body>
</html>