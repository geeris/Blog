<?php
    require_once("../../config/connection.php");

    if(isset($_POST['btnDeleteBlog']))
    {   
        header("Content-Type:application/json");

        $id = $_POST['id'];
        $code=200;
        
        $deleted = $connection->prepare("DELETE FROM blog WHERE blog_id=:id");
        $deleted->bindParam(":id", $id);

        try{
            $success = $deleted->execute();
        }
        catch(PDOException $ex){
            $message = $ex->getMessage();
            $content = "Delete blog - delete - $message";
            // $path = "../../";
            error($content);
        }

        if($success)
        {
            $message = "Blog has been successfully deleted";
        }
        else{
            $message = "An error has been occured";
        }

        echo json_encode($message);
        http_response_code($code);
    }
    else{
        session_destroy();
        header("Location:../../index.php");
    }
?>