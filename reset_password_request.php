<?php
include "reset_password.php";

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <form method="post" action="#">
                <header class="chat-header">Password Reset Request</header>
                <div class="name-details">
                    <div class="form-row">
                        <div class="field">
                            <label for="email_or_username">Email or Username:</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="field">
                            <input type="submit" value="Request" name="reset_request">
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</body>

</html>