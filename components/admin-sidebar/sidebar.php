<?php
// Get the current script name
$current_file = basename($_SERVER['PHP_SELF']);
?>
<link rel="stylesheet" href="../../components/admin-sidebar/sidebar.css">

<div class="col-12 col-md-2 d-none d-md-block p-0 vh-100 border-end border-2 d-flex flex-column" id="sidebar">

  <!-- LOGO -->
  <div class="container d-flex justify-content-center py-3">
    <img class="img-fluid" src="../../assets/image/logo-black.png" height="80" width="80" alt="Logo">
  </div>

  <!-- NAVIGATION -->
  <div class="flex-grow-1 overflow-auto">
    <nav>
      <ul class="navbar-nav px-3 mb-3">
        <li class="nav-item <?php echo $current_file === 'dashboard.php' ? 'bg-primary' : ''; ?>">
          <a class="nav-link <?php echo $current_file === 'dashboard.php' ? 'active text-light' : ''; ?>"
            href="../../admin/dashboard/dashboard.php">
            <i class="fas fa-tachometer-alt"></i> Dashboard
          </a>
        </li>
        <li class="nav-item <?php echo $current_file === 'pending.php' ? 'bg-primary' : ''; ?>">
          <a class="nav-link <?php echo $current_file === 'pending.php' ? 'active text-light' : ''; ?>"
            href="../../admin/booking/pending.php">
            <i class="fas fa-book"></i> Bookings
          </a>
        </li>
        <li class="nav-item <?php echo $current_file === 'payments.php' ? 'bg-primary' : ''; ?>">
          <a class="nav-link <?php echo $current_file === 'payments.php' ? 'active text-light' : ''; ?>"
            href="../../admin/payment/payment.php">
            <i class="fas fa-credit-card"></i> Payments
          </a>
        </li>
        <li class="nav-item <?php echo $current_file === 'customers.php' ? 'bg-primary' : ''; ?>">
          <a class="nav-link <?php echo $current_file === 'customers.php' ? 'active text-light' : ''; ?>"
            href="../../admin/customer/customer.php">
            <i class="fas fa-users"></i> Users
          </a>
        </li>
        <li class="nav-item <?php echo $current_file === 'reports.php' ? 'bg-primary' : ''; ?>">
          <a class="nav-link <?php echo $current_file === 'reports.php' ? 'active text-light' : ''; ?>"
            href="../../admin/reports/reports.php">
            <i class="fas fa-chart-line"></i> Reports
          </a>
        </li>
        <li class="nav-item <?php echo $current_file === 'history.php' ? 'bg-primary' : ''; ?>">
          <a class="nav-link <?php echo $current_file === 'history.php' ? 'active text-light' : ''; ?>"
            href="../../admin/history/history.php">
            <i class="fa fa-history"></i> Archive
          </a>
        </li>
      </ul>
    </nav>
  </div>

  <!-- SETTINGS & LOGOUT -->
  <div class="border-top">
    <ul class="navbar-nav px-3 mt-3">
      <li class="nav-item <?php echo $current_file === 'settings.php' ? 'bg-primary' : ''; ?>">
        <a class="nav-link <?php echo $current_file === 'settings.php' ? 'active text-light' : ''; ?>"
          href="../../admin/settings/settings.php">
          <i class="fas fa-cogs"></i> Settings
        </a>
      </li>
      <li class="nav-item">
        <!-- Trigger the modal with a link -->
        <a class="nav-link text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </div>

</div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to log out?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="../../admin/authentication/authentication.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>