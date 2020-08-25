<?php include "template/miniheader.php";
	unset ($_SESSION['nav']);
	$_SESSION['nav'] = 7 ;
?>
<?php include "signin_checker.php" ?>

<title><?php if (isset($_SESSION['com_name'])){echo $_SESSION['com_name'];};?> | Mechinary</title>
<!-- Bootstrap Core Css -->
<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="plugins/node-waves/waves.css" rel="stylesheet" />

<!-- Animation Css -->
<link href="plugins/animate-css/animate.css" rel="stylesheet" />
<!-- Sweet Alert Css -->
<link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
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
<script>

	window.onload = function dataretrieve(){

		var tbody = document.getElementById("ajaxtable");
		var tableRow="";
		$.ajax({
			type:'POST',
			url:"ajax_retrieve.php",
			data:{"mechinaries":1},
			dataType:"json",
			success : function(response){

				for(var i=0;i<response.length ;i++){

					tableRow += "<tr><td class='text-Primary'  style='text-align:center;' > <b>"+response[i].receipt+"</td>"+
					"<td>"+response[i].name+"</td>"+
					"<td>"+response[i].type+"</td>"+
					"<td>"+response[i].quantity+"</td>"+
					"<td>"+response[i].rate+" Tk</td>"+
					"<td style='text-align:center;' > <b>"+response[i].date+" </td> "+
					"<td><a onclick='edit("+response[i].m_id+")'  class='btn btn-primary a-btn-slide-text' data-toggle='modal' data-target='#edit_modal'>"+
					"<span class='glyphicon glyphicon-plus'></span><span><strong>EDIT</strong></span></a></td>"+
					"</tr>";
					/*loop end*/
				}
				tbody.innerHTML = tableRow;
			}
		});
	}

	function edit(m_id){

		$.ajax({
			type:'POST',
			url:"ajax_retrieve.php",
			data:{mID:m_id},
			dataType:"json",
			success : function(response){

				document.getElementById('m_id').value=response[0].m_id;
				document.getElementById('rt').value=response[0].rate;
				document.getElementById('qt').value=response[0].quantity;
				document.getElementById('nm').value=response[0].name;
				document.getElementById('dt').value=response[0].date;
				document.getElementById('tp').value=response[0].type;

			}
		});
	}

	function editsuccess(){
		swal({
			title: "Edit Successful!!",
			text: "Mechinary Details Edited Successfully",
			type: "success",
			confirmButtonClass: "btn-primary",
			confirmButtonText: "OK!"
		},
		function(){
			window.location.href= "mechinaries";
		});
	}


	function success(){
		swal({
			title: "Add Successful!!",
			text: "Mechinary Details Added Successfully",
			type: "success",
			confirmButtonClass: "btn-primary",
			confirmButtonText: "OK!"
		},
		function(){
			window.location.href= "mechinaries.php";
		});
	}

	function myFN(){
		swal({
			title: "Duplicate Entry!!",
			text: "This receipt has already been created",
			type: "warning",
			confirmButtonClass: "btn-primary",
			confirmButtonText: "OK!"
		},
		function(){
			window.location.href= "mechinaries";
		});
	}

	$(document).ready(function(){
		$("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#ajaxtable tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});


    jQuery(function ($) {
        $("#excel").click(function () {

            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#exportTable",
                schema: {
                    type: "table",
                    fields: {
                        Reciept_No: { type: String },
                        Name: { type: String },
                        Mechinary_Type: { type: String },
                        Quantity: { type: String },
                        Rate: { type: String },
                        Date: { type: String }
					}
				}
			});
            // when parsing is done, export the data to Excel
            dataSource.read().then(function (data) {
                new shield.exp.OOXMLWorkbook({
                    author: "PrepBootstrap",
                    worksheets: [
					{
						name: "PrepBootstrap Table",
						rows: [
						{
							cells: [
							{
								style: {
									bold: true
								},
								type: String,
								value: "Reciept No"
							},
							{
								style: {
									bold: true
								},
								type: String,
								value: "Name"
							},
							{
								style: {
									bold: true
								},
								type: String,
								value: "Mechinary Type"
							},
							{
								style: {
									bold: true
								},
								type: String,
								value: "Quantity"
							},
							{
								style: {
									bold: true
								},
								type: String,
								value: "Rate"
							},
							{
								style: {
									bold: true
								},
								type: String,
								value: "Date"
							}
							]
						}
						].concat($.map(data, function(item) {
							return {
								cells: [
								{ type: String, value: item.Reciept_No },
								{ type: String, value: item.Name },
								{ type: String, value: item.Mechinary_Type },
								{ type: String, value: item.Quantity },
								{ type: String, value: item.Rate },
								{ type: String, value: item.Date }
								]
							};
						}))
					}
                    ]
					}).saveAs({
                    fileName: "Mechinaries_Details"
				});
			});
		});
	});

	jQuery(function ($) {
        $("#pdf").click(function () {

			d = Date.now();
			d = new Date(d);
			d = d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear();
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#exportTable",
                schema: {
                    type: "table",
                    fields: {
                        Reciept_No: { type: String },
                        Name: { type: String },
                        Mechinary_Type: { type: String },
                        Quantity: { type: String },
                        Rate: { type: String },
                        Date: { type: String }
					}
				}
			});

            // when parsing is done, export the data to PDF
            dataSource.read().then(function (data) {
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

				{ field: "Reciept_No", title: "Reciept_No", width: 85 },
				{ field: "Name", title: "Name", width: 85 },
				{ field: "Mechinary_Type", title: "Mechinary Type", width: 100 },
				{ field: "Quantity", title: "Quantity", width: 85 },
				{ field: "Rate", title: "Rate", width: 85 },
				{ field: "Date", title: "Date", width: 85 }
				],
				{
					margins: {
						top: 50,
						left: 50
					}
				}
                );
                pdf.saveAs({
                    fileName: d+'_'+'Mechinary_details'
				});
			});
		});
	});
