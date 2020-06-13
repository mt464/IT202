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
  <li><a href="login.php">Login</a></li>
  <li><a class="active" href="register.php">Register</a></li>
</ul>
<h1>Register</h1>
<p>This is where the users accounts would be shown</p>

<form method="POST">
    <label for="email">Email
        <input type="email" id="email" name="email" autocomplete="off" />
    </label>
	<label for="p">First Name
        <input type="first_name" id="p" name="first_name" autocomplete="off"/>
    </label>
	<label for="p">Last Name
        <input type="last_name" id="p" name="last_name" autocomplete="off"/>
    </label>
    <label for="p">Password
        <input type="password" id="p" name="password" autocomplete="off"/>
    </label>
	<label for="cp">Confirm Password
        <input type="password" id="cp" name="cpassword"/>
    </label>
    <input type="submit" name="register" value="Register"/>
</form>

<?php
//echo var_export($_GET, true);
//echo var_export($_POST, true);
//echo var_export($_REQUEST, true);
if(isset($_POST["register"])){
    if(isset($_POST["password"]) && isset($_POST["cpassword"]) && isset($_POST["email"])){
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $email = $_POST["email"];
		if($email == NULL){
			echo "No Email Entered";
			exit();
		}
		if($password == NULL){
			echo "No Password Entered";
			exit()
		}
        if($password == $cpassword){
            //echo "<div>Passwords Match</div>";
            require("config.php");
            $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
            try{
                $db = new PDO($connection_string, $dbuser, $dbpass);
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $db->prepare("INSERT INTO Users (email, password) VALUES(:email, :password)");
                $stmt->execute(array(
                    ":email" => $email,
                    ":password" => $hash//Don't save the raw password $password
                ));
                $e = $stmt->errorInfo();
                if($e[0] != "00000"){
                    echo var_export($e, true);
                }
                else{
                    echo "<div>Successfully registered!</div>";
                }
            }
            catch (Exception $e){
                echo $e->getMessage();
            }
        }
        else{
            echo "<div>Passwords don't match</div>";
        }
    }
}
?>