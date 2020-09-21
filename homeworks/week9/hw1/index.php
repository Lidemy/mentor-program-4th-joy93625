<?php 
    session_start();
    require_once("./conn.php");
    require_once("./utils.php");

    /*
        1.從cookie 裡面讀取 PHPSESSID(token)
        2.從檔案裡面讀取 session id 的內容
        3.放到 $_SESSION
    */
    $username = NULL;
    if (!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }
    
    $result = $conn->query("SELECT * FROM hsuan_comments");
    if (!$result) {
        die('Error:' . $conn->error);
    }
?>

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
    <?php if (!$username) { ?>
        <div class="board_btn-rigth">
            <a href="./register.php" class="borad_btn">註冊</a>
            <a href="./login.php" class="borad_btn">登入</a>
        </div>
    <?php } else { ?>
        <a href="./logout.php" class="borad_btn">登出</a>
        <h3>Hello,<?php echo $username; ?></h3>
    <?php } ?>
        <h1 class="board_title">Conmment</h1>
    <?php 
        if (!empty($_GET['errCode'])) {
            $code = $_GET['errCode'];
            $msg = 'error';
            if ($code === '1') {
                $msg = '資料不齊全';
            }
            echo '<h2 class="error">錯誤：' . $msg .'</h2>';
        }
    ?>
        <form class="board_new-comment-form" action="handle_add_comment.php" method="POST">
            <textarea class="board_content" name="content" rows="10"></textarea>
    <?php if ($username) { ?>
            <button class="board_submit-btn" type="submit">提交</button>
        </form>
    <?php } else { ?>
            <h3>請登入發布留言</h3>
    <?php } ?>
            <div class="board_hr"></div>
    <section class="cards">
    <?php 
    while ($row = $result->fetch_assoc()) {
    ?>    
            <div class="card">
                <div class="card_avatar"></div>
                <div class="card_body">
                    <div class="card_body-info">
                        <span class="card_body-info-nickname">
                            <?php echo $row['nickname'] ?>
                        </span>
                        <span class="card_body-info-comma">·</span>
                        <span class="card_body-info-time">
                            <?php echo $row['created_at'] ?>
                        </span>
                    </div>
                    <p class="card_body-content"><?php echo $row['content'] ?></p>
                </div>
            </div>
    <?php } ?>
    </section>
    </main>
</body>
</html>