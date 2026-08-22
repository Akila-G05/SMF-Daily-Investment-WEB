<?php

require "connection.php";

session_start();

$email = $_POST["e"];
$password = $_POST["p"];

if(empty($email)){
    echo("Please enter your Email");
}else if(strlen($email) >= 100){
    echo("Email must have less than 100 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email !!!");
}else if(empty($password)){
    echo("Please enter your Password");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo("Password must in between 5-20 characters");
}else{
    
    $rs = Database::search("SELECT * FROM `admin` WHERE `a_email`='".$email."' AND `password`='".$password."';");
    $n = $rs->num_rows;

    if($n==1){

        
        $d = $rs->fetch_assoc();
        $_SESSION["au"] = $d;
        echo("Success");

    }else{
        echo ("Invalid Email or Password");
    }
    
}