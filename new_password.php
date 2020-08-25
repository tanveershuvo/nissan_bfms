<?php 
session_start();
include "signin_checker.php" ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Forgot Password | </title>
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
	<script>
	function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
	</script>
</head>
<?php 
	include_once 'dbCon.php';
	$conn = connect();
	if (isset($_POST['submit'])){
		$pass	=	mysqli_real_escape_string($conn,md5($_POST['password']));
		$email 	=	mysqli_real_escape_string($conn,$_SESSION["email"]);
		$sql 	= "UPDATE login_details SET password='$pass' WHERE email='$email'";
		$conn->query($sql);
		$sql 	= "SELECT * FROM `login_details` WHERE `email`='$email'";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$_SESSION['isLoggedIn'] = TRUE;
			foreach($result as $row){
				if ($row['role']=='emp'){
					$id = $row['log_id'];
					$sql = "select * from employee_details where emp_id='$id'";
					$result=$conn->query($sql);
					$result = mysqli_fetch_assoc($result);
					$cID=$result['com_id'];
					$_SESSION['NAME']=$result['emp_name'];
					$sql = "select * from company where com_id='$cID'";
					$results=$conn->query($sql);
					$tf = mysqli_fetch_assoc($results);
					$_SESSION['com_id']=$tf['com_id'];
					$_SESSION['com_name']=$tf['company_name'];
					header('location:season_details.php');
				}else{
					$_SESSION['NAME']=$row['email'];
					header('location:company.php');
				}						
			}	
		}
		$sql = "UPDATE login_details SET otp='' WHERE email='$email'";
		$conn->query($sql);
	}
?>
<body class="fp-page">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">Brick Factory Management System</a>
        </div>
        <div class="card">
            <div class="body">
                <form id="forgot_password" method="POST">
                    <div class="msg">
                       <b>Please Insert New Password to Continue</b>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="myInput" name="password" placeholder="New Password" required autofocus>
                        </div>
                    </div>
					<div class="col-xs-12 align-right">
                          <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" onclick="myFunction()" class="filled-in chk-col-pink">
                            <label for="rememberme">Show Password</label>
                        </div>
                        </div><br>
                    <button class="btn btn-block btn-lg bg-pink waves-effect" name="submit" type="submit">DONE</button>
                </form>
            </div>
        </div>
    </div>
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
    <script src="js/pages/examples/forgot-password.js"></script>
  </body>
</html>