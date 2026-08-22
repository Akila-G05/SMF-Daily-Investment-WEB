<?php

require "connection.php";

$status = $_POST["s"];
$id = $_POST["id"];

Database::iud("UPDATE `b_type` SET `b_status2_id`='".$status."' WHERE `id`='".$id."'");
echo("Success");


?>