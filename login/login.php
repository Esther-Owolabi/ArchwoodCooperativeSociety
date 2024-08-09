<?php

$email = $_POST['email'];
$password = $_POST['password'];
session_start();
$connection = new mysqli('localhost','root','','sample');

//cehck connection
if($connection->error){
  die("Error connecting to the database: ".$connection->connect_error);
}

//query database
$getUser = "SELECT * FROM users WHERE EMAIL_ADDRESS = ?";
$query = $connection->prepare($getUser);
$query = $connection->prepare($getUser);
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();
$user=$result->fetch_assoc();
if($user && password_verify($password,$user['PASSWORD'])){
  $_SESSION['user_id'] = $user['ID'];
  $_SESSION['username'] = $user['EMAIL_ADDRESS'];
  header("Location: dashboard.php");
  
  exit();
}else{
  echo "Invalid credentials";
}
