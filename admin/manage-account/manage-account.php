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
                <div class="main-body container pt-5 pt-md-3 mt-5 mt-md-0">
                    <div class="container my-4">
                        <h2 class="text-center mb-4">Manage Your Account</h2>

                        <!-- Personal Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Personal Information</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" value="Orlando Dela Cruz">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" value="orlando@example.com">
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" value="orlando123">
                                    </div>
                                    <div class="mb-3">
                                        <label for="profile-pic" class="form-label">Profile Picture</label>
                                        <input type="file" class="form-control" id="profile-pic">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>

                        <!-- Security Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Security Settings</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Change Password</label>
                                        <input type="password" class="form-control" id="password"
                                            placeholder="Enter new password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="2fa" class="form-label">Two-Factor Authentication</label>
                                        <select class="form-select" id="2fa">
                                            <option value="disabled" selected>Disabled</option>
                                            <option value="enabled">Enabled</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Security</button>
                                </form>
                            </div>
                        </div>

                        <!-- Activity Logs -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Activity Logs</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">Logged in from IP: 192.168.1.1 on Jan 10, 2025</li>
                                    <li class="list-group-item">Changed password on Dec 25, 2024</li>
                                    <li class="list-group-item">Updated profile picture on Dec 1, 2024</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Delete Account -->
                        <div class="card mb-4">
                            <div class="card-header bg-danger text-white">
                                <h5>Delete Account</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-danger">Warning: This action is irreversible. Deleting your account will
                                    permanently
                                    remove all your data.</p>
                                <button class="btn btn-danger">Delete My Account</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN BODY -->

                <br><br><br><br>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CUSTOM JS -->
    <script src="../../admin/reports/reports.js"></script>
</body>

</html>