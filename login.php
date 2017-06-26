<?php

require_once 'includes/configuration.php';
require_once 'includes/dbfunctions.php';

$conn = open_db();

$sql = "SELECT * FROM `usertable` WHERE `Active`=1";
$users_result = mysqli_query($conn, $sql);
$length = mysqli_num_rows($users_result);
for($i=0;$i<$length;$i++){
    $users_array = mysqli_fetch_assoc($users_result);
    $users[$i] = $users_array['Name'];
}
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
    <form class="login-container" action="index.php" method="POST" >
        <p><select name="dropdown">
                <option value="" disabled selected>Chose your User</option>
                <?php
                for($i=0;$i<$length;$i++){
                    print "<option value=".$users[$i].">".$users[$i]."</option>";
                }
                ?>
            </select></p>
        <p><input name="submit" type="submit" value="Log in"></p>
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
</ul>
</nav>
</body>
</html>

<?php


if (isset($_POST["submit"])&&isset($_POST["dropdown"])) {
    $_SESSION['login'] = $_POST["dropdown"];
    header("Location: index.php");
}

?>
