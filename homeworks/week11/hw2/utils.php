<?php

    function getUserFromUsername($username) {
        global  $conn;



        $sql = sprintf(
            "SELECT * FROM hsuan_users where username = '%s'",
            $username
        );
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row; //username, id, nickname
    }

    function escape($str) {
        return htmlspecialchars($str, ENT_QUOTES);
    }

?>