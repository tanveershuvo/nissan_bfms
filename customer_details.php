<?php include "template/miniheader.php";
unset($_SESSION['nav']);
$_SESSION['nav'] = 3;
?>
<?php include "signin_checker.php"; ?>


<title><?php if (isset($_SESSION['com_name'])) {
			echo $_SESSION['com_name'];
		}; ?> | Customer Details </title>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap Select Css -->
<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script>
	function dataRetrieval() {
		var tbody = document.getElementById("ajaxtable");
		var tableRow = "";

		$.ajax({
			type: 'POST',
			url: "ajax_retrieve.php",
			data: {
				"total": 1
			},
			dataType: "json",
			success: function(response) {
				/*loop start*/

				for (var i = 0; i < response.length; i++) {
					var a = "";
					if ((response[i].total_price - response[i].paid) == 0) {
						a += "<b class='text-success'> Due Cleared";
					} else {
						a += "<a onclick='due(" + response[i].order_id + "," + response[i].cus_id + "," + response[i].paid + "," + response[i].total_price + ")' class='btn btn-primary a-btn-slide-text'>" +
							"<span class='glyphicon glyphicon-plus'></span><span><strong>Payment</strong></span></a>";
					}
					var b = "";

					if ((response[i].total_price - response[i].paid) == 0) {

					} else {
						b += (response[i].total_price - response[i].paid) + " TK";
					}
					tableRow += "<tr><td>" + response[i].order_id + "</td>" +
						"<td>" + response[i].order_date + "</td>" +
						"<td>" + response[i].pro_name + "</td>" +
						"<td>" + response[i].quantity + "</td>" +
						"<td><b>" + response[i].sea_name + "</b></td>" +
						"<td class='text-Primary'  style='text-align:center;' > <b>" + response[i].total_price + " TK</td>" +
						"<td style='text-align:center;' > <b>" + response[i].paid + " TK</td> " +
						"<td class='text-danger'  style='text-align:center;' > <b>" + b + "</td>" +
						"<td>" + a + "</td>" +
						"<td><a onclick='myPrint(" + response[i].order_id + ")' class='btn btn-danger a-btn-slide-text'>" +
						"<span class='glyphicon glyphicon-print'></span><span></span></a></td>" +
						"</tr>";
					/*loop end*/
					customerDetailsRetrieve();
				}
				tbody.innerHTML = tableRow;
			}

		});
	}

	function myPrint(o_id) {

		$.ajax({
			type: 'POST',
			url: "ajax_retrieve.php",
			data: {
				oID: o_id
			},
			dataType: "json",
			success: function(response) {}

		});
		window.open("customer_reciept");


	}


	function availability() {
		var div = document.getElementById("avl");
		var label = "";
		var available = document.getElementById('mySelect').value;
		$.ajax({
			type: 'POST',
			url: "ajax_retrieve.php",
			data: {
				av: available
			},
			dataType: "json",
			success: function(response) {

				label = "<input type='hidden' id='pro_id' name='pro_id' value='" + response[0].pro_id + "'>";
				div.innerHTML = label;
				document.getElementById('unip').value = response[0].unit_price;
				if (response[0].available > 0) {
					document.getElementById('av').value = response[0].available;
					document.getElementById('qnty').disabled = false;
					document.getElementById('tprc').disabled = false;
					document.getElementById('pay').disabled = false;
				} else {
					document.getElementById('av').value = 'product not available';
					document.getElementById('qnty').disabled = true;
					document.getElementById('tprc').disabled = true;
					document.getElementById('pay').disabled = true;
				}
			}
		});
	}

	function customerDetailsRetrieve() {

		var div = document.getElementById("customerDetails");
		var label = "";

		$.ajax({
			type: 'POST',
			url: "ajax_retrieve.php",
			data: {
				"display": 1
			},
			dataType: "json",
			success: function(response) {

				label = "<label><b>TOTAL DUE : <b class='text-danger'>" + response[0].Total_Due + "  TK</label>";
				div.innerHTML = label;
			}

		});

	}
	window.onload = customerDetailsRetrieve;

	function editAlert() {
		swal({
			title: "Profile Edited Succesfully",
			type: "success",
			confirmButtonClass: "btn-primary",
			confirmButtonText: "OK",
			closeOnConfirm: true,
		}, function() {
			// Redirect the user
			window.location.href = "customer_details";
		});
	}

	function due(order_id, cus_id, paid, total_price) {
		swal({
				title: "Input Due Payment!",
				text: "",
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				inputPlaceholder: "Input something"
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
					swal.showInputError("0 or minus value not accepted!");
					return false
				}

				var due = parseInt(inputValue);
				var t = parseInt(total_price);
				var p = parseInt(paid);
				var pt = (due + paid);

				if (pt > total_price) {
					swal.showInputError("Input amount is greater than due amount");
					return false
				}

				$.ajax({

					type: 'POST',
					data: {
						due: inputValue,
						oid: order_id,
						pid: paid
					},
					url: "ajax_insertion.php",
					success: function() {

						swal("Due Paid Successfully!", "Paid: " + due + " tk", "success");
						dataRetrieval();
						event.target.id == "messages_with_icon_title";

					}

				})
			});
	}
	jQuery(function($) {
		$("#excel").click(function() {

			// parse the HTML table element having an id=exportTable
			var dataSource = shield.DataSource.create({
				data: "#exportTable",
				schema: {
					type: "table",
					fields: {
						RECEIPT_NO: {
							type: String
						},
						ORDER_DATE: {
							type: String
						},
						PRODUCT_NAME: {
							type: String
						},
						QUANTITY: {
							type: String
						},
						SEASON_NAME: {
							type: String
						},
						TOTAL_PRICE: {
							type: String
						},
						AMOUNT_PAID: {
							type: String
						},
						DUE: {
							type: String
						},
					}
				}
			});

			// when parsing is done, export the data to Excel
			dataSource.read().then(function(data) {
				new shield.exp.OOXMLWorkbook({
					author: "PrepBootstrap",
					worksheets: [{
						name: "PrepBootstrap Table",
						rows: [{
							cells: [{
									style: {
										bold: true
									},
									type: String,
									value: "RECEIPT_NO"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "ORDER_DATE"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "PRODUCT_NAME"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "SEASON_NAME"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "QUANTITY"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "TOTAL_PRICE"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "AMOUNT_PAID"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "DUE"
								}



							]
						}].concat($.map(data, function(item) {
							return {
								cells: [{
										type: String,
										value: item.RECEIPT_NO
									},
									{
										type: String,
										value: item.ORDER_DATE
									},
									{
										type: String,
										value: item.PRODUCT_NAME
									},
									{
										type: String,
										value: item.SEASON_NAME
									},
									{
										type: String,
										value: item.QUANTITY
									},
									{
										type: String,
										value: item.TOTAL_PRICE
									},
									{
										type: String,
										value: item.AMOUNT_PAID
									},
									{
										type: String,
										value: item.DUE
									},
								]
							};
						}))
					}]
				}).saveAs({
					fileName: "Customer_payment"
				});
			});
		});
	});

	jQuery(function($) {
		$("#pdf").click(function() {

			d = Date.now();
			d = new Date(d);
			d = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
			// parse the HTML table element having an id=exportTable
			var dataSource = shield.DataSource.create({
				data: "#exportTable",
				schema: {
					type: "table",
					fields: {
						RECEIPT_NO: {
							type: String
						},
						ORDER_DATE: {
							type: String
						},
						PRODUCT_NAME: {
							type: String
						},
						SEASON_NAME: {
							type: String
						},
						QUANTITY: {
							type: String
						},
						TOTAL_PRICE: {
							type: String
						},
						AMOUNT_PAID: {
							type: String
						},
						DUE: {
							type: String
						},
					}
				}
			});

			// when parsing is done, export the data to PDF
			dataSource.read().then(function(data) {
				var pdf = new shield.exp.PDFDocument({
					author: "PrepBootstrap",
					created: new Date()
				});

				pdf.addPage("a4", "portrait");

				pdf.table(
					50,
					50,
					data,
					[

						{
							field: "RECEIPT_NO",
							title: "Receipt",
							width: 50
						},
						{
							field: "ORDER_DATE",
							title: "Order date",
							width: 70
						},
						{
							field: "PRODUCT_NAME",
							title: "Prduct",
							width: 50
						},
						{
							field: "QUANTITY",
							title: "Qty",
							width: 50
						},
						{
							field: "SEASON_NAME",
							title: "Season",
							width: 50
						},
						{
							field: "TOTAL_PRICE",
							title: "Price",
							width: 70
						},
						{
							field: "AMOUNT_PAID",
							title: "Paid",
							width: 70
						},
						{
							field: "DUE",
							title: "Due",
							width: 50
						}
					], {
						margins: {
							top: 50,
							left: 50
						}
					}
				);
				pdf.saveAs({
					fileName: d + '_' + 'customer_details'
				});
			});
		});
	});
