<?php

require_once 'includes/configuration.php';
require 'includes/dbfunctions.php';

$conn = open_db();

if(isset($_POST["export"])){
    $sql = "SELECT `Name`,`Date` FROM `logtable` ORDER BY `Name`";
    $result = mysqli_query($conn, $sql);
    $output = '';
    if(mysqli_num_rows($result)!=0){
        $output .= '
    <table>
        <tr>
            <th>Name</th>
            <th>Date</th>
        </tr>
        ';
        while($row = mysqli_fetch_array($result)){
            $output .= '
        <tr>
            <td>'.$row["Name"].'</td>
            <td>'.$row["Date"].'</td>
        </tr>
        ';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename="data.xls"');
        echo $output;
    }
    else{
        header("Location: download.php");
    }
}
?>