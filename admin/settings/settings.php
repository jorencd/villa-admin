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
            <?php include '../../components/admin-sidebar/sidebar.php'; ?>

            <!-- MAIN CONTENT -->
            <div class="col-12 col-md-10 p-0 bg-body-tertiary vh-100 overflow-auto main-body">
                <!-- HEADER -->
                <?php include '../../components/admin-header/header.php'; ?>

                <!-- MAIN BODY -->
                <div class="main-body container pt-5 pt-md-3 mt-5 mt-md-0">
                    <div class="container my-4">
                        <h2 class="text-center mb-4">Admin Panel - Settings</h2>

                        <div class="accordion" id="settingsAccordion">
                            <!-- General Settings -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="generalSettingsHeading">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#generalSettings" aria-expanded="true"
                                        aria-controls="generalSettings">
                                        General Settings
                                    </button>
                                </h2>
                                <div id="generalSettings" class="accordion-collapse collapse show"
                                    aria-labelledby="generalSettingsHeading" data-bs-parent="#settingsAccordion">
                                    <div class="accordion-body">
                                        <form>
                                            <div class="mb-3">
                                                <label for="siteName" class="form-label">Website Name</label>
                                                <input type="text" class="form-control" id="siteName"
                                                    value="My Admin Panel">
                                            </div>
                                            <div class="mb-3">
                                                <label for="siteLogo" class="form-label">Upload Logo</label>
                                                <input type="file" class="form-control" id="siteLogo">
                                            </div>
                                            <div class="mb-3">
                                                <label for="defaultLanguage" class="form-label">Default Language</label>
                                                <select class="form-select" id="defaultLanguage">
                                                    <option value="en" selected>English</option>
                                                    <option value="es">Spanish</option>
                                                    <option value="fr">French</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Settings -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="securitySettingsHeading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#securitySettings" aria-expanded="false"
                                        aria-controls="securitySettings">
                                        Security Settings
                                    </button>
                                </h2>
                                <div id="securitySettings" class="accordion-collapse collapse"
                                    aria-labelledby="securitySettingsHeading" data-bs-parent="#settingsAccordion">
                                    <div class="accordion-body">
                                        <form>
                                            <div class="mb-3">
                                                <label for="twoFactorAuth" class="form-label">Two-Factor
                                                    Authentication</label>
                                                <select class="form-select" id="twoFactorAuth">
                                                    <option value="disabled" selected>Disabled</option>
                                                    <option value="enabled">Enabled</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ipWhitelist" class="form-label">IP Whitelist</label>
                                                <textarea class="form-control" id="ipWhitelist" rows="3"
                                                    placeholder="Enter allowed IP addresses, one per line"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Security</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Notification Settings -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="notificationSettingsHeading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#notificationSettings" aria-expanded="false"
                                        aria-controls="notificationSettings">
                                        Notification Settings
                                    </button>
                                </h2>
                                <div id="notificationSettings" class="accordion-collapse collapse"
                                    aria-labelledby="notificationSettingsHeading" data-bs-parent="#settingsAccordion">
                                    <div class="accordion-body">
                                        <form>
                                            <div class="mb-3">
                                                <label for="emailNotifications" class="form-label">Enable Email
                                                    Notifications</label>
                                                <select class="form-select" id="emailNotifications">
                                                    <option value="yes" selected>Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="notificationType" class="form-label">Preferred Notification
                                                    Method</label>
                                                <select class="form-select" id="notificationType">
                                                    <option value="email" selected>Email</option>
                                                    <option value="sms">SMS</option>
                                                    <option value="push">Push Notifications</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Preferences</button>
                                        </form>
                                    </div>
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
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>