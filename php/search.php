<?php  
session_start();
include_once 'config.php';
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$output = "";

$sql = mysqli_query($conn, "SELECT * FROM users WHERE fname LIKE '%$searchTerm%' OR lname LIKE '%$searchTerm%'");

if(mysqli_num_rows($sql) > 0){
    while ($row = mysqli_fetch_assoc($sql)) {
        // Define and set the values for $you and $offline based on your business logic
        $you = '';  // Define the logic for $you here
        $offline = ''; // Define the logic for $offline here

        // Construct the HTML output for each user
        $output .= '<a href="chat.php?id=' . $row['unique_id'] . '">
            <div class="content">
                <img src="php/' . $row['img'] . '" alt="">
                <div class="details">
                    <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                    <p>' . $you . '</p>
                </div>
            </div>
            <div class="status-dot ' . $offline . '"><i class="fa fa-circle"></i></div>
        </a>';
    }
} else {
    $output = "No user found";
}

echo $output;
?>
