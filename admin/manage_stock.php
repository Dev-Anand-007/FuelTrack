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
      <h5>View Stock</h5>
    </div>

    <div class="col-md-7  align-self-center">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">View Stock</li>
      </ol>
    </div>
  </div>

  <div class="container-fluid">

    <!-- end page title end breadcrumb -->

    <div class="row">
      <!--   -->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="btn-group float-left">
              <a href="add_stock.php" class="btn btn-primary mb-3">Add Stock</a>
            </div>

            <div class="table-responsive">

              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;" enctype="multipart/form-data">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>Fuel type</th>
                    <th>Date</th>
                    <th>Morning density</th>
                    <th>Morning temperature</th>
                    <th>Morning observed</th>
                    <th>Invoice number</th>
                    <th>Volume</th>
                    <th>Vehicle number</th>
                    <th>Fuel price</th>
                    <th>Truck density</th>
                    <th>truck temperature</th>
                    <th>truck observed</th>
                    <th>After decantation density</th>
                    <th>After decantation temperature</th>
                    <th>After decantation observed</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $stmt = $conn->prepare("SELECT * FROM `add_stock` WHERE delete_status='0' ");
                  $stmt->execute();
                  $record = $stmt->fetchAll();
                  $i = 1;
                  foreach ($record as $key) { ?>


                    <tr>

                      <td><?php echo $i; ?></td>
                      <td>
                        <?php
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
                        ?>
                      </td>
                      <td><?php echo $key['date']; ?></td>
                      <td><?php echo $key['morning_density']; ?></td>
                      <td><?php echo $key['morning_temp']; ?></td>
                      <td><?php echo $key['morning_observed']; ?></td>
                      <td><?php echo $key['invoice_number']; ?></td>
                      <td><?php echo $key['volume']; ?></td>
                      <td><?php echo $key['vehicle_number']; ?></td>
                      <td><?php echo $key['fuel_price']; ?></td>
                      <td><?php echo $key['truck_density']; ?></td>
                      <td><?php echo $key['truck_temp']; ?></td>
                      <td><?php echo $key['truck_observed']; ?></td>
                      <td><?php echo $key['after_decantation_density']; ?></td>
                      <td><?php echo $key['after_decantation_temp']; ?></td>
                      <td><?php echo $key['after_decantation_observed']; ?></td>

                      <td>
                        <a href="#" onclick="editForm(event, <?php echo $key['id']; ?>,'edit_stock.php')"
                          class="btn btn-primary waves-effect waves-light"><i class="fa fa-edit" aria-hidden="true"></i>

                        </a>


                        <a href="#" class="btn btn-danger"
                          onclick="return confirm('Are you sure you want to delete this item?') && delForm(event, <?php echo $key['id']; ?>,'app/stock_crud.php' );"><i
                            class="fa fa-trash-alt" aria-hidden="true"></i></a>



                      </td>
                    </tr>
                    <?php $i++;
                  } ?>
                </tbody>
                </tbody>

              </table>
            </div><!--end /tableresponsive-->
          </div><!--end card-body-->
        </div><!--end card-->
      </div><!--end col-->
    </div><!--end row-->
  </div> <!-- Page content Wrapper -->

</div> <!-- content -->

<?php include('include/footer.php'); ?>


<?php if (!empty($_SESSION['success'])) { ?>
  <script>
    setTimeout(function () {
      swal({
        title: "Congratulaions!",
        text: "Data Added Successfully",
        type: "success",
        confirmButtonText: "Ok"
      }, function () {
        window.location = "manage_stock.php";
      }, 1000);
    });
  </script>
  <p><?php $_SESSION['success'] = '';
} ?></p>


<?php if (!empty($_SESSION['update'])) { ?>
  <script>
    setTimeout(function () {
      swal({
        title: "Congratulaions!",
        text: "Record Updated",
        type: "success",
        confirmButtonText: "Ok"
      }, function () {
        window.location = "manage_stock.php";
      }, 1000);
    });
  </script>
  <p><?php $_SESSION['update'] = '';
} ?></p>

<?php if (!empty($_SESSION['delete'])) { ?>
  <script>
    setTimeout(function () {
      swal({
        title: "Congratulaions!",
        text: "Record Deleted",
        type: "success",
        confirmButtonText: "Ok"
      }, function () {
        window.location = "manage_stock.php";
      }, 1000);
    });
  </script>
  <p><?php $_SESSION['delete'] = '';
} ?></p>