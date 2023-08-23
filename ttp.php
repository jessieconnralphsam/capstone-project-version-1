<?php
include "data_con.php";

if (isset($_GET['getLatestChartData'])) {
    $response = array("status" => "", "data" => array());

    // Fetch latest acidity data
    $queryAcidity = "SELECT * FROM acidity ORDER BY acid_cdate DESC LIMIT 5";
    $resultAcidity = $conn->query($queryAcidity);

    if ($resultAcidity->num_rows > 0) {
        $rowAcidity = $resultAcidity->fetch_assoc();
        $response["data"]["timestamp"] = strtotime($rowAcidity['acid_cdate']); // Convert datetime to timestamp
        $response["data"]["datetime"] = date('h:i A', $response["data"]["timestamp"]);
        $response["data"]["acid_readings"] = $rowAcidity['acid_readings'];
    }

    // Fetch latest water flow data
    $queryFlow = "SELECT * FROM waterflow ORDER BY flow_cdate DESC LIMIT 5";
    $resultFlow = $conn->query($queryFlow);

    if ($resultFlow->num_rows > 0) {
        $rowFlow = $resultFlow->fetch_assoc();
        $response["data"]["flow_readings"] = $rowFlow['flow_readings'];
    }

    // Fetch latest water level data
    $queryLevel = "SELECT * FROM waterlevel ORDER BY level_cdate DESC LIMIT 5";
    $resultLevel = $conn->query($queryLevel);

    if ($resultLevel->num_rows > 0) {
        $rowLevel = $resultLevel->fetch_assoc();
        $response["data"]["level_readings"] = $rowLevel['level_readings'];
    }

    echo json_encode($response);
    exit();
}

?>
