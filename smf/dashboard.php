<?php

require "connection.php";
session_start();
$user = $_SESSION["u"];

$w_total = 0;
$r_total = 0;

if(!empty($user)){


?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMF Dashboard</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>

    <body  style="background-color:#221f3f; font-family: Quicksand;">

        <div class="container-fluid">
            <div class="row">

                <?php include "slidebar.php"; ?>

                <div class="col-11 offset-1 mt-5 vh-100 ">
                    <div class="row align-content-center">
                        <div class="col-12 justify-content-center">
                            <div class="row align-content-center">

                            <div class="col-lg-11 col-11 mx-lg-4 mx-4 justify-content-center">
                                <div class="row align-content-center">

                                    <div class="col-12 my-4" style="font-family: Quicksand;">

                                        <div class="row mx-3">
                                            <div class="col-lg-6 col-10 offset-lg-0 mx-auto ">
                                                <div class="row">

                                                    <div class="col-12 ">
                                                        <div class="row">

                                                        <?php
                                                        
                                                        $w_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$user["email"]."'");
                                                        $w_data = $w_rs->fetch_assoc();

                                                        $r_rs = Database::search("SELECT * FROM `referral` WHERE `refer_code`='".$user["r_code"]."'");
                                                        $r_num = $r_rs->num_rows;

                                                        $withdraw_rs = Database::search("SELECT * FROM `withdraw` WHERE `user_email`='".$user["email"]."'");
                                                        $withdraw_num = $withdraw_rs->num_rows;

                                                        for($x = 0; $x < $withdraw_num; $x++){

                                                            $withdraw_data = $withdraw_rs->fetch_assoc();                                                           

                                                            if($withdraw_data["w_status_id"] == 1){

                                                                $amount = $withdraw_data["amount"];

                                                            }else if($withdraw_data["w_status_id"] == 2){

                                                                $w_total = $w_total + $withdraw_data["amount"];

                                                            }

                                                        }

                                                        $ri_rs = Database::search("SELECT * FROM `r_income` WHERE `user_email`='".$user["email"]."'");
                                                        $ri_num = $ri_rs->num_rows;

                                                        for($a = 0; $a < $ri_num; $a++){

                                                            $ri_data = $ri_rs->fetch_assoc();

                                                            $r_total = (int)$r_total + (int)$ri_data["amount"];

                                                        }

                                                        ?>

                                                            <div class="col-lg-5 col-12 bg-secondary bg-opacity-25 rounded rounded-3 mx-auto my-lg-0 my-3" style="height: 170px">
                                                                <div class="row">
                                                                    <span class="form-label mt-2 text-center text-white fs-4 fw-bold fst-italic">Wallet Balance</span>
                                                                    <div class="col-12 text-white">
                                                                        <i class="bi bi-currency-dollar mb-2" style="font-size: 60px;"></i>
                                                                        <span class="form-label mt-2 text-center" style="font-size: 45px;"> <?php echo number_format($w_data["amount"],1); ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 col-12 bg-secondary bg-opacity-25 rounded rounded-3" style="height: 170px">
                                                                <div class="row">
                                                                    <span class="form-label text-white mt-2 text-center fs-4 fw-bold fst-italic">Direct Riferral</span>
                                                                    <div class="col-12 mt-3 text-center text-white">
                                                                        <span class="form-label mt-3 text-center" style="font-size: 60px;"> <?php echo $r_num; ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-12 mt-lg-5 mt-0 text-white">
                                                        <div class="row">

                                                            <div class="col-lg-5 col-12 my-lg-0 my-3 bg-secondary bg-opacity-25 rounded rounded-3 mx-auto" style="height: 170px">
                                                                <div class="row">
                                                                    <span class="form-label mt-2 text-center fs-5 fw-bold fst-italic">Total withdrawal</span>
                                                                    <div class="col-12">
                                                                        <i class="bi bi-currency-dollar" style="font-size: 60px;"></i>
                                                                        <?php
                                                                        
                                                                        if($w_total == 0){
                                                                            ?>
                                                                            <span class="form-label text-center" style="font-size: 45px;">0.00</span>
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <span class="form-label text-center" style="font-size: 45px;"><?php echo number_format($w_total, 1); ?></span>
                                                                            <?php
                                                                        }
                                                                        
                                                                        ?>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 col-12 bg-secondary bg-opacity-25 rounded rounded-3 mb-lg-0 mb-3" style="height: 170px">
                                                                <div class="row">
                                                                    <span class="form-label mt-2 text-center fs-4 fw-bold fst-italic">Total Referance</span>
                                                                    <div class="col-12">
                                                                        <i class="bi bi-currency-dollar" style="font-size: 60px;"></i>
                                                                        <?php
                                                                        
                                                                        if($r_total == 0){
                                                                            ?>
                                                                            <span class="form-label text-center" style="font-size: 45px;">0.00</span>
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <span class="form-label text-center" style="font-size: 45px;"><?php echo number_format($r_total ,1); ?></span>
                                                                            <?php
                                                                        }
                                                                        
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="row">
                                                    <div class="col-lg-11 col-12 bg-secondary bg-opacity-25 d-lg-flex d-none text-white rounded rounded-3 mx-auto" style="height: 388px;">
                                                        <div class="row">

                                                            <div class="col-12" >
                                                                <div class="row">

                                                                    <span class="form-label fs-2 fw-bold fst-italic mt-3 text-center">Total Earnings</span>
                                                                    <div class="col-12 text-center">
                                                                        <i class="bi bi-currency-dollar" style="font-size: 45px;"></i>
                                                                        <?php
                                                                        
                                                                        if($w_data["total_earnings"] == 0){
                                                                            ?>
                                                                            <span class="form-label text-center" style="font-size: 50px;">0.00</span>
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <span class="form-label text-center" style="font-size: 50px;"><?php echo $w_data["total_earnings"]; ?></span>
                                                                            <?php
                                                                        }
                                                                        
                                                                        ?>
                                                                        
                                                                    </div>

                                                                    <div class="col-10 mx-auto" style="height: 450px; width:450px;">
                                                                        <div class="row">
                                                                            <?php include "lineChart.php"; ?>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-11 col-12 bg-secondary bg-opacity-25 d-lg-none d-block text-white rounded rounded-3 mx-auto">
                                                        <div class="row">

                                                            <div class="col-12" >
                                                                <div class="row">

                                                                    <span class="form-label fs-2 fw-bold fst-italic mt-3 text-center">Total Earnings</span>
                                                                    <div class="col-12 text-center mb-4">
                                                                        <i class="bi bi-currency-dollar" style="font-size: 45px;"></i>
                                                                        <?php
                                                                        
                                                                        if($w_data["total_earnings"] == 0){
                                                                            ?>
                                                                            <span class="form-label text-center" style="font-size: 50px;">0.00</span>
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <span class="form-label text-center" style="font-size: 50px;"><?php echo $w_data["total_earnings"]; ?></span>
                                                                            <?php
                                                                        }
                                                                        
                                                                        ?>
                                                                        
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12  mt-5 overflow-auto bg-secondary bg-opacity-25" style="height: 400px;"> 
                                        <div class="col-12">
                                            <table class="table">

                                                <thead>
                                                    <tr class="bg-dark text-white" style="font-family: 'Quicksand';">
                                                        <th class="text-center text-white">No</th>
                                                        <th class="text-center text-white">Email</th>
                                                        <th class="text-center text-white">Day</th>
                                                        <th class="text-center text-white">Type</th>
                                                        <th class="text-center text-white">Amount</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php
                                                    
                                                    $income_rs = Database::search("SELECT * FROM `income` WHERE `user_email`='".$user["email"]."' ORDER BY `date` DESC");
                                                    $income_num = $income_rs->num_rows;

                                                    for($c = 0; $c < $income_num; $c++){

                                                        $income_data = $income_rs->fetch_assoc();


                                                    ?>

                                                        <tr class="bg-secondary bg-opacity-25 text-white" >
                                                            <td class="fw-bold text-center pt-3 border border-2 border-dark"><?php echo $c + 1; ?></td>
                                                            <td class="fw-bold text-center pt-3 border border-2 border-dark"><?php echo $income_data["user_email"]; ?></td>
                                                            <td class="fw-bold text-center pt-3 border border-2 border-dark"><?php echo $income_data["date"]; ?></td>
                                                            <td class="fw-bold text-center pt-3 border border-2 border-dark">
                                                                <?php 
                                                                if($income_data["i_type_id"] == 1){
                                                                    echo("Daily"); 
                                                                }else if($income_data["i_type_id"] == 2){ 
                                                                    echo("Added Funds");
                                                                } 
                                                                ?>
                                                            </td>
                                                            <?php 
                                                            if($income_data["amount"] > 0){
                                                                ?>
                                                                <td class="fw-bold text-center pt-3 border border-2 border-dark"  style="color: #83f35a"><?php echo $income_data["amount"]; ?>$</td>
                                                                <?php
                                                            }else if($income_data["amount"] < 0){ 
                                                                ?>
                                                                <td class="fw-bold text-center pt-3 border border-2 border-dark"  style="color: #b70000"><?php echo $income_data["amount"]; ?>$</td>
                                                                <?php
                                                            } else{
                                                                ?>
                                                                <td class="fw-bold text-center pt-3 border border-2 border-dark"  style="color: #83f35a"><?php echo $income_data["amount"]; ?>$</td>
                                                                <?php
                                                            }
                                                            ?>
                                                            
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
        
        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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