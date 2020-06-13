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
  <li><a class="active" href="login.php">Login</a></li>
  <li><a href="register.php">Register</a></li>
</ul>
<h1>Login</h1>

<form method="POST">
    <label for="email">Email
        <input type="email" id="email" name="email" autocomplete="off" />
    </label>
    <label for="p">Password
        <input type="password" id="p" name="password" autocomplete="off"/>
    </label>
    <input type="submit" name="login" value="Login"/>
</form>

<?php
session_start();
if(isset($_POST["login"])){
    if(isset($_POST["password"]) && isset($_POST["email"])){
        $password = $_POST["password"];
        $email = $_POST["email"];
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("SELECT * FROM Users where email = :email LIMIT 1");
            $stmt->execute(array(
                ":email" => $email
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result){
                    $rpassword = $result["password"];
                    if(password_verify($password, $rpassword)){
                        $_SESSION["user"] = array(
                            "id"=>$result["id"],
                            "email"=>$result["email"],
                            "first_name"=>$result["first_name"],
                            "last_name"=>$result["last_name"]
                        );
                        header("location: home.php");
                    }
                    else{
                        echo "<div>Invalid password!</div>";
                    }
                }
                else{
                    echo "<div>Invalid user</div>";
                }
                //echo "<div>Successfully registered!</div>";
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
}
?>
