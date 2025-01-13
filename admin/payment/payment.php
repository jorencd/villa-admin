<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="../../admin/dashboard/dashboard.css">

  <!-- TITLE -->
  <title>Admin - Payments</title>
</head>

<body>
  <div class=" container-fluid">
    <div class=" row">
      <!-- SIDE NAV -->
      <?php include '../../components/admin-sidebar/sidebar.php'; ?>

      <!-- MAIN CONTENT -->
      <div class="col-12 col-md-10 p-0 bg-body-tertiary vh-100 overflow-auto main-body">
        <!-- HEADER -->
        <?php include '../../components/admin-header/header.php'; ?>
        <!-- END HEADER -->

        <!-- MAIN BODY -->
        <div class="main-body container-fluid pt-5 pt-md-3 mt-5 mt-md-0">
          <h3 class=" text-center"><i class="fas fa-credit-card"></i> Payments Management</h3>
          <div class="container d-flex justify-content-between mt-4">
            <!-- SEARCH -->
            <form class="d-flex w-50" role="search">
              <input class="form-control rounded-0 rounded-start shadow-none" type="search" placeholder="Search"
                aria-label="Search">
              <button class="btn btn-primary rounded-0 rounded-end" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </form>

          </div>
          <div class=" container mt-3">
            <!-- TABLE -->
            <div class="table-responsive shadow rounded">
              <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-dark">
                  <tr>
                    <th>Booking ID</th>
                    <th>User Name</th>
                    <th>Package Type</th>
                    <th>Payment Method</th>
                    <th>Payment Amount</th>
                    <th>Payment Proof</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Row 1 -->
                  <tr>
                    <td>001</td>
                    <td>Orlando Dela Cruz</td>
                    <td>Essential Room</td>
                    <td>GCash</td>
                    <td>$500</td>
                    <td>GCash Ref: 123456</td>
                    <td class="d-flex flex-column justify-content-center">
                      <!-- Verify Button -->
                      <button class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#verifyModal"
                        onclick="setModalContent('001', 'Orlando Dela Cruz' 'Essential Room', '$500')">Verify</button>

                    </td>
                  </tr>
                  <!-- Row 2 -->
                  <tr>
                    <td>002</td>
                    <td>Jorence Mendoza</td>
                    <td>Deluxe Room</td>
                    <td>Bank Transfer</td>
                    <td>$400</td>
                    <td>Bank Ref: 654321</td>
                    <td class="d-flex flex-column justify-content-center">
                      <!-- Verify Button -->
                      <button class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#verifyModal"
                        onclick="setModalContent('001', 'Orlando Dela Cruz' 'Essential Room', '$500')">Verify</button>
                    </td>
                  </tr>
                  <!-- Row 3 -->
                  <tr>
                    <td>003</td>
                    <td>Dhennis Nizal</td>
                    <td>Supreme Room</td>
                    <td>GCash</td>
                    <td>$500</td>
                    <td>GCash Ref: 987654</td>
                    <td class="d-flex flex-column justify-content-center">
                      <!-- Verify Button -->
                      <button class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#verifyModal"
                        onclick="setModalContent('001', 'Orlando Dela Cruz' 'Essential Room', '$500')">Verify</button>

                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- VERIFY MODAL -->
            <div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalLabel">Verify Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p><strong>Booking ID:</strong> <span id="modalBookingID">N/A</span></p>
                    <p><strong>Customer Name:</strong> <span id="modalCustomerName">N/A</span></p>
                    <p><strong>Room Type:</strong> <span id="modalRoomType">N/A</span></p>
                    <p><strong>Amount:</strong> <span id="modalAmount">N/A</span></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Confirm Payment</button>
                  </div>
                </div>
              </div>
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
        </div>
      </div>
    </div>
  </div>
</body>

</html>