<?php include ("../inc/connect.php");
session_start();
if (isset($_SESSION['logged'])) {
	?>
	<!DOCTYPE html>
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

		<div class="pages">
			<div class="listing  layout_padding2">
				<div class="container">
					<div class="row dashboard">
						<div class="login_form   layout_padding2">
							<h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>

						</div>
						<div class="user-menu">
							<a href="dashboard.php">Back To Dashboard</a>
							<a class="col-md-6" href="change-password.php">Change Password</a>
							<a class="col-md-6" href="logout.php">Logout</a>
						</div>
					</div>
					<div class="row">


						<table class="table">
							<thead class="thead-light">
								<tr>
									<th scope="col">Id</th>
									<th scope="col">Heading</th>
									<th scope="col">Menu Name</th>
									<th scope="col">Status</th>
									<th scope="col">Modify</th>
									<th scope="col">Remove</th>
								</tr>
							</thead>
							<tbody>
								<?php


								$stmt = $conn->prepare("SELECT page_id, page_name, page_status, page_menu_name FROM page");
								$stmt->execute();
								$pages = $stmt->fetchAll();
								foreach ($pages as $pa) {
									?>
									<tr>
										<th scope="row"><?php echo $pa["page_id"] ?></th>
										<td><?php echo $pa["page_name"] ?></td>
										<td><?php echo $pa["page_menu_name"] ?></td>
										<td><?php if ($pa['page_status'] == 1) {
											echo "Active";
										} else {
											echo "Disable";
										} ?></td>
										<td><a href="edit-page.php?page=<?php echo $pa["page_id"] ?>">Edit</a></td>
										<td><a href="delete-page.php?page=<?php echo $pa["page_id"] ?>">Delete</a></td>
									</tr>
								<?php } ?>

							</tbody>
						</table>

					</div>

				</div>



				<script src="../js/jquery-3.4.1.min.js"></script>
				<script src="../js/bootstrap.js"></script>

	</body>

	</html>
<?php } else {
	header("location: index.php");
}