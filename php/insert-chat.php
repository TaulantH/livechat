<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_msg_id = mysqli_real_escape_string($conn, $_POST['outgoing_msg_id']);
    $incoming_msg_id = mysqli_real_escape_string($conn, $_POST['incoming_msg_id']);
    $message = mysqli_real_escape_string($conn, $_POST['msg']);

    // Handle file upload
    $file_uploaded = false;
    $file_path = '';

    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_new_name = uniqid('', true) . '.' . $file_ext;
        $file_destination = 'uploads/' . $file_new_name;

        if (move_uploaded_file($file_tmp_name, $file_destination)) {
            $file_path = $file_destination;
            $file_uploaded = true;
        }
    }

    if ($file_uploaded) {
        // If file was uploaded, treat it as an image message
        $message_type = 'image';
        $message_content = $file_path; // Store image path as message content
    } else {
        // Otherwise, treat it as a text message
        $message_type = 'text';
        $message_content = $message;
    }

    if (!empty($message_content)) {
        // Insert message into database
        $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg_type, msg) VALUES ('$incoming_msg_id', '$outgoing_msg_id', '$message_type', '$message_content')";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            http_response_code(200);
            echo "Message sent successfully";
        } else {
            http_response_code(500);
            echo "Failed to send message";
        }
    } else {
        http_response_code(400);
        echo "Message cannot be empty";
    }
} else {
    header("location: ../login.php");
}
?>
