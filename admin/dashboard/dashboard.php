<?php
// Database connection
include '../database/dbconnect.php';

// Query to get total bookings count
$sql_total_bookings = "SELECT COUNT(*) AS total_bookings FROM booking_form";
$stmt = $pdo->prepare($sql_total_bookings);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_bookings = $row['total_bookings'];

// Query to get confirmed bookings count
$sql_confirmed_bookings = "SELECT COUNT(*) AS confirmed_bookings FROM booking_form WHERE booking_status = 'completed'";
$stmt = $pdo->prepare($sql_confirmed_bookings);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$confirmed_bookings = $row['confirmed_bookings'];

// Query to get pending bookings count
$sql_pending_bookings = "SELECT COUNT(*) AS pending_bookings FROM booking_form WHERE booking_status = 'pending'";
$stmt = $pdo->prepare($sql_pending_bookings);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$pending_bookings = $row['pending_bookings'];

// Query to get cancelled bookings count
$sql_cancelled_bookings = "SELECT COUNT(*) AS cancelled_bookings FROM booking_form WHERE booking_status = 'cancelled'";
$stmt = $pdo->prepare($sql_cancelled_bookings);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$cancelled_bookings = $row['cancelled_bookings'];

// Query to get total revenue
$sql_total_revenue = "SELECT SUM(total_amount_paid) AS total_revenue FROM payment";
$stmt = $pdo->prepare($sql_total_revenue);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_revenue = $row['total_revenue'];

// Close connection
$pdo = null;
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

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="../../admin/dashboard/dashboard.css">

  <!-- TITLE -->
  <title>Admin - Dashboard</title>
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
        <div class="main-body container-fluid pt-5 pt-md-3 mt-5 mt-md-0">
          <h1>Dashboard</h1>
          <div class="row px-3 mt-2 gy-4">
            <!-- Total Bookings -->
            <div class="col-12 col-md-4">
              <div class="card border-0 shadow">
                <div class="card-body px-2 pt-3">
                  <i class="fas fa-calendar-check text-light bg-primary fs-3"></i>
                  <h6 class="card-subtitle text-body-secondary mb-3">Total Bookings</h6>
                  <!-- Displaying the total bookings count from PHP -->
                  <h3 class="card-title"><?php echo $total_bookings; ?></h3>
                  <p><span class="text-success"><i class="bi bi-chevron-double-down"></i>All Bookings check
                      details</span>
                  </p>
                  <a href="../../admin/booking/pending.php" class="btn btn-dark">View Details</a>
                </div>
              </div>
            </div>

            <!-- Confirmed Bookings -->
            <div class="col-12 col-md-4">
              <div class="card border-0 shadow">
                <div class="card-body px-2 pt-3">
                  <i class="fas fa-check-circle bg-success text-light fs-3"></i>
                  <h6 class="card-subtitle text-body-secondary mb-3">Confirmed Bookings</h6>
                  <!-- Displaying confirmed bookings count from PHP -->
                  <h3 class="card-title"><?php echo $confirmed_bookings; ?></h3>
                  <p><span class="text-success"><i class="bi bi-chevron-double-down"></i>Confirmed bookings check
                      details </span>
                  </p>
                  <a href="../../admin/booking/pending.php?status=completed" class="btn btn-dark">View Details</a>
                </div>
              </div>
            </div>

            <!-- Pending Bookings -->
            <div class="col-12 col-md-4">
              <div class="card border-0 shadow">
                <div class="card-body px-2 pt-3">
                  <i class="fas fa-check-circle bg-warning text-light fs-3"></i>
                  <h6 class="card-subtitle text-body-secondary mb-3">Pending Bookings</h6>
                  <!-- Displaying pending bookings count from PHP -->
                  <h3 class="card-title"><?php echo $pending_bookings; ?></h3>
                  <p><span class="text-success"><i class="bi bi-chevron-double-down"></i>Pending bookings check
                      details </span>
                  </p>
                  <a href="../../admin/booking/pending.php?status=pending" class="btn btn-dark">View Details</a>
                </div>
              </div>
            </div>

            <!-- Cancelled Bookings -->
            <div class="col-12 col-md-4">
              <div class="card border-0 shadow">
                <div class="card-body px-2 pt-3">
                  <i class="fas fa-hourglass-half bg-danger text-light fs-3"></i>
                  <h6 class="card-subtitle text-body-secondary mb-3">Cancelled Bookings</h6>
                  <!-- Displaying cancelled bookings count from PHP -->
                  <h3 class="card-title"><?php echo $cancelled_bookings; ?></h3>
                  <p><span class="text-success"><i class="bi bi-chevron-double-down"></i>Cancelled bookings check
                      details </span>
                  </p>
                  <a href="../../admin/booking/pending.php?status=cancelled" class="btn btn-dark">View Details</a>
                </div>
              </div>
            </div>

            <!-- Total Revenue -->
            <div class="col-12 col-md-4">
              <div class="card border-0 shadow">
                <div class="card-body px-2 pt-3">
                  <i class="fas fa-dollar-sign border bg-warning text-dark fs-3"></i>
                  <h6 class="card-subtitle text-body-secondary mb-3">Total Revenue</h6>
                  <!-- Displaying total revenue from PHP -->
                  <h3 class="card-title">₱<?php echo number_format($total_revenue, 2); ?></h3>
                  <p><span class="text-success"><i class="bi bi-chevron-double-down"></i>Total Revenue check
                      details </span>
                  </p>
                  <a href="../../admin/reports/reports.php" class="btn btn-dark">View Details</a>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-5">

          <!-- CHART -->
          <div class="container mt-2">
            <h2 class="text-center mb-4">Sales Overview</h2>
            <div class="card shadow">
              <div class="card-body">
                <h5 class="text-center">Monthly Sales</h5>
                <canvas id="lineChart" style="max-height: 400px;"></canvas>
              </div>
            </div>
          </div>

          <br>
          <br>
          <br>
          <br>
          <br>
        </div>
      </div>
    </div>
  </div>

  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- CUSTOM JS -->
  <script src="../../admin/dashboard/dashboard.js"></script>
</body>

</html>