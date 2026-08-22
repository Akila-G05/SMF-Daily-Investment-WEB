<?php

require "connection.php";

$uname = $_POST["u"];
$email = $_POST["e"];
$password = $_POST["pw"];
$repassword = $_POST["repw"];
$bid = $_POST["bid"];
$mobile = $_POST["m"];
$gender = $_POST["g"];
$rcode = $_POST["rc"];
$rc = uniqid();
$vcode = uniqid();

if(empty($uname)){
    echo("Please enter your User Name !!!");
}else if(strlen($uname) > 50){
    echo("User Name must have less than 50 characters");
}else if(empty($email)){
    echo("Please enter your Email !!!");
}else if(strlen($email) >= 100){
    echo("Email must have less than 100 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid email !!!");
}else if(empty($password)){
    echo("Please enter your Password !!!");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo("Password must in between 5-20 characters");
}else if($password != $repassword){
    echo("Password Feilds Not Maching");
}else if(empty($bid)){
    echo("Please enter your Binance ID !!!");
}else if(!preg_match("/[0-9]/",$bid)){
    echo("Invalid Binance ID");
}else if($bid == 9){
    echo("Binance ID should be 8 Numbers");
}else if(empty($mobile)){
    echo("Please enter your Mobile !!!");
}else if(strlen($mobile) != 10){
    echo("Mobile must have 10 characters");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo ("Invalid mobile Number !!!");
}else if(empty($gender)){
    echo("Please Select Gender !!!");
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `b_id`='".$bid."'");
    $rs_num = $rs->num_rows;

    if($rs_num != 0){

        echo("User with the same email or binanace ID already exists");

    }else{

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        if(empty($rcode)){
            $rcode = "";

            Database::iud ("INSERT INTO `user` (`email`,`user_name`,`password`,`b_id`,`mobile`,`r_date`,`r_code`,`verification_code`,`gender_id`,`u_status_id`) 
            VALUES ('".$email."','".$uname."','".$password."','".$bid."','".$mobile."','".$date."','".$rc."','".$vcode."','".$gender."','1')");

            Database::iud("INSERT INTO `wallet` (`amount`, `total_earnings`, `user_email`) 
            VALUES ('0', '0', '".$email."')");

            Database::iud("INSERT INTO `user_has_address` (`user_email`, `city`, `country`, `address`, `postal_code`) 
            VALUES ('".$email."', '', '', '', '')");
            echo("Success");

        }else{
            
            $rcode = $_POST["rc"];

            $r_rs = Database::search("SELECT * FROM `user` WHERE `r_code`='".$rcode."'");
            $r_num = $r_rs->num_rows;

            if($r_num > 0){

                Database::iud ("INSERT INTO `user` (`email`,`user_name`,`password`,`b_id`,`mobile`,`r_date`,`r_code`, `ls_date`,`verification_code`,`gender_id`,`u_status_id`) 
                VALUES ('".$email."','".$uname."','".$password."','".$bid."','".$mobile."','".$date."','".$rc."', '".$date."','".$vcode."','".$gender."','1')");

                Database::iud("INSERT INTO `wallet` (`amount`, `total_earnings`, `user_email`) 
                VALUES ('0', '0', '".$email."')");

                Database::iud("INSERT INTO `user_has_address` (`user_email`, `city`, `country`, `address`, `postal_code`) 
                VALUES ('".$email."', '', '', '', '')");

                Database::iud("INSERT INTO `referral` (`user_email`,`refer_code`) VALUES ('".$email."','".$rcode."')");

                echo("Success");
            }else{
                echo("Invalid Referral Code");
            }     

        }

    }

}

?>