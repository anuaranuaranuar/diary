<?php
        session_destroy();
        setcookie("id", "", time() - 60 * 60);
        $_COOKIE["id"] = "";
        header("location:diary.php")
        ?>
