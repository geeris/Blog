<?php
    session_start();
    require_once("../../config/connection.php");
    if(isset($_POST['getAllBlogs']))
    {   
        $code=200;
        header("Content-Type:application/json");
        global $connection;

        try{
        $blogs = $connection->query("SELECT u.username AS loggedUser, b.*
                                    FROM user u INNER JOIN blog b ON u.user_id = b.user_id 
                                    ORDER BY date DESC")->fetchAll();
        }
        catch(PDOException $ex){
            $message = $ex->getMessage();
            $content = "Get all blogs - select - $message";
            // $path = "../../";
            error($content);
        }
        
        $session = $_SESSION["user"]->user_id;

        $niz=[];

        foreach($blogs as $oneBlog)
        {
            $blog_id = $oneBlog->blog_id;
            $username = $oneBlog->loggedUser;
            $image = $oneBlog->image;
            $text = $oneBlog->text;
            $title = $oneBlog->title;
            $whoPosted = $oneBlog->user_id;

            $date = $oneBlog->date;
            $date = date('Y-m-d H:i', $date);

        try{
            $tagsOfOne = $connection->query("SELECT t.*
                                    FROM blog b INNER JOIN blog_tag bt ON b.blog_id = bt.blog_id INNER JOIN tag t ON bt.tag_id = t.tag_id WHERE bt.blog_id = $blog_id")->fetchAll();
        }
        catch(PDOException $ex){
            $message = $ex->getMessage();
            $content = "Get all blog tags - select - $message";
            // $path = "../../";
            error($content);
        }

        $myObj = new stdClass();

        $myObj -> blog_id = $blog_id;
        $myObj -> username = $username;
        $myObj -> image = $image;
        $myObj -> text = $text;
        $myObj -> title = $title;
        $myObj -> whoPosted = $whoPosted;
        $myObj -> date = $date;

        $myObj -> tags = $tagsOfOne;
        $myObj -> logged = $session;

        array_push($niz, $myObj);
        }

        $json = json_encode([
            "blogs" => $niz
        ]);
        
        echo $json;
        http_response_code($code);
    }
    else{
        session_destroy();
        header("Location:../../index.php");
    }
?>