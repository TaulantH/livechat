<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_msg_id = mysqli_real_escape_string($conn, $_POST['outgoing_msg_id']);
    $incoming_msg_id = mysqli_real_escape_string($conn, $_POST['incoming_msg_id']);
    $messageCount = mysqli_real_escape_string($conn, $_POST['messageCount']);

    $output = "";

    $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = $outgoing_msg_id AND incoming_msg_id = $incoming_msg_id)
            OR (outgoing_msg_id = $incoming_msg_id AND incoming_msg_id = $outgoing_msg_id)
            ORDER BY msg_id DESC LIMIT $messageCount";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $messageTime = date('Y-m-d H:i:s', strtotime($row['message_time']));
            $msg = $row['msg'];

            // Check if the message is an image file and display it as an image
            if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $msg)) {
                $msg = '<img src="php/' . $msg . '" alt="Image" style="max-width: 100%;">';
            }

            if ($row['outgoing_msg_id'] == $outgoing_msg_id) {
                $output = '<div class="chat outgoing">
                    <img src="php/uploads/' . $row['img'] . '" alt="">
                    <div class="details">
                        <p class="outgoing-chat">
                            ' . $msg . ' 
                            <span class="message-time">' . $messageTime . '</span>
                        </p>
                    </div>
                </div>' . $output;
            } else {
                $output = '<div class="chat incoming">
                    <img src="php/uploads/' . $row['img'] . '" alt="">
                    <div class="details">
                        <p class="incoming-chat">
                            ' . $msg . ' 
                            <span class="message-time">' . $messageTime . '</span>
                        </p>
                    </div>
                </div>' . $output;
            }
        }
        echo $output;
    }
} else {
    header("location: ../login.php");
}
?>
