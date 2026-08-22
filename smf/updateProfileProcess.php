<?php

require "connection.php";
session_start();

if(!empty($_SESSION["u"])){

    $user = $_SESSION["u"];
    $uname = $_POST["un"];
    $mobile = $_POST["m"];
    $line1 = $_POST["l1"];
    $city = $_POST["c"];
    $country = $_POST["country"];
    $pcode = $_POST["pc"];

    if(isset($_FILES["image"])){

        $image = $_FILES["image"];

        $allowed_image_extention = array("image/jpg" , "image/jpeg" , "image/png" , "image/svg+xml" , "image/jfif");
        $file_type = $image["type"];

        if(in_array($file_type,$allowed_image_extention)){

            $new_file_extention;

            if($file_type == "image/jpg"){
                $new_file_extension = ".jpg";
            }else if($file_type == "image/jpeg"){
                $new_file_extension = ".jpeg";
            }else if($file_type == "image/png"){
                $new_file_extension = ".png";
            }else if($file_type == "image/svg+xml"){
                $new_file_extension = ".svg";
            }else if($file_type == "image/jfif"){
                $new_file_extension = ".jfif";
            }

            $file_name = "profile_images//" .$_SESSION["u"]["user_name"]."_".uniqid().$new_file_extension;

            move_uploaded_file($image["tmp_name"],$file_name);

            $image_rs = Database::search("SELECT * FROM `img_path` WHERE `user_email` = '".$_SESSION["u"]["email"]."'");
            $image_num = $image_rs->num_rows;

            if($image_num == 1){

                Database::iud("UPDATE `img_path` SET `path`='".$file_name."' 
                WHERE `user_email` = '".$_SESSION["u"]["email"]."'");

            }else{

                Database::iud("INSERT INTO `img_path` (`path`,`user_email`) 
                VALUES ('".$file_name."','".$_SESSION["u"]["email"]."')");

            }

        }else{
            echo("Please select avalid image");
        }

    }

    Database::iud("UPDATE `user` SET `user_name`='".$uname."', `mobile`='".$mobile."' WHERE `email`='".$_SESSION["u"]["email"]."'");

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$_SESSION["u"]["email"]."'");

    $address_num = $address_rs->num_rows;

    if($address_num == 1){

        Database::iud("UPDATE `user_has_address` SET `city`='".$city."', `country`='".$country."', `address`='".$line1."', 
        `postal_code`='".$pcode."' WHERE `user_email`='".$_SESSION["u"]["email"]."'");
        
    }else{

        Database::iud("INSERT INTO `user_has_address` (`user_email`, `city`, `country`, `address`, `postal_code`) 
        VALUES ('".$_SESSION["u"]["email"]."', '".$city."', '".$country."', '".$line1."', '".$pcode."')");

    }

    echo("Success");

}else{
    echo("Please Signin Frist...");
}

?>