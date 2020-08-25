<?php include "template/miniheader.php";
unset($_SESSION['nav']);
$_SESSION['nav'] = 5; ?>
<?php include "signin_checker.php"; ?>
<title><?php if (isset($_SESSION['com_name'])) {
            echo $_SESSION['com_name'];
        }; ?> | EMP SALARY</title>
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

<!-- Wait Me Css -->
<link href="plugins/waitme/waitMe.css" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap Select Css -->
<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script>
    function mail(eid) {

        $.ajax({
            type: 'POST',
            data: {
                empp_id: eid
            },
            url: "ajax_retrieve.php",
            success: function() {
                window.location.href = "employee_salary";
            }
        });

    }

    function payment(id) {

        $.ajax({
            type: 'POST',
            data: {
                pay_id: id
            },
            url: "ajax_insertion.php",
            success: function() {
                swal({
                    title: "Salary Paid Successfully",
                    type: "success",
                    confirmButtonClass: "btn-primary",
                    confirmButtonText: "OK",
                }, function() {
                    window.location.href = "employee_salary";
                });
            }
        });
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
</head>
<?php include "template/mininavbar.php" ?>
<?php
include_once 'dbCon.php';
$conn = connect();
$comID = $_SESSION['com_id'];
$sql = "SELECT * FROM employee_details where com_id = '$comID' and status=0 ";
$resultData = $conn->query($sql);
foreach ($resultData as $items) {
    $id = $items['emp_id'];
    $empid = (date("my")) + $id;
    $salary = $items['emp_salary'];
    $today = date("d/m/y");
    $sql = "INSERT INTO employee_payment (`emp_pay_id`,`emp_id`,`date`,`salary`,`payment_status`)
	      values('$empid','$id','$today','$salary','unpaid')";
    $conn->query($sql);
}
?>

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

                                    <input type="text" name="Name" id="myInput" class="form-control" placeholder="Search here.....">

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
                            <table class="table table-bordered table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Mobile</th>
                                        <th>Gmail</th>
                                        <th>Designation</th>
                                        <th>Salary </th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    include_once 'dbCon.php';
                                    $conn = connect();
                                    $comID = $_SESSION['com_id'];

                                    $access = $_SESSION['access'];
                                    if ($access == 1) {
                                        $sql = "SELECT * FROM employee_details as e , employee_payment as p
                                                WHERE e.emp_id=p.emp_id AND com_id = '$comID' AND e.status=0
                                                AND p.payment_status='unpaid'
                                                ORDER BY `emp_name` DESC";
                                    } elseif ($access == 2) {
                                        $sql = "SELECT * FROM employee_details as e , employee_payment as p
                                                WHERE e.emp_id=p.emp_id AND e.emp_des='Staff' AND com_id = '$comID'
                                                AND e.status=0 AND p.payment_status='unpaid'
                                                ORDER BY `emp_name` DESC";
                                    }
                                    $resultData = $conn->query($sql);
                                    foreach ($resultData as $row) {
                                    ?>
                                        <tr>
                                            <form method="post">
                                                <input type="hidden" value="<?= $row['emp_pay_id'] ?>">
                                                <td><?= $row['emp_name'] ?></td>
                                                <td><?= $row['emp_phone'] ?></td>
                                                <td><?= $row['emp_email'] ?></td>
                                                <td><?= $row['emp_des'] ?></td>
                                                <td><?= $row['salary'] ?></td>
                                                <td><?= $row['date'] ?></td>
                                                <td><a name="edit" onclick="payment(<?= $row['emp_pay_id'] ?>)" class="btn btn-primary waves-effect waves-float">Pay Now</a></td>
                                            </form>
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