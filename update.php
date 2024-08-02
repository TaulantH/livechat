<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
        exit();
    }
    include_once "php/config.php";
    
    if (isset($_GET['update_id'])) {
        $unique_id = $_GET['update_id'];
        $unique_id = mysqli_real_escape_string($conn, $unique_id);
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '$unique_id'");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
        } else {
            header("location: users.php");
            exit();
        }
    }

    if(isset($_POST['update'])) {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);

        // Validate first and last name
        if (empty($fname) || empty($lname)) {
            $error = "First Name and Last Name cannot be empty.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname) || !preg_match("/^[a-zA-Z\s]+$/", $lname)) {
            $error = "Invalid characters in First Name or Last Name.";
        } else {
            $update_query = "UPDATE users SET fname = '$fname', lname = '$lname'";
            
            if (!empty($_FILES['img']['name'])) {
                $img_name = $_FILES['img']['name'];
                $img_type = $_FILES['img']['type'];
                $img_tmp_name = $_FILES['img']['tmp_name'];
                $img_error = $_FILES['img']['error'];
                $img_size = $_FILES['img']['size'];

                // File upload validation
                $allowed_types = ["image/jpeg", "image/jpg", "image/png"];
                $allowed_extensions = ["jpeg", "jpg", "png"];
                $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);

                if ($img_error === UPLOAD_ERR_OK) {
                    if (in_array($img_type, $allowed_types) && in_array($img_ext, $allowed_extensions) && $img_size <= 5000000) { // 5MB limit
                        $new_img_name = time() . "_" . basename($img_name);
                        $img_upload_path = "images/" . $new_img_name;
                        if (move_uploaded_file($img_tmp_name, $img_upload_path)) {
                            $update_query .= ", img = '$img_upload_path'";
                        } else {
                            $error = "Failed to upload image.";
                        }
                    } else {
                        $error = "Invalid image file or size.";
                    }
                } else {
                    $error = "Error uploading image.";
                }
            }

            if (!isset($error)) {
                $update_query .= " WHERE unique_id = '$unique_id'";
                $update_query = mysqli_query($conn, $update_query);

                if ($update_query) {
                    header("location: users.php");
                    exit();
                } else {
                    $error = "Failed to update profile.";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="wrapper">
        <section class="form update">
            <header>Update Profile</header>
            <?php if (isset($error)): ?>
                <div class="error-text"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="field input">
                    <label>First Name</label>
                    <input type="text" name="fname" value="<?php echo htmlspecialchars($row['fname']); ?>" required>
                </div>
                <div class="field input">
                    <label>Last Name</label>
                    <input type="text" name="lname" value="<?php echo htmlspecialchars($row['lname']); ?>" required>
                </div>
                <div class="field input">
                    <label>Status</label>
                    <input type="text" value="<?php echo htmlspecialchars($row['status']); ?>" readonly>
                </div>
                <div class="field image">
                    <label>Select Image (optional)</label>
                    <input type="file" name="img" accept="image/jpeg, image/jpg, image/png">
                </div>
                <div class="field button">
                    <input type="submit" name="update" value="Update">
                </div>
            </form>
        </section>
    </div>
</div>
</body>
</html>
