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

<div class="login">
    <form class="login-container" method="POST" action="excel.php">
        <p><select name="Month">
                <option value="" disabled selected>Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select></p>
        <p><select name="Year">
                <option value="" disabled selected>Year</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
            </select></p>
        <p><input name="export" type="submit" value="Download data to Excel"></p>
    </form>
</div>


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
    if(isset($_SESSION['login']) && isset($_SESSION['Month']) && isset($_SESSION['Year'])) {
        echo '<li class="logout">
            <a title="Log Out" class="logout" href=".?logout=true">Logout</a>
        </li>';
    }
    ?>
</ul>
</nav>

</body>
</html>

