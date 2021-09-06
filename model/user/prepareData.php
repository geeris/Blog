<?php
    function prepareUserData($data, $isPassword){
        if($isPassword)
        {
            $data = addslashes($data);
            $data = md5($data);

            return $data;
        }
        else{
            $data = addslashes($data);
            return $data;
        }
    }