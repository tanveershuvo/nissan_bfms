<?php include "template/miniheader.php" ?>
<?php include "signin_checker.php" ?>
<title>CUSTOMER RECEIPT</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" **media="screen"**  rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js" **media="screen"** ></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js" **media="screen"** ></script>

<!------ Include the above in your HEAD tag ---------->
<style>

.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
@media print {
  .hide-from-printer{  display:none; }
}
</style>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
<?php

	include_once 'dbCon.php';
	$conn= connect();
		$id = $_SESSION['oID'];
		$sql = "SELECT * FROM order_details as o, customer_details as c WHERE c.cus_id=o.cus_id AND o.order_id = '$id'";
    //echo $sql;exit;
    $results=$conn->query($sql);
    $row = mysqli_fetch_assoc($results);
		$oID = $row['order_id'];
		$pID = $row['pro_id'];
    $ssql = "SELECT * FROM product_details WHERE pro_id='$pID'";
    $result=$conn->query($ssql);
    $rows = mysqli_fetch_assoc($result);
    $pn = $rows['pro_name'];
		$up = $row['unit_price'];
		$qt = $row['quantity'];
		$tp = $row['total_price'];
		$pd = $row['paid'];
		$od = $row['order_date'];
		$cn = $row['cus_name'];
		$cp = $row['cus_phone'];
		$ca = $row['cus_address'];
		$by = $row['inserted_by'];
		$due = ($tp - $pd);



?>
<section class="content" >
        <div class="container">

        <div class="col-xs-12 "><br><br>
		<img src="images/<?=$_SESSION['image']?>"
		alt="Smiley face" height="150" width="1110">
    		<div class="invoice-title ">
			<br>
    			<h2>INVOICE</h2>
				<div class="pull-right" style="font-size:18px">
				<address >
				<b>Billed By </b><br>
    			MR. X<br>
    			SINGAIR<br>
    			</address>
				</div>
    		</div>

			<div class="col-xs-12 well ">
    			<div class="col-xs-6">
					<h3>Billed To </h3>
					<h4> <?=$cn?><br></h4>
					<h4>Contact : <b><?=$cp?></b></h4>
    				<h4><?=$ca?></h4></b>
    				<address>

    			</div>
				<div class="col-xs-6 text-right">
    				<h3>Order Id : <b># <?=$oID?></b></h3>
					<h4>Order Date : <b><?php echo $od;?></b></h4>
					<h4>Inserted By : <b><?php echo $by;?></b></h4>
    			</div>
    		</div>

    	</div>


    	<div class="col-xs-12">
    				<div class="table-responsive">
    					<table class="table table-bordered table-striped table-hover " style="font-size:18px;">
    						<thead>
                                <tr>
        							<td class="text-center"><strong>Product Name</strong></td>
        							<td class="text-center"><strong>Unit Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Total Price</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td class="text-center" ><?=$pn?></td>
    								<td class="text-center"><?=$up?></td>
    								<td class="text-center"><?=$qt?></td>
    								<td class="text-right"><?=$tp?> TK</td>
    							</tr>

    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Paid </strong></td>
    								<td class="thick-line text-right"><?=$pd?> TK</td>
    							</tr>
								<?php if ($due !== 0){ ?>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Due</strong></td>
    								<td class="no-line text-right text-danger"><b><?=$due?> TK</b></td>
    							</tr>
    							<?php } ?>
    						</tbody>
    					</table>
    				</div>


    	</div>

	</br>
	<Button class="hide-from-printer btn btn-success btn-lg btn-block"  onClick="window.print()"> <span class="glyphicon glyphicon-print"> PRINT INVOICE</button>


</div>
</section>
