<?php
  include "template/miniheader.php";
  unset ($_SESSION['nav']);
  $_SESSION['nav'] = 8 ;
  include "signin_checker.php";
?>
    <title><?php if (isset($_SESSION['com_name'])){echo $_SESSION['com_name'];};?> | All Sordars </title>
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

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
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

		function addalert(){
			swal({
           title: "ADD Successfully!!",
           text: "This account has been created",
           type: "success",
           confirmButtonClass: "btn-primary",
           confirmButtonText: "OK!"
         },
         function(){
           window.location.href= "sordar_add";
         });
		}

		function myFN(id){
		swal({
           title: "Duplicate Entry!!",
           text: "This account has already been created",
           type: "warning",
           confirmButtonClass: "btn-primary",
           confirmButtonText: "OK!"
         },
         function(){
           window.location.href= "sordar_details";
         });
		}

	</script>
</head>

<?php include "template/mininavbar.php" ?>

		<script>

		function datasession(sor){
			$.ajax({
				type:'POST',
				url:"ajax_retrieve.php",
				data:{sorID:sor},
				dataType:"json",
				success : function(response){

					 }
			});

				window.location.href="sordar_details";
		}

		function check_info(){
			var name= document.getElementById('sName').value;
			var mobile= document.getElementById('mobile').value;
			var address= document.getElementById('address').value;
			var sl = document.getElementById('mySelect').value;

			if (name==""){
				swal('Please input customer name', '', 'warning')
				return false;
			}

			if (mobile==""){
				swal('Please input mobile number', '', 'warning')
				return false;
			}
			if (address==""){
				swal('Please input address', '', 'warning')
				return false;
			}
			if(sl=="-- Please select --"){
				swal('Please select Sordar type', '', 'warning')
				return false;
			}
			if(mobile.length != 11){
				swal('Mobile Number Must be 11 digit!!', '', 'warning');
				return false;
			}



		}
		function validation(){

			var name= document.getElementById('sName').value;
			var mobile= document.getElementById('mobile').value;
			var address= document.getElementById('address').value;
			if(isNaN(mobile)){
				swal('Mobile Number conatins only numbers!!', '', 'warning')
				document.getElementById('mobile').value='';
				return false;
			}
			if(!isNaN(name)){
				swal('Name conatins only letter!!', '', 'warning')
				document.getElementById('cName').value='';
				return false;
			}

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
		d = Date.now();
d = new Date(d);
d = d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear();
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#exportTable",
                schema: {
                    type: "table",
                    fields: {
                        Sordar_Name: { type: String },
                        Sordar_Mobile: { type: String },
                        Sordar_Address: { type: String },
                        Sordar_Type: { type: String }

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
                                            value: "Sordar_Name"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Sordar_Mobile"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Sordar_Address"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Sordar_Type"
                                        }

                                    ]
                                }
                            ].concat($.map(data, function(item) {
                                return {
                                    cells: [
                                        { type: String, value: item.Sordar_Name },
                                        { type: String, value: item.Sordar_Mobile },
                                        { type: String, value: item.Sordar_Address },
                                        { type: String, value: item.Sordar_Type }
                                    ]
                                };
                            }))
                        }
                    ]
                }).saveAs({
					fileName: d+'_'+'sordar_details'
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
                        Sordar_Name: { type: String },
                        Sordar_Mobile: { type: String },
                        Sordar_Address: { type: String },
                        Sordar_Type: { type: String }
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

                        { field: "Sordar_Name", title: "Sordar_Name", width: 100 },
                        { field: "Sordar_Mobile", title: "Sordar_Mobile", width: 100 },
                        { field: "Sordar_Address", title: "Sordar_Address", width: 150 },
                        { field: "Sordar_Type", title: "Sordar_Type", width: 100 }

                    ],
                    {
                        margins: {
                            top: 50,
                            left: 50
                        }
                    }
                );
                pdf.saveAs({
                    fileName: d+'_'+'sordar details'
                });
            });
        });
    });


		</script>

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
			<button type="button" class="col-lg-offset-10 col-md-offset-4 col-sm-offset-4 col-xs-offset-5 btn btn-primary waves-effect m-r-30" data-toggle="modal" data-target="#largeModal"><i class="material-icons">add_to_queue</i> ADD NEW SORDAR </button>

                 <h2>
                    <b>SORDAR DETAILS AND INVOICE GENERATOR</b>
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
                                <table id="exportTable" style="font-size:15px;color:black;" class="table table-bordered table-striped table-hover text-center ">
                                    <thead>
                                        <tr>
                                            <th  style='text-align:center;'>Sordar_Name</th>
                                            <th  style='text-align:center;'>Sordar_Mobile</th>
                                            <th  style='text-align:center;'>Sordar_Address</th>
                                            <th  style='text-align:center;'>Sordar_Type</th>

                                            <th  style='text-align:center;'>Action</th>
						</tr>
                                    </thead>

                                    <tbody id = "ajaxtable">
									<?php
												include_once 'dbCon.php';
												$conn= connect();
												$comID = $_SESSION['com_id'];

												$sql= "SELECT * from sordar_details where com_id='$comID'";

												$resultData=$conn->query($sql);
											    foreach ($resultData as $row){

										?>
                                        <tr>
                                            <td><b><?=$row['sor_name']?></b></td>
                                            <td><?=$row['sor_phone']?></td>
                                            <td><?=$row['sor_address']?></td>
                                            <td><?=$row['sor_type']?></td>
											<td><a onclick="datasession(<?=$row['sor_id']?>)" class="hide-from-printer btn btn-primary btn-circle waves-effect waves-circle waves-float"><i class="material-icons">input</i></a></td>

                                        </tr>
												<?php }  ?>
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

