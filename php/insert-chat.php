<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_msg_id = mysqli_real_escape_string($conn, $_POST['outgoing_msg_id']);
    $incoming_msg_id = mysqli_real_escape_string($conn, $_POST['incoming_msg_id']);
    $message = mysqli_real_escape_string($conn, $_POST['msg']);
    

    if (!empty($message)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            VALUES ('$incoming_msg_id', '$outgoing_msg_id', '$message')");

        if ($sql) {
            // Successfully inserted message
            http_response_code(200);
        } else {
            // Error in database insertion
            http_response_code(500);
        }
    }
} else {
    header("location: ../login.php");
}
?>
