<div class="modal fade" id="edit_modal<?=$row['emp_id']?>" tabindex="-1" role="dialog">
<?php
	include_once 'dbCon.php';
	$conn= connect();
	
	if (isset($_POST['sbmt'])){
	$eID =$row['emp_id'];
	$emp_name 	= mysqli_real_escape_string($conn,$_POST['eName']);
	$email		= mysqli_real_escape_string($conn,$_POST['eEmail']);
	$des 		= mysqli_real_escape_string($conn,$_POST['desig']);
	$msalary	= mysqli_real_escape_string($conn,$_POST['eMonthly']);
	$mob	 	= mysqli_real_escape_string($conn,$_POST['phone']);
	$addrs 		= mysqli_real_escape_string($conn,$_POST['addres']);
	$sql = "Update employee_details SET emp_name='$emp_name',emp_email='$email',emp_address='$addrs',emp_phone='$mob',emp_des='$des',emp_salary='$msalary' WHERE emp_id='$eID' ";
	$results=$conn->query($sql);
	}
	if (isset($row['emp_id'])){
	$SQL = "select * from employee_details where emp_id = ".$row['emp_id']."";
	$results=$conn->query($SQL);
	foreach ($results as $row){	
	$name= $row['emp_name'];
	$email = $row['emp_email'];
	$des = $row['emp_des'];
	$salary = $row['emp_salary'];
	$address = $row['emp_address'];
	$phone = $row['emp_phone'];
	
	}
?>		
                           
                               <div class="modal-dialog modal-lg" role="document">
                                   <div class="modal-content">
									   <div class="modal-header">
                                           <h4 class="modal-title" align="center" >Edit<?=$row['emp_id']?> Employee Information Here </h4><hr>
                                       </div>
                                       <div class="modal-body">
										 <form class="form-horizontal" id="insert_form" onsubmit="return check_in();" method ="POST" >
										   <div class="row clearfix">
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
                                                    <label >Employee Name :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="eName" id="eName"  class="form-control"  value="<?=$name?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											<div class="row clearfix">
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label" >
                                                    <label for="password_2">Email:</label>
                                                </div>
                                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="eEmail" id="eEmail" class="form-control" value ="<?=$email?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row clearfix">
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
                                                    <label for="password_2">Designation :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="desig"  id="desig" class="form-control" value="<?=$des?>"  >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
											<div class="row clearfix">
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
                                                    <label for="password_2">Monthly Salary :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="eMonthly" oninput="validate()"  id="eMonthly" class="form-control" value="<?=$salary?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
								            <div class="row clearfix">
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label" >
                                                    <label for="password_2">Phone No :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="phone" id="phone" oninput="validate()" class="form-control" value="<?=$phone?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
											  <div class="row clearfix">
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label" >
                                                    <label for="password_2">Address :</label>
                                                </div>
                                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="addres" id="addres" class="form-control" value="<?=$address?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                       <div class="modal-footer">
                                           <button type="submit" name= "sbmt" id= "submit" class="btn btn-primary waves-effect"> SAVE</button>
                                           <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                                       </div>
									  </form>
                                   </div>
                               </div>
                           </div>
					
	<?php } ?>		
<script>		
		function check_in(){
			var name= document.getElementById('eName').value;
			var des= document.getElementById('desig').value;
			var salary= document.getElementById('eMonthly').value;
			var email= document.getElementById('eEmail').value;
			var mob= document.getElementById('phone').value;
			var address = document.getElementById('addres').value;
			
			if (name==""){
				swal('Please input customer name', '', 'warning')
				return false;
			}
			
			if (des==""){
				swal('Please input designation ', '', 'warning')
				return false;
			}
			if (salary==""){
				swal('Please input salary', '', 'warning')
				return false;
			}
			if (email==""){
				swal('Please input employee email', '', 'warning')
				return false;
			}
			if (mob==""){
				swal('Please input mobile number', '', 'warning')
				return false;
			}
			if (address==""){
				swal('Please input address', '', 'warning')
				return false;
			}
			if(mob.length != 11){
				swal('Mobile Number Must be 11 digit!!', '', 'warning');
				document.getElementById('phone').value='';
				return false;					
			}
			
			
		}
		function valmail(){
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('email').value)){
			document.getElementById('msg4').innerHTML = "";
				return (true)
			} else{
			document.getElementById('msg4').innerHTML = "**You have entered an invalid email address!!!";
			
				return (false)	
			}
		}
		function validate(){
			var salary= document.getElementById('eMonthly').value;
			var mob= document.getElementById('phone').value;
			
			 if(isNaN(salary)){
				swal('Salary contains only numbers!!', '', 'warning')
				document.getElementById('eMonthly').value='';
				return false;					
			}
			else if(isNaN(mob)){
				swal('Mobile number conatins only letter!!', '', 'warning')
				document.getElementById('phone').value='';
				return false;					
			}			
		}
</script>