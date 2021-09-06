<?php
    require_once("../../config/connection.php");
    require_once("prepareData.php");
    require_once("isActive.php");
    session_start();

    $i=0;
    if(isset($_POST['btnSignIn']))
    {
        if(isset($_POST['usernameLogin']))
        {
            $usernameLogin = $_POST['usernameLogin'];
            $usernameLogin = trim($usernameLogin);

            $forUsername = "/^[a-zA-Z0-9]{6,30}$/";

            if(!preg_match($forUsername, $usernameLogin))
            {
                $i++;
            }
        }
        else{
                $i++;
        }

        if(isset($_POST['passwordLogin']))
        {
            $passwordLogin = $_POST['passwordLogin'];
            $passwordLogin = trim($passwordLogin);

            $forPassword = "/^.{8,}$/";

            if(!preg_match($forPassword, $passwordLogin))
            {
                $i++;
            }
        }
        else{
            $i++;
        }

        if($i == 0)
        {
            // $signInResult=signInUser($usernameLogin, $passwordLogin);

            $preparedUsername = prepareUserData($usernameLogin, 0);
            $preparedPassword = prepareUserData($passwordLogin, 1);

        try{
        $result = $connection->query("SELECT * FROM user WHERE username='$preparedUsername' AND password='$preparedPassword'")->fetch();
        }
        catch(PDOException $ex){
                $message = $ex->getMessage();
                $content = "Sign in user - select - $message";
                error($content);
        }
        // return $result;


            if(!$result)
            {   
                $_SESSION['errorSignIn'] = "Sign In details are incorrect";

                $content = $_SESSION['errorSignIn'];
                error($content);

                 header("location:../../index.php");
            }
            else{
                $_SESSION['user'] = $result;
    
                $id = $_SESSION['user']->user_id;
                changeIsActive($id, 1);
                
                if($_SESSION['user']->role_id==1)
                    header("location:../../index.php?page=user");
                else if($_SESSION['user']->role_id==2)
                header("location:../../index.php?page=analysis");
            }
        }
        else{
            $_SESSION['errorSignIn'] = "Sign In details are incorrect";
            header("location:../../index.php");
        }
    }
    else{
        session_destroy();
        header("Location:../../index.php");
    }
?>