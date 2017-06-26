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

<?php

$sql = "SELECT * FROM `logtable` WHERE `month`=1";
$result = mysqli_query($conn, $sql);
$jan = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=2";
$result = mysqli_query($conn, $sql);
$feb = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=3";
$result = mysqli_query($conn, $sql);
$mar = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=4";
$result = mysqli_query($conn, $sql);
$apr = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=5";
$result = mysqli_query($conn, $sql);
$may = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=6";
$result = mysqli_query($conn, $sql);
$jun = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=7";
$result = mysqli_query($conn, $sql);
$jul = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=8";
$result = mysqli_query($conn, $sql);
$aug = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=9";
$result = mysqli_query($conn, $sql);
$sep = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=10";
$result = mysqli_query($conn, $sql);
$oct = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=11";
$result = mysqli_query($conn, $sql);
$nov = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable` WHERE `month`=12";
$result = mysqli_query($conn, $sql);
$dec = mysqli_num_rows($result);

$sql = "SELECT * FROM `logtable`";
$result = mysqli_query($conn, $sql);
$tot = mysqli_num_rows($result);

$sql = "SELECT * FROM `usertable` WHERE `active`=1";
$users_result = mysqli_query($conn, $sql);
$size = mysqli_num_rows($users_result);
for($i=0;$i<$size;$i++){
    $users_array = mysqli_fetch_assoc($users_result);
    $users[$i] = $users_array['Name'];
    $user_ids[$i] = $users_array['userID'];
}

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
echo '<br><br><br><br><br><br>
        <div class="table-title">
          </div>
          <table class="table-fill">
          <thead>
          <tr>
          <th class="text-center">Name</th>
          <th class="text-center">Jan</th>
          <th class="text-center">Feb</th>
          <th class="text-center">Mar</th>
          <th class="text-center">Apr</th>
          <th class="text-center">May</th>
          <th class="text-center">Jun</th>
          <th class="text-center">&nbsp;Jul&nbsp;</th>
          <th class="text-center">Aug</th>
          <th class="text-center">Sep</th>
          <th class="text-center">Oct</th>
          <th class="text-center">Nov</th>
          <th class="text-center">Dec</th>
          <th class="text-center">Total</th>
          </tr>
          </thead>
          <tbody class="table-hover">
          <tr>
          <td class="text-left">Total</td>
          <td class="text-center">'.$jan.'</td>
          <td class="text-center">'.$feb.'</td>
          <td class="text-center">'.$mar.'</td>
          <td class="text-center">'.$apr.'</td>
          <td class="text-center">'.$may.'</td>
          <td class="text-center">'.$jun.'</td>
          <td class="text-center">'.$jul.'</td>
          <td class="text-center">'.$aug.'</td>
          <td class="text-center">'.$sep.'</td>
          <td class="text-center">'.$oct.'</td>
          <td class="text-center">'.$nov.'</td>
          <td class="text-center">'.$dec.'</td>
          <td class="text-center">'.$tot.'</td>          
          </tr>';
for($i=0;$i<$size;$i++){

    $sql = "SELECT * FROM `logtable` WHERE `month`=1 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $jan = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `month`=2 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $feb = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `month`=3 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $mar = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `month`=4 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $apr = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `month`=5 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $may = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `month`=6 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $jun = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `month`=7 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $jul = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `month`=8 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $aug = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `month`=9 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $sep = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `month`=10 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $oct = mysqli_num_rows($result);
    
    $sql = "SELECT * FROM `logtable` WHERE `month`=11 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $nov = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `month`=12 AND `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $dec = mysqli_num_rows($result);

    $sql = "SELECT * FROM `logtable` WHERE `userID`=".$user_ids[$i];
    $result = mysqli_query($conn, $sql);
    $tot = mysqli_num_rows($result);
    echo '<tr>
          <td class="text-left">'.$users[$i].'</td>
          <td class="text-center">'.$jan.'</td>
          <td class="text-center">'.$feb.'</td>
          <td class="text-center">'.$mar.'</td>
          <td class="text-center">'.$apr.'</td>
          <td class="text-center">'.$may.'</td>
          <td class="text-center">'.$jun.'</td>
          <td class="text-center">'.$jul.'</td>
          <td class="text-center">'.$aug.'</td>
          <td class="text-center">'.$sep.'</td>
          <td class="text-center">'.$oct.'</td>
          <td class="text-center">'.$nov.'</td>
          <td class="text-center">'.$dec.'</td>
          <td class="text-center">'.$tot.'</td>
          </tr>';
}


echo'     </tr>
          </tbody>
          </table>';

?>

</body>
</html>


