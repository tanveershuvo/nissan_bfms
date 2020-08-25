<?php include "template/miniheader.php";
unset ($_SESSION['nav']);
$_SESSION['nav'] = 111 ; ?>
<title><?php echo $siteName;?> - <?php if (isset($_SESSION['com_name'])){echo $_SESSION['com_name'];};?> | Dashboard</title>
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

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>




<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);

function drawChart() {
	var data = google.visualization.arrayToDataTable([
		['Season Name', 'Budget','Income'],
		<?php
		include_once 'dbCon.php';
		$conn= connect();
		$com=$_SESSION['com_id'];
		$sql1="	select sea_name,sea_budget,sum(paid) ,c.com_id
		from season s, company c,order_details od
		where od.sea_id=s.sea_id
		and s.com_id=c.com_id
		GROUP by od.sea_id
		having c.com_id='$com'";
		$results = $conn->query($sql1);
		while($row=mysqli_fetch_array($results))
		{
			echo "['".$row["sea_name"]."',".$row["sea_budget"].",".$row["sum(paid)"]."],";
		}
		?>
	]);

	var options = {

		hAxis: {title: 'Season name',  titleTextStyle: {color: '#999'}},
		vAxis: {minValue: 0}
	};

	var chart = new google.visualization.AreaChart(document.getElementById('chart'));
	chart.draw(data, options);
}
</script>

<script type="text/javascript">
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
	var data = google.visualization.arrayToDataTable([
		['Season Name', 'Total Income','Total Expense'],
		<?php
		include_once 'dbCon.php';
		$conn= connect();
		$com=$_SESSION['com_id'];
		$sql1="	select sea_name,(sum(weekly_bill)+sum(advance)),(sum(total_bill)+sum(paid)) ,c.com_id
		from sordar_weekly_bill sw,season s, company c,sordar_payment sp,sordar_delivery_status sds
		,order_details as od
		where od.sea_id=s.sea_id and
		sw.sea_id=sp.sea_id
		and sp.sea_id=sds.sea_id
		and sds.sea_id=s.sea_id
		and s.com_id=c.com_id
		group by sw.sea_id , od.sea_id
		having c.com_id='$com'";
		$results = $conn->query($sql1);
		while($row=mysqli_fetch_array($results))
		{
			echo "['".$row["sea_name"]."',".$row["(sum(total_bill)+sum(paid))"].",".$row["(sum(weekly_bill)+sum(advance))"]."],";
		}
		?>
	]);
	var options = {
		chart: {

		},
		bars: 'vartical' // Required for Material Bar Charts.
	};

	var chart = new google.charts.Bar(document.getElementById('charts'));

	chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>

</head>


<?php
include "template/mininavbar.php" ;
include_once 'dbCon.php';
$conn= connect();
$sID = $_SESSION['com_id'];
$sql="select count(cus_id) as 't' from customer_details where com_id='$sID'";
$resultdata=$conn->query($sql);
$row = mysqli_fetch_assoc($resultdata);
$x = $row['t'];
$sql1="select count(emp_id) as 'c' from employee_details where com_id='$sID'";
$result=$conn->query($sql1);
$rows = mysqli_fetch_assoc($result);
$y = $rows['c'];
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2 style="font-weight: bold;">DASHBOARD</h2>
		</div>

		<div class="row clearfix">

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<a href="#" class="dash_card">
					<div class="card-counter info js_card btn_view_saved_job">
						<a href="employee_add"><span class="card-counter3">Total Employee</span></a>
						<div class="number count-to dash_card_count" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?=$y?></div>
						<div class="icon">
							<i class="material-icons">people</i>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<a href="#" class="dash_card">
					<div class="card-counter success js_card btn_view_saved_job">
						<a href="customer_add"><span class="card-counter3">Total Customer</span></a>
						<div class="number count-to dash_card_count" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?=$x?></div>
						<div class="icon">
							<i class="material-icons">face</i>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h3><i> <marquee behavior="alternate">Company Reports</marquee></i></h3><hr>
			</div>
		</div>
		<!-- #END# Widgets -->
		<div class="row clearfix">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 card">
				<span><?php echo $siteName;?> - Company Performance (<strong>Income vs Expense</strong>)</span>
				<hr>
				<div class="card">

					<div  id ="charts" >
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 card">
				<span><?php echo $siteName;?> - Company Performance (<strong>Budget vs Income</strong>)</span>
				<hr>
				<div class="card">

					<div  id ="chart" >
					</div>
				</div>
			</div>

		</div>

		<!-- #END# Hover Zoom Effect -->
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
