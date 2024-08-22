<?php

include ("../inc/connect.php");

session_start();

if (isset($_SESSION['user_name'])) { ?>
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
			<div class="row dashboard">
				<div class="login_form   layout_padding2">
					<h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>

				</div>
				<div class="user-menu">
					<a class="col-md-6" href="change-password.php">Change Password</a>
					<a class="col-md-6" href="logout.php">Logout</a>
				</div>
			</div>

			<div class="row" style="gap:40px">
				<div class="add-pages">
					<a href="create-page.php">Add New Page</a>
				</div>
				<div class="">
					<a href="view-page.php">All Pages</a>
				</div>
				<div class="">
					<a href="contact-details.php">Contact Form Data</a>
				</div>
			</div>
		</div>


	</body>
	</head>

	</html>
<?php } else {
	header("location: index.php");

}
?>