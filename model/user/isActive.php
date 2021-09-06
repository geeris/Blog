<?php
    function changeIsActive($id, $new){
        
        // require_once("../../config/connection.php");
        global $connection;
        var_dump($connection);

        $prepare = $connection->prepare("UPDATE user SET is_active = :changeActive WHERE user_id = :id");

        $prepare -> bindParam(":changeActive", $new);
        $prepare -> bindParam(":id", $id);

        try{
            $prepare->execute();
        }
        catch(PDOException $ex){
                $message = $ex->getMessage();
                $content = "Change active user status - update - $message";
                error($content);
        }
   }

