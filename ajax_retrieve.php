<?php

session_start();

include_once 'dbCon.php';
$conn = connect();

if (isset($_POST['display'])) {
	$cusid = $_SESSION['customer_id'];
	$sql = "SELECT * , (SUM(total_price)-SUM(paid)) as 'Total_Due' FROM
           	order_details as o , customer_details as c
	        WHERE o.cus_id=c.cus_id AND o.cus_id = '$cusid'";

	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'Total_Due' => $row['Total_Due'],
			'cus_name' => $row['cus_name'],

		];
	};
	//print_r ($array);
	echo json_encode($array);
}
if (isset($_POST['sordar_total_due'])) {
	$sorid = $_SESSION['sordar_id'];
	$sql = "SELECT * , (SUM(bill)-SUM(advance)) as 'Total_Due' FROM
           	sordar_payment as sp , sordar_details as sd
	        WHERE sp.sor_id=sd.sor_id AND sp.sor_id = '$sorid'";

	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'Total_Due' => $row['Total_Due'],
			'sor_name' => $row['sor_name'],
			'sor_phone' => $row['sor_phone'],
		];
	};
	echo json_encode($array);
}

if (isset($_POST['total'])) {
	$cusid = $_SESSION['customer_id'];
	$sql = "SELECT *,sea_name FROM order_details as o , customer_details as c , season as s , product_details as p
	WHERE o.cus_id=c.cus_id AND o.sea_id=s.sea_id AND p.pro_id=o.pro_id AND o.cus_id = '$cusid' ORDER BY (total_price-paid) DESC";
	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'order_id' => $row['order_id'],
			'cus_id' => $row['cus_id'],
			'pro_name' => $row['pro_name'],
			'unit_price' => $row['unit_price'],
			'quantity' => $row['quantity'],
			'total_price' => $row['total_price'],
			'paid' => $row['paid'],
			'order_date' => $row['order_date'],
			'inserted_by' => $row['inserted_by'],
			'sea_name' => $row['sea_name'],
		];
	};
	//print_r ($array);
	echo json_encode($array);
}



if (isset($_POST['sordar_name_check'])) {
	$sql = "SELECT * from sordar_details ";

	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'sor_name' => $row['sor_name'],
			'sor_phone' => $row['sor_phone'],
		];
	};
	echo json_encode($array);
}

if (isset($_POST['emp_salary'])) {
	$sql = "SELECT * FROM employee_details as e , employee_payment as p WHERE e.emp_id=p.emp_id ";

	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'emp_name' => $row['emp_name'],
			'emp_phone' => $row['emp_phone'],
			'emp_des' => $row['emp_des'],
			'salary' => $row['salary'],
			'date' => $row['date'],
			'emp_pay_id' => $row['emp_pay_id'],
			'status' => $row['status'],
		];
	};
	echo json_encode($array);
}


if (isset($_POST['empID'])) {
	$id = $_POST['empID'];
	$sql = "SELECT * FROM employee_details as e , employee_payment as p WHERE e.emp_id=p.emp_id AND e.emp_id='$id' ";

	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'emp_id' => $row['emp_id'],
			'emp_name' => $row['emp_name'],
			'emp_phone' => $row['emp_phone'],
			'emp_des' => $row['emp_des'],
			'salary' => $row['salary'],
			'emp_email' => $row['emp_email'],
			'emp_address' => $row['emp_address'],
		];
	};
	echo json_encode($array);
}
if (isset($_POST['employee_details'])) {
	$comID = $_SESSION['com_id'];
	$access = $_SESSION['access'];
	if ($access == 1) {
		$sql = "SELECT * FROM employee_details where com_id='$comID' and status=0 and emp_des='Manager'  ORDER BY emp_name ASC ";
	} else {
		$sql = "SELECT * FROM employee_details where com_id='$comID' and status=0  and emp_des='Staff' ORDER BY emp_name ASC ";
	}
	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'emp_id' => $row['emp_id'],
			'emp_name' => (string)$row['emp_name'],
			'emp_address' => $row['emp_address'],
			'emp_email' => $row['emp_email'],
			'emp_phone' => $row['emp_phone'],
			'emp_des' => $row['emp_des'],
			'emp_salary' => $row['emp_salary'],
		];
	};
	echo json_encode($array);
}

if (isset($_POST['product_details'])) {
	$comID = $_SESSION['com_id'];
	$sql = "SELECT * FROM product_details where com_id='$comID' ORDER BY pro_name ASC ";

	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'pro_id' => $row['pro_id'],
			'pro_name' => (string)$row['pro_name'],
			'unit_price' => (float)$row['unit_price'],
			'available' => (int)$row['available'],
		];
	};
	echo json_encode($array, JSON_NUMERIC_CHECK);
}


if (isset($_POST['av'])) {

	$pId = $_POST['av'];

	$sql = "SELECT * FROM product_details WHERE pro_id='$pId' ";

	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'pro_id' => $row['pro_id'],
			'pro_name' => $row['pro_name'],
			'unit_price' => $row['unit_price'],
			'available' => $row['available'],
		];
	};
	echo json_encode($array);
}


