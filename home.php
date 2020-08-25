<?php include "template/miniheader.php";
    unset($_SESSION['nav']);
    $_SESSION['nav'] = 1 ;
    if ($_SESSION['access']==(1||2)) {
        echo '<script>window.location.href = "dashboard"</script>';
    }
?>
<?php include "signin_checker.php"; ?>
<title><?php if (isset($_SESSION['com_name'])) {
    echo $_SESSION['com_name'];
};?> | HOME</title>
<!-- Bootstrap Core Css -->
<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<!-- Waves Effect Css -->
<link href="plugins/node-waves/waves.css" rel="stylesheet" />

<!-- Animation Css -->
<link href="plugins/animate-css/animate.css" rel="stylesheet" />
<!-- Custom Css --><link href="css/style.css" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="css/themes/all-themes.css" rel="stylesheet" />
<link href="plugins/multi-select/css/multi-select.css" rel="stylesheet">

<!-- Bootstrap Spinner Css -->
<link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

<!-- Bootstrap Tagsinput Css -->
<link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

<!-- Bootstrap Select Css -->
<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

		window.onload=function product_av(){
		$.ajax({
			type:'POST',
			url:"ajax_retrieve.php",
			data:{product_details:1},
			dataType:"json",
			success : function(response){

			for(var i=0;i<response.length ;i++){
			console.log(response[i].available)
			if (response[i].available < 1000){
			a();
					}
				}
			}
		});
		}
</script>
<script type="text/javascript">
	google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
	function ok(){

		$.ajax({
			type:'POST',
			url:"ajax_retrieve.php",
			data:{"product_details":1},
			dataType:"json",
			success : function(response){
				console.log(response)
				drawChart(response);
			}
		});
	}
    window.onload = ok;

	function drawChart(response) {
		dataArray = [];
		dataArray.push(["Product Name", 'Available amount', { role: "style" } ]);

		var color = 33;
		for(v in response){

			dataArray.push([response[v].pro_name, response[v].available,  "#b873"+color]);
			color +=100;

		}
		var data = google.visualization.arrayToDataTable(dataArray);
		var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,
		{ calc: "stringify",
			sourceColumn: 1,
			type: "string",
		role: "annotation" },
		2]);

		var options = {
			title: "Product availability",
			width: 500,
			height: 400,
			bar: {groupWidth: "95%"},
			legend: { position: "none" },
		};
		var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
		chart.draw(view, options);
	}
	setInterval(drawChart , 5000);
	setInterval(ok , 5000);
</script>


</head>


<?php

include "template/mininavbar.php" ?>




<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2 style="font-weight: bold;">DASHBOARD</h2>
		</div>

		<!-- Basic Alerts -->
		<div class="row clearfix">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="card">
					<div  id ="columnchart_values" >

					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

				<div class="row">
					<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
						<div class="info-box-2 bg-green hover-zoom-effect">
							<div class="icon">
								<i class="material-icons">input</i>
							</div>
							<div class="content">
								<div class="text">Total Order Insertion</div>
								<div class="number">9</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
						<div class="info-box-2 bg-blue hover-zoom-effect">
							<div class="icon">
								<i class="material-icons">bookmark_border</i>
							</div>
							<div class="content">
								<div class="text">Tday's total order insertion</div>
								<div class="number">2</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
						<div class="info-box-2 bg-red hover-zoom-effect">
							<div class="icon">
								<i class="material-icons">person_outline</i>
							</div>
							<div class="content">
								<div class="text">Total todays Sorder/foreman Delivery</div>
								<div class="number">12</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
						<div class="info-box-2 bg-pink hover-zoom-effect">
							<div class="icon">
								<i class="material-icons">person</i>
							</div>
							<div class="content">
								<div class="text">Total todays customer order</div>
								<div class="number">13</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</section>

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

    <script src="js/notify.js"></script>
	<script src="js/notiy.min.js"></script>
<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/pages/forms/form-wizard.js"></script>
<!-- Demo Js -->
<script src="js/demo.js"></script>
<!-- Multi Select Plugin Js -->
<script src="plugins/multi-select/js/jquery.multi-select.js"></script>
<!-- Select Plugin Js -->
<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

</body>
</html>
