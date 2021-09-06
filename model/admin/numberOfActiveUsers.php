<?php
    global $connection;

    $active = $connection->query("SELECT COUNT(username) as a FROM user WHERE is_active = 1 AND role_id = 1")->fetch();