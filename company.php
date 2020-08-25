<?php session_start(); ?>
<?php include_once 'dbCon.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title><?php echo $siteName; ?> | Companies</title>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

	<!-- Bootstrap Core Css -->
	<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- Waves Effect Css -->
	<link href="plugins/node-waves/waves.css" rel="stylesheet" />

	<!-- Animation Css -->
	<link href="plugins/animate-css/animate.css" rel="stylesheet" />

	<!-- Custom Css -->
	<link href="css/style.css" rel="stylesheet">
	<script>
		function datasession(cid, cn, img) {
			$.ajax({
				type: 'POST',
				url: "ajax_retrieve.php",
				data: {
					c_ID: cid,
					com_name: cn,
					image: img
				},
				dataType: "json",
				success: function(response) {}

			});
			window.location.href = "season_details";
		}
	</script>
</head>

<body class="signup-page">
	<div class="signup-box">
		<div class="body" style="text-align:center">
			<h4>Welcome to <i><?php echo $siteName; ?></i></h4>
			<h5>Hello <i><?php echo $_SESSION['NAME']; ?></i></h5>
			<hr>
			<h3>Please Select Your Company.</h3>
			<hr>
			<div class="row">
				<?php
				include_once 'dbCon.php';
				$conn = connect();
				$sql = "select * from company";
				$resultdata = $conn->query($sql);
				foreach ($resultdata as $view) {
				?>
					<div class="row">
						<div class="info-box">
							<h5 onclick="datasession(<?= $view['com_id'] ?>,'<?= $view['company_name'] ?>','<?= $view['image'] ?>')" class="com_btn btn  btn-sm btn-info waves-effect" type="submit">
								<?= $view['company_name'] ?>
							</h5>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- Jquery Core Js -->
	<script src="plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core Js -->
	<script src="plugins/bootstrap/js/bootstrap.js"></script>
	<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

	<!-- Waves Effect Plugin Js -->
	<script src="plugins/node-waves/waves.js"></script>
	<script src="js/pages/forms/basic-form-elements.js"></script>

	<!-- Validation Plugin Js -->
	<script src="plugins/jquery-validation/jquery.validate.js"></script>

	<!-- Custom Js -->
	<script src="js/admin.js"></script>
	<script src="js/pages/examples/sign-up.js"></script>
</body>

</html>