<?php 

require "connection.php";
session_start();
$user = $_SESSION["u"];
 
?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMF Packages</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>
    <body style="background-color:#221f3f;">

        <div class="container-fluid" >
            <div class="row">

                <?php include "slidebar.php"; ?>

                <div class="col-10 col-lg-11 mx-5 mx-lg-5 mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-11 offset-1">
                                    <div class="row">

                                        <div class="col-lg-6 col-12 offset-lg-3  mt-2">
                                            <div class="row">
                                                <div class="col-6 input-group mb-3">   
                                                    <input class="form-control rounded rounded-5 rounded-end bg-transparent text-white" placeholder="Search.." type="text">
                                                    <button class="btn btn-primary rounded rounded-5 rounded-start border border-1"><i class="bi bi-search"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">

                                                <?php
                                                
                                                $pkg_rs = Database::search("SELECT * FROM `packages` ORDER BY `price` ASC");
                                                $pkg_num = $pkg_rs->num_rows;

                                                for($x = 0; $x < $pkg_num; $x++){

                                                    $pkg_data = $pkg_rs->fetch_assoc();

                                                    $price = $pkg_data["price"];
                                                    $daily = $price * 1/100;

                                                ?>

                                                    <div class="col-3 mt-2 mb-2 border border-1 border-warning mx-auto rounded rounded-3" style="height: 24rem; width:16rem;">
                                                        <div class="row">

                                                            <span class="form-label fs-4 text-white fst-italic fw-bold text-center mt-2"><?php echo $pkg_data["pkg_name"]; ?></span>
                                                            <span class="form-label fs-2 text-danger fw-bold text-center">$<span class="form-label fw-normal"><?php echo $pkg_data["price"]; ?>.00</span></span>

                                                            <span class="text-white mt-3" style="font-size: 14px;"><i class="bi bi-check-lg fs-6 text-success"></i> Up to 200 Days</span>
                                                            <span class="text-white" style="font-size: 14px;"><i class="bi bi-check-lg fs-6 text-success"></i> Registeration fee $<?php echo $pkg_data["r_fee"]; ?></span>
                                                            <span class="text-white" style="font-size: 14px;"><i class="bi bi-check-lg fs-6 text-success"></i> <?php echo $daily; ?> USDT Per Day</span>

                                                            <span class="text-white mt-3" style="font-size: 11px;">Total cost of this package is $<?php echo $pkg_data["selling_price"]; ?> and you can earn maximum $<?php echo $pkg_data["price"]* 2; ?> from this and this package expires in 180 days. You can reactivate this package after it expires. You can activate multiple packages at once.</span>
                                                            
                                                            <button class="btn btn-outline-light rounded rounded-5 mt-3 text-center" style="width: 100px; margin-left:75px;" onclick="pkgModal('<?php echo $pkg_data['id']; ?>');">Activate</button>   
                                                            
                                                        </div>
                                                    </div>

                                                    <!-- Modal -->
                                                        <div class="modal" tabindex="-1" id="pkgModal<?php echo $pkg_data["id"]; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Activate Product</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <span class="form-label">Package Name</span>
                                                                    <input class="form-control" type="text" value="<?php echo $pkg_data["pkg_name"]; ?>" readonly>

                                                                    <span class="form-label mt-2">Total</span>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text">$</span>
                                                                        <input type="text" class="form-control" value="<?php echo $pkg_data["selling_price"]; ?>" readonly aria-label="Amount (to the nearest dollar)">
                                                                        <span class="input-group-text">.00</span>
                                                                    </div>

                                                                    <span class="form-label">Payment Type</span>
                                                                    <select class="form-select" id="ptype<?php echo $pkg_data["id"]; ?>">
                                                                        <option value="0">Select</option>

                                                                        <?php
                                                                        
                                                                        $pt_rs = Database::search("SELECT * FROM `p_type`");
                                                                        $pt_num = $pt_rs->num_rows;

                                                                        for($y = 0; $y < $pt_num; $y++){

                                                                            $pt_data = $pt_rs->fetch_assoc();

                                                                            ?>
                                                                            <option value="<?php echo $pt_data["id"]; ?>"><?php echo $pt_data["type"]; ?></option>
                                                                            <?php

                                                                        }

                                                                        ?>

                                                                    </select>

                                                                    <br>

                                                                    <span class="form-label">Upload Screenshot OR Recipt</span>
                                                                    <div class="col-12 text-center my-3">

                                                                        <i class="bi bi-file-earmark-arrow-up border border-2" style="font-size: 80px;"></i><br>
                                                                        <input type="file" class="d-none" id="uploadimg" accept="img/*"/>
                                                                        <label for="uploadimg" class="btn btn-primary mt-3" onclick="uploadImage();">Upload Here</label>

                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-success" onclick="payNow('<?php echo $pkg_data['id']; ?>');">Confirm</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- Modal -->

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

            </div>
        </div>
        
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

</html>