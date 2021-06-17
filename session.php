<?php

$conn = mysqli_connect("localhost", "root", "", "store");
session_start();
$user_check = $_SESSION['login_user'];
$query = "SELECT name from users where name = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['name'];
?>
