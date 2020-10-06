<?php 
    session_start();
    require_once("./conn.php");
    require_once("./utils.php");

    $id = $_GET['id'];

    $username = NULL;
    $user = NULL;
    if (!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $user = getUserFromUsername($username);
    }
    
    $stmt = $conn->prepare(
        'select * from comments where id = ?'
    );
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    if (!$result) {
        die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
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
    <h1 class="board_title">編輯留言</h1>
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
    <form class="board_new-comment-form" action="handle_update-comment.php" method="POST">
        <textarea class="board_content" name="content" rows="5"><?php echo $row['content']; ?></textarea>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
            <button class="board_submit-btn" type="submit">提交</button>
    </form>
    </main>
</body>
</html>