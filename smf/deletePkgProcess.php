<?php

require "connection.php";
session_start();

if($_SESSION["au"]){

    $id = $_GET["id"];

    $uhp_rs = Database::search("SELECT * FROM `user_has_packages` WHERE `packages_id`='".$id."'");
    $uhp_num = $uhp_rs->num_rows;

    if($uhp_num > 0){
        echo("You can't delete this package.");
    }else{

        Database::iud("DELETE FROM `packages` WHERE `id`='".$id."'");
        echo("Success");

    }

}else{
    echo("You are not a valid User");
}

?>