<?php

    function visitedPages(){
        try{
            $file = fopen(LOG_FAJL, 'ab');
            $content='';
            $page = $_SERVER["PHP_SELF"];
            // $date = time();
            $content = "$page \n";

            fwrite($file, $content);
            fclose($file);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }