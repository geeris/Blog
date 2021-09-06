<?php
    function error($msg)
    {
        try{
            $openedFile = fopen(ERROR, 'ab');
            $content='';
            $date = time();
            $address = $_SERVER['REMOTE_ADDR'];

            $content = "$date \t $address \t $msg \n";

            fwrite($openedFile, $content);

            fclose($openedFile);
        }
        catch(PDOException $e){

        }
    }
?>