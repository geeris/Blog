<?php

    function getMenuLinks($menuType){
        global $connection;

        $menuLinks = $connection->query("SELECT mtml.*, ml.* FROM menu_type mt
         INNER JOIN menu_type_menu_link mtml ON mt.menu_type_id = mtml.menu_type_id
         INNER JOIN menu_link ml ON mtml.menu_link_id = ml.menu_link_id WHERE mt.type = '$menuType' ORDER BY mtml.priority")->fetchAll();
        //var_dump($menuLinks);
        return $menuLinks;
    }
?>