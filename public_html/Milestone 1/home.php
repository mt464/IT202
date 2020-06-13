<?php
session_start();
echo "Welcome, " . $_SESSION["user"]["email"];
?>
<a href="logout.php">Logout</a>
<head>
<style>
	body{background-color: white;
}

h1{
	color: blue;
	margin-left: 50px;
}
</style>
</head>
<body>
<h1>Welcome to MTBank!</h1>
<p>Money is only a tool. It will take you wherever you wish, but it will not replace you as the driver. --Ayn Rand</p>