<?php

require_once 'configuration.php';

date_default_timezone_set("America/Chicago");

function open_db() {
    $host = Config::host;
    $database = Config::database;
    $user = Config::databaseUser;
    $password = Config::databasePass;
    if(!($db_connection = mysqli_connect($host,$user,$password,$database)))
        echo "open_db(): mysqli_pconnect failed<br>";
    return($db_connection);
}

if(isset($_REQUEST['logout'])){

        session_destroy();

        header("Location: index.php");
}


?>