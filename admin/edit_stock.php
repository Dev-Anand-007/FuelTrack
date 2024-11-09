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
            <h5>Edit stock</h5>
        </div>

        <div class="col-md-7  align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Edit Stock</li>
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


                                <form id="add_stock" method="POST" action="app/stock_crud.php">
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM `add_stock` WHERE id='" . $_POST['id'] . "' ");
                                    $stmt->execute();
                                    $record = $stmt->fetchAll();

                                    foreach ($record as $key) {
                                        ?>

                                        <input class="form-control" type="hidden" name="id"
                                            value="<?php echo $key['id']; ?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <!--   -->
                                                <label class="col-sm-3 control-label">Fuel Type</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="fuelType" name="fuel_type">
                                                        <option value=""><?php
                                                        try {
                                                            $stmt = $conn->prepare("SELECT name FROM fuel_category WHERE id = :fuel_type");
                                                            $stmt->bindParam(':fuel_type', $key['fuel_type'], PDO::PARAM_INT);
                                                            $stmt->execute();
                                                            $records = $stmt->fetch();
                                                            echo htmlspecialchars($records['name'] ?? 'No fuel type was entered');
                                                        } catch (PDOException $e) {
                                                            // Handle potential database errors
                                                            echo "<option value=''>Error retrieving data</option>";
                                                        }
                                                        ?></option>
                                                        <?php
                                                        try {
                                                            // Prepare the statement
                                                            $stmt = $conn->prepare("SELECT id,name FROM fuel_category WHERE delete_status = '0'");
                                                            $stmt->execute();
                                                            $records = $stmt->fetchAll();

                                                            if (!empty($records)) {
                                                                // Loop through each record and create options
                                                                foreach ($records as $row) {
                                                                    ?>
                                                                    <option value="<?php echo htmlspecialchars($row['id']); ?>">
                                                                        <?php echo htmlspecialchars($row['name']); ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                // Fallback option if no records are found
                                                                echo "<option value=''>No options available</option>";
                                                            }
                                                        } catch (PDOException $e) {
                                                            // Handle potential database errors
                                                            echo "<option value=''>Error retrieving data</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <!--   -->
                                                <label class="col-sm-3 control-label">Date</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="date" placeholder="date"
                                                        value="<?php echo $key['date'] ?>" name="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <!--   -->
                                                <label class="col-sm-3 control-label">Morning density</label>
                                                <div class="col-sm-9">
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="morning_density" placeholder="Morning density"
                                                        value="<?php echo $key['morning_density'] ?>"
                                                        name="morning_density">
                                                    <input type="number" step="0.01" class="form-control" id="morning_temp"
                                                        placeholder="Morning temperature"
                                                        value="<?php echo $key['morning_temp'] ?>" name="morning_temp">
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="morning_observed" placeholder="Morning observed"
                                                        value="<?php echo $key['morning_observed'] ?>"
                                                        name="morning_observed">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <!--   -->
                                                <label class="col-sm-3 control-label">Invoice number</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="invoice_number"
                                                        placeholder="Invoice number"
                                                        value="<?php echo $key['invoice_number'] ?>" name="invoice_number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <!--   -->
                                                <label class="col-sm-3 control-label">Volume</label>
                                                <div class="col-sm-9">
                                                    <input type="number" step="0.01" class="form-control" id="volume"
                                                        placeholder="volume" value="<?php echo $key['volume'] ?>"
                                                        name="volume">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <!--   -->
                                                <label class="col-sm-3 control-label">Vehicle number</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="vehicle_number"
                                                        placeholder="Vehicle number"
                                                        value="<?php echo $key['vehicle_number'] ?>" name="vehicle_number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <!--   -->
                                                <label class="col-sm-3 control-label">Fuel price</label>
                                                <div class="col-sm-9">
                                                    <input type="number" step="0.01" class="form-control" id="fuel_price"
                                                        placeholder="Fuel price" value="<?php echo $key['fuel_price'] ?>"
                                                        name="fuel_price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <!--   -->
                                                <label class="col-sm-3 control-label">Truck tank</label>
                                                <div class="col-sm-9">
                                                    <input type="number" step="0.01" class="form-control" id="truck_density"
                                                        placeholder="truck density"
                                                        value="<?php echo $key['truck_density'] ?>" name="truck_density">
                                                    <input type="number" step="0.01" class="form-control" id="truck_temp"
                                                        placeholder="truck temperature"
                                                        value="<?php echo $key['truck_temp'] ?>" name="truck_temp">
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="truck_observed" placeholder="truck observed"
                                                        value="<?php echo $key['truck_observed'] ?>" name="truck_observed">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <!--   -->
                                                <label class="col-sm-3 control-label">After decantation</label>
                                                <div class="col-sm-9">
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="after_decantation_density"
                                                        placeholder="After dacantation density"
                                                        value="<?php echo $key['after_decantation_density'] ?>"
                                                        name="after_decantation_density">
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="after_decantation_temp"
                                                        placeholder="After dacantation temperature"
                                                        value="<?php echo $key['after_decantation_temp'] ?>"
                                                        name="after_decantation_temp">
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="after_decantation_observed"
                                                        placeholder="After dacantation observed"
                                                        value="<?php echo $key['after_decantation_observed'] ?>"
                                                        name="after_decantation_observed">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <button class="btn btn-primary" type="submit" name="update"
                                                onclick="validatestock()">Submit</button>
                                        </div>

                                    <?php } ?>
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
    function validatestock() {
        // Custom method to check if the input contains only spaces
        $.validator.addMethod("noSpacesOnly", function (value, element) {
            return value.trim() !== '';
        }, "Please enter a non-empty value");

        // Custom method to check if the input contains only alphabet characters
        $.validator.addMethod("lettersonly", function (value, element) {
            return /^[a-zA-Z\s]*$/.test(value);
        }, "Please enter alphabet characters only");

        // Custom method to check if the input contains only digits
        $.validator.addMethod("noDigits", function (value, element) {
            return !/\d/.test(value);
        }, "Please enter a value without digits");

        $('#add_stock').validate({
            rules: {
                stockName: {
                    required: true,
                    noSpacesOnly: true,
                    lettersonly: true
                },
                stockEmail: {
                    required: true,
                    email: true
                },
                stockPhone: {
                    required: true,
                    noSpacesOnly: true,
                    digits: true,
                    maxlength: 10,
                    minlength: 10
                },
                stockAccountNo: {
                    required: true,
                    noSpacesOnly: true,
                    digits: true,
                    minlength: 8
                },
                stockAddress: {
                    required: true,
                    noSpacesOnly: true
                },
                shift: {
                    required: true
                }
            },
            messages: {
                stockName: {
                    required: "Please enter a stock name",
                    lettersonly: "Only alphabet characters are allowed"
                },
                stockEmail: {
                    required: "Please enter a stock email",
                    email: "Please enter a valid email address"
                },
                stockPhone: {
                    required: "Please enter a stock phone number",
                    noDigits: "stock phone number should not contain digits"
                },
                stockAccountNo: {
                    required: "Please enter a stock Account number",
                    noDigits: "stock Account number should not contain digits"
                },
                stockAddress: {
                    required: "Please enter a stock address"
                },
                shift: {
                    required: "Please select a stock shift"
                }
            }
        });
    }
</script>