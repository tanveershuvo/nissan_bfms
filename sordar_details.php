<?php include "template/miniheader.php";
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title><?php if (isset($_SESSION['com_name'])) {
				echo $_SESSION['com_name'];
			}; ?> | Sordar Details </title>
	<!-- Favicon-->
	<link rel="icon" href="favicon.ico" type="image/x-icon">
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
	<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
	<link href="css/themes/all-themes.css" rel="stylesheet" />
	<!-- Multi Select Css -->
	<link href="plugins/multi-select/css/multi-select.css" rel="stylesheet">

	<!-- Bootstrap Spinner Css -->
	<link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

	<!-- Bootstrap Tagsinput Css -->
	<link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

	<!-- Bootstrap Select Css -->
	<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>


	<?php include "template/mininavbar.php"; ?>
	<script>
		function dataRetrieval() {
			var tbody = document.getElementById("ajaxtable");
			var tableRow = "";
			$.ajax({
				type: 'POST',
				url: "ajax_retrieve.php",
				data: {
					"weekly_bill": 1
				},
				dataType: "json",
				success: function(response) {
					/*loop start*/
					for (var i = 0; i < response.length; i++) {
						tableRow += "<tr><td  style='text-align:center;' > " + response[i].date + "</td>" +
							"<td style='text-align:center;' > " + response[i].weekly_bill + " TK</td>" +
							"<td style='text-align:center;' > " + response[i].sea_name + "</td>" +
							"<td style='text-align:center;' > " + response[i].paid_by + "</td> " +
							"</tr>";
					}
					tbody.innerHTML = tableRow;
					weeklytotalretrieve();
					totalPaidRetrieve();
				}
			});
		}
		var totalweekly;

		function weeklytotalretrieve() {
			var div = document.getElementById("weeklytotal");
			var label = "";
			$.ajax({
				type: 'POST',
				url: "ajax_retrieve.php",
				data: {
					"weeklytotal": 1
				},
				dataType: "json",
				success: function(response) {
					totalweekly = response[0].total;
					totalBalance();
					if (response[0].total == null) {
						label = "<label>Total Weekly Bill : <b class='text-danger'>0 TK</b></label>";
						div.innerHTML = label;
					} else {
						label = "<label>Total Weekly Bill : <b class='text-danger'>" + response[0].total + "  TK</b></label>";
						div.innerHTML = label;
					}
				}
			});
		}
		var totalPaid;

		function totalPaidRetrieve() {
			var div = document.getElementById("balance");
			var label = "";
			$.ajax({
				type: 'POST',
				url: "ajax_retrieve.php",
				data: {
					"balance": 1
				},
				dataType: "json",
				success: function(response) {
					totalPaid = response[0].total;
					totalBalance();
					if (response[0].total == null) {
						label = "<label>Advance : <b class='text-danger'>0 TK</label>";
					} else {
						label = "<label>Advance : <b class='text-danger'>" + response[0].total + "  TK</label>";
					}
					div.innerHTML = label;
				}

			});
			totalDeliveryBill();
			weeklytotalretrieve();
		}
		window.onload = totalPaidRetrieve;

		var totalDelivery;

		function totalDeliveryBill() {

			var div = document.getElementById("delivery_bill");
			var label = "";

			$.ajax({
				type: 'POST',
				url: "ajax_retrieve.php",
				data: {
					"delivery": 1
				},
				dataType: "json",
				success: function(response) {

					totalDelivery = response[0].total;
					totalBalance();
					if (response[0].total > 0) {
						label = "<label><b>Total Delivery Payable Amount : <b class='text-danger'>" + response[0].total + "  TK</label>";
						div.innerHTML = label;
					} else {
						label = "<label><b>Total Delivery Payable Amount : <b class='text-danger'> 0 TK</label>";
						div.innerHTML = label;
					}
				}

			});

		}

		function totalBalance() {
			var div = document.getElementById("total_balance");
			var label = "";
			var a = parseInt(totalPaid);
			console.log(totalPaid)
			var e = parseInt(totalweekly);
			console.log(totalweekly)
			var b = totalDelivery;
			console.log(totalDelivery)

			var g = a + e;
			console.log(g)
			var c = g - b;
			console.log(c)
			let balance = parseInt(c);
			if (balance > 0) {
				label = "<label><b>Nit Total Balance : <b class='text-danger'>" + balance + "  TK</label>";
				div.innerHTML = label;

			} else if (balance < 0) {
				let result = Math.abs(balance);
				label = "<label><b>Nit Total Payable Balance : <b class='text-danger'>" + result + "  TK</label>";
				div.innerHTML = label;

			} else {
				label = "<label><b class='text-danger'>No Transaction Record</b></label>";
				div.innerHTML = label;
			}

		}

		function myPrint(p_id) {
			$.ajax({
				type: 'POST',
				url: "ajax_retrieve.php",
				data: {
					pID: p_id
				},
				dataType: "json",
				success: function(response) {}
			});
		}

		function editAlert() {
			swal({
				title: "Profile Edited Succesfully",
				type: "success",
				confirmButtonClass: "btn-primary",
				confirmButtonText: "OK",
				closeOnConfirm: true,
			}, function() {
				// Redirect the user
				window.location.href = "sordar_details";
			});
		}

		function weeklypay() {
			swal({
					title: "Input Weekly Payment!",
					text: "",
					type: "input",
					showCancelButton: true,
					closeOnConfirm: false,
					inputPlaceholder: "Input weekly bill in taka"
				},
				function(inputValue) {
					if (inputValue === false) return false;
					if (inputValue === "") {
						swal.showInputError("You need to input!");
						return false
					}
					if (isNaN(inputValue)) {
						swal.showInputError("Insert Numeric Value!");
						return false
					}
					if (inputValue < 0) {
						swal.showInputError("minus value not accepted!");
						return false
					}
					if (inputValue == 0) {
						swal.showInputError("Null Value not accepted!");
						return false
					}
					$.ajax({
						type: 'POST',
						data: {
							pay: inputValue
						},
						url: "ajax_insertion.php",
						success: function() {
							swal("Weekly bill Paid Successfully!", "Paid:" + inputValue + "tk", "success");
							dataRetrieval();
							event.target.id == "messages_with_icon_title";

						}

					})
				});
		}

		function success() {
			swal({
					title: "Bill created Successful!!",
					text: "Weekly Bill Added Successfully",
					type: "success",
					confirmButtonClass: "btn-primary",
					confirmButtonText: "OK!"
				},
				function() {
					window.location.href = "sordar_details";
				});
		}
	</script>
