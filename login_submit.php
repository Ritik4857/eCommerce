<?php
session_start(); 
$error = '';
if (isset($_POST['submit'])) {
if (empty($_POST['name']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else{
$username = $_POST['name'];
$password = $_POST['password'];
$conn = mysqli_connect("localhost", "root", "", "store");
$query = "SELECT name, password from users where name=? AND password=? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->bind_result($username, $password);
$stmt->store_result();
if($stmt->fetch()) 
$_SESSION['login_user'] = $name; 
header("location:index.php"); 
}
mysqli_close($conn); 
}
?>
