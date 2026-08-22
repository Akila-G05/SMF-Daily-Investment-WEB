<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $p_total = 0;
    $i_total = 0;
    $w_total = 0;

?>


<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SMF AdminPannel</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>

    <body style="font-family: Quicksand;" >

        <div class="container-fluid">
            <div class="row">

                <?php include "Adminslidebar.php"; ?>

                <div class="col-11 offset-1 mt-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                            <div class="col-11 mx-4">
                                <div class="row">

                                    <div class="col-12 mb-4 text-center"  style="background-color:#11101d;">
                                        <div class="row">
                                            <span class="form-label fs-2 fst-italic text-white my-3">Admin Pannel <i class="bi bi-speedometer2"></i></span>
                                        </div>
                                    </div>

                                    <?php 
                                    
                                    $uhp_rs2 = Database::search("SELECT * FROM `user_has_packages` INNER JOIN `packages` ON `user_has_packages`.`packages_id` = `packages`.`id` WHERE `p_status_id`='2' OR `p_status_id`='4'");
                                    $uhp_num2 = $uhp_rs2->num_rows;

                                    for($c = 0; $c < $uhp_num2; $c++){

                                        $uhp_data2 = $uhp_rs2->fetch_assoc();

                                        $p_total = (int)$p_total + (int)$uhp_data2["r_fee"];
                                        $i_total = (int)$i_total + (int)$uhp_data2["price"];

                                    }

                                    $user_rs = Database::search("SELECT * FROM `user`");
                                    $user_num = $user_rs->num_rows;

                                    $withdraw_rs = Database::search("SELECT * FROM `withdraw` WHERE `w_status_id`='1'");
                                    $withdraw_num = $withdraw_rs->num_rows;

                                    for($x = 0; $x < $withdraw_num; $x++){

                                        $withdraw_data = $withdraw_rs->fetch_assoc();

                                        $w_total = (int)$w_total + (int)$withdraw_data["amount"];

                                    }
                                    
                                    ?>

                                    <div class="col-12 my-4" style="font-family: Quicksand;">
                                        <div class="row">

                                            <div class="col-lg-6 col-11 rounded rounded-3 mx-lg-auto mx-3" style="background-color:#221f3f; ">
                                                <div class="row">
                                                    <div class="col-6 mx-3">
                                                        <div class="row">
                                                            <span class="text-white form-label fs-5 mt-2">Total Profit</span>
                                                            <span class="text-white form-label fs-4"><?php echo $p_total; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-4 text-end mt-2">
                                                        <span class="text-white form-label fst-italic" style="font-size: 50px;">$</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-11 rounded-3 mx-lg-auto mx-3 mt-3 mt-lg-0" style="background-color:#221f3f;">
                                                <div class="row">
                                                    <div class="col-6 mx-3">
                                                        <div class="row">
                                                            <span class="text-white form-label fs-5 mt-2">Total Investments</span>
                                                            <span class="text-white form-label fs-4"><?php echo $i_total; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-4 text-end mt-2">
                                                        <span class="text-white form-label fst-italic" style="font-size: 50px;">$</span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-4 rounded rounded-3 mx-1 mx-lg-auto  mt-3" style="background-color:#221f3f; width: 320px;">
                                                <div class="row">
                                                    <div class="col-7 mx-3">
                                                        <div class="row">
                                                            <span class="text-white form-label fs-5 mt-2">Packages</span>
                                                            <span class="text-white form-label fs-4"><?php echo $uhp_num2; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 text-end mt-2">
                                                        <span class="text-white form-label fst-italic" style="font-size: 50px;"><i class="bi bi-cart"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 rounded rounded-3 mx-lg-auto mx-1 mt-3" style="background-color:#221f3f; width: 320px;">
                                                <div class="row">
                                                    <div class="col-7 mx-3">
                                                        <div class="row">
                                                            <span class="text-white form-label fs-5 mt-2">User Count</span>
                                                            <span class="text-white form-label fs-4"><?php echo $user_num; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 text-end mt-2">
                                                        <span class="text-white form-label fst-italic" style="font-size: 50px;"><i class="bi bi-person"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 rounded rounded-3 mx-lg-auto mx-1 mt-3" style="background-color:#221f3f; width: 320px;">
                                                <div class="row">
                                                    <div class="col-7 mx-3">
                                                        <div class="row">
                                                            <span class="text-white form-label fs-5 mt-2">Withdrawals</span>
                                                            <span class="text-white form-label fs-4"><?php echo $w_total; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 text-end mt-2">
                                                        <span class="text-white form-label fst-italic" style="font-size: 50px;">$</span>
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
                
                <div class="col-12 mt-3 d-lg-block d-none" style="background-color: #11101d;">
                    <div class="row">
                        <div class="col-4 text-center my-2">
                            <span class="form-label fs-5 text-white">Total Active Time</span>
                        </div>

                        <?php

                        $start_date = new DateTime("2023-07-01 00:00:00");

                        $tdate = new DateTime();
                        $tz = new DateTimeZone("Asia/Colombo");
                        $tdate->setTimezone($tz);

                        $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                        $difference = $end_date->diff($start_date);

                        ?>

                        <div class="col-8 text-end mt-1 ">
                            <span class="form-label text-warning fs-4">
                            <?php
                            echo $difference->format('%Y') . "Y - " . $difference->format('%m') . "M - " .
                                $difference->format('%d') . "D | " . $difference->format('%H') . "H : " .
                                $difference->format('%i') . "M : " . $difference->format('%s') . "S ";
                            ?>
                            </span>
                            <span class="form-label fs-4" style="color: #11101d;">maaS</span>
                        </div>
                    </div>
                </div>

                <div class="col-11 offset-lg-1 offset-1 mt-4 text-center">
                    <div class="row">
                        <span class="form-label fs-2 fst-italic text-primary my-3">Packages Activation Requests</span>
                    </div>
                </div>

                <div class="col-12 col-lg-11 offset-lg-1 offset-0 mb-5 overflow-auto" style="height: 400px;">
                    <div class="row">

                        <div class="col-11 col-lg-12 mb-lg-2"  >
                            <table class="table">

                                <thead>
                                    <tr class="border border-2 rounded rounded-5 border-light text-white" style="background-color:#221f3f; font-family: 'Quicksand';">
                                        <th class="text-center text-white">No</th>
                                        <th class="text-center text-white">Email</th>
                                        <th class="text-center text-white">Time</th>
                                        <th class="text-center text-white">Binance Id</th>
                                        <th class="text-center text-white">Amount</th>
                                        <th class="text-center text-white">Status</th>
                                        <th class="text-center text-white">Add Funds</th>
                                        <th class="text-center text-white"></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                
                                    $uhp_rs = Database::search("SELECT * FROM `user_has_packages`");
                                    $uhp_num = $uhp_rs->num_rows;

                                    for($x = 0; $x < $uhp_num; $x++){

                                        $uhp_data = $uhp_rs->fetch_assoc();

                                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$uhp_data["user_email"]."'");
                                        $user_data = $user_rs->fetch_assoc();

                                        $pkg_rs = Database::search("SELECT * FROM `packages` WHERE `id`='".$uhp_data["packages_id"]."'");
                                        $pkg_data = $pkg_rs->fetch_assoc();

                                    ?>

                                        <tr class="bg-secondary bg-opacity-25 text-dark" >
                                            <td class="text-center pt-3 border-white"><?php echo $x + 1; ?></td>
                                            <td class=" text-center pt-3 border-white"><?php echo $user_data["email"]; ?></td>
                                            <td class="text-center pt-3 border-white"><?php echo $uhp_data["date"]; ?></td>
                                            <td class=" text-center pt-3 border-white"><?php echo $user_data["b_id"]; ?></td>
                                            <td class=" text-center pt-3 border-white"><?php echo $pkg_data["selling_price"]; ?>$</td>
                                            <td class=" text-center mt-1 border-white">
                                                <?php

                                                if($uhp_data["p_status_id"] == 1){
                                                    ?>
                                                    <select class="form-control-sm rounded rounded-5 bg-secondary text-white" onchange="confirmPStatus('<?php echo $uhp_data['id']; ?>');" id="status<?php echo $uhp_data['id']; ?>">       
                                                        
                                                        <?php
                                                        
                                                        $ps_rs = Database::search("SELECT * FROM `p_status`");
                                                        $ps_num = $ps_rs->num_rows;

                                                        for($y = 0; $y < $ps_num; $y++){

                                                            $ps_data = $ps_rs->fetch_assoc();
                                                            
                                                            ?>
                                                            
                                                            <option value="<?php echo $ps_data["id"]; ?>"><?php echo $ps_data["p_name"]; ?></option>
                                                            <?php

                                                        }
                                                
                                                        ?>                                               
                                            
                                                    </select>
                                                    <?php
                                                }else if($uhp_data["p_status_id"] == 2){
                                                    ?>
                                                    <button class="btn btn-sm rounded rounded-5 form-label text-success fw-bold" >Confirmed</button>
                                                    <?php
                                                }else if($uhp_data["p_status_id"] == 3){
                                                    ?>
                                                    <button class="btn btn-sm rounded rounded-5 form-label text-danger fw-bold" >Failed</button>
                                                    <?php
                                                }else if($uhp_data["p_status_id"] == 4){
                                                    ?>
                                                    <button class="btn btn-sm rounded rounded-5 form-label text-danger fw-bold" >Expired</button>
                                                    <?php
                                                }

                                                ?>
                                            </td>

                                            
                                            <td class="text-center pt-3 border-white">
                                                <?php
                                                
                                                if($uhp_data["p_status_id"] == 2){
                                                    ?>
                                                    <input type="text" class="text-center" style="width: 70px;" value="<?php echo $uhp_data["earning"]; ?>" id="balance<?php echo $uhp_data['id']; ?>">
                                                    <button class="btn btn-sm btn-secondary" onclick="changePkgBalance('<?php echo $uhp_data['id']; ?>');">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button> 
                                                    <?php
                                                }
                                                
                                                ?>
                                            </td>
                                            <td class="text-center pt-3 border-white">
                                                <a download="<?php echo $uhp_data["path"]; ?>" href="<?php echo $uhp_data["path"]; ?>" class="">   
                                                    <i class="bi bi-file-earmark-arrow-down-fill fs-5 text-success"></i>
                                                </a>
                                            </td>
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
        
        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </body>

</html>

<?php
}else{
    echo("You are not a Valid User");
    ?>
    <script>
        window.location = "adminSignin.php";
    </script>
    <?php
}

?>