</head>


<?php
include_once 'dbCon.php';
$conn = connect();

$id = $_SESSION['sordar_id'];
$sql = "SELECT * FROM sordar_details WHERE sor_id = '$id'";
$results = $conn->query($sql);
$row = mysqli_fetch_assoc($results);
$cn = $row['sor_name'];
$cp = $row['sor_phone'];
$ca = $row['sor_address'];
$st = $row['sor_type'];
$sor_ID = $_SESSION['sordar_id'];
$sea_ID = $_SESSION['sea_id'];

if (isset($_POST['add'])) {
	$sID = $_SESSION['sordar_id'];
	function generateRandomString()
	{
		$characters = '1234567890123456789';
		$length = 8;
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	$payment = generateRandomString();
	$adv = $_POST['adv'];
	$date = $_POST['date'];
	$seaID = $_SESSION['sea_id'];

	$sql = "INSERT INTO `sordar_payment`(`sor_id`,`pay_id`, `advance`, `date`,`sea_id`)
			VALUES ('$sID','$payment','$adv','$date','$seaID')";

	if ($conn->query($sql)) {
		echo "<script>myPrint('" . $payment . "');</script>";
	} else {
		echo "<script>window.location.href = '500';</script>";
	}
}
?>
<section class="content">


	<div class="row clearfix well ">

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<h4>SORDAR :<b class="text-primary"><?= $cn ?></b></h4>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<h4>SORDAR TYPE: <b class="text-primary"><?= $st ?></b></h4>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<h4 id="total_balance" style="float:right"></b></h4>
		</div>

	</div>



	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="body">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">

						<?php
						include_once 'dbCon.php';
						$conn = connect();
						$id = $_SESSION['sordar_id'];
						$seaid = $_SESSION['sea_id'];
						$sql = "SELECT * FROM sordar_payment WHERE sor_id = '$id' AND sea_id='$seaid'";
						$result = $conn->query($sql);
						if ($result->num_rows == 0) {
						?>
							<li role="presentation" class="active">
								<a href="#home_with_icon_title" data-toggle="tab">
									<i class="material-icons">plus_one</i> ADVANCE
								</a>
							</li>

						<?php } else { ?>
							<li role="presentation" class="active">
								<a href="#m_with_icon_title" data-toggle="tab">
									<i class="material-icons">history</i>TOTAL DELIVERED
								</a>
							</li>

							<li role="presentation">
								<a onclick="(dataRetrieval()& weeklytotalretrieve())" href="#messages_with_icon_title" data-toggle="tab">
									<i class="material-icons">history</i> WEEKLY BILL
								</a>
							</li>


							<li role="presentation">
								<a href="#profile_with_icon_title" data-toggle="tab">
									<i class="material-icons">face</i> EDIT PROFILE
								</a>
							</li>

						<?php } ?>

					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<?php
						include_once 'dbCon.php';
						$conn = connect();
						$id = $_SESSION['sordar_id'];
						$seaid = $_SESSION['sea_id'];
						$sql = "SELECT * FROM sordar_payment WHERE sor_id = '$id' AND sea_id='$seaid'";
						$result = $conn->query($sql);
						if ($result->num_rows == 0) {
						?>
							<div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
								<form class="form-horizontal" method="POST">
									<div class="row clearfix">
										<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
											<label for="password_2">Advance :</label>
										</div>
										<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="adv" oninput="findTotal()" id="adv" class="form-control" placeholder="Enter advance payment">
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
											<label for="password_2">Date :</label>
										</div>
										<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
											<div class="form-group">
												<div class="form-line">
													<input type="date" name="date" id="date" class="form-control" value="<?php print(date("Y-m-d")); ?>" />
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-lg-offset-4 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">

											<button type="submit" onclick="return check_info();" name="add" class="col-lg-4 btn btn-primary waves-effect"> DONE </button>

										</div>
									</div>
								</form>

								<script>
									function findTotal() {


										if (isNaN(g = document.getElementById('adv').value)) {
											swal('Please enter only numbers', '', 'warning')
											document.getElementById('adv').value.value = '';
										}
									}

									function check_info() {
										var g = document.getElementById('adv').value;

										if (g == "") {
											swal('Please input advance payment', '', 'warning')
											return false;
										}
									}
								</script>


							</div>
						<?php } else { ?>
							<div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
								<?php
								include_once 'dbCon.php';
								$conn = connect();
								if (isset($_POST['edit'])) {
									$id = $_SESSION['sordar_id'];
									$ecn = $_POST['sname'];
									$ecm = $_POST['mob'];
									$eca = $_POST['addrs'];

									$sql = "UPDATE sordar_details SET `sor_name` = '$ecn' , `sor_phone` = '$ecm',`sor_address`='$eca' WHERE sor_id = '$id'";
									if ($conn->query($sql)) {
										echo '<script type="text/javascript"> editAlert(); </script>';
									} else {
										echo '<script type="text/javascript"> window.location.href = "500";</script>';
									}
								}



								$sID = $_SESSION['sea_id'];
								$sorID = $_SESSION['sordar_id'];
								$sql = "SELECT * FROM sordar_delivery_status as sd, season as s
								WHERE sd.sea_id=s.sea_id AND sd.sea_id = '$sID' AND sor_id = '$sorID' ORDER BY sd.delivery_date";

								$resultdata = $conn->query($sql);


								?>
								<form class="form-horizontal" method="POST">
									<div class="row clearfix">
										<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
											<label>Sordar Name :</label>
										</div>
										<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="sname" id="sname" class="form-control" value="<?php if (isset($cn)) {
																																echo $cn;
																															}; ?>">
												</div>
											</div>
										</div>
									</div></br>

									<div class="row clearfix">
										<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
											<label for="password_2">Mobile Number :</label>
										</div>
										<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="mob" id="mobile" class="form-control" value="<?php if (isset($cn)) {
																																echo $cp;
																															}; ?>">
												</div>
											</div>
										</div>
									</div> <br>

									<div class="row clearfix">
										<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
											<label for="password_2">Address :</label>
										</div>
										<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="addrs" id="address" class="form-control" value="<?php if (isset($cn)) {
																																	echo $ca;
																																}; ?>">
												</div>
											</div>
										</div>
									</div>

									<div class="row clearfix">
										<div class="col-lg-offset-4 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">

											<button type="submit" onclick=" return MyFn2()" name="edit" class="btn btn-primary m-t-30 waves-effect">EDIT DONE</button>

										</div>
									</div>
								</form>
							</div>
							<script>
								function MyFn2() {
									var name = document.getElementById('sname').value;
									var mobile = document.getElementById('mobile').value;
									var address = document.getElementById('address').value;
									if (name == "") {
										swal('Please input customer name', '', 'warning')
										return false;
									}
									if (mobile == "") {
										swal('Please input mobile number', '', 'warning')
										return false;
									}
									if (address == "") {
										swal('Please input address', '', 'warning')
										return false;
									}
									if (isNaN(mobile)) {
										swal('Mobile Number conatins only numbers!!', '', 'warning');
										document.getElementById('mobile').value = '';
										return false;
									}
									if (mobile.length != 11) {
										swal('Mobile Number Must be 11 digit!!', '', 'warning');
										return false;
									}
								}
							</script>
							<div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">


								<div class="row clearfix ">
									<div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
										<h4 id="weeklytotal"></h4>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
										<h4 id="balance"></h4>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
										<button onclick="(weeklypay() & totalPaidRetrieve() & totalDeliveryBill())" class="btn btn-primary waves-effect" style="float:right"><i class="material-icons">queue</i>WEEKLY BILL PAYMENT</button>
									</div>
								</div>
								<div class="table-responsive">

									<table id="table" class="table table-bordered table-striped table-hover ">
										<thead>
											<tr>
												<th style="text-align:center;">PAYMENT DATE</th>
												<th style="text-align:center;">WEEKLY BILL</th>
												<th style="text-align:center;">SEASON NAME </th>
												<th style="text-align:center;">PAID BY</th>
											</tr>
										</thead>

										<tbody id="ajaxtable">

										</tbody>
									</table>
								</div>

							</div>
							<div role="tabpanel" class="tab-pane fade in active" id="m_with_icon_title">
								<div class="row clearfix">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
										<h4 id="delivery_bill"></h4>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
										<button class="btn btn-primary waves-effect" style="float:right" data-toggle="modal" data-target="#largeModal"><i class="material-icons">add_to_queue</i> ADD NEW DELIVERY DETAILS </button>
									</div>
								</div>
								<div class="table-responsive">
									<table style="text-align:center" id="table" class="table table-bordered table-striped table-hover ">
										<thead>
											<tr>
												<th style="text-align:center">RECEIPT NO.</th>
												<th style="text-align:center">DELIVERY DATE</th>
												<th style="text-align:center">AMOUNT OF BRICKS</th>
												<th style="text-align:center">RATE</th>
												<th style="text-align:center">TOTAL BILL</th>
												<th style="text-align:center">SEASON</th>
												<th style="text-align:center">INSERTED BY</th>

											</tr>
										</thead>
										<tbody>
											<?php


											foreach ($resultdata as $view) {

											?>

												<tr>
													<td><?= $view['receipt_no'] ?></td>
													<td><?= $view['delivery_date'] ?></td>
													<td><?= $view['amount'] ?></td>
													<td><?= $view['rate'] ?> tk</td>
													<td><?= $view['total_bill'] ?> tk</td>
													<td><?= $view['sea_name'] ?></td>
													<td><?= $view['inserted_by'] ?></td>
												</tr>

											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- #END# Tabs With Icon Title -->
	</div>
</section>

<style>
	a.btn:hover {
		-webkit-transform: scale(1.1);
		-moz-transform: scale(1.1);
		-o-transform: scale(1.1);
	}

	a.btn {
		-webkit-transform: scale(0.8);
		-moz-transform: scale(0.8);
		-o-transform: scale(0.8);
		-webkit-transition-duration: 0.5s;
		-moz-transition-duration: 0.5s;
		-o-transition-duration: 0.5s;
	}
</style>

<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Jquery Validation Plugin Css -->
<script src="plugins/jquery-validation/jquery.validate.js"></script>

<!-- JQuery Steps Plugin Js -->
<script src="plugins/jquery-steps/jquery.steps.js"></script>

<!-- Sweet Alert Plugin Js -->
<script src="plugins/sweetalert/sweetalert.min.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="plugins/node-waves/waves.js"></script>


<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/pages/forms/form-wizard.js"></script>
<script src="js/pages/forms/advanced-form-elements.js"></script>
<!-- Demo Js -->
<script src="js/demo.js"></script>
<!-- Multi Select Plugin Js -->
<script src="plugins/multi-select/js/jquery.multi-select.js"></script>
<!-- Select Plugin Js -->
<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>


</body>
<script>
	function checkInfo() {

		var total = document.getElementById('total').value;
		if (document.getElementById('amount').value == "") {
			swal('Please input in all text fields', '', 'error')
			return false;
		}

		if (document.getElementById('total').value == "") {
			swal('Please input in all text fields', '', 'error')
			return false;
		}



	}

	function MYFN() {
		var amount = document.getElementById('amount').value;
		var rate = document.getElementById('rate').value;
		var total = document.getElementById('total').value;
		x = amount * rate;
		console.log(x)
		document.getElementById('total').value = x;
		if (isNaN(amount)) {
			swal('Please enter only numbers', '', 'error')
			document.getElementById('amount').value = '';
		}
		if (isNaN(rate)) {
			swal('Please enter only numbers', '', 'error')
			document.getElementById('rate').value = '';
		}
		if (isNaN(total)) {
			swal('Please enter only numbers', '', 'error')
			document.getElementById('total').value = '';
		}

	}
</script>
<?php
include_once 'dbCon.php';
$conn = connect();
if (isset($_POST['submit'])) {
	$amnt = $_POST['amount'];
	$rate = $_POST['rate'];
	$total = $_POST['total'];
	$sname = $_SESSION['NAME'];
	$seaID = $_SESSION['sea_id'];
	$date = $_POST['date'];
	$sor_id = $_SESSION['sordar_id'];
	function generateRandomString()
	{
		$characters = '1234567890';
		$length = 6;
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	$random = generateRandomString();
	$receipt = "WB$random";
	$sql = "INSERT INTO sordar_delivery_status(receipt_no,delivery_date,amount,rate,total_bill,inserted_by,sea_id,sor_id)
		VALUES ('$receipt','$date','$amnt','$rate','$total','$sname','$seaID','$sorID')";

	if ($conn->query($sql)) {
		echo "<Script>success()</Script>";
	}
} else {
	echo "<Script>myFN()</Script>";
}

?>

<div class="body">
	<!-- Large Size -->
	<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" align="center" id="largeModalLabel"><b>Insert Delivery Details Here</b> </h4>
					<hr>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="insert_form" onsubmit="return checkInfo()" method="POST">

						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
								<label for="password_2">AMOUNT OF BRICKS :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="amount" oninput="MYFN()" id="amount" class="form-control" placeholder="Enter Amount">
									</div>
								</div>
							</div>
						</div> <br>

						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
								<label for="password_2">RATE :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="rate" id="rate" oninput="MYFN()" class="form-control" placeholder="Enter RAte ">
									</div>
								</div>
							</div>
						</div> <br>

						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
								<label for="password_2">TOTAL BILL :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="total" oninput="MYFN()" id="total" class="form-control" placeholder="Enter bill ">
									</div>
								</div>
							</div>
						</div> <br>
						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
								<label for="password_2">Date :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="date" name="date" id="date" class="form-control" value="<?php print(date("Y-m-d")); ?>" />
									</div>
								</div>
							</div>
						</div><br>
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit" id="submit" class="btn btn-primary">SAVE </button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>




</html>