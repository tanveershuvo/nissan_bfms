<?php include "template/miniheader.php" ;
unset($_SESSION['nav']);
$_SESSION['nav'] = 2 ;

?>
<?php include "signin_checker.php" ?>
<title><?php echo $siteName;?> - <?php if (isset($_SESSION['com_name'])) {
    echo $_SESSION['com_name'];
};?> | All Product</title>
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
<!-- Bootstrap Select Css -->
<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
window.onload=function dataRetrieval(){
    var tbody = document.getElementById("ajaxtable");
    var tableRow="";

    $.ajax({
        type:'POST',
        url:"ajax_retrieve.php",
        data:{"product_details":1},
        dataType:"json",
        success : function(response){
            /*loop start*/

            for(var i=0;i<response.length ;i++){

                tableRow += "<tr><td><b>"+response[i].pro_name+"</b></td>"+
                "<td><b>"+response[i].unit_price+"</b> Tk</td>"+
                "<td><b>"+response[i].available+"</b> pcs</td>"+
                "<td ><a onclick='available("+response[i].pro_id+","+response[i].available+")' class='btn btn-success waves-effect' role='button'><span class='material-icons'>add</span></a></td>"+
                "<td><a onclick='edit("+response[i].pro_id+")' class='btn btn-warning a-btn-slide-text' data-toggle='modal' data-target='#edit_modal'>"+
                "<span class='material-icons'>edit</span></a></td>"+
                "</tr>";
                /*loop end*/
            }
            tbody.innerHTML = tableRow;
        }

    });
}
function edit(pro_id){

    $.ajax({
        type:'POST',
        url:"ajax_retrieve.php",
        data:{productID:pro_id},
        dataType:"json",
        success : function(response){
            document.getElementById('pro_name').value=response[0].pro_name;
            document.getElementById('unit_price').value=response[0].unit_price;
            document.getElementById('pro_id').value=response[0].pro_id;
        }
    });
}
function editAlert(){
    swal({
        title: "Product Edited Succesfully",
        type: "success",
        confirmButtonClass: "btn-primary",
        confirmButtonText: "OK",
        closeOnConfirm: true,
    }, function() {
        // Redirect the user
        window.location.href = "product_availability.php";
    });
}
function addAlert(){
    swal({
        title: "Product added Succesfully",
        type: "success",
        confirmButtonClass: "btn-primary",
        confirmButtonText: "OK",
        closeOnConfirm: true,
    }, function() {
        window.location.href = "product_availability";
    });
}

function wrongalert(){
    swal({
        title: "Duplicate Product Entry",
        type: "error",
        confirmButtonClass: "btn-primary",
        confirmButtonText: "OK",
        closeOnConfirm: true,
    }, function() {
        window.location.href = "product_availability";
    });
}


function available(pro_id, available){
    swal({
        title: "Please Input Available Product Amount!",
        text: "",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        inputPlaceholder: "Please Input Amount"
    },
    function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("Amount Required!");
            return false
        }
        if (isNaN(inputValue)) {
            swal.showInputError("Please add Numeric Value!");
            return false
        }
        if (inputValue < 0) {
            swal.showInputError("0 or (-) value not accepted!");
            return false
        }

        $.ajax({

            type:'POST',
            data:{amount:inputValue,av:available, proid:pro_id},
            url:"ajax_insertion.php",
            success : function(){
                swal({
                    title: "Available product amount added successfully",
                    text: "Which is now available",
                    type: "success",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Done",
                },
                function(){
                    window.location.href="product_availability.php";
                });
            }

        })
    });
}

function validation(){

    var unit_price= document.getElementById('up').value;

    if(isNaN(unit_price)){
        swal('Only numbers are allowed!!', '', 'warning')
        return false;
    }
    var unirice= document.getElementById('unit_price').value;

    if(isNaN(unirice)){
        swal('Only numbers are allowed!!', '', 'warning')
        return false;
    }
}
function check_info(){
    var pn= document.getElementById('pn').value;
    var up= document.getElementById('up').value;

    if (pn==""){
        swal('Product name required', '', 'warning')
        return false;
    }

    if (up==""){
        swal('Product price required', '', 'warning')
        return false;
    }

}
function check_edit_info(){
    var pro_name= document.getElementById('pro_name').value;
    var unit_price= document.getElementById('unit_price').value;
    if (pro_name==""){
        swal('Product name required', '', 'warning')
        return false;
    }
    if (unit_price==""){
        swal('Product price required', '', 'warning')
        return false;
    }
}

