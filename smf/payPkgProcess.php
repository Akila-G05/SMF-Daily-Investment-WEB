<?php

require "connection.php";
session_start();

if(!empty($_SESSION["u"])){

    $pid = $_POST["id"];
    $ptype = $_POST["ptype"];
    $email = $_SESSION["u"]["email"];

    if(!empty($_FILES["image"])){

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

            $file_name = "payement//" .$_SESSION["u"]["email"]."_".uniqid().$new_file_extension;

            move_uploaded_file($image["tmp_name"],$file_name);

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `user_has_packages` (`user_email`, `packages_id`, `date`, `confirm_date`, `path`, `earning`, `p_type_id`, `p_status_id`) 
            VALUES ('".$email."', '".$pid."', '".$date."', '".$date."', '".$file_name."','0', '".$ptype."', '1')");

            echo("Success");

        }else{
            echo("Please select a valid image");
        }

    }else{
        echo("Please upload Payment Recipt");
    }

}else{

    echo("Please Signin Frist");

}

?>