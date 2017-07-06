<?php

require_once 'includes/configuration.php';
require 'includes/dbfunctions.php';

$conn = open_db();

if(isset($_POST["export"])){
    $total = 0;
    $sql = "SELECT `Name`,`Total` FROM `totals` WHERE Month='{$_POST['Month']}' AND Year='{$_POST['Year']}' ORDER BY `UserID`";
    $result = mysqli_query($conn, $sql);
    $output = '';
    if(mysqli_num_rows($result)!=0){
        $output .= '
    <table>
        <tr>
            <th>Name</th>
            <th>Tally</th>
        </tr>
        ';
        while($row = mysqli_fetch_array($result)){
            $output .= '
        <tr>
            <td>'.$row["Name"].'</td>
            <td>'.$row["Total"].'</td>
        </tr>
        ';
            $total = $total + $row["Total"];
        }
        $output .= '
        <tr>
            <td><b>Total</td>
            <td><b>'.$total.'</b></td>
        </tr>
        ';
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename="Summary_'.$_POST['Month'].'_'.$_POST['Year'].'.xls"');
        echo $output;
    }
    else{
        echo '<!DOCTYPE HTML>
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
                  </li>';
        if(isset($_SESSION['login'])) {
               echo '<li class="logout">
                   <a title="Log Out" class="logout" href=".?logout=true">Logout</a>
               </li>';
           }
        echo '</ul>
              </nav>
              <script>
                  setTimeout(function() {
                  swal({
                  title: "Oops...",
                  text: "No logs were made in the selected month.",
                  type: "error"
                  }, function() {
                  window.location = "download.php";
                  });
                  }, 50);
                  </script>';
    }
}
?>

</body>
</html>
