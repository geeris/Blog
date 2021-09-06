<?php
    require_once("../../config/connection.php");

    if(isset($_POST['visitedPages']))
    {   
        $code=200;
        header("Content-Type:application/json");
        $allVisited;
        $allPages;
        $number=[];
        try{
           $openedFile = file(LOG_FAJL);
            $allVisited=0;
            $allPages=[];
            $number=[];
            foreach($openedFile as $one){
                $allVisited++;
                if(!in_array($one, $allPages))
                    array_push($allPages, $one);
                }
            $i;
            foreach($allPages as $exist){
                $i=0;
                foreach($openedFile as $one){
                    if($exist == $one)
                        $i++;
                }
                array_push($number, $i);
            }
            

            $json = json_encode([
                "pages" => $allPages,
                "number" => $number,
                "total" => $allVisited
            ]); 

        }
        catch(PDOException $ex){
            $message = $ex->getMessage();
            $content = "Get blog tags - select - $message";
            // $path = "../../";
            error($content);
        }
        
        echo $json;
        http_response_code($code);
    }
    else{
        session_destroy();
        header("Location:../../index.php");
    }
?>