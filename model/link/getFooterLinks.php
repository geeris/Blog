<?php
    function getFooterLinks($footerType){
        global $connection;

        $footerLinks = $connection->query("SELECT fl.* FROM footer_type ft
         INNER JOIN footer_link fl ON ft.footer_type_id = fl.footer_type_id
         WHERE ft.type = '$footerType'")->fetchAll();
        //var_dump($menuLinks);
        return $footerLinks;
    }