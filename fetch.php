<?php
// Replace with your database connection logic
include "php/config.php";

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['view'])) {
    $output = '';
    $count = 0;

    // Fetch the last 5 messages
    $query = "SELECT * FROM messages ORDER BY msg_id DESC LIMIT 5";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '
            <li>
                <a href="#">
                    <strong>Message from ' . $row["outgoing_msg_id"] . '</strong><br />
                    <small><em>' . $row["msg"] . '</em></small>
                </a>
            </li>
            ';
            $count++;
        }
    }

    $data = array(
        'notification' => $output,
        'unseen_notification' => $count
    );

    echo json_encode($data);
}

$mysqli->close();
?>
