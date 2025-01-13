<?php
// Get the current script name
$current_file = basename($_SERVER['PHP_SELF']);
?>
<!-- CUSTOM JS -->
<script src="../../components/admin-header/header.js"></script>

<!-- HEADER -->
<header class="bg-light d-none d-md-block">
  <div class="container-fluid d-flex justify-content-between align-items-center py-1">
    <div class="d-flex align-items-center">
      <button class="btn me-2" id="menu-toggle">
        <i class="bi bi-list fs-3"></i>
      </button>
      <form class="d-flex align-items-center position-relative" role="search">
        <input class="form-control rounded-pill ps-5 shadow-none bg-body-secondary" type="search" placeholder="Search"
          aria-label="Search">
        <button class="btn rounded-circle position-absolute start-0 ms-2" type="submit">
          <i class="bi bi-search"></i>
        </button>
      </form>
    </div>
    <div class="d-flex align-items-center">
      <!-- DROPDOWN PROFILE -->
      <div class="dropdown">
        <button class="btn btn-secondary rounded-circle p-2" type="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          SG
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="../../admin/manage-account/manage-account.php">Manage Accounts</a></li>
          <li>
            <hr class=" dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="../../admin/authentication/authentication.php">Log Out</a></li>
        </ul>
      </div>
      <div class="d-flex flex-column align-items-center px-2">
        <h6 class="mb-0">Selwyn</h6>
        <small class="text-secondary">admin</small>
      </div>
    </div>
  </div>
</header>

<!-- NAVBAR MOBILE VIEW -->
<nav class="navbar px-2 d-flex justify-content-between bg-light shadow-sm py-0 d-block d-md-none fixed-top">
  <!-- DROPDOWN PROFILE -->
  <div class="d-flex align-items-center">
    <div class="dropdown">
      <button class="btn btn-secondary rounded-circle p-2" type="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        SG
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="../../">Manage Accounts</a></li>
        <li>
          <hr class=" dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="../../admin/authentication/authentication.php"><i
              class="fas fa-sign-out-alt"></i>Log Out</a></li>
      </ul>
    </div>
    <div class="d-flex flex-column align-items-center px-2">
      <h6 class="mb-0">Selwyn</h6>
      <small class="text-secondary">admin</small>
    </div>
  </div>
  <!-- LOGO -->
  <a class="navbar-brand me-5" href="../../admin/dashboard/dashboard.php">
    <img src="../../assets/image/logo-black.png" alt="Logo" width="50" height="50">
  </a>
  <!-- MENU BUTTON -->
  <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class=" container">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="d-flex mt-2" role="search">
        <input class="form-control rounded-0 rounded-start shadow-none" type="search" placeholder="Search"
          aria-label="Search">
        <button class="btn btn-primary rounded-0 rounded-end" type="submit"><i class="bi bi-search"></i></button>
      </form>
      <ul class="navbar-nav my-3 px-md-3">
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
            <i class="fas fa-users"></i> Customers
          </a>
        </li>
        <li class="nav-item <?php echo $current_file === 'reports.php' ? 'bg-primary' : ''; ?>">
          <a class="nav-link <?php echo $current_file === 'reports.php' ? 'active text-light' : ''; ?>"
            href="../../admin/reports/reports.php">
            <i class="fas fa-chart-line"></i> Reports
          </a>
        </li>
        <hr>
        <li class="nav-item <?php echo $current_file === 'settings.php' ? 'bg-primary' : ''; ?>">
          <a class="nav-link <?php echo $current_file === 'settings.php' ? 'active text-light' : ''; ?>"
            href="../../admin/settings/settings.php">
            <i class="fas fa-cogs"></i> Settings
          </a>
        </li>
        <li class="nav-item <?php echo $current_file === 'logout.php' ? 'bg-primary' : ''; ?>">
          <a class="nav-link <?php echo $current_file === 'logout.php' ? 'active text-light' : ''; ?>"
            href="../../admin/authentication/authentication.php">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>