if (isset($_POST['mechinaries'])) {
	$comID = $_SESSION['com_id'];
	$sql = "SELECT * FROM mechinaries_details where com_id='$comID' ";

	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'm_id' => $row['m_id'],
			'rate' => $row['rate'],
			'type' => $row['type'],
			'quantity' => $row['quantity'],
			'name' => $row['name'],
			'receipt' => $row['receipt'],
			'date' => $row['date'],
		];
	};
	echo json_encode($array);
}

if (isset($_POST['mID'])) {
	$id = $_POST['mID'];
	$sql = "SELECT * FROM mechinaries_details where m_id='$id' ";

	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'm_id' => $row['m_id'],
			'rate' => $row['rate'],
			'type' => $row['type'],
			'quantity' => $row['quantity'],
			'name' => $row['name'],
			'receipt' => $row['receipt'],
			'date' => $row['date'],
		];
	};

	echo json_encode($array);
}

if (isset($_POST['c_ID'])) {

	$_SESSION['com_id'] = $_POST['c_ID'];
	$_SESSION['com_name'] = $_POST['com_name'];
	$_SESSION['image'] = $_POST['image'];
}
if (isset($_POST['empp_id'])) {

	$_SESSION['mailID'] = $_POST['empp_id'];
}
if (isset($_POST['s_ID'])) {

	$_SESSION['sea_id'] = $_POST['s_ID'];
	$_SESSION['sea_name'] = $_POST['s_name'];
}
if (isset($_POST['eID'])) {

	$_SESSION['eID'] = $_POST['eID'];
}
if (isset($_POST['sorID'])) {
	$_SESSION['sordar_id'] = $_POST['sorID'];
}

if (isset($_POST['cusID'])) {

	$_SESSION['cusID'] = $_POST['cusID'];
}
if (isset($_POST['oID'])) {

	$_SESSION['oID'] = $_POST['oID'];
}

if (isset($_POST['pID'])) {

	$_SESSION['pID'] = $_POST['pID'];
}
if (isset($_POST['productID'])) {
	$id = $_POST['productID'];
	$sql = "SELECT * FROM product_details where pro_id='$id' ";
	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'pro_id' => $row['pro_id'],
			'pro_name' => $row['pro_name'],
			'unit_price' => $row['unit_price'],
		];
	};
	echo json_encode($array);
}
if (isset($_POST['resignID'])) {
	$id = $_POST['resignID'];
	$sql = "Update employee_details SET status=1 where emp_id='$id' ";
	$result = $conn->query($sql);
	$array;

	echo json_encode($array);
}

if (isset($_POST['employeeID'])) {
	$id = $_POST['employeeID'];
	$sql = "SELECT * FROM employee_details where emp_id='$id' ";
	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'emp_id' => $row['emp_id'],
			'emp_name' => $row['emp_name'],
			'emp_address' => $row['emp_address'],
			'emp_email' => $row['emp_email'],
			'emp_phone' => $row['emp_phone'],
			'emp_des' => $row['emp_des'],
			'emp_salary' => $row['emp_salary'],
		];
	};
	echo json_encode($array);
}

if (isset($_POST['pie'])) {
	$sql = "SELECT `pro_name`, COUNT(`order_id`)as 't' FROM order_details GROUP BY pro_name";
	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'pro_name' => $row['pro_name'],
			'a' => $row['t'],
		];
	};
	echo json_encode($array);
}


if (isset($_POST['weekly_bill'])) {
	$sorid = $_SESSION['sordar_id'];
	$sID = $_SESSION['sea_id'];
	$sql = "SELECT *  FROM sordar_weekly_bill as sw , season as s WHERE s.sea_id=sw.sea_id AND sor_id='$sorid' AND sw.sea_id='$sID'";
	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'date' => $row['date'],
			'weekly_bill' => $row['weekly_bill'],
			'paid_by' => $row['paid_by'],
			'sea_name' => $row['sea_name'],
		];
	};
	//print_r ($array);
	echo json_encode($array);
}
if (isset($_POST['weeklytotal'])) {
	$sorid = $_SESSION['sordar_id'];
	$sID = $_SESSION['sea_id'];
	$sql = "SELECT IFNULL(sum(weekly_bill),0) as 'total'  FROM sordar_weekly_bill WHERE sor_id='$sorid' AND sea_id='$sID'";
	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'total' => $row['total']
		];
	};
	echo json_encode($array);
}

if (isset($_POST['balance'])) {
	$sorid = $_SESSION['sordar_id'];
	$sID = $_SESSION['sea_id'];
	$sql = "SELECT IFNULL(advance,0) as 'total'
	FROM sordar_payment as sp WHERE
  sp.sor_id='$sorid' AND sp.sea_id='$sID' ";
	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'total' => $row['total']
		];
	};
	//print_r ($array);
	echo json_encode($array);
}

if (isset($_POST['delivery'])) {
	$sorid = $_SESSION['sordar_id'];
	$sID = $_SESSION['sea_id'];
	$sql = "SELECT IFNULL(SUM(total_bill),0) as 'total' FROM sordar_delivery_status WHERE sea_id = '$sID' AND sor_id = '$sorid' ";
	$result = $conn->query($sql);
	$array;
	while ($row = mysqli_fetch_array($result)) {
		$array[] = [
			'total' => $row['total']
		];
	};
	echo json_encode($array);
}
