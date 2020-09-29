<?php
    function generateToken() {
        $s = '';
        for ($i=1; $i<=16; $i++) {
            $s .= chr(rand(65,90));
        }
        return $s;
    }
    function getUserFromUsername($username) {
        global  $conn;



        $sql = sprintf(
            "SELECT * FROM users where username = '%s'",
            $username
        );
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row; //username, id, nickname
    }

    function escape($str) {
        return htmlspecialchars($str, ENT_QUOTES);
    }
    // $action: update, delete, create
    function hasPermission($user, $action, $comment) {
        if($user === NULL) {
            return;
        }

        if ($user["role"] === "ADMIN") {
            return true;
        }

        if ($user["role"] === "NORMAL") {
            if ($action === "create") return true;
            return $comment["username"] === $user["username"];
        }

        if ($user["role"] === "BANNED") {
            return $action !== "create";
        }
    }
    function isAdmin($user) {
        return $user["role"] === "ADMIN";
    }

?>