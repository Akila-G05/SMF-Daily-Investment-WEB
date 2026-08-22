<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $auser = $_SESSION["au"];

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMF Packages</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>

    <body  style="font-family: Quicksand;">

        <div class="container-fluid">
            <div class="row">

                <?php include "Adminslidebar.php"; ?>

                <div class="col-11 offset-1 mt-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                            <div class="col-11 mx-4">
                                <div class="row">

                                    <div class="col-12 text-center"  style="background-color:#11101d;">
                                        <div class="row">
                                            <span class="form-label fs-2 fst-italic text-white my-3">Manage Packages <i class="bi bi-collection"></i></span>
                                        </div>
                                    </div>


                                    <div class="col-12 mt-4">
                                        <div class="row">

                                        <?php
                                        
                                        $pkg_rs = Database::search("SELECT * FROM `packages`");
                                        $pkg_num = $pkg_rs->num_rows;

                                        for($x = 0; $x < $pkg_num; $x++){

                                            $pkg_data = $pkg_rs->fetch_assoc();

                                            $price = $pkg_data["price"];
                                            $daily = $price * 1/100;

                                        ?>

                                            <div class="col-3 mt-2 mb-2 border border-1 border-warning mx-auto rounded rounded-3" style="background-color:#221f3f; height: 24rem; width:16rem;">
                                                <div class="row">

                                                    <span class="form-label fs-4 text-white fst-italic fw-bold text-center mt-2"><?php echo $pkg_data["pkg_name"]; ?></span>
                                                    <span class="form-label fs-2 text-danger fw-bold text-center">$<span class="form-label fw-normal"><?php echo $pkg_data["price"]; ?>.00</span></span>

                                                    <span class="text-white mt-3" style="font-size: 14px;"><i class="bi bi-check-lg fs-6 text-success"></i> Up to 200 Days</span>
                                                    <span class="text-white" style="font-size: 14px;"><i class="bi bi-check-lg fs-6 text-success"></i> Registeration fee $<?php echo $pkg_data["r_fee"]; ?></span>
                                                    <span class="text-white" style="font-size: 14px;"><i class="bi bi-check-lg fs-6 text-success"></i> <?php echo $daily; ?> USDT Per Day</span>

                                                    <span class="text-white mt-3" style="font-size: 11px;">Total cost of this package is $<?php echo $pkg_data["selling_price"]; ?> and you can earn maximum $<?php echo $pkg_data["price"]* 2; ?> from this and this package expires in 180 days. You can reactivate this package after it expires. You can activate multiple packages at once.</span>
                                                    
                                                    <button class="btn btn-outline-light rounded rounded-5 mt-3 text-center" style="width: 100px; margin-left:75px;" onclick="deletePkgModal('<?php echo $pkg_data['id']; ?>');">Delete</button>      
                                                    
                                                </div>
                                            </div>

                                            <!-- modal -->
                                            <div class="modal" tabindex="-1" id="deletePkgModal<?php echo $pkg_data["id"]; ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <div class="modal-title mt-3">
                                                            <span class="form-label fs-5 text-danger fw-bold"><i class="bi bi-exclamation-circle-fill text-danger"></i> Attention</span>
                                                        </div>

                                                        <div class="modal-body">    
                                                            <div class="row g-3">   
                                                                <span class="text-black fw-bold fs-6">Are You sure want to delete this Package?</span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger rounded rounded-5" onclick="deletePkg('<?php echo $pkg_data['id']; ?>')">Yes</button>
                                                            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary rounded rounded-5">Cancel</button>                                               
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal -->

                                        <?php

                                        }
                                        
                                        ?>

                                            
                                            <div class="col-3 mt-2 border border-2 border-primary mx-auto rounded rounded-3" style="background-color:#221f3f; height: 24rem; width:16rem;" onclick="openAddPkgModel('<?php echo $pkg_data['id']; ?>');">
                                                <div class="row">

                                                    <span class="form-label fs-2 text-white fst-italic fw-bold text-center mt-4">Add New Package</span>
                                                    <span class="form-label text-white fst-italic fw-bold text-center mt-4" style="font-size: 60px;"><i class="bi bi-plus-lg"></i></span>
                                                    
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal" tabindex="-1" id="addPkgModal<?php echo $pkg_data["id"]; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Add new Package</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <span class="form-label">Package Name</span>
                                                        <input class="form-control" type="text" id="pname">

                                                        <span class="form-label mt-2">Price</span>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">$</span>
                                                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" id="price">
                                                            <span class="input-group-text">.00</span>
                                                        </div>

                                                        <span class="form-label">Registeration Fee</span>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">$</span>
                                                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" id="fee">
                                                            <span class="input-group-text">.00</span>
                                                        </div>

                                                        <br>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" onclick="addNewPkg();">Add</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->

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
        <script src="bootstrap.bundle.js"></script>
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