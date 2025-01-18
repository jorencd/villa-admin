<?php
include '../database/dbconnect.php';

// Prepare the SQL query to fetch users
$query = "SELECT id, first_name, last_name, email FROM users";
$stmt = $pdo->prepare($query);   // Prepare the query
$stmt->execute();                // Execute the query
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as an associative array

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'permanent_delete' && isset($_GET['id'])) {
    $delete_history_query = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($delete_history_query);
    $stmt->execute([':id' => $_GET['id']]);
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to prevent form resubmission
    exit();
}
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
                    <h3 class="mb-4 text-center"><i class="fas fa-users"></i> User Management</h3>

                    <!-- Search Bar -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="container d-flex">
                            <input type="text" class="form-control w-50 shadow-sm rounded-0 rounded-start"
                                placeholder="Search" aria-label="Search">
                            <button class="btn btn-primary rounded-0 rounded-end">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- TABLE -->
                    <div class="table-responsive shadow rounded bg-secondary">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>User ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['first_name']; ?></td>
                                        <td><?php echo $row['last_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>
                                            <!-- Delete Button with Modal Trigger -->
                                            <a href="#" class="btn btn-danger me-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal<?php echo $row['id']; ?>">Delete</a>
                                        </td>
                                    </tr>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to permanently delete the user with ID
                                                    <?php echo $row['id']; ?>? This action cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <a href="?action=permanent_delete&id=<?php echo $row['id']; ?>"
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