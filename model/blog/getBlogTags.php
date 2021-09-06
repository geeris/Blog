<?php
    require_once("../../config/connection.php");
    if(isset($_POST['getTagsRequest']))
    {   
        $code=200;
        header("Content-Type:application/json");
        global $connection;

        try{
        $result = $connection->query("SELECT * FROM tag ORDER BY title")->fetchAll();
        }
        catch(PDOException $ex){
            $message = $ex->getMessage();
            $content = "Get blog tags - select - $message";
            // $path = "../../";
            error($content);
        }
        
        echo json_encode($result);
        http_response_code($code);
    }
    else{
        session_destroy();
        header("Location:../../index.php");
    }
?>