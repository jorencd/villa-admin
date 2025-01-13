<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Villa Mirales</title>

  <!-- CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../components/navbar/navbar.css">

  <!-- ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <nav id="navbar" class="navbar navbar-expand-lg fixed-top z-3">
    <div class="container-fluid">
      <!-- Brand -->
      <div class="order-2 mx-auto">
        <a class="navbar-brand" href="#">
          <img class="img-fluid" src="../../assets/image/logo-white.png" alt="Logo" width="50" height="45" class="d-inline-block align-text-top">
        </a>
      </div>

      <!-- Toggler -->
      <div class="order-1">
        <button class="navbar-toggler shadow-none ps-0 pe-5 pe-md-0 me-5 me-md-0 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span><i class="bi bi-filter-left fs-1"></i></span>
        </button>
      </div>

      <!-- Offcanvas Menu -->
      <div class="offcanvas offcanvas-start order-3" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
          <button type="button" class="btn shadow-none ms-auto" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-x-lg fw-bold"></i>
          </button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#home">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">ABOUT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#rooms">ROOMS</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link d-flex align-items-center" href="#experience" id="experienceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                EXPERIENCE <i class="fa-solid fa-angle-down ms-1"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="experienceDropdown">
                <li><a class="dropdown-item" href="#">Facilities & Activities</a></li>
                <li><a class="dropdown-item" href="#">Dining</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Packages & Offers</a></li>
              </ul>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="#rooms">GALLERY</a>
            </li>
          </ul>
          <!-- SEARCH -->
          <form class="d-flex" role="search">
            <input class="form-control rounded-0" type="search" placeholder="Search" aria-label="Search">
            <button class="btn" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </form>
        </div>
      </div>

      <!-- Social Links -->
      <div class="ms-auto d-flex align-items-center order-4">
        <ul class="navbar-nav d-flex flex-row align-items-center">
          <li class="nav-item">
            <a href="#" class="nav-link px-2" aria-label="Facebook">
              <i class="bi bi-facebook"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2" aria-label="Instagram">
              <i class="bi bi-instagram"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2" aria-label="Email">
              <i class="bi bi-envelope-at"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</body>

</html>