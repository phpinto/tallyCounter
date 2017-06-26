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
    <script src="css/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/sweetalert-master/dist/sweetalert.css">
</head>
<body>

<div class="login">
    <form class="login-container" action="#" method="POST" >
        <p><input type="text" name="name" placeholder="User's  Name"></p>
        <p><input type="password" name="password" placeholder="Password"></p>
        <p><input name="submit" type="submit" value="Add User"></p>
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
    if(isset($_SESSION['login'])) {
        echo '<li class="logout">
            <a title="Log Out" class="logout" href=".?logout=true">Logout</a>
        </li>';
    }
    ?>
</ul>
</nav>

<?php

if (isset($_POST["submit"])&&isset($_POST["name"])&&isset($_POST["password"])) {

    $name = strip_tags($_POST['name']);
    $password = strip_tags($_POST['password']);

    $name = stripslashes($name);
    $password = stripslashes($password);

    $name = mysqli_real_escape_string($conn, $name);
    $password = mysqli_real_escape_string($conn, $password);

    $password = md5($password);
    $name = ucfirst(strtolower($name));

    $sql = "SELECT * FROM `usertable` WHERE `Name`='{$name}'";
    $result = mysqli_query($conn, $sql);
    $size = mysqli_num_rows($result);

    if ($password != Config::password) {
        print '<script language="javascript">';
        print 'sweetAlert("Oops...", "Your password was incorrect!", "error")';
        print '</script>';
    } else if (!ctype_alpha($name)){
        print '<script language="javascript">';
        print 'sweetAlert("Oops...", "Make sure all characters are valid letters!", "error")';
        print '</script>';
    } else if ($size != 0){
        print '<script language="javascript">';
        print 'sweetAlert("Oops...", "'.$name.' is already in the user table.", "error")';
        print '</script>';
    } else {
        $sql = "INSERT INTO `usertable` (Name) VALUES ('{$name}')";
        if (mysqli_query($conn, $sql)){
            echo '<script>
                  setTimeout(function() {
                  swal({
                  title: "Success!",
                  text: "You have successfully added '.$name.' to the user table.",
                  type: "success"
                  }, function() {
                  window.location = "logs.php";
                  });
                  }, 50);
                  </script>';
        }
    }
}
?>

</body>
</html>

