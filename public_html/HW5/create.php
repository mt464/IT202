<form method="POST">
	<label for="t">Account Type
	<input type="text" id="t" name="atype" />
	</label>
	<label for="b">Balance
	<input type="number" id="b" name="balance" />
	</label>
	<label for="n">Account Number
	<input type="number" id="n" name="ac" />
	</label>
	<input type="submit" name="create" value="Create Account"/>
</form>

<?php
if(isset($_POST["create"])){
    $atype = $_POST["atype"];
    $balance = $_POST["balance"];
	$ac = $_POST["ac"];
    if(!empty($atype) && !empty($ac)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO BankAccounts (AccountType, Balance, AccountNumber) VALUES(:atype, :balance, :ac)");
            $result = $stmt->execute(array(
                ":atype" => $atype,
                ":balance" => $balance,
				":ac" => $ac
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new account. Type: " . $atype;
                }
                else{
                    echo "Error inserting record";
                }
            }
        }
        catch (Exception $e){
        }
    }
    else{
        echo "type, and account must not be empty.";
    }
}
?>