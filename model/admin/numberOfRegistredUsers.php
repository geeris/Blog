<?php
    global $connection;

    $registred = $connection->query("SELECT COUNT(username) as r FROM user WHERE role_id = 1")->fetch();