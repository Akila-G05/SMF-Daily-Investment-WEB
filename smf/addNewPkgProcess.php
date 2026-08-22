<?php

require "connection.php";
session_start();

if($_SESSION["au"]){

    $pname = $_POST["pn"];
    $price = $_POST["p"];
    $fee = $_POST["fee"];
    $sprice = $price + $fee;

    if(!empty($pname && $price && $fee)){

        Database::iud("INSERT INTO `packages` (`pkg_name`, `price`, `r_fee`, `selling_price`) 
        VALUES ('".$pname."', '".$price."', '".$fee."', '".$sprice."')");
        echo("Success");

    }else{
        echo("Input Field should not be empty");
    }

}else{
    echo("You are not a valid User");
}

?>