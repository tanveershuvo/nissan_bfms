<?php session_start(); ?>
<?php include_once 'dbCon.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title><?php echo $siteName; ?></title>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<!-- Bootstrap Core Css -->
	<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	<!-- Waves Effect Css -->
	<link href="plugins/node-waves/waves.css" rel="stylesheet" />
	<!-- Animation Css -->
	<link href="plugins/animate-css/animate.css" rel="stylesheet" />
	<link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
	<!-- Sweet Alert Css -->
	<!-- Custom Css -->
	<link href="css/style.css" rel="stylesheet">
	<style media="screen">
		.card {
			background: #272643;
			min-height: 30px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
			position: relative;
			margin-bottom: 30px;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			-ms-border-radius: 2px;
			border-radius: 2px;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<?php
	include_once 'dbCon.php';
	$conn = connect();
	$comID = $_SESSION['com_id'];
	$sql = "SELECT MAX(sea_end_time) as mx from season WHERE com_id = $comID";

	$result = $conn->query($sql);
	foreach ($result as $row) {
		$mx = $row['mx'];
	}
	?>
	<script>
		$(function() {
			var dateFormat = "mm/dd/yy",
				from = $("#from")
				.datepicker({
					defaultDate: "+2d",
					changeMonth: true,
					numberOfMonths: 1,
					minDate: new Date("<?= $mx ?>"),
				})
				.on("change", function() {
					to.datepicker("option", "minDate", getDate(this));
				}),
				to = $("#to").datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					numberOfMonths: 1,
				})
				.on("change", function() {
					from.datepicker("option", "maxDate", getDate(this));
				});

			function getDate(element) {
				var date;
				try {
					date = $.datepicker.parseDate(dateFormat, element.value);
				} catch (error) {
					date = null;
				}

				return date;
			}
		});
	</script>

</head>
<!-- Large Size -->
<?php
include_once 'dbCon.php';
$conn = connect();
if (isset($_POST['add'])) {
	$name = $_POST['name'];
	$start = $_POST['from'];
	$end = $_POST['to'];
	$budget = $_POST['budget'];
	$sql = "SELECT MAX(sea_end_time) as mx from season WHERE com_id = $comID";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		foreach ($result as $row) {
			$mx = $row['mx'];
			$dateTimestamp1 = strtotime($mx);
			$dateTimestamp2 = strtotime($start);
			if ($dateTimestamp1 < $dateTimestamp2) {
				$sql = "INSERT INTO season (sea_name,com_id,sea_start_time,sea_end_time,sea_budget) VALUES ('$name','$comID','$start','$end','$budget')";
				$conn->query($sql);
				echo '<script>window.location.href = "season_details"</script>';
			} else {
				echo '<script>alert("Current season ends at ' . "$mx" . ' . Select following date to create new season");</script>';
			}
		}
	}
}
if (isset($_GET['id'])) {

	$id = $_GET['id'];
	$sql = "Select * from season where sea_id='$id'";
	$result = $conn->query($sql);
	foreach ($result as $row) {
		$name = $row['sea_name'];
		$start = $row['sea_start_time'];
		$end = $row['sea_end_time'];
		$budget = $row['sea_budget'];
	}
}

if (isset($_POST['edit'])) {
	$sid = $_GET['id'];
	$name = $_POST['name'];
	$start = $_POST['from'];
	$end = $_POST['to'];
	$budget = $_POST['budget'];
	$comID = $_SESSION['com_id'];
	$sql = "Update season SET sea_name='$name',com_id='$comID',sea_start_time='$start',sea_end_time='$end',sea_budget='$budget' Where sea_id='$sid' ";
	//echo $sql;exit;
	$conn->query($sql);
	echo '<script>window.location.href = "season_details"</script>';
}
?>

<body class="login-page">
	<div class="msg">
		<h4>
			<?php if (!isset($_GET['id'])) { ?>
				Add / Save
			<?php } else { ?>
				Edit / Update
			<?php } ?>
			Season Details
		</H4>

	</div>
	<hr>
	<div class="login-box">
		<div class="card">
			<div class="body">

				<form method="POST">
					<div class="row clearfix">

						<div class="col-lg-6 col-md-4 col-sm-8 col-xs-8 ">
							<label for="password_2">Name:</label>
						</div>
						<div class="col-lg-6 col-md-8 ">
							<div class="form-group">
								<div class="form-line">
									<input type="text" name="name" id="name" class="form-control" value="<?php if (isset($name)) {
																												echo $name;
																											} ?>" placeholder="Enter Season Name">
								</div>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-lg-6 col-md-4 col-sm-8 col-xs-8 ">
							<label for="password_2">Duration Time:</label>
						</div>
						<div class="col-lg-3 col-md-10 col-sm-8 col-xs-7">
							<div class="form-group">
								<div class="form-line">
									<input type="text" name="from" id="from" value="<?php if (isset($start)) {
																						echo $start;
																					} ?>" class="form-control" placeholder="From">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-10 col-sm-8 col-xs-7">
							<div class="form-group">
								<div class="form-line">
									<input type="text" name="to" id="to" value="<?php if (isset($end)) {
																					echo $end;
																				} ?>" class="form-control" placeholder="To">
								</div>
							</div>
						</div>
					</div>

					<div class="row clearfix">
						<div class="col-lg-6 col-md-4 col-sm-8 col-xs-8 ">
							<label for="password_2">Total Budget :</label>
						</div>
						<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
							<div class="form-group">
								<div class="form-line">
									<input type="text" name="budget" id="pro_name" class="form-control" value="<?php if (isset($budget)) {
																													echo $budget;
																												} ?>" placeholder="Enter Season Budget">
								</div>
							</div>
						</div>
					</div>

					<?php if (!isset($_GET['id'])) { ?>
						<button class="btn btn-block btn-lg  waves-effect" type="submit" name="add"><span class="material-icons">save</span></button>
					<?php } else { ?>
						<button class="btn btn-block btn-lg waves-effect" type="submit" name="edit"><span class="material-icons">done_outline</span> </button>
					<?php } ?>
				</form>
			</div>
		</div>
	</div>

	<script src="plugins/sweetalert/sweetalert.min.js"></script>
	<!-- Bootstrap Core Js -->
	<script src="plugins/bootstrap/js/bootstrap.js"></script>
	<!-- Waves Effect Plugin Js -->
	<script src="plugins/node-waves/waves.js"></script>
	<!-- Validation Plugin Js -->
	<script src="plugins/jquery-validation/jquery.validate.js"></script>
	<!-- Custom Js -->
	<script src="js/admin.js"></script>
	<script src="js/pages/examples/sign-in.js"></script>
</body>

</html>