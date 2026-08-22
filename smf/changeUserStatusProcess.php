<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $status = $_POST["s"];
    $email = $_POST["e"];

    Database::iud("UPDATE `user` SET `u_status_id`='".$status."' WHERE `email`='".$email."'");
    echo("Success");

}else{

    echo("You are not a valid user");

}

?>