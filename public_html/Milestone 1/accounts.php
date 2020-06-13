<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=1){
    header('Location: login.php');
    exit();
}
?>
<head>
<style>
	body{background-color: white;
}

h1{
	color: blue;
	margin-left: 50px;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}
li {
  float: left;
}
li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
li a:hover:not(.active) {
  background-color: #111;
}
.active {
  background-color: #0000FF;
}
</style>
</head>
<body>
<ul>
  <li><a href="home.php">Home</a></li>
  <li><a class="active" href="accounts.php">Accounts</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li style="float:right"><a href="logout.php">Logout</a></li>
</ul>
<h1>Accounts</h1>
<p>This is where the users accounts would be shown</p>