<?php
session_start();
include_once "config.php";
$outgoing_msg_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_msg_id}");
$output = "";

if (mysqli_num_rows($sql) == 0) {
    $output .= "No users are available for chat";
} else {
   include "data.php";
}

echo $output;
?>
