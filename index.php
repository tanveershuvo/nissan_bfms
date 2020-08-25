<?php session_start(); ?>
<?php include_once 'dbCon.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title> <?php echo $siteName; ?> Management System </title>

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
	<!-- Custom Css -->
	<link href="css/style.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>

	<script>
		function myFN2() {
			swal({
				title: "This is Invalid Authentication",
				text: "Check Check Your Email Address Or Password ",
				type: "error",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Once Again!"
			});
		}
	</script>
</head>

<body class="login-page">
	<?php

	include_once 'dbCon.php';
	$conn = connect();
	if (isset($_POST['signin'])) {
		$mail 		= mysqli_real_escape_string($conn, $_POST['email']);
		$password 	= mysqli_real_escape_string($conn, md5($_POST['password']));
		$sql = "SELECT * FROM `login_details` WHERE `email`='$mail' AND `password`='$password'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$_SESSION['isLoggedIn'] = true;
			foreach ($result as $row) {
				if ($row['access_level'] == 0) {
					$id = $row['log_id'];
					$_SESSION['access'] = $row['access_level'];
					$sql = "select * from employee_details where emp_id='$id'";
					$result = $conn->query($sql);
					$result = mysqli_fetch_assoc($result);
					$cID = $result['com_id'];
					$_SESSION['NAME'] = $result['emp_name'];
					$sql = "select * from company where com_id='$cID'";
					$results = $conn->query($sql);
					$tf = mysqli_fetch_assoc($results);
					$_SESSION['com_id'] = $tf['com_id'];
					$_SESSION['com_name'] = $tf['company_name'];
					$_SESSION['image'] = $tf['image'];
					echo '<script>window.location.href = "season_details"</script>';
				} elseif ($row['access_level'] == 2) {
					$id = $row['log_id'];
					$_SESSION['access'] = $row['access_level'];
					$sql = "select * from employee_details where emp_id='$id'";
					$result = $conn->query($sql);
					$result = mysqli_fetch_assoc($result);
					$cID = $result['com_id'];
					$_SESSION['NAME'] = $result['emp_name'];
					$sql = "select * from company where com_id='$cID'";
					$results = $conn->query($sql);
					$tf = mysqli_fetch_assoc($results);
					$_SESSION['com_id'] = $tf['com_id'];
					$_SESSION['com_name'] = $tf['company_name'];
					echo '<script>window.location.href = "season_details"</script>';
				} else {
					$_SESSION['NAME'] = $row['email'];
					$_SESSION['access'] = $row['access_level'];
					echo '<script>window.location.href = "company"</script>';
				}
			}
		} else {
			$ssql = "SELECT * FROM `login_details` WHERE `email`='$mail' AND `OTP`='$password'";
			$results = $conn->query($ssql);
			if ($results->num_rows > 0) {
				$_SESSION['isLoggedIn'] = true;
				foreach ($results as $row) {
					$_SESSION['email'] = $row['email'];
					echo '<script>window.location.href = "new_password"</script>';
				}
			}
		}
		echo "<script>myFN2();</script>";
	}
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="logo">
				<h3><i>
						<marquee behavior="alternate"><?php echo $siteName; ?> Management System</marquee>
					</i></h3>
			</div>
		</div>
		<div class="col-md-12">
			<div class="login-box">
				<div class="card" style="background: #272643;">
					<div class="body">
						<form method="POST" onsubmit="return myFN()">
							<span id="msgs" style="font-size:12px;color:red;font-weight:bold;"></span>
							<div class="form-group form-float">
								<div class="input-group">
									<label>Email Address</label>
									<div class="form-line">
										<input type="text" class="form-control" name="email" id="username" oninput="myFN()" placeholder="Enter your email Address">
									</div>
									<span id="msg1" style="font-size:12px;color:red;font-weight:bold;"></span>
								</div>
							</div>

							<div class="form-group form-float">
								<div class="input-group">
									<label>Password</label>
									<div class="form-line">
										<input type="password" class="form-control" name="password" id="password" oninput="myFN()" placeholder="Enter your Password">
									</div>
									<span id="msg2" style="font-size:12px;color:red;font-weight:bold;"></span>
								</div>
							</div>

							<button class="btn btn-block btn-lg btn-success waves-effect" type="submit" name="signin"> <span class="material-icons">login</span></button>
							<hr>

						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div>
				<p style="color:white;"><i>
						<marquee behavior="alternate">
							Develop By : Mahadi hasan | Greenwich ID : 00122163
						</marquee>
				</p>
				<hr>
			</div>
		</div>
	</div>



	<script>
		function myFN() {
			var email = document.getElementById('username').value;
			var password = document.getElementById('password').value;
			if (email == "") {
				document.getElementById('msg1').innerHTML = "Please Input Your valid Email Address";
				return false;
			} else {
				document.getElementById('msg1').innerHTML = "";
			}
			if (password == "") {
				document.getElementById('msg2').innerHTML = "Please Input Your valid password";
				return false;
			} else {
				document.getElementById('msg2').innerHTML = "";
			}
		}
	</script>
	<!-- Jquery Core Js -->
	<script src="plugins/jquery/jquery.min.js"></script>
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