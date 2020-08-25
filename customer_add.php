<?php include "template/miniheader.php";
unset($_SESSION['nav']);
$_SESSION['nav'] = 3;

?>
<?php include "signin_checker.php"; ?>


<title><?php echo $siteName; ?> - <?php if (isset($_SESSION['com_name'])) {
										echo $_SESSION['com_name'];
									}; ?> | All Customers </title>
<!-- Bootstrap Core Css -->
<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="plugins/node-waves/waves.css" rel="stylesheet" />

<!-- Animation Css -->
<link href="plugins/animate-css/animate.css" rel="stylesheet" />
<!-- Sweet Alert Css -->
<link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
<!-- JQuery DataTable Css -->

<!-- Custom Css -->
<link href="css/style.css" rel="stylesheet">
<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="css/themes/all-themes.css" rel="stylesheet" />
<!-- Bootstrap Material Datetime Picker Css -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Bootstrap Select Css -->
<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<?php include "template/mininavbar.php" ?>

<script>
	function datasession(cus) {
		$.ajax({
			type: 'POST',
			url: "ajax_retrieve.php",
			data: {
				cusID: cus
			},
			dataType: "json",
			success: function(response) {}

		});
		window.location.href = "customer_details";
	}

	function success(cus) {
		swal({
				title: "New customer Added Successfully",
				text: " ",
				type: "success",
				confirmButtonClass: "btn-success",
				confirmButtonText: "Done"
			},
			function() {
				datasession(cus);
			});
	}

	function duplicate(cus) {
		swal({
				title: "Sorry Duplicate Entry!! This Account Already Existed. ",
				text: "",
				type: "danger",
				confirmButtonClass: "btn-success",
				confirmButtonText: "Try Again"
			},
			function() {
				datasession(cus);
			});
	}

	function check_info() {
		var name = document.getElementById('cName').value;
		var mobile = document.getElementById('mobile').value;
		var address = document.getElementById('address').value;
		var pd = 0;
		if (name == "") {
			swal('Customer Name Required', '', 'warning')
			return false;
		}

		if (mobile == "") {
			swal('Mobile Number Required', '', 'warning')
			return false;
		}
		if (address == "") {
			swal('Address Required', '', 'warning')
			return false;
		}



	}

	function validation() {

		var name = document.getElementById('cName').value;
		var mobile = document.getElementById('mobile').value;
		var address = document.getElementById('address').value;
		if (isNaN(mobile)) {
			swal('Characters Not Allowed', '', 'warning')
			document.getElementById('mobile').value = '';
			return false;
		}
		if (!isNaN(name)) {
			swal('Number Not Allowed', '', 'warning')
			document.getElementById('cName').value = '';
			return false;
		}
	}
	$(document).ready(function() {
		$("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#ajaxtable tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});


	jQuery(function($) {
		$("#excel").click(function() {
			d = Date.now();
			d = new Date(d);
			d = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
			// parse the HTML table element having an id=exportTable
			var dataSource = shield.DataSource.create({
				data: "#exportTable",
				schema: {
					type: "table",
					fields: {
						Customer_Name: {
							type: String
						},
						Mobile: {
							type: String
						},
						Address: {
							type: String
						},
						Total_Due: {
							type: String
						},
						Total_Order: {
							type: String
						}

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
									value: "Customer_Name"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "Mobile"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "Address"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "Total_Due"
								},
								{
									style: {
										bold: true
									},
									type: String,
									value: "Total_Order"
								}

							]
						}].concat($.map(data, function(item) {
							return {
								cells: [{
										type: String,
										value: item.Customer_Name
									},
									{
										type: String,
										value: item.Mobile
									},
									{
										type: String,
										value: item.Address
									},
									{
										type: String,
										value: item.Total_Due
									},
									{
										type: String,
										value: item.Total_Order
									}
								]
							};
						}))
					}]
				}).saveAs({
					fileName: d + '_' + 'customer_details'
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
						Customer_Name: {
							type: String
						},
						Mobile: {
							type: String
						},
						Address: {
							type: String
						},
						Total_Due: {
							type: String
						},
						Total_Order: {
							type: String
						}
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
							field: "Customer_Name",
							title: "Customer_Name",
							width: 100
						},
						{
							field: "Mobile",
							title: "Mobile",
							width: 85
						},
						{
							field: "Address",
							title: "Address Type",
							width: 150
						},
						{
							field: "Total_Due",
							title: "Total_Due",
							width: 85
						},
						{
							field: "Total_Order",
							title: "Total_Order",
							width: 85
						}
					], {
						margins: {
							top: 50,
							left: 50
						}
					}
				);
				pdf.saveAs({
					fileName: d + '_' + 'customer details'
				});
			});
		});
	});
</script>

