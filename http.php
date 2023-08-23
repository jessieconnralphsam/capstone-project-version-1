<?php
include "data_con.php";

if (isset($_GET['getLatestData'])) {
    $queryTDS = "SELECT * FROM total_dissolved_solids ORDER BY tds_cdate DESC LIMIT 1";
    $resultTDS = $conn->query($queryTDS);

    if ($resultTDS->num_rows > 0) {
        $rowTDS = $resultTDS->fetch_assoc();
        $latestData = [
            "datetime" => date('m-d-Y h:i A', strtotime($rowTDS['tds_cdate'])),
            "electric_con" => $rowTDS['tds_readings']
        ];

        $queryTemperature = "SELECT * FROM temperature ORDER BY temp_cdate DESC LIMIT 1";
        $resultTemperature = $conn->query($queryTemperature);

        if ($resultTemperature->num_rows > 0) {
            $rowTemperature = $resultTemperature->fetch_assoc();
            $latestData["temperature"] = $rowTemperature['temp_readings'];
        } else {
            $latestData["temperature"] = 0;
        }

        echo json_encode($latestData);
    } else {
        echo json_encode(["error" => "No data available"]);
    }
    exit(); 
}
?>
