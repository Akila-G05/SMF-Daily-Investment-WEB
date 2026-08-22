<?php

require "connection.php";
session_start();
$user = $_SESSION["u"];

if(!empty($user)){

    $amount = 0;
    $total = 0;
    
    
    ?>


<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DMF Referrals</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>
    <body style="background-color:#221f3f; font-family: Quicksand;">

        <div class="container-fluid" >
            <div class="row">

                <?php include "slidebar.php"; ?>

                <div class="col-10 col-lg-11 mx-5 mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-11 offset-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">

                                                <?php
                                                                                                                                                          
                                                $v_rs = Database::search("SELECT * FROM `convert`");          
                                    
                                                $vdata = $v_rs->fetch_assoc();
                                                $lkr = $vdata["lkr"];

                                                $wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$user["email"]."'");
                                                $wallet_data = $wallet_rs->fetch_assoc();
                                                                                            
                                                $bill_rs = Database::search("SELECT * FROM `paybill` WHERE `user_email`='".$user["email"]."'");
                                                $bill_num = $bill_rs->num_rows;

                                                for($c = 0; $c < $bill_num; $c++){

                                                    $bill_data = $bill_rs->fetch_assoc();

                                                    if($bill_data["b_status_id"] == 1){

                                                        $amount = $amount + $bill_data["payment"];

                                                    }else if($bill_data["b_status_id"] == 2){

                                                        $total = $total + $bill_data["payment"];

                                                    }

                                                }

                                                $available = $wallet_data["amount"] - $amount;
                                                
                                                ?>

                                                <div class="col-lg-7 mx-auto mx-lg-0 col-12 mt-lg-5 mt-0">
                                                    <div class="col-12 bg-secondary bg-opacity-25 rounded rounded-3 my-lg-3 my-3" style="height: 80px">
                                                        <div class="row">
                                                            <div class="col-3 text-white mt-4 mt-lg-2">
                                                                <span class="form-label mt-2 text-start fs-2 text-white fw-bold fst-italic">
                                                                    <i class="bi bi-currency-dollar mb-2 fs-1" ></i> 1
                                                                </span>
                                                            </div>
                                                            <div class="col-4 col-lg-5 text-center mt-lg-3 mt-4 text-white">
                                                                <span class="form-label mt-2 text-center fs-2">---<i class="bi bi-arrow-right"></i></span>
                                                            </div>
                                                            <div class="col-5 col-lg-4 text-end text-white mt-lg-3 mt-4">
                                                                <span class="form-label mt-3 text-center fs-2"><span class="form-label">Rs.</span> <?php echo $lkr ." "; ?></span>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-12 bg-secondary bg-opacity-25 rounded rounded-3 mt-lg-5  my-lg-0 my-1" style="height: 250px">
                                                        <div class="row">

                                                            <div class="col-12 text-center text-light mt-lg-4 mt-5">
                                                                <div class="row">
                                                                    <span class="form-label text-center fs-2 fw-bold">Available Balance</span>
                                                                    <div class="col-11 mx-auto">
                                                                        <hr class="border border-2 border-light rounded rounded-5">
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <span class="form-label mt-2 text-start fs-2 text-white fw-bold fst-italic">
                                                                            <i class="bi bi-currency-dollar mb-2 fs-1" ></i>
                                                                        </span>
                                                                        <br>
                                                                        <span class="form-label mt-2 text-start fs-2 text-white fw-bold fst-italic">
                                                                            <?php echo number_format($available, 1); ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-1 mt-3 mt-lg-4 d-lg-none d-block">
                                                                        <span class="form-label text-center fs-5"><i class="bi bi-arrow-right"></i></span>   
                                                                    </div>
                                                                    <div class="col-1 mt-3 mt-lg-4 d-none d-lg-block">
                                                                        <span class="form-label text-center fs-1"><i class="bi bi-arrow-right"></i></span>   
                                                                    </div>
                                                                    <div class="col-6 mt-1 mt-lg-3 d-lg-none d-block">
                                                                        <div class="row">
                                                                            <span class="form-label text-center fs-4">Rs.</span><br>
                                                                            <span class="form-label mt- text-center fs-4"><?php echo number_format($available * $lkr,2); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6  d-none d-lg-block">
                                                                        <div class="row">
                                                                            <span class="form-label text-center fs-2">Rs.</span><br>
                                                                            <span class="form-label mt- text-center fs-2"><?php echo number_format($available * $lkr,2); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                <div class="col-lg-5 col-12 mt-4 mb-1">
                                                    <div class="row">

                                                        <div class="col-lg-5 col-12 bg-secondary text-white bg-opacity-25 rounded rounded-3 mx-auto my-lg-0 my-1" style="height: 470px; width: 340px;">
                                                            <div class="row">
                                                                
                                                                <span class="form-label mt-3 text-center fs-2 fw-bold">Pay Bill</span>

                                                                <div class="col-11 mx-auto mt-3">
                                                                    <select class="form-select" id="category" onchange="loadType();">
                                                                        <option value="0">Select Bill Category</option>
                                                                        <?php
                                                                        
                                                                        $bc_rs = Database::search("SELECT * FROM `b_category`");

                                                                        for($x = 0; $x < $bc_rs->num_rows; $x++){

                                                                            $bc_data = $bc_rs->fetch_assoc();

                                                                            ?>
                                                                            <option value="<?php echo $bc_data["id"]; ?>"><?php echo $bc_data["name"]; ?></option>
                                                                            <?php

                                                                        }
                                                                        
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-11 mx-auto mt-1">
                                                                    <select class="form-select" id="type">
                                                                        <option value="0">Select</option>
                                                                        <?php
                                                                        
                                                                        $bc_rs = Database::search("SELECT * FROM `b_type` WHERE `b_status2_id`='1'");

                                                                        for($x = 0; $x < $bc_rs->num_rows; $x++){

                                                                            $bc_data = $bc_rs->fetch_assoc();

                                                                            ?>
                                                                            <option value="<?php echo $bc_data["id"]; ?>"><?php echo $bc_data["type"]; ?></option>
                                                                            <?php

                                                                        }
                                                                        
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                

                                                                <div class="col-11 mx-auto mt-3">
                                                                    <input type="text" class="form-control" placeholder="Account Number..." id="number">
                                                                </div>
                                                                <div class="col-11 mx-auto mt-2">
                                                                    <input type="text" class="form-control" placeholder="Name..." id="name">
                                                                </div>
                                                                <div class="input-group mb-1 mt-3">
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" id="amount" onkeyup="convert('<?php echo $lkr; ?>');">
                                                                    <span class="input-group-text">.00</span>
                                                                </div>
                                                                <div class="col-6 mx-auto mb-1">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">$</span>
                                                                        <input type="number" class="form-control" id="usd" readonly>
                                                                    </div>
                                                                </div>

                                                                <span class="form-label text-center">Minimum Balance $1 (RS. <?php echo $lkr; ?>)</span>

                                                                <button class="btn btn-outline-success mx-auto rounded rounded-5 fw-bold fs-5 my-2" style="width: 170px;" onclick="payBill();">Pay</button>
                                                                
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-12 bg-secondary bg-opacity-25  overflow-auto offset-lg-1 mx-auto my-lg-3 my-1 mt-4 mt-lg-4" style="height: 400px;">
                                                    <div class="row">
                                                        
                                                        <table class="table">

                                                            <thead>
                                                                <tr class="border border-2 rounded rounded-5 border-light bg-gradient text-white" style="font-family: 'Quicksand';">
                                                                    <th class="text-center text-white">Name</th>
                                                                    <th class="text-center text-white">Ac No</th>
                                                                    <th class="text-center text-white">Amount</th>
                                                                    <th class="text-center text-white">DateTime</th>
                                                                    <th class="text-center text-white">Type</th>
                                                                    <th class="text-center text-white">Status</th>
                                                                    <th class="text-center text-white"></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                                <?php

                                                                $bill_rs = Database::search("SELECT * FROM `paybill` WHERE `user_email`='".$user["email"]."' ORDER BY `date` DESC");
                                                                $bill_num = $bill_rs->num_rows;

                                                                for($y = 0; $y < $bill_num; $y++){

                                                                    $bill_data = $bill_rs->fetch_assoc();

                                                                    $amount2 = $bill_data["payment"];

                                                                    $type2_rs = Database::search("SELECT * FROM `b_type` INNER JOIN `b_category` ON `b_type`.`b_category_id` = `b_category`.`id` WHERE `b_type`.`id`='".$bill_data["b_type_id"]."'");
                                                                    $type2_data = $type2_rs->fetch_assoc();

                                                                ?>

                                                                    <tr class="bg-secondary bg-opacity-25 text-white" >
                                                                        <td class="text-center pt-3 border-white"><?php echo $bill_data["name"]; ?></td>
                                                                        <td class=" text-center pt-3 border-white"><?php echo $bill_data["ac_no"]; ?></td>
                                                                        <td class=" text-center pt-3 border-white"  style="color: #83f35a"><?php echo $amount2; ?>$</td>
                                                                        <td class="text-center pt-3 border-white"><?php echo $bill_data["date"]; ?></td>
                                                                        <td class=" text-center pt-3 border-white"><?php echo $type2_data["name"] ."-". $type2_data["type"] ; ?></td>
                                                                        <?php
                                                                        
                                                                            if($bill_data["b_status_id"] == 1){
                                                                                ?>
                                                                                <td class=" text-center text-warning pt-3 border-white">Pending</td>                                                                                <?php
                                                                            }else if($bill_data["b_status_id"] == 2){
                                                                                ?>
                                                                                <td class=" text-center pt-3 border-white" style="color: #83f35a">Success</td>                                                                                <?php
                                                                            }else if($bill_data["b_status_id"] == 3){
                                                                                ?>
                                                                                <td class=" text-center text-danger pt-3 border-white">Failed</td>
                                                                                <?php
                                                                            }

                                                                            if($bill_data["b_status_id"] == 1){

                                                                                ?>
                                                                                <td class=" text-center text-danger pt-3 border-white" onclick="deletePayBill('<?php echo $bill_data['id'] ?>');"><i class="bi bi-trash-fill text-danger"></i></td>
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