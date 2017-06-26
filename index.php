<?php

session_start();

require_once 'includes/configuration.php';
require 'includes/dbfunctions.php';

$conn = open_db();

if(isset($_SESSION['login'])) {
    include "tally.php";
}

else {
    include "login.php";
}
?>
