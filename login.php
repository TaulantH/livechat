
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div class="container">
    <div class="wrapper">
        <section class="form login">
        <header class="chat-header">Realtime chat LOGIN</header>
    
            <form action="php/login.php">
            <div class="name-details">
                        <div class="form-row">
                    <div class="field">
                        <label for="">Email Address</label>
                        <input type="email" name="email" placeholder="email" id="">
                    </div>
                        </div>
                        <div class="form-row">
                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <!-- <i class="fa fa-eye" id="togglePassword"></i> -->
                    </div>
                        </div>
                    <div class="form-row">
                    <div class="field">
                        <input type="submit" value="login">
                    </div>
                    </div>
                </div>
            </form>
            <div class="link">Don't have account? <a href="index.php">signup now</a><br>

            <a href="reset_password_request.php" class="text-black-50 fw-bold color">Forgot password</a>

            </div>

        </section>
    </div>
</div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
    
</body>
</html>