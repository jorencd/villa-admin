<?php
include '../database/dbconnect.php';

// Handle form submission for new bookings
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $package_type = $_POST['package_type'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Insert the data into the booking_form table
    $insert_query = "INSERT INTO booking_form (first_name, last_name, package_type, check_in, check_out, booking_status) VALUES (:first_name, :last_name, :package_type, :check_in, :check_out, 'pending')";

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

// Handle actions for Confirm, Delete, Restore, and Permanent Delete
if (isset($_GET['action']) && isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];
    $action = $_GET['action'];

    if ($action === 'confirm' || $action === 'delete') {
        // Fetch booking details from booking_form
        $fetch_query = "SELECT * FROM booking_form WHERE booking_id = :booking_id";
        $stmt = $pdo->prepare($fetch_query);
        $stmt->execute([':booking_id' => $booking_id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($booking) {
            $booking_status = ($action === 'confirm') ? 'completed' : 'cancelled';

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
                ':booking_status' => $booking_status
            ]);

            // Delete from booking_form
            $delete_query = "DELETE FROM booking_form WHERE booking_id = :booking_id";
            $stmt = $pdo->prepare($delete_query);
            $stmt->execute([':booking_id' => $booking_id]);

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    } elseif ($action === 'restore' || $action === 'permanent_delete') {
        // Fetch booking details from history
        $fetch_query = "SELECT * FROM history WHERE booking_id = :booking_id";
        $stmt = $pdo->prepare($fetch_query);
        $stmt->execute([':booking_id' => $booking_id]);
        $history = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($history) {
            if ($action === 'restore') {
                // Update status to 'pending' and restore to booking_form
                $restore_query = "INSERT INTO booking_form (booking_id, user_id, first_name, last_name, email, guest, check_in, check_out, add_ons, message, package_type, booking_status) 
                          VALUES (:booking_id, :user_id, :first_name, :last_name, :email, :guest, :check_in, :check_out, :add_ons, :message, :package_type, 'pending')";

                $stmt = $pdo->prepare($restore_query);
                $stmt->execute([
                    ':booking_id' => $history['booking_id'],
                    ':user_id' => $history['user_id'],
                    ':first_name' => $history['first_name'],
                    ':last_name' => $history['last_name'],
                    ':email' => $history['email'],
                    ':guest' => $history['guest'],
                    ':check_in' => $history['check_in'],
                    ':check_out' => $history['check_out'],
                    ':add_ons' => $history['add_ons'],
                    ':message' => $history['message'],
                    ':package_type' => $history['package_type']
                ]);
            }

            // Delete from history table
            $delete_history_query = "DELETE FROM history WHERE booking_id = :booking_id";
            $stmt = $pdo->prepare($delete_history_query);
            $stmt->execute([':booking_id' => $booking_id]);

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}

// Fetch pending bookings for display
$query = "SELECT booking_id, first_name, last_name, package_type, check_in, check_out, booking_status FROM booking_form WHERE booking_status = 'pending'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch history for display
$history_query = "SELECT booking_id, first_name, last_name, package_type, check_in, check_out, booking_status FROM history";
$stmt = $pdo->prepare($history_query);
$stmt->execute();
$history_entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../../admin/pending/pending.css">

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
                    <h3 class="mb-4 text-center"><i class="fa fa-history"></i>
                        History</h3>

                    <!-- Search Bar -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="container d-flex ">
                            <input type="text" class="form-control w-50 shadow-sm rounded-0 rounded-start"
                                placeholder="Search" aria-label="Search">
                            <button class="btn btn-primary rounded-0 rounded-end">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        <select class="form-select shadow-none w-50" aria-label="Default select example">
                            <option selected>All</option>
                            <option value="1">Completed</option>
                            <option value="3">Cancelled</option>
                        </select>
                    </div>


                    <!-- History Table -->
                    <h5>Booking History</h5>
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
                                <?php foreach ($history_entries as $entry) { ?>
                                    <tr>
                                        <td><?php echo $entry['booking_id']; ?></td>
                                        <td><?php echo $entry['first_name']; ?></td>
                                        <td><?php echo $entry['last_name']; ?></td>
                                        <td><?php echo $entry['package_type']; ?></td>
                                        <td><?php echo $entry['check_in']; ?></td>
                                        <td><?php echo $entry['check_out']; ?></td>
                                        <td><span class="badge bg-secondary"><?php echo $entry['booking_status']; ?></span>
                                        </td>
                                        <td>
                                            <!-- Restore Button with Modal Trigger -->
                                            <a href="#" class="btn btn-primary me-1" data-bs-toggle="modal"
                                                data-bs-target="#restoreModal<?php echo $entry['booking_id']; ?>">Restore</a>

                                            <!-- Delete Button with Modal Trigger -->
                                            <a href="#" class="btn btn-danger me-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal<?php echo $entry['booking_id']; ?>">Delete</a>
                                        </td>
                                    </tr>

                                    <!-- Restore Modal -->
                                    <div class="modal fade" id="restoreModal<?php echo $entry['booking_id']; ?>"
                                        tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="restoreModalLabel">Restore Booking</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to restore the booking with ID
                                                    <?php echo $entry['booking_id']; ?>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <a href="?action=restore&booking_id=<?php echo $entry['booking_id']; ?>"
                                                        class="btn btn-primary">Restore</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $entry['booking_id']; ?>"
                                        tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Booking</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to permanently delete the booking with ID
                                                    <?php echo $entry['booking_id']; ?>? This action cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <a href="?action=permanent_delete&booking_id=<?php echo $entry['booking_id']; ?>"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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