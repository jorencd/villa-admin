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
            <!-- CARDS 1 -->
            <div class="col-12 col-md-4">
              <div class="card border-0 shadow">
                <div class="card-body px-2 pt-3">
                  <i class="fas fa-calendar-check text-light bg-primary fs-3"></i>
                  <h6 class="card-subtitle text-body-secondary mb-3">Total Bookings</h6>
                  <h3 class="card-title">125</h3>
                  <p><span class="text-success"><i class="bi bi-chevron-double-up"></i> 8.5%</span> up from yesterday
                  </p>
                  <a href="../../admin/history/history.php" class="btn btn-dark">View Details</a>
                </div>
              </div>
            </div>

            <!-- CARDS 2 -->
            <div class="col-12 col-md-4">
              <div class="card border-0 shadow">
                <div class="card-body px-2 pt-3">
                  <i class="fas fa-check-circle bg-success text-light fs-3"></i>
                  <h6 class="card-subtitle text-body-secondary mb-3">Confirmed Bookings</h6>
                  <h3 class="card-title">90</h3>
                  <p><span class="text-success"><i class="bi bi-chevron-double-up"></i> 8.5%</span> up from yesterday
                  </p>
                  <a href="../../admin/history/history.php" class="btn btn-dark">View Details</a>
                </div>
              </div>
            </div>

            <!-- CARDS 3 -->
            <div class="col-12 col-md-4">
              <div class="card border-0 shadow">
                <div class="card-body px-2 pt-3">
                  <i class="fas fa-hourglass-half bg-danger text-light fs-3"></i>
                  <h6 class="card-subtitle text-body-secondary mb-3">Pending Bookings</h6>
                  <h3 class="card-title">25</h3>
                  <p><span class="text-success"><i class="bi bi-chevron-double-up"></i> 8.5%</span> up from yesterday
                  </p>
                  <a href="../../admin/booking/pending.php" class="btn btn-dark">View Details</a>
                </div>
              </div>
            </div>

            <!-- CARDS 4 -->
            <div class="col-12 col-md-4">
              <div class="card border-0 shadow">
                <div class="card-body px-2 pt-3">
                  <i class="fas fa-dollar-sign border bg-warning text-dark fs-3"></i>
                  <h6 class="card-subtitle text-body-secondary mb-3">Total Revenue</h6>
                  <h3 class="card-title">₱40,689</h3>
                  <p><span class="text-success"><i class="bi bi-chevron-double-up"></i> 8.5%</span> up from yesterday
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