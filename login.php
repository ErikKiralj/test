<?php include('controlers\sessions\loginController.php'); 
if (isset($_SESSION['username'])) {
	header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  	<title>Prijava</title>
  	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css\styles.css">
</head>
<body>
<div class="container login-container">
	<div class="row">
		<div class="col-lg-8 login-form-2">
			<h2 style="text-align:center; color: white">Prijava</h2>
		<form method="post" action="login.php">
			<div class="form-group">
				<input class="form-control" type="text" name="username" placeholder="Korisničko ime">
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="password" placeholder="Lozinka">
			</div>
			<div class="form-group">
				<button type="submit" class="btnSubmit" name="user_login">Prijava</button>
			</div>
			<div class="form-group">
			<p style="text-align:center; color: white">
				Nemate račun? <a style="color: black" href="register.php">Registracija</a>
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