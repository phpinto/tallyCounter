<?php

session_start();

require_once 'includes/configuration.php';
require 'includes/dbfunctions.php';

$conn = open_db();


?>

<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tally Counter</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/screen.css">
</head>
<body>

<nav class="screen"">
<ul>
    <li>
        <a class="logo" title="Logo" href="index.php"><span></span></a>
    </li>
    <li>
        <a title="Check Logs" href="logs.php">Check Logs</a>
    </li>
    <li>
        <a title="Add New Users" href="add_users.php">Add New Users</a>
    </li>
    <li>
        <a title="Download Data" href="download.php">Download Data</a>
    </li>
    <?php
    if(isset($_SESSION['login'])) {
        echo '<li class="logout">
              <a title="Log Out" class="logout" href=".?logout=true">Logout</a>
              </li>';
    }
    ?>
</ul>
</nav>
</body>
</html>