</script>

</head>

<?php include "template/mininavbar.php" ?>

<?php
include_once 'dbCon.php';
$conn = connect();
$id = $_SESSION['cusID'];
$sql = "SELECT * , (SUM(total_price)-SUM(paid)) as 'Total_Due'
	FROM order_details as o , customer_details as c
	WHERE o.cus_id=c.cus_id AND o.cus_id = '$id'";
$results = $conn->query($sql);
$row = mysqli_fetch_assoc($results);
$_SESSION['customer_id'] = $row['cus_id'];
$cn = $row['cus_name'];
$cp = $row['cus_phone'];
$ca = $row['cus_address'];
$td = $row['Total_Due'];

if (isset($_POST['add'])) {
	$cID = $_SESSION['cusID'];
	$proID  = $_POST['pro_id'];
	$order =	$_POST['order'];
	$pro_id = $_POST['product'];
	$uPrice = $_POST['u_price'];
	$qnt = $_POST['qnt'];
	$tPrice = $_POST['tPrice'];
	$pay = $_POST['pay'];
	$date = date('d/m/Y');
	$sID = $_SESSION['sea_id'];
	$insertBy = $_SESSION['NAME'];
	$sql = "INSERT INTO `order_details`(`order_id`,`cus_id`, `pro_id`, `unit_price`, `quantity`, `total_price`, `paid`, `order_date`,`sea_id`,`inserted_by`)
			VALUES ('$order','$cID','$pro_id','$uPrice','$qnt','$tPrice','$pay','$date','$sID','$insertBy')";


	if ($conn->query($sql)) {

		$query = "select * from product_details where pro_id='$proID'";
		$results = $conn->query($query);
		$row = mysqli_fetch_assoc($results);
		$aval = $row['available'];

		$x = ($aval - $qnt);
		$sql = "update product_details SET available='$x' WHERE pro_id='$proID'";
		$conn->query($sql);
		header("Refresh:0");
		echo "<script>myPrint('" . $order . "');</script>";
	}
}
?>

