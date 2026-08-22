<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(!empty($_POST["e"] && $_POST["p"])){

    $email = $_POST["e"];
    $pw = $_POST["p"];

    $rs = Database::search("SELECT * FROM `admin` WHERE `a_email`='".$email."' AND `password`='".$pw."'");
    $n = $rs->num_rows;

    if($n == 1){
 
        $code = uniqid();
        Database::iud("UPDATE `admin` SET `v_code`='".$code."' WHERE `a_email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gimhanaakilatmd@gmail.com';
            $mail->Password = 'rfhwdgbctusyhyjg';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('gimhanaakilatmd@gmail.com', 'Reset Password');
            $mail->addReplyTo('gimhanaakilatmd@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Smart Money Fortune Forgot Password Verification Code';
            $bodyContent = '<h1 style="color:green">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo("Verification code sending Faild");
        }else{
            echo("Success");
        }

    }else{
        echo("Invalid Email address Or Password");
    }

}else{
    echo("Please Enter Password and Email");
}

?>