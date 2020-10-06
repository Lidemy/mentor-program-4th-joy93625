<?php 
    $uri = $_SERVER['REQUEST_URI'];
    $isAdminPage = (strpos($uri, 'admin.php') !== false);
?>

<nav class="navbar">
    <div class="wrapper navbar_wrapper">
        <a href="index.php" class="navbar_sitename">Who's Blog</a>
        <ul class="navbar_list">
        <div>
            <li><a class="active" href="#">文章列表</a></li>
            <li><a href="#">分類專區</a></li>
            <li><a href="#">關於我</a></li>
        </div>
        <div>
            <?php if (!empty($_SESSION['username'])) { ?>
                <?php if ($isAdminPage) { ?>
                    <li><a href="new_post.php">發布文章</a></li>
                <?php } else { ?>
                <li><a href="admin.php">後台管理</a></li>
                <?php } ?>
                <li><a href="logout.php">登出</a></li>
            <?php } else { ?>
                <li><a href="login.php">登入</a></li>    
            <?php } ?>    
        </div>
        </ul>
    </div>
</nav>