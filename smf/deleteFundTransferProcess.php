<?php

require "connection.php";
session_start();

if(!empty($_SESSION["u"])){

    $user = $_SESSION["u"];
    $id = $_GET["id"];

    Database::iud("DELETE FROM `fund_transfer` WHERE `id`='".$id."'");
    echo("Success");

}else {
    echo("Please Signin Frist");
}

?>