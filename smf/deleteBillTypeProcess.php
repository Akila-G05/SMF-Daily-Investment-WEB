<?php

$id = $_GET["id"];

Database::iud("DELETE FROM `b_type` WHERE `id`='".$id."'");
echo("Success");

?>