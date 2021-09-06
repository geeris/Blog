<?php

// Osnovna podesavanja
define("BASE_URL", "http://localhost/blog/");
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/blog/");

// Ostala podesavanja
define("ENV_FAJL", ABSOLUTE_PATH."config/.env");
define("LOG_FAJL", ABSOLUTE_PATH."data/log.txt");
define("ERROR", ABSOLUTE_PATH."data/error.txt");
define("SEPARTOR", "&");

// Podesavanja za bazu
$host = env("SERVER");
$dbname = env("DBNAME");
$un = env("USERNAME");
$pass = env("PASSWORD");

function env($naziv){
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach($podaci as $key=>$value){
        $row = explode("=", $value);
        if($row[0]==$naziv){
            $vrednost = trim($row[1]);
        }
    }
    return $vrednost;
}
 