</script>
<style>
a.btn:hover {
    -webkit-transform: scale(1.1);
    -moz-transform: scale(1.1);
    -o-transform: scale(1.1);
}
a.btn {
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    -webkit-transition-duration: 0.5s;
    -moz-transition-duration: 0.5s;
    -o-transition-duration: 0.5s;
}

</style>
`</head>

<?php include "template/mininavbar.php" ?>


<section class="content">
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <h4>Products Manage</h4>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <button type="button" class="col-lg-offset-9 col-md-offset-4 col-sm-offset-4 col-xs-offset-5 btn btn-success waves-effect m-r-30" data-toggle="modal" data-target="#largeModal"><i class="material-icons">save</i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="table-responsive">
                                <table  id = "table" class="table">
                                    <thead>
                                        <tr>
                                            <th> Name</th>
                                            <th> Per Rate</th>
                                            <th>Total amount</th>
                                            <th>Add Quantity</th>
                                            <th>Update</th>
                                    </tr>
                                    </thead>

                                    <tbody id="ajaxtable">

                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>



                </div>
            </div>
            <!-- #END# Custom Content -->
        </div>
    </section>

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

    <!-- Jquery Knob Plugin Js -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- Sweet Alert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/charts/jquery-knob.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <?php
    include_once 'dbCon.php';
    $conn= connect();

    if (isset($_POST['submit'])) {
        $comID		=$_SESSION['com_id'];
        $productname = $_POST['pro_name'];
        $unitprice 	 = $_POST['u_price'];
        $comID = $_SESSION['com_id'];
        $sql = "SELECT * from product_details where com_id='$comID' and pro_name='$productname'";

        $result = $conn->query($sql);
        if ($result->num_rows < 1) {
            $sql = "INSERT INTO `product_details`(`pro_name`,`unit_price`,`com_id`) VALUES ('$productname','$unitprice','$comID')";
            $conn->query($sql);
            echo '<script type="text/javascript"> addAlert(); </script>';
        } else {
            echo '<script type="text/javascript"> wrongalert(); </script>';
        }
    }
    ?>
    <!-- CREATE MODAL ----------------------------------------------------------------------------------------------------------------------------->
    <div class="body">
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" align="center" id="largeModalLabel">Add Product Details</h4><hr>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="insert_form" onsubmit="return check_info();" method ="POST" >


                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
                                    <label for="password_2">Product Name :</label>
                                </div>
                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="pro_name"  id="pn" class="form-control" placeholder="Please Enter Product Name" >
                                        </div>
                                    </div>
                                </div>
                            </div> <br>

                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
                                    <label for="password_2">Per Rate :</label>
                                </div>
                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="u_price"  id="up" oninput="validation()" class="form-control" placeholder="Please Enter Per Unit Price">
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name= "submit" id= "submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        <div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- CREATE MODAL ----------------------------------------------------------------------------------------------------------------------------->
        <?php if (isset($_POST['done'])) {
            $id = $_POST['pro_id'];
            $productname 	= $_POST['proname'];
            $unitprice 	= $_POST['uprice'];
            $sql = "UPDATE product_details SET pro_name='$productname',unit_price='$unitprice' WHERE pro_id='$id'";
            //echo $sql;exit;
            if ($conn->query($sql)) {
                echo '<script type="text/javascript"> editAlert(); </script>';
            } else {
                echo "<script>window.location.href = '500';</script>";
            }
        } ?>
        <!-- EDIT MODAL ----------------------------------------------------------------------------------------------------------------------------->
        <div class="body">
            <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" align="center" id="largeModalLabel">Edit Products :</h4></hr>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="insert_form" name="editable" onsubmit="return check_edit_info();" method ="POST" >
                                <input type="hidden" name="pro_id" id="pro_id">

                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
                                        <label for="password_2">Product Name :</label>
                                    </div>
                                    <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="proname"  id="pro_name" class="form-control" placeholder="Enter Product Name" >
                                            </div>
                                        </div>
                                    </div>
                                </div> <br>


                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 form-control-label">
                                        <label >Per Rate :</label>
                                    </div>
                                    <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="uprice" oninput="validation()" id="unit_price" class="form-control" placeholder="Enter Product rate" >
                                            </div>
                                        </div>
                                    </div>
                                </div></br>



                                <div class="modal-footer">
                                    <button type="submit" name= "done" id= "submit" class="btn btn-primary">SAVE </button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </body>

        </html>
