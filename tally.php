<?php

require_once 'includes/configuration.php';
require_once 'includes/dbfunctions.php';

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
    <form class="login-container" action="#" method="POST" >
        <p><input name="submit" type="submit" value="Make New Log"></p>
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
    <li class="logout">
        <a title="Log Out" class="logout" href=".?logout=true">Logout</a>
    </li>
</ul>
</nav>


<?php

$name = $_SESSION["login"];
$date = date("Y-m-d");
$month = date("n");
$query = "SELECT `userID` FROM `usertable` WHERE `Name`='{$name}'";
$result = mysqli_query($conn, $query);
$array = mysqli_fetch_assoc($result);
$id = $array['userID'];


$sql = "SELECT * FROM `logtable` WHERE `userID`='{$id}'";
$result = mysqli_query($conn, $sql);
$size = mysqli_num_rows($result);

if($size != 0) {
    $sql = "SELECT * FROM `logtable` WHERE `userID`='{$id}' AND `date`='{$date}'";
    $today_result = mysqli_query($conn, $sql);
    $today = mysqli_num_rows($today_result);

    $sql = "SELECT * FROM `logtable` WHERE `userID`='{$id}' AND `Month`='{$month}'";
    $month_result = mysqli_query($conn, $sql);
    $this_month = mysqli_num_rows($month_result);


    echo '<style>div.table-title {
    display: block;
    margin: auto;
    max-width: 400px;
    padding:5px;
    width: 100%;
}

.table-title h3 {
    color: #fafafa;
    font-size: 10px;
    font-weight: 400;
    font-style:normal;
    font-family: "Roboto", helvetica, arial, sans-serif;
    text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
    text-transform:uppercase;
}


/*** Table Styles **/

.table-fill {
    background: white;
    border-radius:3px;
    border-collapse: collapse;
    height: 200px;
    margin: auto;
    max-width: 300px;
    padding:5px;
    width: 100%;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    animation: float 5s infinite;
}

th {
    color:#D5DDE5;;
    background:#008542;
    border-bottom:4px solid #9ea7af;
    border-right: 1px solid #343a45;
    font-size:20px;
    font-weight: 100;
    padding:10px;
    text-align:left;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    vertical-align:middle;
}

th:first-child {
    border-top-left-radius:3px;
}

th:last-child {
    border-top-right-radius:3px;
    border-right:none;
}

tr {
    border-top: 1px solid #C1C3D1;
    border-bottom-: 1px solid #C1C3D1;
    color:#666B85;
    font-size:16px;
    font-weight:normal;
    text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}

tr:hover td {
    background:#4E5066;
    color:#FFFFFF;
    border-top: 1px solid #22262e;
    border-bottom: 1px solid #22262e;
}

tr:first-child {
    border-top:none;
}

tr:last-child {
    border-bottom:none;
}

tr:nth-child(odd) td {
    background:#EBEBEB;
}

tr:nth-child(odd):hover td {
    background:#4E5066;
}

tr:last-child td:first-child {
    border-bottom-left-radius:3px;
}

tr:last-child td:last-child {
    border-bottom-right-radius:3px;
}

td {
    background:#FFFFFF;
    padding:10px;
    text-align:left;
    vertical-align:middle;
    font-weight:300;
    font-size:18px;
    text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
    border-right: 1px solid #C1C3D1;
}

td:last-child {
    border-right: 0px;
}

th.text-left {
    text-align: left;
}

th.text-center {
    text-align: center;
}

th.text-right {
    text-align: right;
}

td.text-left {
    text-align: left;
}

td.text-center {
    text-align: center;
}

td.text-right {
    text-align: right;
}</style>';
    echo '<div class="table-title">
          </div>
          <table class="table-fill">
          <thead>
          <tr>
          <th class="text-center">Period</th>
          <th class="text-center">Assistances</th>
          </tr>
          </thead>
          <tbody class="table-hover">
          <tr>
          <td class="text-left">Today</td>
          <td class="text-center">'.$today.'</td>
          </tr>
          <tr>
          <td class="text-left">This Month</td>
          <td class="text-center">'.$this_month.'</td>
          </tr>
          <tr>
          <td class="text-left">Total</td>
          <td class="text-center">'.$size.'</td>
          </tr>

          </tr>
          </tbody>
          </table>';
}

if (isset($_POST["submit"])) {
    $type = $_POST["type"];
    $sql = "INSERT INTO `logtable` (userID,Name,Month,Date) VALUES ('{$id}' , '{$name}' , '{$month}','{$date}')";
    mysqli_query($conn, $sql);
    echo '<script type="text/javascript">
          window.location.href = \'index.php\';
          </script>';
    
}




?>


</body>
</html>