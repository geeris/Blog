<?php
    require_once("configuration.php");
    require_once("visitedLog.php");
    require_once("getError.php");

    try{
        $connection=new PDO("mysql:host=$host;dbname=$dbname",$un , $pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);    

    }
    catch(PDOException $ex)
        {  
            $message = $ex->getMessage();
            $content = "Connection problems - $message";
            $path = "";
            error($content, $path);
        }
    visitedPages();