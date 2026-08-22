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
        <title>SMF Withdrawals</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>
    <body style="background-color:#221f3f; font-family: Quicksand;">

        <div class="container-fluid" >
            <div class="row">

                <?php include "slidebar.php"; ?>

                <div class="col-lg-11 col-10 mx-5 mx-lg-0 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 offset-lg-1 offset-0">
                                    <div class="row">
                                        <div class="col-11 mx-auto mt-4">
                                            <div class="row"> 

                                                <div class="col-12">
                                                    <div class="row">

                                                    <?php
                                                
                                                    $wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$user["email"]."'");
                                                    $wallet_num = $wallet_rs->num_rows;

                                                    if($wallet_num > 0){

                                                        $wallet_data = $wallet_rs->fetch_assoc();

                                                        $withdraw_rs = Database::search("SELECT * FROM `withdraw` WHERE `user_email`='".$user["email"]."'");
                                                        $withdraw_num = $withdraw_rs->num_rows;

                                                        for($x = 0; $x < $withdraw_num; $x++){

                                                            $withdraw_data = $withdraw_rs->fetch_assoc();

                                                            if($withdraw_data["w_status_id"] == 1){

                                                                $amount = $withdraw_data["amount"];

                                                            }else if($withdraw_data["w_status_id"] == 2){

                                                                $total = $total + $withdraw_data["amount"];

                                                            }

                                                        }

                                                        
                                                    
                                                    ?>

                                                        <div class="col-3 bg-secondary bg-opacity-25 rounded rounded-3 mx-auto my-2 my-lg-0 mt-lg-0 mt-3" style="width: 225px;">
                                                            <div class="row">
                                                                <div class="col-9 my-2">
                                                                    <span class="text-white mt-2 mx-1 fst-italic fs-6">Wallet Balance</span>
                                                                    <span class="text-white mt-1 mx-1 fw-bold fs-3"><?php echo $wallet_data["amount"]; ?></span>
                                                                </div>
                                                                <div class="col-3 mt-2">
                                                                    <span class="text-white mt-2 fst-italic fs-1">$</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 bg-secondary bg-opacity-25 rounded rounded-3 mx-auto my-2 my-lg-0" style="width: 225px;">
                                                            <div class="row">
                                                                <div class="col-9 my-2">
                                                                    <span class="text-white mt-2 mx-1 fst-italic fs-6">Pending</span><br>

                                                                    <?php
                                                                    
                                                                    if(!empty($amount)){
                                                                        ?>
                                                                        <span class="text-white mt-1 mx-1 fw-bold fs-3"><?php echo $amount; ?></span>
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                        <span class="text-white mt-1 mx-1 fw-bold fs-3">0</span>
                                                                        <?php
                                                                    }

                                                                    ?>

                                                                    
                                                                </div>
                                                                <div class="col-3 mt-2">
                                                                    <span class="text-white mt-2 fst-italic fs-1">$</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 bg-secondary bg-opacity-25 rounded rounded-3 mx-auto my-2 my-lg-0" style="width: 225px;">
                                                            <div class="row">
                                                                <div class="col-9 my-2">
                                                                    <span class="text-white mt-2 mx-1 fst-italic fs-6">Hold</span><br>
                                                                    <?php
                                                                    
                                                                    if(!empty($amount)){
                                                                        ?>
                                                                        <span class="text-white mt-1 mx-1 fw-bold fs-3"><?php echo $amount; ?></span>
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                        <span class="text-white mt-1 mx-1 fw-bold fs-3">0</span>
                                                                        <?php
                                                                    }

                                                                    ?>
                                                                </div>
                                                                <div class="col-3 mt-2">
                                                                    <span class="text-white mt-2 fst-italic fs-1">$</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 bg-secondary bg-opacity-25 rounded rounded-3 mx-auto my-2 my-lg-0" style="width: 225px;">
                                                            <div class="row">
                                                                <div class="col-9 my-2">
                                                                    <span class="text-white mt-2 mx-1 fst-italic fs-6">Total Withdrawal</span>
                                                                    <span class="text-white mt-1 mx-1 fw-bold fs-3"><?php echo $total; ?></span>
                                                                </div>
                                                                <div class="col-3 mt-2">
                                                                    <span class="text-white mt-2 fst-italic fs-1">$</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                        }else{

                                                            

                                                        }
                                                        ?>

                                                        <div class="col-lg-5 col-11 mx-lg-auto mx-auto rounded rounded-3 mt-5 mb-lg-5 mb-0 bg-secondary bg-opacity-25">
                                                            <div class="row">
                                                                <span class="text-white mt-2 fst-italic fs-5 text-center">Request Withdraw</span>
                                                                <div class="input-group mb-3 mt-2">
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" id="amount">
                                                                    <span class="input-group-text">.00</span>
                                                                </div>
                                                                <div class="col-10 mx-auto">
                                                                    <hr class="border border-white">
                                                                </div>
                                                                <div class="col-4 d-grid mx-auto mb-3">
                                                                    <button class="btn btn-outline-light rounded rounded-5 text-white" onclick="withdraw();">Withdraw</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-11 mx-auto mx-lg-0 col-lg-12 overflow-auto mt-5 mb-2"  style="height: 400px;">
                                                            <table class="table">

                                                                <thead>
                                                                    <tr class="border border-2 rounded rounded-5 border-light bg-gradient text-white" style="font-family: 'Quicksand';">
                                                                        <th class="text-center text-white">No</th>
                                                                        <th class="text-center text-white">Binance Id</th>
                                                                        <th class="text-center text-white">Day</th>
                                                                        <th class="text-center text-white">Amount</th>
                                                                        <th class="text-center text-white">Status</th>
                                                                        <th class="text-center text-white"></th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>

                                                                    <?php

                                                                    $withdraw_rs2 = Database::search("SELECT * FROM `withdraw` WHERE `user_email`='".$user["email"]."' ORDER BY `date` DESC");
                                                                    $withdraw_num2 = $withdraw_rs2->num_rows;

                                                                    for($y = 0; $y < $withdraw_num2; $y++){

                                                                        $withdraw_data2 = $withdraw_rs2->fetch_assoc();

                                                                        $amount2 = $withdraw_data2["amount"];

                                                                    ?>

                                                                        <tr class="bg-secondary bg-opacity-25 text-white" >
                                                                            <td class="text-center pt-3 border-white"><?php echo $y + 1; ?></td>
                                                                            <td class=" text-center pt-3 border-white"><?php echo $user["b_id"]; ?></td>
                                                                            <td class="text-center pt-3 border-white"><?php echo $user["r_date"]; ?></td>
                                                                            <td class=" text-center pt-3 border-white"  style="color: #83f35a"><?php echo $amount2; ?>$</td>
                                                                            <?php
                                                                        
                                                                            if($withdraw_data2["w_status_id"] == 1){
                                                                                ?>
                                                                                <td class=" text-center text-warning pt-3 border-white">Pending</td>                                                                                <?php
                                                                            }else if($withdraw_data2["w_status_id"] == 2){
                                                                                ?>
                                                                                <td class=" text-center pt-3 border-white" style="color: #83f35a">Success</td>                                                                                <?php
                                                                            }else if($withdraw_data2["w_status_id"] == 3){
                                                                                ?>
                                                                                <td class=" text-center text-danger pt-3 border-white">Failed</td>
                                                                                <?php
                                                                            }

                                                                            if($withdraw_data2["w_status_id"] == 1){

                                                                                ?>
                                                                                <td class=" text-center text-danger pt-3 border-white" onclick="deleteWithdraw('<?php echo $withdraw_data2['id'] ?>');"><i class="bi bi-trash-fill text-danger"></i></td>
                                                                                <?php
                                                                                
                                                                            }else{
                                                                                ?>
                                                                                <td class=" text-center text-danger pt-3 border-white"></td>
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