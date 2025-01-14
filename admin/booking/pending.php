<?php
include '../database/dbconnect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user_id = $_POST['user_id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $package_type = $_POST['package_type'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];

  // Insert the data into the booking_form table
  $insert_query = "INSERT INTO booking_form (user_id, first_name, last_name, email, package_type, check_in, check_out, booking_status) VALUES ('00', :first_name, :last_name, 'admin', :package_type, :check_in, :check_out, 'pending')";

  $stmt = $pdo->prepare($insert_query);
  $stmt->execute([
    ':first_name' => $first_name,
    ':last_name' => $last_name,
    ':package_type' => $package_type,
    ':check_in' => $check_in,
    ':check_out' => $check_out
  ]);

  // Redirect to the same page to clear form submission
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

// Prepare the SQL query
$query = "SELECT booking_id, first_name, last_name, package_type, check_in, check_out, booking_status FROM booking_form WHERE booking_status = 'pending'";

// Execute the query and fetch the results
$stmt = $pdo->prepare($query);   // Prepare the query
$stmt->execute();                // Execute the query
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as an associative array
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="../../admin/booking/pending.css">

  <!-- TITLE -->
  <title>Admin - Pending</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- SIDE NAV -->
      <?php include '../../components/admin-sidebar/sidebar.php'; ?>

      <!-- MAIN CONTENT -->
      <div class="col-12 col-md-10 p-0 bg-body-tertiary vh-100 overflow-auto main-body">
        <!-- HEADER -->
        <?php include '../../components/admin-header/header.php'; ?>

        <!-- MAIN BODY -->
        <div class="main-body container pt-5 pt-md-3 mt-5 mt-md-0">
          <!-- Heading -->
          <h3 class="mb-4 text-center"><i class="fas fa-book"></i> Booking Management</h3>

          <!-- Search Bar -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="container d-flex ">
              <input type="text" class="form-control w-50 shadow-sm rounded-0 rounded-start" placeholder="Search"
                aria-label="Search">
              <button class="btn btn-primary rounded-0 rounded-end">
                <i class="bi bi-search"></i>
              </button>
            </div>

            <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal"
              data-bs-target="#addBookingModal">Add</button>
            <a href="../../admin/history/history.php" class=" btn btn-outline-primary" type="button">History</a>
          </div>

          <!-- Add Booking Modal -->
          <div class="modal fade" id="addBookingModal" tabindex="-1" aria-labelledby="addBookingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addBookingModalLabel">Add New Booking</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="">
                    <div class="mb-3">
                      <label for="first_name" class="form-label">First Name</label>
                      <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                      <label for="last_name" class="form-label">Last Name</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                      <label for="package_type" class="form-label">Package Type</label>
                      <select class="form-select" id="package_type" name="package_type" required>
                        <option value="Essential">Essential</option>
                        <option value="Deluxe">Deluxe</option>
                        <option value="Supreme">Supreme</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="check_in" class="form-label">Check-in Date</label>
                      <input type="date" class="form-control" id="check_in" name="check_in" required
                        min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-3">
                      <label for="check_out" class="form-label">Check-out Date</label>
                      <input type="date" class="form-control" id="check_out" name="check_out" required
                        min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-primary d-flex justify-content-center">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- TABLE -->
          <div class="table-responsive shadow rounded bg-secondary">
            <table class="table table-hover table-bordered align-middle mb-0">
              <thead class="table-dark">
                <tr>
                  <th>Booking ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Package Type</th>
                  <th>Check-in Date</th>
                  <th>Check-out Date</th>
                  <th>Booking Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($bookings as $row) { ?>
                  <tr>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['package_type']; ?></td>
                    <td><?php echo $row['check_in']; ?></td>
                    <td><?php echo $row['check_out']; ?></td>
                    <td><span class="badge bg-warning text-dark"><?php echo $row['booking_status']; ?></span></td>
                    <td><a href="#" class=" btn btn-primary me-1" type="button">Confirm</a> <a href="#"
                        class=" btn btn-danger" type="button">Delete</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- PAGINATION -->
          <div class="d-flex justify-content-between align-items-center mt-3">
            <p class="mb-0">Showing 1 to 3 of 50 bookings</p>
            <nav aria-label="Page navigation">
              <ul class="pagination mb-0">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">
                    <i class="bi bi-arrow-left"></i>
                  </a>
                </li>
                <li class="page-item active">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">
                    <i class="bi bi-arrow-right"></i>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <br><br><br>
        </div>
        <!-- END MAIN BODY -->

        <br><br><br><br>
      </div>
    </div>
  </div>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Close the PDO connection
$pdo = null;
?>