<section class="content">
	<div class="container-fluid">

		<!-- Exportable Table -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<div class="row clearfix">
							<div class="col-lg-3 col-md-5 col-sm-12 col-xs-12">
								<h4>Customers Details</h4>
							</div>
							<div class="col-lg-5 col-md-4 col-sm-12 col-xs-12">
								<div class="form-line">

									<input type="text" name="Name" id="myInput" class="form-control" placeholder="Search here.....">

								</div>
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
								<a type="button" class=" btn btn-success " data-toggle="modal" data-target="#largeModal"><i class="material-icons">save</i> Add</a>
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
								<a id="pdf" class="btn btn-warning "><i class="material-icons">picture_as_pdf</i> </span> PDFDocument</a><br><br>
							</div>
						</div>
					</div>

					<div class="body">
						<div class="table-responsive" style='text-align:center;'>
							<table style="font-size:15px;color:black;" id="exportTable" class="table table-bordered table-striped table-hover ">
								<thead>
									<tr>
										<th style='text-align:center;'>Customer_Name</th>
										<th style='text-align:center;'>Mobile</th>
										<th style='text-align:center;'>Address</th>
										<th style='text-align:center;'>Total_Due</th>
										<th style='text-align:center;'>Total_Order</th>
										<th style='text-align:center;'>Action</th>
									</tr>
								</thead>

								<tbody id="ajaxtable">
									<?php
									include_once 'dbCon.php';
									$conn = connect();
									$comID = $_SESSION['com_id'];
									$sql = "select *,(SUM(`total_price`)-SUM(`paid`)) as 'due',COUNT(od.order_id) as 'totalorder',
									cs.cus_id as 'cus' from customer_details as cs LEFT OUTER JOIN
									order_details as od ON cs.cus_id=od.cus_id WHERE cs.com_id='$comID' group by cs.cus_id ORDER BY 'due'";
									$resultData = $conn->query($sql);
									foreach ($resultData as $row) {

									?>
										<tr align="center">
											<td><b><?= $row['cus_name'] ?></b></td>
											<td><?= $row['cus_phone'] ?></td>
											<td><?= $row['cus_address'] ?></td>
											<td <?php $o = $row['due'];
												if ($o == null) {
													echo 'class="text-primary">No Entry';
												} elseif ($o == 0) {
													echo 'class="text-success">All due cleared';
												} else {
													echo "class='text-danger'><b> $o TK</b>";
												} ?> </td> <td><b><?= $row['totalorder'] ?></b></td>
											<td><a onclick="datasession(<?= $row['cus'] ?>)" class="btn btn-primary btn-circle waves-effect waves-circle waves-float"><i class="material-icons">input</i></a></td>

										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!-- #END# Exportable Table -->



	</div>
</section>
</body>
<!-- Jquery Core Js -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="plugins/node-waves/waves.js"></script>

<!-- Sweet Alert Plugin Js -->
<script src="plugins/sweetalert/sweetalert.min.js"></script>



<!-- Custom Js -->
<script src="js/admin.js"></script>

<!-- Demo Js -->
<script src="js/demo.js"></script>
<?php
include_once 'dbCon.php';
$conn = connect();

if (isset($_POST['submit'])) {
	function generateRandomString()
	{
		$characters = '0123456789';
		$length = 6;
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	$cusID = generateRandomString();
	$cName = $_POST['cus_name'];
	$cMob = $_POST['mob'];
	$cAdd = $_POST['addrs'];
	$sql = "SELECT * FROM customer_details WHERE cus_name='$cName' AND cus_phone='$cMob'";
	$result = $conn->query($sql);
	if ($result->num_rows < 1) {
		$sql = "INSERT INTO customer_details (cus_id,cus_name,cus_address,cus_phone,com_id) VALUES ('$cusID','$cName','$cAdd','$cMob','$comID')";

		if ($conn->query($sql)) {
			echo '<script>success(' . $cusID . ')</script>';
		}
	} else {
		$row = mysqli_fetch_assoc($result);
		$id = $row['cus_id'];
		echo '<Script>duplicate(' . $id . ')</Script>';
	}
}


?>


<div class="body">
	<!-- Large Size -->
	<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" align="center" id="largeModalLabel"><b>Add Customer Details</b> </h4>
					<hr>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="insert_form" onsubmit="return check_info();" method="POST">
						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
								<label>Customer Name :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="cus_name" oninput="validation()" id="cName" class="form-control" placeholder="Please Enter Customer name">
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
										<input type="text" name="mob" oninput="validation()" id="mobile" class="form-control" placeholder="Please Enter Mobile number">
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
										<input type="text" name="addrs" id="address" class="form-control" placeholder="Please Enter Full Address ">
									</div>
								</div>
							</div>
						</div> <br>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" name="submit" id="submit" class="btn btn-primary">Save </button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>


</html>