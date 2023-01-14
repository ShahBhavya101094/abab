<?php
session_start();

include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
$uid = $_SESSION['id'];
$query = "DELETE FROM `abab_booking` WHERE `uid` = ?";
$stmt = $mysqli->prepare($query);
$rc = $stmt->bind_param('i', $uid);
$stmt->execute();
$query = "INSERT INTO `abab_booking` ( `uid`, `attend_event`, `pick_point_place`, `drop_point_place`, `food_status`, `arrival_date`, `arrival_time`, `arrival_mode_transport`, `arrival_mode_details`, `departure_date`, `departure_time`, `departure_mode_transport`, `departure_mode_details`, `feb13`, `feb14`, `total_member_sis`, `total_member_bro`, `status`) VALUES (?, 'No', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');";
$stmt = $mysqli->prepare($query);
$rc = $stmt->bind_param('i', $uid);
$stmt->execute();
$status = 1;
$query = "UPDATE user_reg set reg_status=? where id=?";
$stmt = $mysqli->prepare($query);
$rc = $stmt->bind_param('ii',   $status, $uid);
echo "<script>location.href='dashboard.php';</script>";
?>
