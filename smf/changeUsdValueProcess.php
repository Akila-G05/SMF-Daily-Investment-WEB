<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $lkr = $_GET["lkr"];

    Database::iud("UPDATE `convert` SET `lkr`='".$lkr."' WHERE `id`='1'");
    echo("Success");

}else{
    echo("You are not valid user");
}

?>