<section class="content">
	<div class="container-fluid">
		<div class="header well">
			<div class="row clearfix">
				<div class="col-lg-6">
					<h4 align="left" class="">
						Customer Name : <b class="text-primary"><?= $cn ?></b>
					</h4>
				</div>
				<div class="col-lg-6">
					<h4 align="right" id="customerDetails">
					</h4>
				</div>
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
							$id = $_SESSION['com_id'];
							$Sid = $_SESSION['sea_id'];
							$sql = "SELECT * FROM season where com_id='$id' AND sea_id='$Sid'";
							$resultData = $conn->query($sql);
							foreach ($resultData as $row) {
								$day = date('m/d/Y');
								$seaDay = $row['sea_end_time'];
								if ($day < $seaDay) { ?>
									<li role="presentation" class="active">
										<a href="#home_with_icon_title" data-toggle="tab">
											<i class="material-icons">plus_one</i> NEW ORDER
										</a>
									</li>
							<?php }
							} ?>
							<li role="presentation">
								<a onclick="(dataRetrieval()& customerDetailsRetrieve())" href="#messages_with_icon_title" data-toggle="tab">
									<i class="material-icons">history</i> History
								</a>
							</li>

							<li role="presentation">
								<a href="#profile_with_icon_title" data-toggle="tab">
									<i class="material-icons">face</i> EDIT PROFILE
								</a>
							</li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<?php

							include_once 'dbCon.php';
							$conn = connect();
							$id = $_SESSION['com_id'];
							$Sid = $_SESSION['sea_id'];
							$sql = "SELECT * FROM season where com_id='$id' AND sea_id='$Sid'";
							$resultData = $conn->query($sql);
							foreach ($resultData as $row) {
								$day = date('m/d/Y');
								$seaDay = $row['sea_end_time'];
								if ($day < $seaDay) { ?>
									<div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
										<!--PHP chilo-->

										<form class="form-horizontal" method="POST">
											<div id="avl">

											</div>
											<div class="row clearfix">
												<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
													<label for="password_2">Order/চালান no. :</label>
												</div>
												<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
													<div class="form-group">
														<div class="form-line">
															<input type="text" name="order" id="order" class="form-control" placeholder="Enter চালান number">
														</div>
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
													<label for="password_2">Product Name :</label>
												</div>
												<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">

													<select class=" show-tick" id="mySelect" name="product" onchange="availability()">
														<option>SELECT FROM HERE</option>
														<?php
														include_once 'dbCon.php';
														$conn = connect();
														$comID = $_SESSION['com_id'];
														$sql = "SELECT * FROM product_details where com_id='$comID'";
														$resultData = $conn->query($sql);
														foreach ($resultData as $row) {
														?>
															<option value="<?= $row['pro_id'] ?>"><?= $row['pro_name'] ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="row clearfix">
												<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
													<label for="password_2">Unit Price :</label>
												</div>
												<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
													<div class="form-group">
														<div class="form-line">
															<input type="text" name="u_price" id="unip" oninput="findTotal()" class="form-control" placeholder="Enter unit price" />
														</div>
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
													<label style="color:red"> Available Product :</label>
												</div>
												<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
													<div class="form-group">
														<div class="form-line">
															<input type="text" style="color:red; font-weight:bold;" name="av" id="av" oninput="findTotal()" class="form-control" disabled>
														</div>
													</div>
												</div>
											</div>

											<div class="row clearfix">
												<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
													<label for="password_2">Quantity :</label>
												</div>
												<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
													<div class="form-group">
														<div class="form-line">
															<input type="text" name="qnt" id="qnty" oninput="findTotal()" class="form-control" placeholder="Enter Quantity">
														</div>
													</div>
												</div>
											</div>


											<div class="row clearfix">
												<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
													<label for="password_2">Total Price:</label>
												</div>
												<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
													<div class="form-group">
														<div class="form-line">
															<input type="text" name="tPrice" id="tprc" class="form-control">
														</div>
													</div>
												</div>
											</div>

											<div class="row clearfix">
												<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
													<label for="password_2">Paid:</label>
												</div>
												<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
													<div class="form-group">
														<div class="form-line">
															<input type="text" name="pay" id="pay" oninput="findTotal()" class="form-control" placeholder="Enter payment">
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
												var w = document.getElementById('unip').value;
												var h = document.getElementById('qnty').value;
												var g = document.getElementById('pay').value;
												var s = document.getElementById('mySelect').value;

												total = w * h;
												document.getElementById('tprc').value = total;

												if (isNaN(total)) {
													swal('Please enter only numbers', '', 'warning')
													return false;
												}
												if (isNaN(w)) {
													swal('Please enter only numbers', '', 'warning')
													document.getElementById('unp').value = '';
													return false;
												}
												if (isNaN(h)) {
													swal('Please enter only numbers', '', 'warning')
													document.getElementById('qnt').value = '';
												}
												if (isNaN(g)) {
													swal('Please enter only numbers', '', 'warning')
													document.getElementById('pay').value = '';
												}

											}

											function check_info() {
												var un = parseFloat(document.getElementById('unip').value);
												var qn = parseFloat(document.getElementById('qnty').value);
												var sl = document.getElementById('mySelect').value;

												var av = document.getElementById('av').value;
												var pd = 0;
												if (document.getElementById('order').value == "") {
													swal('Please input in all text fields', '', 'warning')
													return false;
												} else if (av == "product not available") {

													swal('Selected product is not available', '', 'error')
													return false;
												} else {
													if (qn > av) {
														swal('Quantity is more than available product', 'try again after stock is available ', 'error')
														document.getElementById('qnty').value = '';
														document.getElementById('pay').value = '';
														document.getElementById('tprc').value = '';
														return false;
													}
												}

												if (sl == "SELECT FROM HERE") {
													swal('Please select product name', '', 'warning')
													return false;
												} else if (document.getElementById('unip').value == "") {
													swal('Please input in all text fields', '', 'warning')
													return false;
												} else if (document.getElementById('qnty').value == "") {
													swal('Please input in all text fields', '', 'warning')
													return false;
												} else if (document.getElementById('qnty').value == "") {
													swal('Please input in all text fields', '', 'warning')
													return false;
												} else if (document.getElementById('pay').value == "") {
													swal('Please input in all text fields', '', 'warning')
													return false;
												} else if (qn < 0) {
													console.log(qn)
													swal('Minus value not accepted', '', 'warning')
													document.getElementById('qnty').value = '';
													document.getElementById('pay').value = '';
													document.getElementById('tprc').value = '';
													return false;
												} else if (document.getElementById('tprc').value < 0) {
													console.log()
													swal('Minus value not accepted', '', 'warning')
													document.getElementById('qnty').value = '';
													document.getElementById('pay').value = '';
													document.getElementById('tprc').value = '';
													return false;
												} else if (!Number.isInteger(qn)) {

													swal('Float Number is not accepted', '', 'warning')
													document.getElementById('qnty').value = '';
													document.getElementById('pay').value = '';
													document.getElementById('tprc').value = '';
													return false;
												} else {
													pd = parseFloat(document.getElementById('pay').value);
													tp = parseFloat(document.getElementById('tprc').value);
													if (pd > tp) {
														swal('Incorrect Payment insertion!', 'Payment is more than total price!!', 'warning')
														return false;
													} else {
														return true;
													}
												}
											}
										</script>


									</div>
							<?php }
							} ?>
							<div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
								<?php
								include_once 'dbCon.php';
								$conn = connect();
								if (isset($_POST['edit'])) {
									$id = $_SESSION['cusID'];
									$ecn = $_POST['cus_name'];
									$ecm = $_POST['mob'];
									$eca = $_POST['addrs'];

									$sql = "UPDATE customer_details SET `cus_name` = '$ecn' , `cus_phone` = '$ecm',`cus_address`='$eca' WHERE cus_id = '$id'";
									if ($conn->query($sql)) {
										echo '<script type="text/javascript"> editAlert(); </script>';
									} else {
										echo '<script type="text/javascript"> window.location.href = "index";</script>';
									}
								}

								?>
								<form class="form-horizontal" method="POST">
									<div class="row clearfix">
										<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
											<label>Customer Name :</label>
										</div>
										<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="cus_name" id="cName" class="form-control" value="<?php if (isset($cn)) {
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
									var name = document.getElementById('cName').value;
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
								<div class="body">

									<div class="table-responsive">
										<div class="col-lg-2 ">
											<button id="excel" class="btn btn-md btn-secoundary clearfix"><i class="material-icons">explicit</i> </span> Export to Excel </button>

										</div>
										<div class="col-lg-2 ">
											<button id="pdf" class="btn btn-md btn-secoundary clearfix"><i class="material-icons">description</i> </span> Export to PDF</button><br><br>

										</div>
										<table id="exportTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
												<tr>
													<th>RECEIPT_NO</th>
													<th>ORDER_DATE</th>
													<th>PRODUCT_NAME</th>
													<th>QUANTITY</th>
													<th>SEASON_NAME</th>
													<th>TOTAL_PRICE</th>
													<th>AMOUNT_PAID</th>
													<th>DUE</th>
													<th>DUE_PAYMENT</th>
													<th>PRINT</th>

												</tr>
											</thead>

											<tbody id="ajaxtable" align="center">

											</tbody>
										</table>
									</div>
								</div>
							</div>
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

</html>