</script>
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
</head>
<?php include "template/mininavbar.php"; ?>
<?php
	include_once 'dbCon.php';
	$conn= connect();

	if (isset($_POST['submit'])){
		//echo 'fgfgfg';exit;
		$Rate = $_POST['Rate'];
		$Type = $_POST['Type'];
		$Quantity = $_POST['Quantity'];
		$Name = $_POST['Name'];
		$Receipt = $_POST['Receipt'];
		$date = $_POST['date'];
		$comID = $_SESSION['com_id'];
		$sql = "SELECT * FROM mechinaries_details WHERE receipt='$Receipt'";
		$result = $conn->query($sql);
		if($result->num_rows < 1){
			$sql = "INSERT INTO mechinaries_details (rate,type,quantity,name,receipt,date,com_id) VALUES ('$Rate','$Type','$Quantity','$Name','$Receipt','$date','$comID')";

			if ($conn->query($sql)){
				echo "<Script>success()</Script>";
			}
			} else{
			echo "<Script>myFN()</Script>";
		}
	}


	if(isset($_POST['edit'])){
		$Rate = $_POST['rt'];
		$Type = $_POST['tp'];
		$Quantity = $_POST['qt'];
		$Name = $_POST['nm'];
		$date = $_POST['dt'];
		$Mid = $_POST['m_id'];
		$sql = "UPDATE mechinaries_details SET rate='$Rate' , type='$Type', quantity='$Quantity', name='$Name',date='$date' WHERE m_id='$Mid'";
	    if ($conn->query($sql)){
			echo "<Script>editsuccess()</Script>";
		}

	}

