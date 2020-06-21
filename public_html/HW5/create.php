<form method="POST">
	<label for="t">Account Type
	<input type="text" id="t" name="type" />
	</label>
	<label for="b">Balance
	<input type="number" id="b" name="balance" />
	</label>
	<label for="n">Account Number
	<input type="number" id="n" name="number" />
	</label>
	<input type="submit" name="create" value="Create Account"/>
</form>

<?php
if(isset($_POST["create"])){
    $type = $_POST["type"];
    $balance = $_POST["balance"];
	$number = $_POST["number"];
    if(!empty($type) && !empty($balance) && !empty($number)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO BankAccounts (AccountType, Balance, AccountNumber) VALUES (:type, :balance, :number)");
            $result = $stmt->execute(array(
                ":type" => $type,
                ":balance" => $balance
				":number" => $number
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new account. Type: " . $type;
                }
                else{
                    echo "Error inserting record";
                }
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
    else{
        echo "type, balance, and account must not be empty.";
    }
}
?>