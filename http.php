<?php
include "data_con.php";


$response = array("status" => "", "message" => "");


if (isset($_GET['waterflow'])) {
    $waterflow = $conn->real_escape_string($_GET['waterflow']);
    $waterflowSql = "INSERT INTO waterflow (flow_readings) VALUES ('$waterflow')";
    if ($conn->query($waterflowSql) === TRUE) {
        $response["status"] = "success";
        $response["message"] = "Waterflow data inserted successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error inserting waterflow data: " . $conn->error;
    }
}

if (isset($_GET['waterlevel'])) {
    $waterlevel = $conn->real_escape_string($_GET['waterlevel']);
    $waterlevelSql = "INSERT INTO waterlevel (level_readings) VALUES ('$waterlevel')";
    if ($conn->query($waterlevelSql) === TRUE) {
        $response["status"] = "success";
        $response["message"] = "Waterlevel data inserted successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error inserting waterlevel data: " . $conn->error;
    }
}
if (isset($_GET['acidity'])) {
    $acidity = $conn->real_escape_string($_GET['acidity']);
    $aciditySql = "INSERT INTO acidity (acid_readings) VALUES ('$acidity')";
    if ($conn->query($aciditySql) === TRUE) {
        $response["status"] = "success";
        $response["message"] = "Acidity data inserted successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error inserting Acidity data: " . $conn->error;
    }
}
if (isset($_GET['tds'])) {
    $tds = $conn->real_escape_string($_GET['tds']);
    $tdsSql = "INSERT INTO total_dissolved_solids (tds_readings) VALUES ('$tds')";
    if ($conn->query($tdsSql) === TRUE) {
        $response["status"] = "success";
        $response["message"] = "tds data inserted successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error inserting tds data: " . $conn->error;
    }
}
if (isset($_GET['temperature'])) {
    $temp = $conn->real_escape_string($_GET['temperature']);
    $tempSql = "INSERT INTO temperature (temp_readings) VALUES ('$temp')";
    if ($conn->query($tempSql) === TRUE) {
        $response["status"] = "success";
        $response["message"] = "Temperature data inserted successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error inserting Temperature data: " . $conn->error;
    }
}

echo json_encode($response);
// $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enter Water Data</title>
</head>
<body>
    <h2>Enter Water Data</h2>
    <form action="" method="get">
        Water Flow: <input type="text" name="waterflow"><br>
        Water Level: <input type="text" name="waterlevel"><br>
        Acidity: <input type="text" name="acidity"><br>
        TDS: <input type="text" name="tds"><br>
        Temperature: <input type="text" name="temperature"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
