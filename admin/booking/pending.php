<?php
include '../database/dbconnect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $package_type = $_POST['package_type'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];

  // Insert the data into the booking_form table
  $insert_query = "INSERT INTO booking_form (first_name, last_name, email, package_type, check_in, check_out, booking_status) VALUES (:first_name, :last_name, 'admin', :package_type, :check_in, :check_out, 'pending')";

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

// Handle Confirm action
if (isset($_GET['action'], $_GET['booking_id']) && $_GET['action'] === 'confirm') {
  $booking_id = $_GET['booking_id'];

  // Update booking status to completed
  $update_query = "UPDATE booking_form SET booking_status = 'completed' WHERE booking_id = :booking_id";
  $stmt = $pdo->prepare($update_query);
  $stmt->execute([':booking_id' => $booking_id]);

  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

// Handle Cancel action
if (isset($_GET['action'], $_GET['booking_id']) && $_GET['action'] === 'cancel') {
  $booking_id = $_GET['booking_id'];

  // Update booking status to completed
  $update_query = "UPDATE booking_form SET booking_status = 'cancelled' WHERE booking_id = :booking_id";
  $stmt = $pdo->prepare($update_query);
  $stmt->execute([':booking_id' => $booking_id]);

  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

// Handle Delete action
if (isset($_GET['action'], $_GET['booking_id']) && $_GET['action'] === 'delete') {
  $booking_id = $_GET['booking_id'];

  // Fetch booking details
  $fetch_query = "SELECT * FROM booking_form WHERE booking_id = :booking_id";
  $stmt = $pdo->prepare($fetch_query);
  $stmt->execute([':booking_id' => $booking_id]);
  $booking = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($booking) {
    // Insert into history table
    $history_query = "INSERT INTO history (booking_id, user_id, first_name, last_name, email, guest, check_in, check_out, add_ons, message, package_type, booking_status) 
                      VALUES (:booking_id, :user_id, :first_name, :last_name, :email, :guest, :check_in, :check_out, :add_ons, :message, :package_type, :booking_status)";

    $stmt = $pdo->prepare($history_query);
    $stmt->execute([
      ':booking_id' => $booking['booking_id'],
      ':user_id' => $booking['user_id'],
      ':first_name' => $booking['first_name'],
      ':last_name' => $booking['last_name'],
      ':email' => $booking['email'],
      ':guest' => $booking['guest'],
      ':check_in' => $booking['check_in'],
      ':check_out' => $booking['check_out'],
      ':add_ons' => $booking['add_ons'],
      ':message' => $booking['message'],
      ':package_type' => $booking['package_type'],
      ':booking_status' => 'deleted'
    ]);

    // Delete from booking_form
    $delete_query = "DELETE FROM booking_form WHERE booking_id = :booking_id";
    $stmt = $pdo->prepare($delete_query);
    $stmt->execute([':booking_id' => $booking_id]);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }
}

// Handle filter logic
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Prepare the SQL query with filter
$query = "SELECT booking_id, first_name, last_name, package_type, check_in, check_out, booking_status FROM booking_form";

// If a status filter is selected, modify the query
if ($status_filter !== 'all') {
  $query .= " WHERE booking_status = :status";
}

// Execute the query and fetch the results
$stmt = $pdo->prepare($query);
if ($status_filter !== 'all') {
  $stmt->execute([':status' => $status_filter]);
} else {
  $stmt->execute();
}

$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  <title>Admin - Booking Management</title>
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
            <div class="container d-flex">
              <input type="text" class="form-control w-50 shadow-sm rounded-0 rounded-start" placeholder="Search"
                aria-label="Search">
              <button class="btn btn-primary rounded-0 rounded-end">
                <i class="bi bi-search"></i>
              </button>
            </div>

            <!-- Filter Dropdown -->
            <form method="GET" action="" class="d-flex align-items-center w-50">
              <select name="status" class="form-select shadow-none me-3" aria-label="Status filter" onchange="this.form.submit()">
                <option value="all" <?php echo ($status_filter === 'all') ? 'selected' : ''; ?>>All</option>
                <option value="pending" <?php echo ($status_filter === 'pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="completed" <?php echo ($status_filter === 'completed') ? 'selected' : ''; ?>>Completed</option>
                <option value="cancelled" <?php echo ($status_filter === 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                
              </select>
            </form>

            <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal"
              data-bs-target="#addBookingModal">Add</button>
            <a href="../../admin/history/history.php" class="btn btn-outline-primary" type="button">History</a>
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
                    <td>
                      <span
                        class="badge 
                          <?php 
                            echo ($row['booking_status'] === 'completed') 
                              ? 'bg-success' 
                              : (($row['booking_status'] === 'cancelled') ? 'bg-danger' : 'bg-warning text-dark'); 
                          ?>">
                        <?php echo $row['booking_status']; ?>
                      </span>
                    </td>
                    <td>
                      <button class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#confirmModal"
                        data-action="confirm" data-id="<?php echo $row['booking_id']; ?>" <?php echo ($row['booking_status'] === 'completed') ? 'disabled' : ''; ?>>Confirm</button>

                      <button class="btn btn-danger text-white me-5" data-bs-toggle="modal"
                        data-bs-target="#confirmModal" data-action="cancel" data-id="<?php echo $row['booking_id']; ?>"
                        <?php echo ($row['booking_status'] === 'cancelled') ? 'disabled' : ''; ?>>Cancel</button>
                      <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                        data-action="delete" data-id="<?php echo $row['booking_id']; ?>">Delete</button>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

          <!-- Modal for Confirm and Delete -->
          <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to proceed with this action?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <a id="modalConfirmAction" href="#" class="btn btn-primary">Proceed</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Script to handle dynamic action links in the modal -->
          <script>
            var confirmModal = document.getElementById('confirmModal');
            confirmModal.addEventListener('show.bs.modal', function (event) {
              var button = event.relatedTarget;
              var action = button.getAttribute('data-action');
              var bookingId = button.getAttribute('data-id');
              var modalConfirmAction = document.getElementById('modalConfirmAction');
              modalConfirmAction.href = "?action=" + action + "&booking_id=" + bookingId;
            });
          </script>
        </div>
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
