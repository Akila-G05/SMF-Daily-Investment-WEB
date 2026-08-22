<?php

require "connection.php";

session_start();

$email = $_POST["e"];
$password = $_POST["p"];

// $email = "test@gmail.com";
// $password = "maruwa";

if (empty($email)) {
    echo ("Please enter your Email");
} else if (strlen($email) >= 100) {
    echo ("Email must have less than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !!!");
} else if (empty($password)) {
    echo ("Please enter your Password");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must in between 5-20 characters");
} else {

    $a_rs = Database::search("SELECT * FROM `admin`");
    $a_data = $a_rs->fetch_assoc();

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    if($password == $a_data["password"]){

        $rs2 = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
        $n2 = $rs2->num_rows;

        if ($n2 == 1) {

            $rs_data2 = $rs2->fetch_assoc();

            $uhp_rs = Database::search("SELECT * FROM `user_has_packages` WHERE `user_email`='".$email."'");
            $uhp_num = $uhp_rs->num_rows;

            for($x = 0; $x < $uhp_num; $x++){

                $uhp_data = $uhp_rs->fetch_assoc();

                if($uhp_data["p_status_id"] == 2){

                    $pkg_rs = Database::search("SELECT * FROM `packages` WHERE `id`='".$uhp_data["packages_id"]."'");
                    $pkg_data = $pkg_rs->fetch_assoc(); 

                    $price = $pkg_data["price"];
                    $total = $price * 2;

                    if($uhp_data["earning"] != $total){

                        $daily = $price * 0.8 / 100;

                        $last_s_date = new DateTime();
                        $pkg_c_date = new DateTime($uhp_data["confirm_date"]);

                        $interval = $last_s_date->diff($pkg_c_date);
                        $days = abs($interval->days);

                        // echo($days . " ");
                        // echo($uhp_data["earning"] . " ");
                        // echo($total . " ");
                        // echo($daily) . " ";
                        if($days > 0){

                            $w_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$uhp_data["user_email"]."'");
                            $w_data = $w_rs->fetch_assoc();

                            $w_amount2 = $w_data["amount"];
                            $w_earnings = $w_data["total_earnings"];

                            $daily_earn = $days * $daily;
                            $uhp_earning = $uhp_data["earning"] + $daily_earn;

                            $w_new_amount = $w_amount2 + $daily_earn;
                            $w_new_earnings = $w_earnings + $daily_earn;

                            Database::iud("UPDATE `user_has_packages` SET `earning`='".$uhp_earning."', `confirm_date`='".$date."' WHERE `id`='".$uhp_data["id"]."'");

                            if($uhp_data["earning"] != $total){

                                for($y = 0; $y < $days; $y++){

                                    $dateInterval = new DateInterval("P1D");
                                    $pkg_c_date->add($dateInterval);
    
                                    $resultDate = $pkg_c_date->format("Y-m-d");
    
                                    Database::iud("INSERT INTO `income` (`date`, `amount`, `user_has_packages_id`, `i_type_id`, `user_email`) 
                                    VALUES('".$resultDate."', '".$daily."', '".$uhp_data["id"]."', '1', '".$uhp_data["user_email"]."')");
    
                                }
    
                                Database::iud("UPDATE `wallet` SET `amount`='".$w_new_amount."', `total_earnings`='".$w_new_earnings."' 
                                WHERE `user_email`='".$uhp_data["user_email"]."'");

                            }else{
                                Database::iud("UPDATE `user_has_packages` SET `p_status_id`='4' WHERE `id`='".$uhp_data["id"]."'");
                            }

                            
                        }

                    }else{

                        Database::iud("UPDATE `user_has_packages` SET `p_status_id`='4' WHERE `id`='".$uhp_data["id"]."'");

                    }

                }
                
            }
        
            if ($rs_data2["u_status_id"] == 1) {

                Database::iud("UPDATE `user` SET `ls_date`='".$date."' WHERE `email`='".$email."'");
    
                $_SESSION["u"] = $rs_data2;
                echo ("Success2");
            } else {
                echo ("Your Account has been suspended. Contact the admin");
            }
        } else {
            echo ("Invalid Email or Password");
        }

    }else{

        $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $password . "';");
        $n = $rs->num_rows;

        if ($n == 1) {

            $rs_data2 = $rs->fetch_assoc();

            $uhp_rs = Database::search("SELECT * FROM `user_has_packages` WHERE `user_email`='".$email."'");
            $uhp_num = $uhp_rs->num_rows;

            for($x = 0; $x < $uhp_num; $x++){

                $uhp_data = $uhp_rs->fetch_assoc();

                if($uhp_data["p_status_id"] == 2){

                    $pkg_rs = Database::search("SELECT * FROM `packages` WHERE `id`='".$uhp_data["packages_id"]."'");
                    $pkg_data = $pkg_rs->fetch_assoc(); 

                    $price = $pkg_data["price"];
                    $total = $price * 2;

                    if($uhp_data["earning"] != $total){

                        $daily = $price * 0.8 / 100;

                        $last_s_date = new DateTime();
                        $pkg_c_date = new DateTime($uhp_data["confirm_date"]);

                        $interval = $last_s_date->diff($pkg_c_date);
                        $days = abs($interval->days);

                        // echo($days . " ");
                        // echo($uhp_data["earning"] . " ");
                        // echo($total . " ");
                        // echo($daily) . " ";
                        if($days > 0){

                            $w_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$uhp_data["user_email"]."'");
                            $w_data = $w_rs->fetch_assoc();

                            $w_amount2 = $w_data["amount"];
                            $w_earnings = $w_data["total_earnings"];

                            $daily_earn = $days * $daily;
                            $uhp_earning = $uhp_data["earning"] + $daily_earn;

                            $w_new_amount = $w_amount2 + $daily_earn;
                            $w_new_earnings = $w_earnings + $daily_earn;

                            Database::iud("UPDATE `user_has_packages` SET `earning`='".$uhp_earning."', `confirm_date`='".$date."' WHERE `id`='".$uhp_data["id"]."'");

                            if($uhp_data["earning"] != $total){

                                for($y = 0; $y < $days; $y++){

                                    $dateInterval = new DateInterval("P1D");
                                    $pkg_c_date->add($dateInterval);
    
                                    $resultDate = $pkg_c_date->format("Y-m-d");
    
                                    Database::iud("INSERT INTO `income` (`date`, `amount`, `user_has_packages_id`, `i_type_id`, `user_email`) 
                                    VALUES('".$resultDate."', '".$daily."', '".$uhp_data["id"]."', '1', '".$uhp_data["user_email"]."')");
    
                                }
    
                                Database::iud("UPDATE `wallet` SET `amount`='".$w_new_amount."', `total_earnings`='".$w_new_earnings."' 
                                WHERE `user_email`='".$uhp_data["user_email"]."'");

                            }else{
                                Database::iud("UPDATE `user_has_packages` SET `p_status_id`='4' WHERE `id`='".$uhp_data["id"]."'");
                            }
                        }

                    }else{

                        Database::iud("UPDATE `user_has_packages` SET `p_status_id`='4' WHERE `id`='".$uhp_data["id"]."'");

                    }

                }
                
            }
        

            if ($rs_data2["u_status_id"] == 1) {
                Database::iud("UPDATE `user` SET `ls_date`='".$date."' WHERE `email`='".$email."'");
                $_SESSION["u"] = $rs_data2;
                echo ("Success");
            } else {
                echo ("Your Account has been suspended. Contact the admin");
            }
        } else {
            echo ("Invalid Email or Password");
        }

    }

}
