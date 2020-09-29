
<?php 
    session_start();
    require_once("./conn.php");
    require_once("./utils.php");

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
    <link rel="stylesheet" href="style.css">
    <title>Blog</title>
</head>
<body>
    <?php include_once('header.php'); ?>
    <section class="banner">
        <div class="banner_wrapper">
            <h2>存放技術之地</h2>
            <div>Welcome to my blog</div>
        </div>
    </section>
    <main>
        <div class="cards_wrapper">
            <div class="cards">
            <?php 
                while($row = $result->fetch_assoc()) {
            ?>
                <div class="card">
                    <div class="card_header">
                        <div class="card_title">
                            <?php echo escape($row['title']); ?>
                        </div>
                        <?php if (!empty($username)) { ?>
                            <a href="update_post.php?id=<?php echo escape($row['id']); ?>" class="btn_card_update" >
                                編輯
                            </a>
                        <?php } ?>
                    </div>
                                       
                    <div class="card_time">
                        <?php echo escape($row['created_at']); ?>
                    </div>
                    <div class="card_content">
                        <?php echo substr(escape($row['content']),0, 200); ?>
                    </div>
                    <a class="btn_read_more" href="post.php?id=<?php echo escape($row['id']); ?>">READ MORE</a>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>
</body>
</html>