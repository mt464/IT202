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
	<input type="text" id="t" name="atype" value="<?php echo get($result, "AccountType");?>" />
	</label>
	<label for="b">Balance
	<input type="number" id="b" name="balance" value="<?php echo get($result, "Balance");?>" />
	</label>
	<label for="n">Account Number
	<input type="number" id="n" name="ac" value="<?php echo get($result, "AccountNumber");?>" />
	</label>
	<input type="submit" name="Delete" value="Delete Account"/>
</form>

<?php
if(isset($_POST["Delete"])){
    $atype = $_POST["atype"];
    $balance = $_POST["balance"];
	$ac = $_POST["ac"];
    if(!empty($atype) && !empty($ac)){
        try{
            $stmt = $db->prepare("Delete from BankAccounts where id=:id");
            $result = $stmt->execute(array(
				":id" => $thingId
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
            }
            else{
                if ($result){
                    echo "Successfully deleted account. Number: " . $ac;
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