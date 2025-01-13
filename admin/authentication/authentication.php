<?php
session_start();

// Redirect to dashboard if success is set
if (isset($_SESSION['success'])) {
    echo "<script>
            setTimeout(function() {
                window.location.href = '../../admin/dashboard/dashboard.php';
            }, 1000); // Redirect after 1seconds
          </script>";
    unset($_SESSION['success']); // Unset success session variable after redirection
}
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

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="../../admin/dashboard/dashboard.css">

    <!-- TITLE -->
    <title>Admin - Log In/Sign Up</title>
    <style>
        .left-side {
            background-color: brown;
            height: 100vh;
            display: flex;
            justify-content: center !important;
            align-items: center !important;
        }

        .login-btn,
        .signup-btn {
            background-color: #D3AB8B;
            color: white;
            margin-top: 30px;
        }

        .login-btn:hover,
        .signup-btn:hover {
            background-color: #C19D6B;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- LEFT SIDE -->
            <div class="left-side col-12 col-md-5 d-none d-md-flex">
                <img class="img-fluid" src="../../assets/image/logo-white.png" alt="logo" height="200" width="200">
            </div>

            <!-- RIGHT SIDE -->
            <div class="col-12 col-md-7 vh-100">
                <div class="container d-flex flex-column align-items-center justify-content-center mt-3">
                    <!-- HEADER -->
                    <img class="img-fluid" src="../../assets/image/logo-black.png" alt="logo" height="100" width="100">

                    <!-- LOG IN FORM -->
                    <div id="authForm">
                        <h2 class="mt-3 text-center">Log In</h2>
                        <form method="POST" action="signin.php">
                            <div class="form-floating mt-3 mb-3">
                                <input type="email" class="form-control shadow-none" id="loginEmail" name="email"
                                    placeholder="name@example.com" required>
                                <label for="loginEmail">Email address</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control shadow-none" id="loginPassword"
                                    name="password" placeholder="Password" required>
                                <label for="loginPassword">Password</label>
                            </div>
                            <div class="container d-flex flex-column align-items-center">
                                <button type="submit" name="signIn"
                                    class="login-btn btn rounded-pill w-100">Login</button>
                            </div>
                        </form>

                        <!-- Error Modal -->
                        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-light text-danger">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?= $_SESSION['error'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Wrapper d-flex justify-content-center mt-4">
                            <p> Cannot remember your password? <a href="#">Forgot Password</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Show Modals for Error -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if (isset($_SESSION['error'])): ?>
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        });
    </script>
</body>

</html>