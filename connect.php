<?php
$connection=mysqli_connect('localhost','nik','123','users');
$query="INSERT INTO users (username,password,email) VALUES ('$username','$email','$password')";
$result=mysqli_query($connection,$query);
