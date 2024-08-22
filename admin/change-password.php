<?php

include ("../inc/connect.php");
session_start();


if (isset($_SESSION['user_name'])) { ?>
	<?php


	if (count($_POST) > 0) {
		$sql = "SELECT * FROM Users WHERE user_name = :user_name";
		$statement = $conn->prepare($sql);
		$statement->bindParam(':user_name', $_SESSION["user_name"], PDO::PARAM_STR);
		$statement->execute();
		$row = $statement->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			$hashedPassword = $row["user_password"];

			$newPassword = md5($_POST["newPassword"]);
			$current_pass = md5($_POST["currentPassword"]);
			if ($current_pass == $hashedPassword) {
				$sql = "UPDATE Users SET user_password = :user_password WHERE user_name = :user_name";

				$statement = $conn->prepare($sql);
				$statement->bindParam(':user_password', $newPassword, PDO::PARAM_STR);
				$statement->bindParam(':user_name', $_SESSION["user_name"], PDO::PARAM_STR);
				$statement->execute();
				$message = "Password Changed";
			} else {
				$message = "Current Password is not correct";
			}
		}
	}

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
			<div class="row dashboard">
				<div class="login_form   layout_padding2">
					<h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>

				</div>
				<div class="user-menu">
					<a href="dashboard.php">Back To Dashboard</a>

					<a class="col-md-6" href="logout.php">Logout</a>
				</div>
			</div>
			<div class="row">
				<div class="phppot-container tile-container col-md-6 mx-auto">
					<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">

						<div class="validation-message text-center"><?php if (isset($message)) {
							echo $message;
						} ?></div>
						<h2 class="text-center">Change Password</h2>
						<div class="form-group">
							<label class="inline-block">Current Password</label>
							<span id="currentPassword" class="validation-message"></span> <input type="password"
								name="currentPassword" class="form-control">

						</div>
						<div>

							<div class="form-group">
								<label class="inline-block">New Password</label> <span id="newPassword"
									class="validation-message"></span><input type="password" name="newPassword"
									class="form-control">

							</div>
							<div class="form-group">
								<label class="inline-block">Confirm Password</label>
								<span id="confirmPassword" class="validation-message"></span><input type="password"
									name="confirmPassword" class="form-control">

							</div>
							<div class="form-group">
								<input type="submit" name="submit" value="Submit" class="form-control">
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
		<script>
			function validatePassword() {
				var currentPassword, newPassword, confirmPassword, output = true;

				currentPassword = document.frmChange.currentPassword;
				newPassword = document.frmChange.newPassword;
				confirmPassword = document.frmChange.confirmPassword;

				if (!currentPassword.value) {
					currentPassword.focus();
					document.getElementById("currentPassword").innerHTML = "required";
					output = false;
				}
				else if (!newPassword.value) {
					newPassword.focus();
					document.getElementById("newPassword").innerHTML = "required";
					output = false;
				}
				else if (!confirmPassword.value) {
					confirmPassword.focus();
					document.getElementById("confirmPassword").innerHTML = "required";
					output = false;
				}
				if (newPassword.value != confirmPassword.value) {
					newPassword.value = "";
					confirmPassword.value = "";
					newPassword.focus();
					document.getElementById("confirmPassword").innerHTML = "not same";
					output = false;
				}
				return output;
			}
		</script>





	</body>
	</head>

	</html>
<?php } else {
	header("location: index.php");

}
?>