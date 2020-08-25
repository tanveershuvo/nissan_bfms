<?php include "template/miniheader.php";
unset($_SESSION['nav']);
$_SESSION['nav'] = 55 ; ?>
<?php include "signin_checker.php"; ?>
<title><?php if (isset($_SESSION['com_name'])) {
    echo $_SESSION['com_name'];
};?> | Emp Paid</title>
    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
	<!-- Sweet Alert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- Wait Me Css -->
	<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
	<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
	<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>

	<script>

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
                        EmployeeName: { type: String },
                        Mobile: { type: String },
                        Gmail: { type: String },
                        Designation: { type: String },
                        Salary: { type: String },
                        Date: { type: String },
                        Status: { type: String }

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
                                            value: "EmployeeName"
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
                                            value: "Gmail"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Designation"
                                        },
										{
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Salary"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Date"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Status"
                                        }

                                    ]
                                }
                            ].concat($.map(data, function(item) {
                                return {
                                    cells: [
                                        { type: String, value: item.EmployeeName },
                                        { type: String, value: item.Mobile },
                                        { type: String, value: item.Gmail },
                                        { type: String, value: item.Designation },
                                        { type: String, value: item.Salary },
                                        { type: String, value: item.Date },
                                        { type: String, value: "Paid" }
                                    ]
                                };
                            }))
                        }
                    ]
                }).saveAs({
					fileName:'employees_paid_salary'
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
                        EmployeeName: { type: String },
                        Mobile: { type: String },
                        Gmail: { type: String },
                        Designation: { type: String },
                        Salary: { type: String },
                        Date: { type: String },
                        Status: { type: String },
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

                        { field: "EmployeeName", title: "EmployeeName", width: 70 },
                        { field: "Mobile", title: "Mobile", width: 70 },
                        { field: "Gmail", title: "Gmail", width: 70 },
                        { field: "Designation", title: "Designation", width: 70 },
                        { field: "Salary", title: "Salary", width: 70 },
                        { field: "Date", title: "Salary", width: 70 },
                        { field: "Status", title: "Status", width: 70 },
                    ],
                    {
                        margins: {
                            top: 50,
                            left: 50
                        }
                    }
                );
                pdf.saveAs({
                    fileName: d+'_'+'employee_paid_details'
                });
            });
        });
    });


	</script>

	</head>
<?php include "template/mininavbar.php" ?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 <h2>
                                EMPLOYEE SALARY DETAILS
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
                                <table id="exportTable" class="table table-bordered table-striped table-hover ">
                                    <thead>
                                        <tr>
                                            <th>EmployeeName</th>
                                            <th>Mobile</th>
                                            <th>Gmail</th>
                                            <th>Designation</th>
                                            <th>Salary</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody id = "ajaxtable">
									<?php
                                                include_once 'dbCon.php';
                                                $conn= connect();
                                                $comID=$_SESSION['com_id'];
                                                $access =$_SESSION['access'];
                                                $sql= "SELECT * FROM employee_details as e , employee_payment as p
												                        WHERE e.emp_id=p.emp_id AND com_id = '$comID'
												                        and p.payment_status='paid' ORDER BY `emp_name` DESC";

                                                $resultData=$conn->query($sql);
                                                foreach ($resultData as $row) {
                                                    ?>
                                        <tr>
                                            <td><?=$row['emp_name']?></td>
                                            <td><?=$row['emp_phone']?></td>
                                            <td><?=$row['emp_email']?></td>
                                            <td><?=$row['emp_des']?></td>
                                            <td><?=$row['salary']?></td>
                                            <td><?=$row['date']?></td>

											<td><b class="text-primary">Salary Paid</b></td>

                                        </tr>
										<?php
                                                } ?>
                                    </tbody>

									<tbody id="ajaxtable">

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
    <script src="plugins/multi-select/js/jquery.multi-select.js"></script>
    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>


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
    <script src="js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>
