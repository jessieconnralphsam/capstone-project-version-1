<?php

include("database_connection.php");
$sql = "UPDATE notifications SET status='1'";
$res = mysqli_query($conn, $sql);
if ($res) {
  echo "Success";
} else {
  echo "Failed";
}

