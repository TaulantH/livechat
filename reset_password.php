<?php
// Initialize the session
session_start();

// Include necessary files and configuration
include_once "php/config.php";
require_once "mail.php"; // Assuming you have a mailer script

if (isset($_POST["reset_request"])) {
    $email = $_POST["email"];

    // Check if the email/username exists in the database
    $query = "SELECT id, email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query); // Use $conn here, not $$conn

    if (mysqli_num_rows($result) == 1) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Calculate expiration time (e.g., 1 hour from now)
        $expirationTime = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Fetch the user's email from the database (if a row exists)
        $userRow = mysqli_fetch_assoc($result);
        $to = $userRow["email"];

        if ($to !== null) {
            // Store the token and expiration time in the database
            $userId = $userRow["id"];
            $insertTokenQuery = "INSERT INTO password_reset_tokens (user_id, token, expiration_time) VALUES ($userId, '$token', '$expirationTime')";
            mysqli_query($conn, $insertTokenQuery); // Use $conn here, not $$conn

            // Send an email with a link to reset the password
            $resetLink = "http://localhost/livechat/reset_pasword_form.php?token=$token";
            $subject = "Password Reset - You have one hour to reset!";
            $message = "Click the link below to reset your password:\n\n$resetLink";

            // Send the email using your mailer script
            $emailResult = sendMail($to, '', $subject, $message);

            if ($emailResult == true) {
                // Email sent successfully
                $_SESSION["success_message"] = "Password reset link sent to your email.";
                echo '<script>alert("Password reset link sent to your email. Check your inbox!");</script>';

                header("Location: login.php");
                exit;
            } else {
                // Email sending failed
                $_SESSION["error_message"] = "Email sending failed: $emailResult";
                echo '<script>alert("Email sending failed. Please try again later or contact support.");</script>';

                header("Location: reset_password_request.php"); // Redirect to a password reset request page
                exit;
            }
        } else {
            // User's email is null (should not happen)
            $_SESSION["error_message"] = "User's email is missing in the database.";
            echo '<script>alert("Email sending failed. Please try again later or contact support.");</script>';

            header("Location: reset_password_request.php.php"); // Redirect to a password reset request page
            exit;
        }
    } else {
        // User not found in the database
        $_SESSION["error_message"] = "User not found.";
        echo '<script>alert("User not found. Please check your email or username.");</script>';

        header("Location: reset_password_request.php"); // Redirect to a password reset request page
        exit;
    }
}

if (isset($_POST["reset_password"])) {
    $token = $_POST["token"];
    $password = $_POST["password"];

    // Validate the token and check if it's still valid (not expired)
    $query = "SELECT user_id, expiration_time FROM password_reset_tokens WHERE token = '$token'";
    $result = mysqli_query($conn, $query); // Use $conn here, not $$conn

    if (mysqli_num_rows($result) == 1) {
        $tokenData = mysqli_fetch_assoc($result);
        $expirationTime = strtotime($tokenData["expiration_time"]);

        if (time() < $expirationTime) {
            // Token is valid and not expired
            $userId = $tokenData["user_id"];

            // Hash the new password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Update the user's password in the database
            $updatePasswordQuery = "UPDATE users SET password = '$hashedPassword' WHERE id = $userId";
            mysqli_query($conn, $updatePasswordQuery); // Use $conn here, not $$conn

            // Delete the used token
            $deleteTokenQuery = "DELETE FROM password_reset_tokens WHERE token = '$token'";
            mysqli_query($conn, $deleteTokenQuery); // Use $conn here, not $$conn

            $_SESSION["success_message"] = "Password reset successfully. You can now login with your new password.";
            header("Location: login.php");
            exit;
        } else {
            // Token has expired
            $_SESSION["error_message"] = "Token has expired.";
            header("Location: reset_password.php?token=$token");
            exit;
        }
    } else {
        // Invalid token
        $_SESSION["error_message"] = "Invalid token.";
        header("Location: reset_password.php?token=$token");
        exit;
    }
}
?>
