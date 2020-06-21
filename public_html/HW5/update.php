<?php
require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);
$thingId = -1;
$result = array();
function get($arr, $key){
    if(isset($arr[$key])){
        return $arr[$key];
    }
    return "";
}
if(isset($_GET["thingId"])){
    $thingId = $_GET["thingId"];
    $stmt = $db->prepare("SELECT * FROM BankAccounts where id = :id");
    $stmt->execute([":id"=>$thingId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<form method="POST">
	<label for="t">Account Type
	<input type="text" id="t" name="atype" value="<?php echo get($result, "AccountType");?>" />/>
	</label>
	<label for="b">Balance
	<input type="number" id="b" name="balance" value="<?php echo get($result, "Balance");?>" />/>
	</label>
	<label for="n">Account Number
	<input type="number" id="n" name="ac" value="<?php echo get($result, "AccountNumber");?>" />/>
	</label>
	<input type="submit" name="Update" value="Update Account"/>
</form>

<?php
if(isset($_POST["Update"])){
    $atype = $_POST["atype"];
    $balance = $_POST["balance"];
	$ac = $_POST["ac"];
    if(!empty($atype) && !empty($ac)){
        try{
            $stmt = $db->prepare("UPDATE BankAccounts set AccountType = :atype, Balance = :balance, AccountNumber = :ac)");
            $result = $stmt->execute(array(
                ":atype" => $atype,
                ":balance" => $balance,
				":ac" => $ac
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
            }
            else{
                if ($result){
                    echo "Successfully updated account. Number: " . $ac;
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
        echo "Update Fields must not be empty.";
    }
}
?>