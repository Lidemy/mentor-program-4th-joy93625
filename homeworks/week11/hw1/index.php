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
    $user = NULL;
    if (!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $user = getUserFromUsername($username);
    }
    $page = 1;
    if (!empty($_GET['page'])) {
      $page = intval($_GET['page']);
    }
    $items_per_page = 5;
    $offset = ($page - 1) * $items_per_page;
  
    
    $stmt = $conn->prepare(
        'SELECT ' . 
        'C.id as id, C.content as content, ' .
        'C.created_at as created_at, U.nickname as nickname, U.username as username ' . 
        'from comments as C ' .  
        'left join users as U on C.username = U.username ' .
        'where C.is_deleted IS NULL ' .   
        'ORDER BY C.id desc ' . 
        'limit ? offset ? '
    );
    $stmt->bind_param('ii', $items_per_page, $offset);
    $result = $stmt->execute();
    if (!$result) {
        die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();    
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
        <span class="borad_btn update_nickname">編輯暱稱</span>
        <?php if ($user && $user['role'] === 'ADMIN') { ?>
                 <a href="admin.php" class="borad_btn">管理後台</a>
        <?php } ?>
        <form class="hide board_nickname-form  board_new-comment-form" action="update_user.php" method="POST">
            <div>
                <span>新的暱稱：</span> 
                <input  class="board_nickname" type="text" name="nickname">
            </div>
            <input class="board_submit-btn" type="submit" />
        </form>
        <h3>Hello,<?php echo $user['nickname']; ?></h3>
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
    <?php if ($username && !hasPermission($user, 'create', NULL)) { ?>    
        <h3>你已被停權</h3>    
    <?php } else if ($username) { ?>
            <button class="board_submit-btn" type="submit">提交</button>
    <?php } else { ?>
            <h3>請登入發布留言</h3>
    <?php } ?>
        </form>
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
                            <?php echo escape($row['nickname']); ?>
                            (@<?php echo escape($row['username']);?>)
                        </span>
                        <span class="card_body-info-comma">·</span>
                        <span class="card_body-info-time">
                            <?php echo escape($row['created_at']); ?>
                        </span>
                        <?php if (hasPermission($user, 'update', $row)) { ?>
                        <a href="update_comment.php?id=<?php echo $row['id']; ?>">編輯</a>
                        <a href="delete_comment.php?id=<?php echo $row['id']; ?>">刪除</a>
                        <?php } ?>
                    </div>
                    <p class="card_body-content"><?php echo escape($row['content']); ?></p>
                </div>
            </div>
        <?php } ?>
    </section>
    <div class="board__hr"></div>
      <?php
        $stmt = $conn->prepare(
          'select count(id) as count from comments where is_deleted IS NULL'
        );
        $result = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];
        $total_page = ceil($count / $items_per_page);
      ?>
      <div class="page-info">
        <span>總共有 <?php echo $count ?> 筆留言，頁數：</span>
        <span><?php echo $page ?> / <?php echo $total_page ?></span>
      </div>
      <div class="paginator">
        <?php if ($page != 1) { ?> 
          <a href="index.php?page=1">首頁</a>
          <a href="index.php?page=<?php echo $page - 1 ?>">上一頁</a>
        <?php } ?>
        <?php if ($page != $total_page) { ?>
          <a href="index.php?page=<?php echo $page + 1 ?>">下一頁</a>
          <a href="index.php?page=<?php echo $total_page ?>">最後一頁</a> 
        <?php } ?>

      </div>
    </main>
    <script>
        var btn = document.querySelector('.update_nickname')
        btn.addEventListener('click', function() {
            var form = document.querySelector('.board_nickname-form')
            form.classList.toggle('hide')
        })
    </script>
</body>
</html>