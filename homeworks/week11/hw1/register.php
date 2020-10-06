<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>留言板</title>
    <link rel="stylesheet" href="style.css" >
</head>
<body>
    <header class="warning">
        <strong>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</strong>
    </header>
    <main class="board">
        <div class="board_btn-rigth">
            <a href="index.php" class="borad_btn">回留言板</a>
            <a href="./login.php" class="borad_btn">登入</a>
        </div>
        <h1 class="board_title">註冊</h1>
        <?php 
            if (!empty($_GET['errCode'])) {
                $code = $_GET['errCode'];
                $msg = 'error';
                if ($code === '1') {
                    $msg = '資料不齊全';
                } else if ($code === '2') {
                    $msg = '帳號已被註冊';
                }
                echo '<h2 class="error">錯誤：' . $msg .'</h2>';
            }
        ?>
        <form class="board_new-comment-form" action="handle_register.php" method="POST">
            <div>
                <span>暱稱：</span>
                <input  class="board_nickname" type="text" name="nickname">
            </div>
            <div>
                <span>帳號：</span> 
                <input  class="board_nickname" type="text" name="username">
            </div>
            <div>
                <span>密碼：</span>
                <input  class="board_nickname" type="password" name="password">
            </div>
            <div>
                <button class="board_submit-btn" type="submit">提交</button>
            </div>
        </form>
    </main>
</body>
</html>