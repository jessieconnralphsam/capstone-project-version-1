<?php
include "data_con.php";

if (isset($_GET['getLatestChartData'])) {
    $response = array("status" => "success", "data" => array());
    $queryAcidity = "SELECT * FROM acidity ORDER BY acid_cdate DESC LIMIT 5";
    $resultAcidity = $conn->query($queryAcidity);

    if ($resultAcidity->num_rows > 0) {
        $rowAcidity = $resultAcidity->fetch_assoc();
        $response["data"]["acidity"] = array(
            "timestamp" => strtotime($rowAcidity['acid_cdate']),
            "datetime" => date('h:i A', strtotime($rowAcidity['acid_cdate'])),
            "acid_readings" => $rowAcidity['acid_readings']
        );
    }
    $queryFlow = "SELECT * FROM waterflow ORDER BY flow_cdate DESC LIMIT 5";
    $resultFlow = $conn->query($queryFlow);

    if ($resultFlow->num_rows > 0) {
        $rowFlow = $resultFlow->fetch_assoc();
        $response["data"]["water_flow"] = array(
            "flow_readings" => $rowFlow['flow_readings']
        );
    }
    $queryLevel = "SELECT * FROM waterlevel ORDER BY level_cdate DESC LIMIT 5";
    $resultLevel = $conn->query($queryLevel);

    if ($resultLevel->num_rows > 0) {
        $rowLevel = $resultLevel->fetch_assoc();
        $response["data"]["water_level"] = array(
            "level_readings" => $rowLevel['level_readings']
        );
    }

    echo json_encode($response);
    exit();
}
?>
