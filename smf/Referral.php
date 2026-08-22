<?php

require "connection.php";
session_start();
$user = $_SESSION["u"];

$total = 0;

if(!empty($user)){


?>


<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMF Referrals</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>
    <body style="background-color:#221f3f; font-family: Quicksand;">

        <div class="container-fluid" >
            <div class="row">

                <?php include "slidebar.php"; ?>

                <div class="col-lg-11 col-10 mx-5 mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-11 offset-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-lg-5 col-11 mx-1 mx-lg-0 mt-4">
                                                    <div class="row">

                                                        <?php
                                                        
                                                        $r_rs = Database::search("SELECT * FROM `referral` WHERE `refer_code`='".$user["r_code"]."'");
                                                        $r_num = $r_rs->num_rows;

                                                        $ri_rs = Database::search("SELECT * FROM `r_income` WHERE `user_email`='".$user["email"]."'");
                                                        $ri_num = $ri_rs->num_rows;

                                                        $w_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$user["email"]."'");
                                                        $w_data = $w_rs->fetch_assoc();

                                                        for($x = 0; $x < $ri_num; $x++){

                                                            $ri_data = $ri_rs->fetch_assoc();

                                                            $total = $total + $ri_data["amount"];

                                                        }
                                                        
                                                        ?>

                                                        <div class="col-12 border border-2 border-secondary rounded rounded-3" style="height: 6rem;">
                                                            <div class="row">
                                                                <div class="col-8 mt-2 mt-lg-4">
                                                                    <span class="form-label fs-2 text-white">Direct Referrals</span>
                                                                </div>
                                                                <div class="col-4 text-end mt-3">
                                                                    <span class="form-label text-white" style="font-size: 40px;"><?php echo $r_num; ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 border border-2 border-secondary rounded rounded-3 mt-4" style="height: 6rem;">
                                                            <div class="row">
                                                                <div class="col-8 mt-2 mt-lg-4">
                                                                    <span class="form-label fs-2 text-white">Referral Income</span>
                                                                </div>
                                                                <div class="col-4 text-end mt-3">
                                                                    <span class="form-label text-white" style="font-size: 40px;"><?php echo $total; ?>$</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 border border-2 border-secondary rounded rounded-3 mt-4" style="height: 6rem;">
                                                            <div class="row">
                                                                <div class="col-8 mt-2 mt-lg-4">
                                                                    <span class="form-label fs-2 text-white">Total Balance</span>
                                                                </div>
                                                                <div class="col-4 text-end mt-3">
                                                                    <span class="form-label text-white" style="font-size: 40px;"><?php echo $w_data["amount"]; ?>$</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-lg-7 col-12 mx-lg-0 mx-1 mt-4">
                                                    <div class="row">

                                                        <div class="col-lg-11 col-12 mx-auto" style="height: 7rem;">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                    
                                                                        <div class="col-11 col-lg-12 mt-lg-0 mt-5 border border-1 border-secondary">
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-12">
                                                                                    <span class="form-label fs-4 fst-italic text-white">Your Referral Code </span>   
                                                                                </div>
                                                                                <div class="col-lg-6 col-12 text-lg-end text-start">
                                                                                    <span class="form-label fs-4 fst-italic text-info"><?php echo $user["r_code"]; ?></span>
                                                                                    <i class="bi bi-clipboard text-secondary copy"></i>   
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12  mt-5">
                                                                            <div class="row">
                                                                                <span class="form-label fs-3 text-center text-primary fw-bold fst-italic">Refferal Incomes</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-11 col-lg-12 overflow-auto">
                                                                            <table class="table">

                                                                                <thead>
                                                                                    <tr class="border border-2 rounded rounded-5 border-light bg-gradient text-white" style="font-family: 'Quicksand';">
                                                                                        <th class="text-center text-white">No</th>
                                                                                        <th class="text-center text-white">Email</th>
                                                                                        <th class="text-center text-white">Day</th>
                                                                                        <th class="text-center text-white">Amount</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody>

                                                                                <?php
                                                                        
                                                                                $ri_rs2 = Database::search("SELECT * FROM `r_income` WHERE `user_email`='".$user["email"]."'");
                                                                                $ri_num2 = $ri_rs2->num_rows;

                                                                                for($y = 0; $y < $ri_num2; $y++){

                                                                                    $ri_data = $ri_rs2->fetch_assoc();

                                                                                ?>

                                                                                        <tr class="bg-secondary bg-opacity-25 text-white" >
                                                                                            <td class="fw-bold text-center pt-3 border border-2 border-white"><?php echo $y + 1; ?></td>
                                                                                            <td class="fw-bold text-center pt-3 border border-2 border-white"><?php echo $ri_data["from"]; ?></td>
                                                                                            <td class="fw-bold text-center pt-3 border border-2 border-white"><?php echo $ri_data["date"]; ?></td>
                                                                                            <td class="fw-bold text-center pt-3 border border-2 border-white"  style="color: #83f35a"><?php echo $ri_data["amount"]; ?>$</td>
                                                                                        </tr>

                                                                                    <?php

                                                                                    }
                                                                                    
                                                                                    ?>
                                                                                    
                                                                                </tbody>
                                                                            
                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
        <script src="script.js"></script>
    </body>

</html>

<?php

}else {

    ?>
    <script>
        alert("Please Signin Frist");
        window.location = "index.php";
    </script>
    <?php

}

?>