<?php

require "connection.php";

$id = $_GET["id"];

if(!empty($id)){

    $bill_rs = Database::search("SELECT * FROM `paybill` WHERE `id`='".$id."' ORDER BY `date` DESC");
    $bill_num = $bill_rs->num_rows;

    if($bill_num > 0){
        Database::iud("DELETE FROM `paybill` WHERE `id`='".$id."'");
        echo("Success");
    }

}






?>