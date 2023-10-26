<?php
session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $checkEmailQuery = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $checkEmailQuery);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo "$email - This email already exists!";
            } else {
                if (isset($_FILES['image'])) {
                    $img_name = $_FILES['image']['name'];
                    $img_tmp = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);
                    $extensions = ['png', 'jpeg', 'jpg'];

                    if (in_array($img_ext, $extensions)) {
                        $time = time();
                        $new_img_name = $time . $img_name;
                        $image_path = "images/" . $new_img_name;

                        if (move_uploaded_file($img_tmp, $image_path)) {
                            $status = "Active now";
                            $random_id = rand(100000, 999999);

                            $insertQuery = "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                            VALUES ('$random_id', '$fname', '$lname', '$email', '$password', '$image_path', '$status')";

                            $insertResult = mysqli_query($conn, $insertQuery);

                            if ($insertResult) {
                                $selectQuery = "SELECT unique_id FROM users WHERE email = '$email'";
                                $selectResult = mysqli_query($conn, $selectQuery);

                                if ($selectResult && mysqli_num_rows($selectResult) > 0) {
                                    $row = mysqli_fetch_assoc($selectResult);
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo "success";
                                }
                            } else {
                                echo "Something went wrong!";
                            }
                        } else {
                            echo "Failed to upload image.";
                        }
                    } else {
                        echo "Please select an image file with the correct format (png, jpeg, jpg).";
                    }
                } else {
                    echo "Please select an image file!";
                }
            }
        } else {
            echo "Query error.";
        }
    } else {
        echo "$email - This is not a valid email";
    }
} else {
    echo "All input fields are required!";
}
?>
