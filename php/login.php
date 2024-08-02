<?php
session_start();
include_once "config.php";

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password']; // Do not hash the password for comparison

if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if ($sql) {
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);

            // Verify the password using password_verify
            if (password_verify($password, $row['password'])) {
                $status = "Active now";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

                if ($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success";
                }
            } else {
                echo "Email or Password is incorrect";
            }
        } else {
            echo "Email or Password is incorrect";
        }
    }
} else {
    echo "All input fields are required!";
}
?>
