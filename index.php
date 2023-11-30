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
            <section class="form signup">
                <header class="chat-header">Realtime chat REGISTER</header>
                <form action="php/signup.php" method="POST" enctype="multipart/form-data" autocomplete="off">


                    <div class="name-details">
                        <div class="form-row">
                            <div class="field">
                                <label for="fname">First name</label>
                                <input type="text" name="fname" id="fname" placeholder="First name" required>
                            </div>
                            <div class="field">
                                <label for="lname">Last name</label>
                                <input type="text" name="lname" id="lname" placeholder="Last name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" placeholder="Email" required>
                            </div>
                            <div class="field">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" required>
                                <!-- <i class="fa fa-eye" id="togglePassword"></i> -->
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <label for="image">Select Image</label>
                                <input type="file" name="image" id="image" accept="image/" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <input type="submit" value="Register">
                            </div>
                        </div>

                    </div>
                </form>
                <div class="link">Already signed up? <a href="login.php">login</a></div>
            </section>
        </div>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
</body>

</html>