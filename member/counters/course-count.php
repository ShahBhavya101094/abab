<?php
include '../includes/dbconn.php';
$uid = $_SESSION["id"];
$sql = "SELECT id FROM abab_guest_booking WHERE uid = ". $uid;
$query = $mysqli->query($sql);
echo "$query->num_rows";
?>