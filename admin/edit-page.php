<?php include ("../inc/connect.php");
session_start();
if (isset($_SESSION['logged'])) {


	ob_start();
	$pageid = $_GET['page'];

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
			$content = $_POST['page_content'];
			$menu_title = $_POST['page_menu_name'];

			if (isset($_POST['check']) && $_POST['check'] === 'Disable') {
				$check = "1";
			} else {
				$check = "0";
			}

			try {
				$sql = "UPDATE page SET page_name = '$title', page_content = '$content', page_status = '$check', page_menu_name = '$menu_title' Where page_id = $pageid";
				// use exec() because no results are returned
				$conn->exec($sql);
				$notice = "Page Updated";

			} catch (PDOException $e) {
				echo $sql . "<br>" . $e->getMessage();
			}
		}


		?>
		<div class="pages">
			<div class="listing">
				<div class="container">
					<div class="row dashboard">
						<div class="login_form   layout_padding2">
							<h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>

						</div>
						<div class="user-menu">
							<a href="dashboard.php">Back To Dashboard</a>
							<a class="col-md-6" href="view-page.php">All Pages</a>
							<a class="col-md-6" href="change-password.php">Change Password</a>
							<a class="col-md-6" href="logout.php">Logout</a>
						</div>
					</div>
					<?php if (isset($notice)) {
						echo $notice;
					} ?>
					<div class="row">
						<?php


						$stmt = $conn->prepare("SELECT * FROM page Where page_id = $pageid");
						$stmt->execute();
						$pages = $stmt->fetchAll();

						?>


						<?php
						foreach ($pages as $pa) { ?>

							<form method="POST">
								<div class="form-group"> <input type="text" class="form-control" name="page_title"
										value="<?php echo $pa["page_name"] ?>"></div>
								<div class="form-group"> <textarea id="full-featured-non-premium" class="form-control"
										name="page_content" <?php echo $pa["page_id"] ?>
										placeholder="Add page content Here"><?php echo $pa["page_content"] ?></textarea></div>
								<div class="form-group"> <input type="text" class="form-control" name="page_menu_name"
										value="<?php echo $pa["page_menu_name"] ?>"></div>
								<div class="form-group"><input type="checkbox" name="check" value="<?php if ($pa['page_status'] == 1) {
									echo "Active";
								} else {
									echo "Disable";
								} ?>" <?php if ($pa['page_status'] == 1) {
										echo "Checked";
									} ?>>
									<label>Active Page</label>
								</div>
								<input type="submit" value="Update" name="submit">
							</form>





						<?php } ?>



					</div>

				</div>


				<script src="../js/jquery-3.4.1.min.js"></script>
				<script src="../js/bootstrap.js"></script>
				<script type="text/javascript" src="../js/tinymce.min.js"></script>
				<script>
					tinymce.init({
						selector: 'textarea#full-featured-non-premium',


					});
				</script>
	</body>

	</html>
<?php
} else {
	header("location: index.php");
}