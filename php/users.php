<?php
session_start();
include_once "config.php";

// Get the unique ID of the logged-in user
$outgoing_msg_id = $_SESSION['unique_id'];

// Fetch all users except the logged-in user
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id != {$outgoing_msg_id}");
$output = "";

if (mysqli_num_rows($sql) == 0) {
    $output .= "No users are available for chat";
} else {
    while ($row = mysqli_fetch_assoc($sql)) {
        // Fetch the latest message between the logged-in user and the other user
        $sql2 = "SELECT * FROM messages WHERE 
                (incoming_msg_id = {$row['unique_id']} AND outgoing_msg_id = {$outgoing_msg_id})
                OR (incoming_msg_id = {$outgoing_msg_id} AND outgoing_msg_id = {$row['unique_id']})
                ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $you = "";

        if ($query2 && mysqli_num_rows($query2) > 0) {
            $row2 = mysqli_fetch_assoc($query2);
            $result = $row2['msg'];
            $you = ($row2['outgoing_msg_id'] == $outgoing_msg_id) ? "You: " : "";
        } else {
            $result = "No messages available";
        }

        $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;
        $offline = ($row['status'] == "Offline now") ? "offline" : "";

        $output .= '<a href="chat.php?id=' . $row['unique_id'] . '">
            <div class="content">
                <img src="php/' . $row['img'] . '" alt="">
                <div class="details">
                    <span>' . $row['fname'] . ' ' . $row['lname'] . '</span>
                    <p>' . $you . $msg . '</p>
                </div>
            </div>
            <div class="status-dot ' . $offline . '"><i class="fa fa-circle"></i></div>
        </a>';
    }
}

echo $output;
?>
