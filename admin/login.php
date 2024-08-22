<?php
session_start();

include ("../inc/connect.php");

function users($data)
{

	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (isset($_POST['login'])) {

	$uname = users($_POST["uname"]);
	$upassword = users($_POST["upassword"]);

	$password = md5($upassword);

	$stmt = $conn->prepare("SELECT * FROM Users");
	$stmt->execute();
	$users = $stmt->fetchAll();

	foreach ($users as $user) {

		if (
			($user['user_name'] == $uname) &&
			($user['user_password'] == $password)
		) {
			$_SESSION['logged'] = true;
			$_SESSION['user_name'] = $uname;

			header("location: dashboard.php");
		} else {
			$_SESSION['user_name'] = $uname;
			echo "<script>alert('Invalid username or password')</script>";
			echo "<script>window.location='index.php'</script>";
		}
	}
}
