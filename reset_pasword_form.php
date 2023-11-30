<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <header class="chat-header">Reset password</header>
            <?php if (isset($error)) : ?>
                <p><?php echo $error; ?></p>
            <?php else : ?>
                <form method="post" action="reset_password.php">
                    <div class="name-details">
                        <div class="form-row">
                            <div class="field">
                                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                                <label for="new_password">New Password:</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="field">
                            <input type="submit" value="Reset password" name="reset_password">
                            </div>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>