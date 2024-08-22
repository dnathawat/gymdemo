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
		<?php
		if (isset($_POST['submit'])) {

			$title = $_POST['page_title'];
			$menu_title = $_POST['page_menu_name'];
			$content = $_POST['page_content'];
			if (isset($_POST['check']) && $_POST['check'] === 'off') {
				$check = "1";
			} else {
				$check = "0";
			}

			try {
				$sql = "INSERT INTO page (page_name, page_content, page_status, page_menu_name)
  VALUES ('$title', '$content', '$check', '$menu_title')";
				// use exec() because no results are returned
				$conn->exec($sql);
				$notice = "New record created successfully";
			} catch (PDOException $e) {
				echo $sql . "<br>" . $e->getMessage();
			}
		}


		?>

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
				<div class="pages col-md-6 mx-auto">
					<div class="listing  layout_padding2">
						<div class="name">
							<h2>Add New Page</h2>
							<?php if (isset($notice)) {
								echo $notice;
							} ?>

							<form method="POST">
								<div class="form-group">
									<input type="text" name="page_title" placeholder="Page Heading" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" name="page_menu_name" placeholder="Page Menu Title"
										class="form-control">
								</div>
								<div class="form-group">
									<textarea id="full-featured-non-premium" name="page_content"
										placeholder="Add page content Here" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<input type="checkbox" name="check" value="off">
									<label>Disable</label>
								</div>
								<div class="form-group">
									<input type="submit" value="Add Page" name="submit" class="form-control">

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>


		<script src="js/jquery-3.4.1.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script type="text/javascript" src="../js/tinymce.min.js"></script>
		<script>
			tinymce.init({
				selector: 'textarea#full-featured-non-premium',


			});
		</script>
	</body>

	</html>
<?php } else {
	header("location: index.php");
}