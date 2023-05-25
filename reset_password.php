<?php
session_start();
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $email = $_POST["email"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Server-side validation
    if (empty($email) || empty($newPassword) || empty($confirmPassword)) {
        $showError = "All fields are required";
    } elseif ($newPassword != $confirmPassword) {
        $showError = "Passwords do not match";
    } else {
        // Check if the email exists in the database
        $sql = "SELECT * FROM users WHERE username = '$email'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);

        if ($numRows == 1) {
            // Update the user's password
            $hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = '$hash' WHERE username = '$email'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
                $successMsg = "Password reset successfully. You can now login with your new password.";
            } else {
                $showError = "Error updating password. Please try again later.";
            }
        } else {
            $showError = "Email address not found";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./partials/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">

    <title>Reset Password</title>
</head>
<body>
<div class="body">
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> ' . $successMsg . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ' . $showError . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }
    ?>

    <div class="container3">
        <div class="signup-head">
            <a href="index.php">
                <img src="./assets/Asset 212.png" alt="logo" class="signup-logo">
            </a>
        </div>
        <p class="text-center">Reset Your Password</p>
        <div class="whole-form2">
            <form action="" method="post" class="whole-form2">
                <div class="form-group">
                    <input type="email" class="form-cont2" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-cont2" name="new_password" placeholder="New Password" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-cont2" name="confirm_password" placeholder="Confirm Password"
                           required>
                </div>
                <button type="submit" class="btns5">Reset Password</button>
            </form>
            <p class="text-center"><a href="index.php" class="reset-link2">Back to login</a></p>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"></script>
</body>
</html>


