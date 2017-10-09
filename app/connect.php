<?php
    require_once '../admin.php';

    $link = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    if (!$link) {
        die('<p style="color:red">'.mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
    }
    mysqli_query($link, "SET NAMES utf8");