?>
<script>


	function check_info(){
		var Rate= document.getElementById('Rate').value;
		var Type= document.getElementById('Type').value;
		var Quantity= document.getElementById('Quantity').value;
		var Receipt = document.getElementById('Receipt').value;
		var Name = document.getElementById('Name').value;

		if (Name==""){
			swal('Please input Name', '', 'warning')
			return false;
		}
		if(Type=="-- Please select --"){
			swal('Please select mechinary type', '', 'warning')
			return false;
		}

		if (Rate==""){
			swal('Please input Rate', '', 'warning')
			return false;
		}

		if (Quantity==""){
			swal('Please input Quantity', '', 'warning')
			return false;
		}
		if (Receipt==""){
			swal('Please input Receipt no', '', 'warning')
			return false;
		}

	}


	function check_edit_info(){
		var Rate= document.getElementById('rt').value;
		var Type= document.getElementById('tp').value;
		var Quantity= document.getElementById('qt').value;
		var Name = document.getElementById('nm').value;

		if (Name==""){
			swal('Please input Name', '', 'warning')
			return false;
		}
		if(Type=="-- Please select --"){
			swal('Please select machinary type', '', 'warning')
			return false;
		}


		if (Rate==""){
			swal('Please input Rate', '', 'warning')
			return false;
		}

		if (Quantity==""){
			swal('Please input Quantity', '', 'warning')
			return false;
		}


	}

	function validation(){

		var Rate= document.getElementById('Rate').value;
		var Quantity= document.getElementById('Quantity').value;

		if(isNaN(Rate)){
			swal('Rate have only numbers!!', '', 'warning')
			document.getElementById('Rate').value='';
			return false;
		}

	}

	function validation2(){

		var Rate= document.getElementById('rt').value;
		var Quantity= document.getElementById('qt').value;

		if(isNaN(Rate)){
			swal('Rate have only numbers!!', '', 'warning')
			document.getElementById('rt').value='';
			return false;
		}

	}


</script>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">

			<button type="button" class="col-lg-offset-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-5 btn btn-primary waves-effect m-r-30" data-toggle="modal" data-target="#largeModal"><i class="material-icons">add_to_queue</i> ADD NEW MACHINARY DETAILS</button>
			<h2>
				<b> MACHINARY AND PARTS DETAILS</b>
			</h2>
		</div>
		<!-- Exportable Table -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<div class="row clearfix">
                            <div class="col-lg-4 ">
								<div class="form-line">

									<input type="text" name="Name"  id="myInput" class="form-control"  placeholder="Search here....." >


								</div>
							</div>
							<div class="col-lg-4 ">

							</div>
							<div class="col-lg-2 ">
							<button id="excel" class="btn btn-md btn-secoundary clearfix"><i class="material-icons">explicit</i> </span> Export to Excel </button>

						</div>
						<div class="col-lg-2 ">
						<button id="pdf" class="btn btn-md btn-secoundary clearfix"><i class="material-icons">description</i> </span> Export to PDF</button><br><br>

					</div>
				</div>
			</div>

			<div class="body">
				<div class="table-responsive">
					<table id="exportTable" class="table table-bordered table-striped  ">
						<thead>
							<tr>
								<th>Reciept_No</th>
								<th>Name</th>
								<th>Mechinary_Type</th>
								<th>Quantity</th>
								<th>Rate</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody class="table" id = "ajaxtable">

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



<!-- Autosize Plugin Js -->
<script src="plugins/autosize/autosize.js"></script>
<!-- Multi Select Plugin Js -->
<!-- Moment Plugin Js -->
<script src="plugins/momentjs/moment.js"></script>

<!-- Select Plugin Js -->
<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Date Plugin Js -->
<script src="js/jquery.number.min.js"></script>
<script src="js/jquery.number.js"></script>

<script type="text/javascript">

	$(function(){
		// Set up the number formatting.

		$('#number_container').slideDown('fast');

		$('#price').on('change',function(){
			console.log('Change event.');
			var val = $('#price').val();
			$('#the_number').text( val !== '' ? val : '(empty)' );
		});

		$('#price').change(function(){
			console.log('Second change event...');
		});

		$('#price').number( true, 2 );


		// Get the value of the number for the demo.
		$('#get_number').on('click',function(){

			var val = $('#price').val();

			$('#the_number').text( val !== '' ? val : '(empty)' );
		});
	});
