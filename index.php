<?php
    require_once("config/connection.php");

    session_start();

    require_once("view/fixed/head.php");

    require_once("view/fixed/menu.php");

    if(isset($_SESSION['user']) && $_SESSION['user']->role_id == 1)
    {
        if(isset($_GET['page']))
        {
            if($_GET['page'] == 'user')
            {
                include("view/home.php");
            }
        }
    }
    else if(isset($_SESSION['user']) && $_SESSION['user']->role_id == 2)
    {
        if(isset($_GET['page']))
        {
            if($_GET['page'] == 'analysis')
            {
                include("view/analysis.php");
            }
            else if($_GET['page'] == 'manage'){
                include("view/manage.php");
            }
        }
    }
    else{
        require_once("view/header.php");
    }
    require_once("view/fixed/footer.php");
?>
        
    


    