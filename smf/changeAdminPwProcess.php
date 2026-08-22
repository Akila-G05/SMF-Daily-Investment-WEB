<?php

require "connection.php";

$vcode = $_POST["vc"];
$np = $_POST["np"];
$rp = $_POST["rp"];

if(empty($vcode)){
    echo("Please Enter Verification Code");
}else if(empty($np)){
    echo("Please Enter New Password");
}else if(empty($rp)){
    echo("Please Reenter Password");
}else if($np != $rp){
    echo("Pasword Field Doesn't Match....");
}else{

    $a_rs = Database::search("SELECT * FROM `admin` WHERE `v_code`='".$vcode."'");
    $a_num = $a_rs->num_rows;

    if($a_num > 0){
        Database::iud("UPDATE `admin` SET `password`='".$np."' WHERE `v_code`='".$vcode."'");
        echo("Success");
    }else{
        echo("Invalid Email Address");
    }

}
    







?>