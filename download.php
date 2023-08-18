
<?php
include "data_con.php";
session_start();
if(!isset($_SESSION['user_id'])){ 
    header('Location: index.php'); 
    exit;
}
  $datequery="SELECT * FROM temperature ORDER BY temp_cdate DESC";
  $dateconnect=mysqli_query($conn,$datequery);
  $datenum=mysqli_num_rows($dateconnect);
  $flquery = "SELECT * FROM waterflow ORDER BY flow_cdate DESC";
  $flconnect = mysqli_query($conn, $flquery);
  $flnum = mysqli_num_rows($flconnect);
  $levelquery = "SELECT * FROM waterlevel ORDER BY level_cdate DESC";
  $levelconnect = mysqli_query($conn, $levelquery);
  $levelnum = mysqli_num_rows($levelconnect);
  $tdsquery = "SELECT * FROM total_dissolved_solids ORDER BY tds_cdate DESC";
  $tdsconnect = mysqli_query($conn, $tdsquery);
  $tdsnum = mysqli_num_rows($tdsconnect);
  $phquery = "SELECT * FROM acidity ORDER BY acid_cdate DESC";
  $phconnect = mysqli_query($conn, $phquery);
  $phnum = mysqli_num_rows($phconnect);
$dataArray = array();
while ($data = mysqli_fetch_assoc($dateconnect)) {
    $flowdata = mysqli_fetch_assoc($flconnect);
    $ldata = mysqli_fetch_assoc($levelconnect);
    $acdata = mysqli_fetch_assoc($phconnect);
    $tddata = mysqli_fetch_assoc($tdsconnect);
    $row = array(
        date('F-d-Y H:i A', strtotime($data['temp_cdate'])),
        "pH of " . $acdata['acid_readings'],
        $tddata['tds_readings'] . " ppm",
        $data['temp_readings'] . " °C",
        $flowdata['flow_readings'] . " L/min",
        $ldata['level_readings'] . " m"
    );
    $dataArray[] = $row; 
}
$currentDate = date('F-j-Y');
$filename = "hydroponicsdata_$currentDate.csv";
header("Content-Disposition: attachment; filename=$filename");
header("Content-Type: text/csv");
$output = fopen("php://output", "w");
fputcsv($output, array("Date & Time", "Acidity", "Total Dissolve solids", "Temperature", "Water Flow", "Water level"));
foreach ($dataArray as $row) {
    fputcsv($output, $row);
}
fclose($output);
exit();
?>