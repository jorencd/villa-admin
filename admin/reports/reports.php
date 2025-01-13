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
            <?php include'../../components/admin-sidebar/sidebar.php'; ?>

            <!-- MAIN CONTENT -->
            <div class="col-12 col-md-10 p-0 bg-body-tertiary vh-100 overflow-auto main-body">
                <!-- HEADER -->
                <?php include'../../components/admin-header/header.php';?>

                <!-- MAIN BODY -->
                <div class="main-body container pt-3">
                    <div class="container">
                        <h3 class="text-center"><i class="fas fa-chart-line"></i> Report</h3>
                        <div class="row my-4 gy-2">
                            <div class="col-12 col-md-6">
                                <!-- DROPDOWN SELECT -->
                                <label for="reportType" class="form-label">Select Report Type</label>
                                <select class="form-select">
                                    <option value="annual">Annual Income</option>
                                    <option value="monthly">Monthly Income</option>
                                    <option value="daily">Daily Income</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-md-end justify-content-start align-items-end">
                                <!-- EXPORT PDF -->
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                    Export to PDF
                                </button>
                            </div>
                        </div>
                        <!-- REPORT -->
                        <div id="reportContent" class="p-4 border rounded bg-light mt-4">
                            <h5>Annual Income</h5>
                            <table class="table table-bordered mt-3">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Income</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2024</td>
                                        <td>$100,000.00</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2023</td>
                                        <td>$95,000.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p><strong>Total Annual Income:</strong> $195,000.00</p>

                            <h5 class="mt-4">Monthly Income</h5>
                            <table class="table table-bordered mt-3">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Income</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>January 2025</td>
                                        <td>$8,500.00</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>December 2024</td>
                                        <td>$8,000.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p><strong>Total Monthly Income:</strong> $16,500.00</p>

                            <h5 class="mt-4">Daily Income</h5>
                            <table class="table table-bordered mt-3">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Income</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2025-01-10</td>
                                        <td>$300.00</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2025-01-09</td>
                                        <td>$250.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p><strong>Total Daily Income:</strong> $550.00</p>
                        </div>
                    </div>


                    <!-- CONFIRMATION MODAL -->
                    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Confirm Export</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to export the report as a PDF?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">Export PDF</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN BODY -->

                <br><br><br><br>
            </div>
        </div>
    </div>


    <!-- jsPDF Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CUSTOM JS -->
    <script src="../../admin/reports/reports.js"></script>
</body>

</html>