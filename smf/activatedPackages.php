<?php

require "connection.php";
session_start();
$user = $_SESSION["u"];

if(!empty($user)){

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DMF ActivatedPackages</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>
    <body style="background-color:#221f3f;">

        <div class="container-fluid" >
            <div class="row">

                <?php include "slidebar.php"; ?>

                <div class="col-lg-11 col-10 mx-5 mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-11 offset-1">
                                    <div class="row">

                                        <div class="col-lg-6 col-12 offset-lg-3">
                                            <div class="row">
                                                <div class="col-6 input-group mb-3">   
                                                    <input class="form-control rounded rounded-5 rounded-end bg-transparent text-white" placeholder="Search.." type="text">
                                                    <button class="btn btn-primary rounded rounded-5 rounded-start border border-1"><i class="bi bi-search"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <?php 
                                        
                                        $uhp_rs = Database::search("SELECT * FROM `user_has_packages` WHERE `user_email`='".$_SESSION["u"]["email"]."'");
                                        $uhp_num = $uhp_rs->num_rows;

                                        if($uhp_num > 0){
                                        ?>

                                        <div class="col-12">
                                            <div class="row">

                                                <?php
                                                
                                                for($x = 0; $x < $uhp_num; $x++){

                                                    $uhp_data = $uhp_rs->fetch_assoc();

                                                    $pkg_rs = Database::search("SELECT * FROM `packages` WHERE `id`='".$uhp_data["packages_id"]."'");
                                                    $pkg_data = $pkg_rs->fetch_assoc();

                                                    $price = $pkg_data["price"];
                                                    $daily = $price * 1/100;

                                                
                                                
                                                ?>

                                                <div class="col-3 border border-2 border-info mx-auto  rounded rounded-3" style="height: 24rem; width:16rem;">
                                                    <div class="row">

                                                        <span class="form-label fs-4 text-white fst-italic fw-bold text-center mt-2"><?php echo $pkg_data["pkg_name"]; ?></span>
                                                        <span class="form-label fs-2 text-danger fw-bold text-center">$<span class="form-label fw-normal"><?php echo $pkg_data["price"]; ?>.00</span></span>

                                                        <span class="text-white mt-3" style="font-size: 14px;"><i class="bi bi-check-lg fs-6 text-success"></i> Up to 200 Days</span>
                                                        <span class="text-white" style="font-size: 14px;"><i class="bi bi-check-lg fs-6 text-success"></i> Registeration fee $<?php echo $pkg_data["r_fee"]; ?></span>
                                                        <span class="text-white" style="font-size: 14px;"><i class="bi bi-check-lg fs-6 text-success"></i> <?php echo $daily; ?> USDT Per Day</span>

                                                        <span class="text-white mt-3" style="font-size: 11px;">Total cost of this package is $<?php echo $pkg_data["selling_price"]; ?> and you can earn maximum $<?php echo $pkg_data["price"]* 2; ?> from this and this package expires in 180 days. You can reactivate this package after it expires. You can activate multiple packages at once.</span>
                                                        
                                                        <?php
                                                        
                                                        if($uhp_data["p_status_id"] == 1){
                                                            ?>
                                                            <span class="text-center mt-4 fw-bold" style="color: #ff8040">Pending</span>
                                                            <?php
                                                        }else if($uhp_data["p_status_id"] == 2){
                                                            ?>
                                                            <span class="text-center mt-4 fw-bold" style="color: #83f35a">Activated</span>
                                                            <?php
                                                        }else if($uhp_data["p_status_id"] == 3){
                                                            ?>
                                                            <span class="text-center mt-4 fw-bold" style="color: #ff0000">Failed</span>
                                                            <?php
                                                        }else if($uhp_data["p_status_id"] == 4){
                                                            ?>
                                                            <span class="text-center mt-4 fw-bold" style="color: #ffff00">Expired</span>
                                                            <?php
                                                        }

                                                        ?>
                                                        
                                                    </div>
                                                </div>
                                                <?php
                                        
                                                }
                                                
                                                ?>

                                            </div>
                                        </div>  
                                        
                                        <?php

                                        }else{
                                            
                                        ?>

                                        <!-- empty view -->
                                        <div class="col-12 mt-5">
                                            <div class="row">
                                                <div class="col-12 text-center mb-2">
                                                    <label class="form-label text-white fs-1 fw-bold">
                                                        You don't have Activated any Packages yet.....
                                                    </label>
                                                    <br>
                                                    <a href="packages.php">Click Here....</a>
                                                </div>
                                            </div>
                                        </div>  
                                        <!-- empty view -->
                                            
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