</script>

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
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="js/pages/forms/basic-form-elements.js"></script>
<script src="js/admin.js"></script>
<!-- Demo Js -->
<script src="js/demo.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</body>

<!-- CREATE MODAL ----------------------------------------------------------------------------------------------------------------------------->
<div class="body">
	<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" align="center" id="largeModalLabel">Insert Mechinaries Information here :</h4><hr>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="insert_form" onsubmit="return check_info();" method ="POST" >
						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
								<label for="password_2">Name :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="Name"  id="Name" class="form-control" placeholder="Enter Rate" >
									</div>
								</div>
							</div>
						</div> <br>

						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label" >
								<label for="password_2">Type :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<select name ="Type" id="Type" class="form-control show-tick">
									<option value="-- Please select --">-- Please select --</option>
									<option value="Mechine">Mechine</option>
									<option value="Parts">Parts</</option>
								</select>
							</div>
						</div></br>
						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
								<label >Quantity :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="Quantity" oninput="validation()" id="Quantity" class="form-control" placeholder="Enter Quantity" >

									</div>
								</div>
							</div>
						</div></br>

						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
								<label >Rate :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="Rate" oninput="validation()" id="Rate" class="form-control" placeholder="Enter Quantity" >
									</div>
								</div>
							</div>
						</div></br>

						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
								<label >Receipt No. :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="Receipt" id="Receipt" class="form-control" placeholder="Enter Receipt" >
									</div>
								</div>
							</div>
						</div></br>
						<div class="row clearfix">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
								<label for="password_2">Date :</label>
							</div>
							<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<input type="date" name="date"  id="date" class="form-control" value="<?php print(date("Y-m-d")); ?>"/>
									</div>
								</div>
							</div>
						</div><br>
					</div>
					<div class="modal-footer">
						<button type="submit" name= "submit" id= "submit" class="btn btn-primary">SAVE </button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
					</div>
					<div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- CREATE MODAL ----------------------------------------------------------------------------------------------------------------------------->


	<!-- EDIT MODAL ----------------------------------------------------------------------------------------------------------------------------->
	<div class="body">
		<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" align="center"  id="largeModalLabel">Edit Mechinaries Information here :</h4><hr>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" id="insert_form" name="editable" onsubmit="return check_edit_info();" method ="POST" >
							<input type="hidden" name="m_id" id="m_id">

							<div class="row clearfix">
								<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
									<label for="password_2">Name :</label>
								</div>
								<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="text" name="nm"  id="nm" class="form-control" placeholder="Enter Rate" >
										</div>
									</div>
								</div>
							</div> <br>
							<div class="row clearfix">
								<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label" >
									<label for="password_2">Type :</label>
								</div>
								<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
									<select name ="tp" id="tp" class="form-control show-tick">
										<option value="-- Please select --">-- Please select --</option>
										<option value="Mechine">Mechine</option>
										<option value="Parts">Parts</</option>
									</select>
								</div>
							</div></br>
							<div class="row clearfix">
								<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
									<label >Quantity :</label>
								</div>
								<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="text" name="qt" oninput="validation2()" id="qt" class="form-control" placeholder="Enter Quantity" >
										</div>
									</div>
								</div>
							</div></br>

							<div class="row clearfix">
								<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
									<label >Rate :</label>
								</div>
								<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="text" name="rt" oninput="validation2()" id="rt" class="form-control" placeholder="Enter Quantity" >
										</div>
									</div>
								</div>
							</div></br>


							<div class="row clearfix">
								<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
									<label for="password_2">Date :</label>
								</div>
								<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="date" name="dt"  id="dt" class="form-control" value="<?php print(date("Y-m-d")); ?>"/>
										</div>
									</div>
								</div>
							</div><br>

						</div>
						<div class="modal-footer">
							<button type="submit" name= "edit" id= "submit" class="btn btn-primary">SAVE </button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- EDIT MODAL ----------------------------------------------------------------------------------------------------------------------------->



</html>
