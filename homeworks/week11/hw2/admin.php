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
        'SELECT ' . 
        'P.id as id, P.content as content, P.title as title, ' .
        'P.created_at as created_at, U.nickname as nickname, U.username as username ' . 
        'from hsuan_posts as P ' .  
        'left join hsuan_users as U on P.username = U.username ' .
        'where P.is_deleted = 0 order by id desc'
    );
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
    <title>後台管理</title>
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

    <div class="card_admin">
        
            <?php 
                while($row = $result->fetch_assoc()) {
            ?>
                <div class="card_admin_list">
                    <div class="card_admin_title"><?php echo escape($row['title']); ?></div>
                    <div ><?php echo escape($row['created_at']); ?></div>
                    <a class="card_admin_btn" href='update_post.php?id=<?php echo escape($row['id']); ?>'>編輯</a>
                    <a class="card_admin_btn" href='handle_delete.php?id=<?php echo escape($row['id']); ?>'>刪除</a>   
                </div>
                <div class="card_admin_hr"></div>
            <?php }  ?>

 
            <a href="index.php" class="card_admin_btn">回首頁</a>
    </div>

    </main>
    <script>

    </script>
</body>
</html>