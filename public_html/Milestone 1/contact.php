<?php
session_start();
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
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="accounts.php">Accounts</a></li>
  <li><a class="active" href="#contact">Contact</a></li>
  <li style="float:right"><a href="logout.php">Logout</a></li>
</ul>
<h1>Contact Us</h1>
<p>Please feel free to contact us at (888)555-5555 during our normal business hours
<br>
<br>MON:	9:00AM-5:00pm
<br>TUES:	9:00AM-5:00pm
<br>WED:	9:00AM-5:00pm
<br>THURS:	9:00AM-5:00pm
<br>FRI:	9:00AM-5:00pm
<br>SAT		9:00AM-2:00pm
<br>SUN		CLOSED
<br>
<br>If you need to contact us ourtide of business hours, please feel free to reash out to out support email, Support@@MTBank.com.
</p>