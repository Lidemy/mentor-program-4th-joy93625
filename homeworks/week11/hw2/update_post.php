<?php 
    session_start();
    require_once("./conn.php");
    require_once("./utils.php");
    require_once("./check_permission.php");

    $username = NULL;
    $user = NULL;
    if (!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }

    $stmt = $conn->prepare(
        'SELECT * FROM hsuan_posts ORDER BY created_at DESC'
    );
    $result = $stmt->execute();
    if (!$result) {
        die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();    
    $id = intval($_GET['id']);
    $stmt = $conn->prepare(
        'SELECT ' . 
        'P.id as id, P.content as content, P.title as title, ' .
        'P.created_at as created_at, U.nickname as nickname, U.username as username ' . 
        'from hsuan_posts as P ' .  
        'left join hsuan_users as U on P.username = U.username ' .
        'where P.id = ?'
    );
    $stmt->bind_param('i', $id);
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
    <title>發布文章</title>
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
            <div class="card_newpost">
                <form action="handle_update_post.php" method="POST">
                    <div class="card_newpost_label">
                        <span>編輯文章：</span>
                        <input name="title" class="card_newpost_title" placeholder="請輸入文章標題" value="<?php echo escape($row['title']); ?>" />
                    </div>
                    <div class="card_newpost_label">
                        <textarea name="content" id="" cols="30" rows="10"><?php echo escape($row['content']); ?></textarea>
                    </div>
                    <div class="card_newpost_btn-wrapper">
                        <input class="card_newpost_btn" value="送出" type="submit"/>
                    </div>
                    <input type="hidden" name="id" value="<?php echo escape($row['id']); ?>">
                    <input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                </form>
            </div>
    </main>
</body>
</html>