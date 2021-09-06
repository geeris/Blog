<?php
    session_start();
    require_once("../../config/connection.php");
    require_once("prepareData.php");
    header("Content-type:application/json");
    $data = null;
    $code = 404;

    $i=0;
    if(isset($_POST['btnSignUp']))
    {
        if(isset($_POST['username']))
        {
            $username = $_POST['username'];
            $username = trim($username);

            $forUsername = "/^[a-zA-Z0-9]{6,30}$/";

            if(!preg_match($forUsername, $username))
            {
                $errorun = "Username must have at least five characters and start with a letter";
                $i++;
            }
        }
        else{
            $errorun = "Username must have at least five characters and start with a letter";
                $i++;
        }

        if(isset($_POST['email']))
        {
            $email = $_POST['email'];
            $email = trim($email);

            $forEmail = "/^[a-z]+[a-z0-9\?\+\_\.\-]*@[a-z]{2,10}(\.[a-z]{2,4})+$/";

            if(!preg_match($forEmail, $email))
            {
                $errore = "Wrong format of an e-mail address";
                $i++;
            }
        }
        else{
                $errore = "Wrong format of an e-mail address";
                $i++;
        }

        if(isset($_POST['password']))
        {
            $passwordup = $_POST['password'];
            $passwordup = trim($passwordup);

            $forPassword = "/^.{8,}$/";

            if(!preg_match($forPassword, $passwordup))
            {
                $errorp = "Password must have at least 8 characters";
                $i++;
            }

            else{
                if(isset($_POST['passwordConfirm']))
                {
                $passwordConfirm = $_POST['passwordConfirm'];
                $passwordConfirm = trim($passwordConfirm);

                    if($passwordup != $passwordConfirm)
                    {
                        $errorpc = "Passwords are not matched";
                    $i++;
                }
                }
                else{
                    $errorpc = "Passwords are not matched";
                    $i++;
                }
            }
        }
        else{
            $errorp = "Password must have at least 8 characters";
            $i++;
        }

        if($i != 0)
        {
            $data = json_encode([
                "response" => 0,
                "errorun" => $errorun,
                "errore" => $errore,
                "errorp" => $errorp,
                "errorpc" => $errorpc,
            ]);
        }
        else{
            $prepareQuery = $connection->prepare("INSERT INTO user VALUES (null, :username, null, :email, :passwordup, null, :createDate, :isActive, :roleID)");
        
            $preparedUsername = prepareUserData($username, 0);
            $prepareQuery->bindParam(":username", $preparedUsername);
            
            $preparedEmail = prepareUserData($email, 0);
            $prepareQuery->bindParam(":email", $preparedEmail);

            $preparedPassword = prepareUserData($passwordup, 1);
            $prepareQuery->bindParam(":passwordup", $preparedPassword);
            
            $createDate=time();
            $prepareQuery->bindParam(":createDate", $createDate);

            define("IS_ACTIVE", 0);
            $isActive = IS_ACTIVE;
            $prepareQuery -> bindParam(":isActive", $isActive);

            define("USER_ROLE", 1);
            $roleID = USER_ROLE;
            $prepareQuery->bindParam(":roleID", $roleID);

            try{
                $prepareQuery->execute();
            }
            catch(PDOException $ex){
                $message = $ex->getMessage();
                $content = "Sign up user - insert - $message";
                error($content);
            }
        }

            $data = json_encode([
                "response" => 1,
                "message" => 'Your account has been successfully made'
            ]);
        

            echo $data;
            http_response_code(200);
        //     try{
        //         if($prepareQuery)
        //         {   
        //             $_SESSION['successRegister'] = "Your account is made successfully";
        //             unset($_SESSION['username']);
        //             unset($_SESSION['email']);
        //             unset($_SESSION['confirm']);
        //             unset($_SESSION['password']);
        //             header("Location: ../index.php?view=register");
        //         }
        //         }
        //         catch(PDOException $e){

        //         $query = "SELECT * FROM user WHERE username = :username";
                
        //         $prepareQuery = $connection -> prepare($query);
        //         $prepareQuery -> bindParam(":username", $usernameReg);
                
        //         $prepareQuery  -> execute();
        //         //var_dump($prepareQuery);
        //         if($prepareQuery -> rowCount() == 1)
        //         {
        //             $_SESSION['errorReg'] = "This username already exists";
        //             header("Location: ../index.php?view=register");
        //         }
                
        //         $query = "SELECT * FROM user WHERE email = :email";
        //         $prepareQuery = $connection -> prepare($query);
        //         $prepareQuery -> bindParam(":email", $emailReg);

        //         $prepareQuery -> execute();

        //         if($prepareQuery -> rowCount() == 1)
        //         {
        //             $_SESSION['errorReg'] = "This e-mail already exists";
        //             header("Location: ../index.php?view=register");
        //         }
        //             $_SESSION['errorReg'] = "Problem has been occured";
        //             header("Location: ../index.php?view=register");
        //     } 
        // }
    }
    else{
        session_destroy();
        header("Location:../../index.php");
    }


