<?php
// Database connection
include '../database/dbconnect.php';

// Handle "Verify" action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_verify_payment'])) {
  $paymentId = intval($_POST['payment_id']); // Securely retrieve payment_id

  try {
    // Update payment_status to 'Paid'
    $stmt = $pdo->prepare("UPDATE payment SET payment_status = 'Paid' WHERE payment_id = ?");
    $stmt->execute([$paymentId]);
  } catch (PDOException $e) {
    // Handle error silently
  }
}
?>
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

  <!-- TITLE -->
  <title>Admin - Payments</title>
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
        <!-- END HEADER -->

        <div class="container mt-5">
          <h3 class="text-center"><i class="fas fa-credit-card"></i> Payments Management</h3>

          <!-- TABLE -->
          <div class="table-responsive shadow rounded mt-4">
            <table class="table table-hover table-bordered align-middle">
              <thead class="table-dark">
                <tr>
                  <th>Payment ID</th>
                  <th>Booking ID</th>
                  <th>Payment Status</th>
                  <th>Total Amount</th>
                  <th>Payment Method</th>
                  <th>Payment Date</th>
                  <th>Payment Proof</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $stmt = $pdo->prepare("SELECT payment_id, booking_id, payment_status, total_amount_paid, payment_method, payment_date, payment_proof_url FROM payment");
                  $stmt->execute();
                  $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  if ($payments) {
                    foreach ($payments as $row) {
                      echo "<tr>
                  <td>" . htmlspecialchars($row['payment_id']) . "</td>
                  <td>" . htmlspecialchars($row['booking_id']) . "</td>
                  <td>";
                      if ($row['payment_status'] === 'Pending') {
                        echo "<span class='badge bg-warning text-dark'>" . htmlspecialchars($row['payment_status']) . "</span>";
                      } elseif ($row['payment_status'] === 'Paid') {
                        echo "<span class='badge bg-success'>" . htmlspecialchars($row['payment_status']) . "</span>";
                      } else {
                        echo htmlspecialchars($row['payment_status']);
                      }
                      echo "</td>
                  <td>" . htmlspecialchars($row['total_amount_paid']) . "</td>
                  <td>" . htmlspecialchars($row['payment_method']) . "</td>
                  <td>" . htmlspecialchars($row['payment_date']) . "</td>
                  <td><a href='" . htmlspecialchars($row['payment_proof_url']) . "' target='_blank'>View Proof</a></td>
                  <td>
                    <button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#verifyModal' 
                      onclick=\"setPaymentId('" . htmlspecialchars($row['payment_id']) . "')\" 
                      " . ($row['payment_status'] === 'Paid' ? 'disabled' : '') . ">Verify</button>
                  </td>
              </tr>";
                    }
                  } else {
                    echo "<tr><td colspan='8' class='text-center'>No payments found</td></tr>";
                  }
                } catch (PDOException $e) {
                  echo "<tr><td colspan='8' class='text-center text-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL -->
  <div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="verifyModalLabel">Confirm Verification</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to mark this payment as <strong>Paid</strong>?
            <input type="hidden" name="payment_id" id="modalPaymentId">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="confirm_verify_payment" class="btn btn-primary">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Set payment ID in modal input
    function setPaymentId(paymentId) {
      document.getElementById('modalPaymentId').value = paymentId;
    }
  </script>
</body>

</html>