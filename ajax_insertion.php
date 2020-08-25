<?php
    include_once 'dbCon.php';
	$conn= connect();


	session_start();

	if ($_REQUEST['oid']){
	$id = $_POST['oid'];
	$de = $_POST['due'];
	$pd = $_POST['pid'];
	$due = $de + $pd;
	$sql="UPDATE `order_details` SET `paid`= '$due'  WHERE order_id='$id'";
	$conn->query($sql);
	}

	if ($_REQUEST['sorID']){
	$pay = $_POST['pay'];
	$sd = $_POST['sorID'];
	$name = $_SESSION['NAME'];
	$today = date("Y-m-d");
	$payID=$_SESSION['pay_id'];
	$sql="INSERT INTO sordar_weekly_bill(sor_id,date,weekly_bill,paid_by,pay_id) VALUES('$sd','$today' ,'$pay' , '$name','$payID') ";
	$conn->query($sql);
	}

	if ($_REQUEST['pay_id']){
	$pay = $_POST['pay_id'];
	$sql="UPDATE `employee_payment` SET `payment_status`= 'paid'  WHERE emp_pay_id='$pay'";
	$conn->query($sql);
	}

	if ($_REQUEST['pay']){
	$pay = $_POST['pay'];
	$sd = $_SESSION['sordar_id'];
	$name = $_SESSION['NAME'];
	$today = date("Y-m-d");
	$payID=$_SESSION['pay_id'];
	$sea_id = $_SESSION['sea_id'];
	$sql="INSERT INTO sordar_weekly_bill(sor_id,date,weekly_bill,paid_by,pay_id,sea_id) VALUES('$sd','$today' ,'$pay' , '$name','$payID','$sea_id')";
	$conn->query($sql);
	}
	if ($_REQUEST['amount']){
	$available = $_POST['av'];
	$amount = $_POST['amount'];
	$total=($available+$amount);
	$pid = $_POST['proid'];
	$sql="UPDATE `product_details` SET `available`= '$total'  WHERE pro_id='$pid'";
	$conn->query($sql);
	}


?>
