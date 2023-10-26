<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body>
    <div class="container">
    <div class="wrapper">
        <section class ="chat-area">
            <header>
                <?php 
                include_once "php/config.php";
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$id}");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <a href="users.php" class="back-icon"><i class="fa fa-arrow-left"></i></a>
                <img src="php/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname'] . " " . $row['lname']; ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            </header>
            <div class="chat-box">
            </div>
            <form action="#" method="POST" class="typing-area" autocomplete="off">
            <input type="text" name="incoming_msg_id" value="<?php echo $id; ?>" hidden>
                <input type="text" name="outgoing_msg_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="msg" placeholder="Type a message here..." class="input-field" id="">
                <button><i class="fa fa-telegram"></i></button>
            </form>
        </section>
    </div>
    </div>
    <script src="javascript/chat.js"></script>
</body>

</html>
