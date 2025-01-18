<?php
// Include your database connection
include '../database/dbconnect.php';

// Get today's date
$dateToday = date('Y-m-d');

// Query for total bookings count
$queryTotalBookings = "SELECT COUNT(*) AS total_bookings FROM booking_form";
$stmtTotalBookings = $pdo->prepare($queryTotalBookings);
$stmtTotalBookings->execute();
$totalBookings = $stmtTotalBookings->fetch(PDO::FETCH_ASSOC)['total_bookings'];

// Query for pending bookings count
$queryPendingBookings = "SELECT COUNT(*) AS pending_bookings FROM booking_form WHERE booking_status = 'pending'";
$stmtPendingBookings = $pdo->prepare($queryPendingBookings);
$stmtPendingBookings->execute();
$pendingBookings = $stmtPendingBookings->fetch(PDO::FETCH_ASSOC)['pending_bookings'];

// Query for confirmed bookings count
$queryConfirmedBookings = "SELECT COUNT(*) AS confirmed_bookings FROM booking_form WHERE booking_status = 'completed'";
$stmtConfirmedBookings = $pdo->prepare($queryConfirmedBookings);
$stmtConfirmedBookings->execute();
$confirmedBookings = $stmtConfirmedBookings->fetch(PDO::FETCH_ASSOC)['confirmed_bookings'];

// Query for cancelled bookings count
$queryCancelledBookings = "SELECT COUNT(*) AS cancelled_bookings FROM booking_form WHERE booking_status = 'cancelled'";
$stmtCancelledBookings = $pdo->prepare($queryCancelledBookings);
$stmtCancelledBookings->execute();
$cancelledBookings = $stmtCancelledBookings->fetch(PDO::FETCH_ASSOC)['cancelled_bookings'];

// Query for total revenue sum
$queryTotalRevenue = "SELECT SUM(total_amount_paid) AS total_revenue FROM payment";
$stmtTotalRevenue = $pdo->prepare($queryTotalRevenue);
$stmtTotalRevenue->execute();
$totalRevenue = $stmtTotalRevenue->fetch(PDO::FETCH_ASSOC)['total_revenue'];
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

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="../../admin/pending/pending.css">

    <!-- TITLE -->
    <title>Admin - Pending</title>

    <style>
        /* Add your custom styles here */
        body {
            background: linear-gradient(145deg, #f4f7fa, #e9eff1);
            font-family: 'Poppins', sans-serif;
        }

        .main-body {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .report-section {
            background-color: #f9f9f9;
            padding: 1.8rem;
            margin-top: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .report-section:hover {
            transform: scale(1.02);
        }

        .report-section h5 {
            font-size: 1.3rem;
            color: #007bff;
            font-weight: bold;
        }

        .report-section p {
            font-size: 1.1rem;
            color: #555;
            margin: 0.5rem 0;
        }

        .btn-export {
            border-radius: 30px;
            padding: 0.8rem 2rem;
            font-size: 1.2rem;
            background: linear-gradient(145deg, #007bff, #0062cc);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-export:hover {
            background: linear-gradient(145deg, #0056b3, #004085);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .modal-content {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #007bff;
            color: white;
            font-size: 1.3rem;
            font-weight: bold;
        }

        .modal-body,
        .modal-footer {
            font-size: 1.1rem;
        }

        .report-date {
            font-size: 1.2rem;
            font-weight: 600;
            color: #444;
            margin-top: 1rem;
        }

        .report-icon {
            font-size: 1.4rem;
            margin-right: 0.5rem;
        }

        .container-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
        }
    </style>
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
                <div class="main-body container pt-3">
                    <div class="container">
                        <h3 class="container-title text-center"><i class="fas fa-chart-line"></i> <strong>Daily
                                Report</strong></h3>

                        <div class="row my-4 gy-2">
                            <div class="col-12 col-md-6"></div>
                            <div
                                class="col-12 col-md-6 d-flex justify-content-md-end justify-content-start align-items-end">
                                <!-- EXPORT PDF Button -->
                                <button class="btn btn-primary btn-export" id="exportBtn">
                                    <i class="fas fa-file-pdf"></i> Export to PDF
                                </button>
                            </div>
                        </div>

                        <!-- REPORT CONTENT -->
                        <div id="reportContent" class="p-4 border rounded bg-light mt-4">
                            <!-- Title Section -->
                            <div style="text-align: center; margin-bottom: 30px;">
                                <h2>Villa Solaria</h2>
                                <h4>Daily Report</h4>
                            </div>

                            <!-- Report Content -->
                            <div class="report-section">
                                <h5>Date:</h5>
                                <p class="report-date"><?php echo $dateToday; ?></p>
                            </div>

                            <div class="report-section">
                                <h5>Booking Overview</h5>
                                <p><i class="fas fa-clipboard-list report-icon"></i><strong>Total Bookings:</strong>
                                    <span class="text-success"><?php echo $totalBookings; ?></span>
                                </p>
                                <p><i class="fas fa-clock report-icon"></i><strong>Pending Bookings:</strong> <span
                                        class="text-warning"><?php echo $pendingBookings; ?></span></p>
                                <p><i class="fas fa-times-circle report-icon"></i><strong>Cancelled Bookings:</strong>
                                    <span class="text-danger"><?php echo $cancelledBookings; ?></span>
                                </p>
                                <p><i class="fas fa-check-circle report-icon"></i><strong>Confirmed Bookings:</strong>
                                    <span class="text-success"><?php echo $confirmedBookings; ?></span>
                                </p>
                            </div>

                            <div class="report-section">
                                <h5>Total Revenue</h5>
                                <p><i
                                        class="fas fa-dollar-sign report-icon"></i><strong>$<?php echo number_format($totalRevenue, 2); ?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jsPDF and html2pdf Library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- CUSTOM JS -->
        <script>
            document.getElementById('exportBtn').addEventListener('click', function () {
                const reportContent = document.getElementById('reportContent');
                const options = {
                    margin: 1,
                    filename: 'daily_report.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
                    html2pdf: {
                        // Add a custom header before the report content
                        header: {
                            text: 'Villa Solaria\nDaily Report',
                            font: 'Helvetica',
                            size: 20,
                            color: '#000000',
                            padding: 10,
                            center: true,
                            bold: true
                        }
                    }
                };
                html2pdf().from(reportContent).set(options).save();
            });
        </script>
</body>

</html>