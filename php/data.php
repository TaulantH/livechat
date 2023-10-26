<?php
// Replace with your database connection code
include_once "config.php";

$output = '';

if (isset($_SESSION['unique_id'])) {
    $sql = "SELECT * FROM users";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$_SESSION['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $you = "";

            if ($query2 && mysqli_num_rows($query2) > 0) {
                $row2 = mysqli_fetch_assoc($query2);
                $result = $row2['msg'];
                $you = ($row2['outgoing_msg_id'] == $_SESSION['unique_id']) ? "You: " : "";
            } else {
                $result = "No messages available";
            }

            $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

            $offline = ($row['status'] == "Offline now") ? "offline" : "";

            $output .= '<a href="chat.php?id=' . $row['unique_id'] . '">
                <div class="content">
                    <img src="php/' . $row['img'] . '" alt="">
                    <div class="details">
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                </div>
                <div class="status-dot ' . $offline . '"><i class="fa fa-circle"></i></div>
            </a>';
        }

    } else {
        // Handle database query error here
        http_response_code(500);
    }
} else {
    header("location: ../login.php");
}
?>
