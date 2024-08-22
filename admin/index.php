<?php

include ("../inc/connect.php");
session_start();

if (isset($_SESSION['logged'])) {
	header("location: dashboard.php");
} else {
	?>
	<html>

	<head>

		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

		<link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

		<link href="../css/style.css" rel="stylesheet" />

		<link href="../css/responsive.css" rel="stylesheet" />
	</head>


	<body>
		<div class="container">
			<div class="row">
				<div class="login_form col-md-6 mx-auto layout_padding ">
					<h2>Login Form</h2>
					<form action="login.php" method="post">
						<div class="form-group">
							<input type="text" name="uname" class="form-control" placeholder="User Name">
						</div>
						<div class="form-group">
							<input type="password" name="upassword" class="form-control">
						</div>

						<div class="form-group">
							<input type="submit" name="login" class="btn-primary">

						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
	</head>

	</html>
<?php } ?>
<style>

</style>