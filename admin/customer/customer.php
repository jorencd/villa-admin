<?php
include '../database/dbconnect.php';


// Prepare the SQL query
$query = "SELECT id, first_name, last_name, email FROM users";

// Execute the query and fetch the results
$stmt = $pdo->prepare($query);   // Prepare the query
$stmt->execute();                // Execute the query
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as an associative array
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
                        <div class="container d-flex ">
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


                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['first_name']; ?></td>
                                        <td><?php echo $row['last_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
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