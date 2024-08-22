<?php include ('inc/connect.php');

$pageid = '31';

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


	<!-- end contact section -->



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