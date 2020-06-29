<?php
$search = "";

if(isset($_POST["search"])){
    $search = $_POST["search"];
}
?>
<form method="POST">
    <input type="text" name="search" placeholder="Search for Account" value="<?php echo $search;?>"/><br>
	
	<input type="checkbox" id="checkedCount" name="checkedCount" value=2> <label for="checkedCount"> Descending Order?</label><br>

    <input type="submit" value="Search"/>
</form>
<?php
if(isset($search)) {


	if(isset($_POST['checkedCount']) && $_POST['checkedCount'] == 2){ 
		$query = file_get_contents(__DIR__ . "/queries/listdesc.sql");
	}else{
		$query = file_get_contents(__DIR__ . "/queries/listasc.sql");
	}
	if (isset($query) && !empty($query)) {
		require("config.php");
		$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
		try {
			$db = new PDO($connection_string, $dbuser, $dbpass);
			$stmt = $db->prepare($query);
			$stmt->execute([":thing"=>$search]);
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo $results;
			foreach($results as $value){
				echo $value . "<br>";
			}
			
		} catch (Exception $e) {
			echo $e->getMessage();
        }
    }
}
?>

<?php if(isset($results) && count($results) > 0):?>
    <p>This shows when we have results</p>
    <ul>
        <!-- Here we'll loop over all our results and reuse a specific template for each iteration,
        we're also using our helper function to safely return a value based on our key/column name.-->
        <?php foreach($results as $row1):?>
            <li>
                <?php echo get($row1, "AccountNumber");?>
                <?php echo get($row1, "Balance");?>
                <a href="delete.php?thingId=<?php echo get($row1, "id");?>">Delete</a>
				<br><p>works</p>
            </li>
        <?php endforeach;?>
    </ul>
<?php else:?>
    <p>This shows when we don't have results</p>
<?php endif;?>