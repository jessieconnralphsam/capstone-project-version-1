<?php
// Database configuration
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'hydro';

// Establish database connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Initialize the response array
$response = array("status" => "", "message" => "");

// Process GET request parameters
if (isset($_GET['waterflow'])) {
    $waterflow = $connection->real_escape_string($_GET['waterflow']);
    // Construct and execute SQL query for waterflow
    $waterflowSql = "INSERT INTO waterflow (flow_readings) VALUES ('$waterflow')";
    if ($connection->query($waterflowSql) === TRUE) {
        $response["status"] = "success";
        $response["message"] = "Waterflow data inserted successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error inserting waterflow data: " . $connection->error;
    }
}

if (isset($_GET['waterlevel'])) {
    $waterlevel = $connection->real_escape_string($_GET['waterlevel']);
    // Construct and execute SQL query for waterlevel
    $waterlevelSql = "INSERT INTO waterlevel (level_readings) VALUES ('$waterlevel')";
    if ($connection->query($waterlevelSql) === TRUE) {
        $response["status"] = "success";
        $response["message"] = "Waterlevel data inserted successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error inserting waterlevel data: " . $connection->error;
    }
}
if (isset($_GET['acidity'])) {
    $acidity = $connection->real_escape_string($_GET['acidity']);
    // Construct and execute SQL query for acidity
    $aciditySql = "INSERT INTO acidity (acid_readings) VALUES ('$acidity')";
    if ($connection->query($aciditySql) === TRUE) {
        $response["status"] = "success";
        $response["message"] = "Acidity data inserted successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error inserting Acidity data: " . $connection->error;
    }
}
if (isset($_GET['tds'])) {
    $tds = $connection->real_escape_string($_GET['tds']);
    // Construct and execute SQL query for tds
    $tdsSql = "INSERT INTO total_dissolved_solids (tds_readings) VALUES ('$tds')";
    if ($connection->query($tdsSql) === TRUE) {
        $response["status"] = "success";
        $response["message"] = "tds data inserted successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error inserting tds data: " . $connection->error;
    }
}
if (isset($_GET['temperature'])) {
    $temp = $connection->real_escape_string($_GET['temperature']);
    // Construct and execute SQL query for tds
    $tempSql = "INSERT INTO temperature (temp_readings) VALUES ('$temp')";
    if ($connection->query($tempSql) === TRUE) {
        $response["status"] = "success";
        $response["message"] = "Temperature data inserted successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error inserting Temperature data: " . $connection->error;
    }
}

// Repeat the process for other variables (acidity, temperature, tds)...

$connection->close();
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
