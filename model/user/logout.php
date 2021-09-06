<?php
    session_start();
    require_once("../../config/connection.php");
    require("isActive.php");

    $id = $_SESSION['user']->user_id;
    changeIsActive($id, 0);
    
    session_destroy();
    header("location:../../index.php");
?>
    