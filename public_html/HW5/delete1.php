<?php
if (isset($_GET["thingId"]) && !empty($_GET["thingId"])){
    if(is_numeric($_GET["thingId"])){
        $thingId = (int)$_GET["thingId"];
        $query = file_get_contents(__DIR__ . "/queries/delete1.sql");
        if(isset($query) && !empty($query)) {
            require("common.inc.php");
            $stmt = getDB()->prepare($query);
            $stmt->execute([":id"=>$thingId]);
            $e = $stmt->errorInfo();
            else{
                echo var_export($e, true);
            }
        }
    }
}
else{
    echo "Invalid thing to delete";
}