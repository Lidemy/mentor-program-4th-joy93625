<?php 
    session_start();
    require_once("conn.php");
    require_once("utils.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" >
</head>
<body>
    <?php include_once('header.php'); ?>
    <section class="banner">
        <div class="banner_wrapper">
            <h2>存放技術之地</h2>
            <div>Welcome to my blog</div>
        </div>
    </section>
    <main class="cards_wrapper">
            <!-- <div class="board_btn-rigth">
                <a href="index.php" class="btn_read_more">回留言板</a>
                <a href="./register.php" class="btn_read_more">註冊</a>
            </div>
            <h1 class="board_title">登入</h1>
            <?php 
                if (!empty($_GET['errCode'])) {
                    $code = $_GET['errCode'];
                    $msg = 'error';
                    if ($code === '1') {
                        $msg = '資料不齊全';
                    } else if ($code === '2') {
                        $msg = '帳號或密碼資料錯誤';
                    }
                    echo '<h2 class="error">錯誤：' . $msg .'</h2>';
                }
            ?> -->
            <div class="card_login">
                <h2 class="card_login_title">Login</h2>
                <form action="handle_login.php" method="POST">
                    <div class="card_login_users">
                        <div class="card_login_label">
                            <span>USERNAME</span>
                            <input type="text" name="username">
                        </div>
                        <div class="card_login_label">
                            <span>PASSWORD</span>
                            <input type="password" name="password">
                        </div>
                    </div>
                    <input type='submit' value="登入" />
                </form>
            </div>
    </main>
</body>
</html>