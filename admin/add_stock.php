<?php
session_start();
include '../assets/constant/config.php';
 
  
  

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<?php include('include/sidebar.php'); ?>
<!-- Top Bar End -->
<?php include('include/header.php'); ?>
<div class="page-content-wrapper ">
    <div class="row tittle">
        <div class="top col-md-5 align-self-center">
            <h5>Add Stock Management</h5>
        </div>
        <div class="col-md-7  align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add Stock</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
        <!--   -->
            <div class="col-lg-8" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="home" role="tabpanel">
                                <form id="add_employee" method="POST" action="app/employee_crud.php">
                                    <div class="form-group">
                                        <div class="row">
        <!--   -->
                                            <label class="col-sm-3 control-label">Fuel Type</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="fuleType" name="fuleType">
                                                    <option value="">~~SELECT~~</option>
                                                    <option value="1">Petrol</option>
                                                    <option value="2">Disel</option>
                                                    <option value="3">Power</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
        <!--   -->
                                            <label class="col-sm-3 control-label">Volume</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="volume" placeholder="Volume" name="volume">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
        <!--   -->
                                            <label class="col-sm-3 control-label">Invoice Number</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="invoice" placeholder="Invoice number" name="invoice">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
        <!--   -->
                                            <label class="col-sm-3 control-label">Vehicle Number</label>
                                            <div class="col-sm-9">
                                                <input type="tel" class="form-control" id="vehicle" placeholder="Vehicle number" name="vehicle">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
        <!--   -->
                                            <label class="col-sm-3 control-label">Date</label>
                                            <div class="col-sm-9">
                                                <input type="tel" class="form-control" id="date" placeholder="Date" name="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
        <!--   -->
                                            <label class="col-sm-3 control-label">Fuel Price</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="price" placeholder="Fuel Price" name="price"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
        <!--   -->
                                            <label class="col-sm-3 control-label">Fuel Density</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="density" placeholder="Fuel Density" name="density"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <button class="btn btn-primary" type="submit" name="submit" onclick="">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div> <!-- Page content Wrapper -->
</div> <!-- content -->
<?php include('include/footer.php'); ?>


<script>
    function validateemployee() {
        // Custom method to check if the input contains only spaces
        $.validator.addMethod("noSpacesOnly", function(value, element) {
            return value.trim() !== '';
        }, "Please enter a non-empty value");

        // Custom method to check if the input contains only alphabet characters
        $.validator.addMethod("lettersonly", function(value, element) {
            return /^[a-zA-Z\s]*$/.test(value);
        }, "Please enter alphabet characters only");

        // Custom method to check if the input contains only digits
        $.validator.addMethod("noDigits", function(value, element) {
            return !/\d/.test(value);
        }, "Please enter a value without digits");

        $('#add_employee').validate({
            rules: {
                employeeName: {
                    required: true,
                    noSpacesOnly: true,
                    lettersonly: true
                },
                employeeEmail: {
                    required: true,
                    email: true
                },
                employeePhone: {
                    required: true,
                    noSpacesOnly: true,
                    digits: true,
                    maxlength: 10,
                    minlength: 10
                },
                employeeAccountNo: {
                    required: true,
                    noSpacesOnly: true,
                    digits: true,
                    minlength: 8
                },
                employeeAddress: {
                    required: true,
                    noSpacesOnly: true
                },
                shift: {
                    required: true
                }
            },
            messages: {
                employeeName: {
                    required: "Please enter a Employee name",
                    lettersonly: "Only alphabet characters are allowed"
                },
                employeeEmail: {
                    required: "Please enter a Employee email",
                    email: "Please enter a valid email address"
                },
                employeePhone: {
                    required: "Please enter a Employee phone number",
                    noDigits: "Employee phone number should not contain digits"
                },
                employeeAccountNo: {
                    required: "Please enter a Employee Account number",
                    noDigits: "Employee Account number should not contain digits"
                },
                employeeAddress: {
                    required: "Please enter a Employee address"
                },
                shift: {
                    required: "Please select a Employee shift"
                }
            }
        });
}
</script>