<?php
	include_once 'dbCon.php';
	$conn= connect();
   if (isset($_POST['submit'])){
	   function generateRandomString()  {
        $characters = '0123456789';
        $length = 6;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
                                        }
	   $sID = generateRandomString();
	   $sName = $_POST['sor_name'];
	   $sMob = $_POST['mob'];
	   $comID = $_SESSION['com_id'];
	   $sAdd = $_POST['addrs'];
	   $sType = $_POST['sor_type'];
	   $sql = "SELECT * FROM sordar_details WHERE sor_name='$sName' AND sor_phone='$sMob'";
	   $result = $conn->query($sql);
	   if($result->num_rows < 1){
	   $sql = "INSERT INTO sordar_details (sor_id,sor_name,sor_address,sor_phone,sor_type,com_id) VALUES ('$sID','$sName','$sAdd','$sMob','$sType','$comID')";
	   $conn->query($sql);
		echo "<Script>addalert(".$sID.")</Script>";

	   } else{
		   $row = mysqli_fetch_assoc($result);
	     $id=$row['sor_id'];
		 echo "<Script>myFN(".$id.")</Script>";
	   }
   }


?>

						<div class="body">
						<!-- Large Size -->
                           <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                               <div class="modal-dialog modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h4 class="modal-title" align="center" id="largeModalLabel">Insert Sordars Information here :</h4><hr>
                                       </div>
                                       <div class="modal-body">
										 <form class="form-horizontal" id="insert_form" onsubmit="return check_info();" method ="POST" >
                                            <div class="row clearfix">
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
                                                    <label >Sordar Name :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="sor_name" oninput="validation()" id="sName" class="form-control" placeholder="Enter Customer name" >
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
                                                            <input type="text" name="mob" oninput="validation()"  id="mobile" class="form-control" placeholder="Enter Mobile number" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <br>

										    <div class="row clearfix">
										    	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label" >
										    		<label for="password_2">Sordar Type :</label>
										    	</div>
										    	<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                                          <select name ="sor_type" id="mySelect" class="form-control show-tick">
                                                              <option value="-- Please select --">-- Please select --</option>
                                                              <option value="Mail Sordar">Mail Sordar</option>
                                                              <option value="Load Sordar">Load Sordar</option>
                                                              <option value="Unload Sordar">Unload Sordar</option>
                                                              <option value="Saak Sordar">Saak Sordar</option>
                                                              <option value="Porai Sordar">Porai Sordar</option>
                                                          </select>
                                                </div>
                                            </div></br>

								            <div class="row clearfix">
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label" >
                                                    <label for="password_2">Address :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="addrs" id="address" class="form-control" placeholder="Enter Address " >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                       <div class="modal-footer">
                                           <button type="submit" name= "submit" id= "submit" class="btn btn-primary waves-effect">SAVE </button>
                                           <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                                       </div>
									   </form>
                                   </div>
                               </div>
                           </div>
						</div>

</html>
