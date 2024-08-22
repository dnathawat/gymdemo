<?php include ('inc/connect.php');

$pageid = '33';

?>
<?php

$errors = [];
$errorMessage = '';

if (!empty($_POST)) {
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	if (empty($name)) {
		$errors[] = 'Name is empty';
	}
	if (empty($phone)) {
		$errors[] = 'Phone is empty';
	}

	if (empty($email)) {
		$errors[] = 'Email is empty';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Email is invalid';
	}

	if (empty($message)) {
		$errors[] = 'Message is empty';
	}

	if (empty($errors)) {
		$toEmail = 'codechk@gmail.com';
		$emailSubject = 'New email from your contact form';
		$headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=utf-8'];
		$bodyParagraphs = ["<strong>Name:</strong> {$name}", "<br>", "<strong>Email:</strong> {$email}", "<br>", "<strong>Phone Number:</strong> {$phone}", "<br>", "<strong>Message:</strong>", $message];
		$body = join(PHP_EOL, $bodyParagraphs);

		if (mail($toEmail, $emailSubject, $body, $headers)) {

			$succes = "mail sent";
			$stmt = "INSERT into contactform (Name, Email, Phone, Message) VALUES ('$name', '$email', '$phone', '$message')";
			$conn->exec($stmt);
		} else {
			$errorMessage = 'Oops, something went wrong. Please try again later';
		}

	} else {

		$allErrors = join('<br/>', $errors);
		$errorMessage = "<p style='color: red;'>{$allErrors}</p>";
	}


	//$notice = "New record created successfully";

}


?>
<!DOCTYPE html>
<html>

<head>
	<!-- Basic -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!-- Site Metas -->
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />

	<title>Neogym</title>

	<!-- slider stylesheet -->
	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

	<!-- bootstrap core css -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

	<!-- fonts style -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet" />
	<!-- responsive style -->
	<link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
	<div class="hero_area">
		<!-- header section strats -->
		<?php include ('inc/header.php'); ?>
		<!-- end header section -->
		<!-- slider section -->


	</div>
	<!-- contact section -->

	<section class="contact_section ">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 px-0">
					<div class="img-box">
						<img src="images/contact-img.jpg" alt="">
					</div>
				</div>
				<div class="col-lg-5 col-md-6">
					<div class="form_container pr-0 pr-lg-5 mr-0 mr-lg-2">
						<div class="heading_container">
							<h2>
								Contact Us
							</h2>
						</div>
						<?php echo ((!empty($errorMessage)) ? $errorMessage : '') ?>
						<?php if (!empty($succes)) {
							echo $succes;
						} ?>
						<form method="post" id="contact-form">
							<div>
								<input type="text" placeholder="Name" name="name" />
								<span class="error-message" id="error-name"></span>
							</div>
							<div>
								<input type="email" placeholder="Email" name="email" />
								<span class="error-message" id="error-email"></span>
							</div>
							<div>
								<input type="text" placeholder="Phone Number" name="phone" />
								<span class="error-message" id="error-phone"></span>
							</div>
							<div>
								<input type="text" class="message-box" placeholder="Message" name="message" />
								<span class="error-message" id="error-message"></span>
							</div>
							<div class="d-flex ">
								<button type="submit">
									Send
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- end contact section -->

	<!-- info section -->
	<section class="info_section layout_padding2">
		<div class="container">
			<div class="info_items">
				<?php
				$sgmt = $conn->prepare("SELECT page_name, page_content  FROM page WHERE page_id = :page_id");
				$sgmt->bindParam(':page_id', $pageid);
				$sgmt->execute();
				$row = $sgmt->fetch(PDO::FETCH_ASSOC);

				if ($row) {
					echo "<h1>" . $row['page_name'] . "</h1>";
					// Process the retrieved row
					echo $row['page_content'];
				} else {
					echo 'No row found';
				}



				?>
			</div>
		</div>
	</section>

	<!-- end info_section -->

	<!-- footer section -->
	<?php include ('inc/footer.php'); ?>
	<!-- footer section -->

	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
	<script>
		const constraints = {
			name: {
				presence: { allowEmpty: false }
			},
			email: {
				presence: { allowEmpty: false },
				email: true
			},
			message: {
				presence: { allowEmpty: false }
			}
		};

		const form = document.getElementById('contact-form');

		form.addEventListener('submit', function (event) {
			const formValues = {
				name: form.elements.name.value,
				email: form.elements.email.value,
				message: form.elements.message.value
			};

			const errors = validate(formValues, constraints);

			if (errors) {
				event.preventDefault();
				const errorMessage = Object
					.values(errors)
					.map(function (fieldValues) { return fieldValues.join(', ') })
					.join("\n");

				alert(errorMessage);
			}
		}, false);
	</script>
</body>

</html>