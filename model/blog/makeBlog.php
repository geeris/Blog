<?php
    require_once("../../config/connection.php");
    session_start();
    $cameFrom =  $_SERVER["HTTP_REFERER"];
    // var_dump($_POST);
    if(isset($_POST['btnPostBlog']))
    {
        $errors=[];

        if(isset($_POST['blogTitle']) && preg_match("/^.{1,}$/", $_POST['blogTitle']))
        {
            $title = $_POST['blogTitle'];
        }
        else
        {
            array_push($errors, "Fill the title field");
        }
    
        if(isset($_POST['blogText']) && preg_match("/^.{1,}$/", $_POST['blogText']))
        {
            $text = $_POST['blogText'];
        }
        else
        {
            array_push($errors, "Fill the text field");
        }

        if(isset($_POST['chooseTags']))
        {
            $tags = $_POST['chooseTags'];
        }
        else
        {
            array_push($errors, "Choose at least one tag");
        }

        if(isset($_FILES['blogFile']) && !empty($_FILES['blogFile']))
        {
            $fileName = $_FILES['blogFile']['name'];
            $tmpLocation = $_FILES['blogFile']['tmp_name'];

            $arrayName = explode(".", $fileName);
            $ext = end($arrayName);
            $time = time();

            $newFile = "../../assets/images/blogImages/"."small".$time.$fileName;
            $newFileForDatabase = "assets/images/blogImages/"."small".$time.$fileName;

            if($ext == "jpg" || $ext == "jpeg")
            {
                //header("content-type:image/jpeg");
                $newHeight = 500;

                list($width, $height) = getImageSize($tmpLocation);

                $newWidth = $width * $newHeight / $height;

                $platno = imagecreatetruecolor($newWidth, $newHeight);
                $for = imagecreatefromjpeg($tmpLocation);

                imagecopyresized($platno, $for, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                imagejpeg($platno, $newFile);
                imagedestroy($platno);
            }
            else
            {
                array_push($errors, "Insert an image with jpg or jpeg format");
            }
        }
        else
        {
            array_push($errors, "Insert an image with jpg or jpeg format");
        }

        if(count($errors) == 0)
        {
            $user_id = $_SESSION['user']->user_id;

            $prepare = $connection->prepare("INSERT INTO blog VALUES (null, :title, :image, :text, :date, :user_id)");
            
            $title = addslashes($title);
            $prepare->bindParam(":title", $title);

            $prepare->bindParam(":image", $newFileForDatabase);

            $text = addslashes($text);
            $prepare->bindParam(":text", $text);

            $prepare->bindParam(":date", $time);

            $prepare->bindParam(":user_id", $user_id);
            
            try{
                $result = $prepare->execute();

                if($result){
                        $data = $connection->query("SELECT blog_id FROM blog ORDER BY blog_id DESC LIMIT 1")->fetch();
                        $blog_id = $data->blog_id;
                        settype($blog_id, "integer");
                        $successfullyAddedTags=0;

                    foreach($tags as $one)
                    {
                        settype($one, "integer"); 
                        $prepare = $connection->prepare("INSERT INTO blog_tag VALUES (null, :blog_id, :tag_id)");
                        $prepare->bindParam(":blog_id", $blog_id);
                        $prepare->bindParam(":tag_id", $one);

                        
                        try{
                            $result = $prepare->execute();

                            if(!$result)
                            {
                                $successfullyAddedTags++;
                            }
                        }

                        catch(PDOException $ex){
                            $message = $ex->getMessage();
                            $content = "Add tags to new blog - insert - $message";
                            error($content);
                        }
                    }

                    if($successfullyAddedTags == 0)
                    {
                        $_SESSION["blogMade"] = "Your blog has been successfully added";
                        header("location:$cameFrom");
                    }
                }
            }
            catch(PDOException $ex){
                $message = $ex->getMessage();
                $content = "Make new blog - insert - $message";
                error($content);
            }
        }
        else
        {
            $_SESSION["errors"] = $errors;
            header("location:$cameFrom");
        }
    }
    else{
        session_destroy();
        header("Location:../../index.php");
    }

