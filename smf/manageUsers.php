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
        <title>SMF AdminPannel</title>
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
                                            <span class="form-label fs-2 fst-italic text-white my-3">Manage Users <i class="bi bi-person-badge"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-5 mb-4">
                                        <div class="row">
                                            <div class="col-lg-8 col-8 mt-2 offset-lg-1 offset-0 ">
                                                <input type="text" class="form-control border-1 border-dark" placeholder="Enter Email..." id="text">
                                            </div>
                                            <div class="col-2 mt-2 d-grid">
                                                <button class="btn btn-outline-primary rounded rounded-5" onclick="findusers(0)">Search</button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">

                                        <div class="col-12 col-lg-12 overflow-auto mt-5 mb-2"  style="height: 400px;">
                                            <table class="table">

                                                <thead>
                                                    <tr class="border border-2 rounded rounded-5 border-light bg-gradient text-white" style="background-color:#221f3f; font-family: 'Quicksand';">
                                                        <th class="text-center text-white">No</th>
                                                        <th class="text-center text-white">Email</th>
                                                        <th class="text-center text-white">BinanceId</th>
                                                        <th class="text-center text-white">Day</th>
                                                        <th class="text-center text-white">Wallet Balance</th>
                                                        <th class="text-center text-white">Packages</th>
                                                        <th class="text-center text-white">Status</th>
                                                        <th class="text-center text-white"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="result">
                                                    

                                                        <?php

                                                            if(isset($_GET["page"])){
                                                                $pageno = $_GET["page"];
                                                            }else{
                                                                $pageno = 1;
                                                            }

                                                            $user_rs = Database::search("SELECT * FROM `user`");
                                                            $user_num = $user_rs->num_rows;

                                                            $results_per_page = 20;
                                                            $number_of_page = ceil($user_num/$results_per_page);

                                                            $page_results = ($pageno - 1) * $results_per_page;

                                                            $selected_rs = Database::search("SELECT * FROM `user` ORDER BY `r_date` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");
                                                            $selected_num = $selected_rs->num_rows;
                                                                                                    
                                                            for($x = 0; $x < $selected_num; $x++){

                                                                $selected_data = $selected_rs->fetch_assoc();

                                                                $wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$selected_data["email"]."'");
                                                                $wallet_data = $wallet_rs->fetch_assoc();

                                                        ?>

                                                            <tr class="bg-secondary bg-opacity-25 text-dark" >
                                                                <td class="text-center pt-3 border-white"><?php echo $x + 1; ?></td>
                                                                <td class=" text-center pt-1 border-white">
                                                                    <?php echo $selected_data["email"]; ?>
                                                                    </br>
                                                                    <?php echo $selected_data["mobile"]; ?>
                                                                </td>
                                                                <td class="text-center pt-3 border-white"><?php echo $selected_data["b_id"]; ?></td>
                                                                <td class="text-center pt-3 border-white"><?php echo $selected_data["r_date"]; ?></td>
                                                                <td class="text-center pt-3 border-white">
                                                                    <input type="text" class="text-center" style="width: 70px;" value="<?php echo $wallet_data["amount"]; ?>" id="balance<?php echo $selected_data['email']; ?>">
                                                                    <button class="btn btn-sm btn-secondary" onclick="changeWalletBalance('<?php echo $selected_data['email']; ?>');">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                    </button>    
                                                                </td>
                                                                <td class=" text-center pt-2 border-white">
                                                                    <select class="form-control-sm rounded rounded-5 bg-success text-white" name="" id="">

                                                                        <?php

                                                                        $uhp_rs = Database::search("SELECT * FROM `user_has_packages` INNER JOIN `packages` ON `user_has_packages`.`packages_id` = `packages`.`id` WHERE `user_email`='".$selected_data["email"]."'");
                                                                        $uhp_num = $uhp_rs->num_rows;

                                                                        if($uhp_num > 0){

                                                                            for($i = 0; $i < $uhp_num; $i++){

                                                                                $uhp_data = $uhp_rs->fetch_assoc();

                                                                                ?>
                                                                                <option value="0"><?php echo $uhp_data["pkg_name"]; ?></option>
                                                                                <?php

                                                                            }

                                                                        }else{
                                                                            ?>
                                                                            <option value="0" readonly>Empty</option>
                                                                            <?php
                                                                        }



                                                                        ?>

                                                                    </select>    
                                                                </td>
                                                                <td class="text-center pt-2 border-white">
                                                                    <select class="form-control-sm rounded rounded-5 bg-secondary text-white" onchange="changeUserStatus('<?php echo $selected_data['email']; ?>');" id="status">
                                                                        <?php
                                                                        
                                                                        if($selected_data["u_status_id"] == 1){
                                                                            ?>
                                                                            <option value="1">Active</option>
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <option value="2">Deavtive</option>
                                                                            <?php
                                                                        }
                                                                        
                                                                        ?>
                                                                        
                                                                        <?php 
                                                                        
                                                                        $u_status_rs = Database::search("SELECT * FROM `u_status`");
                                                                        $u_status_num = $u_status_rs->num_rows;

                                                                        for($a = 0; $a < $u_status_num; $a++){

                                                                            $u_status_data = $u_status_rs->fetch_assoc();

                                                                            ?>
                                                                            <option value="<?php echo $u_status_data["id"]; ?>"><?php echo $u_status_data["name"]; ?></option>
                                                                            <?php

                                                                        }
                                                                        
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td class="text-center pt-2 border-white">
                                                                    <button class="btn btn-danger text-white rounded rounded-5" onclick="deleteUserModal('<?php echo $selected_data['email']; ?>');"><i class="bi bi-trash3"></i></button>
                                                                </td>
                                                            </tr>

                                                            <!-- modal -->
                                                            <div class="modal" tabindex="-1" id="deleteUserModal<?php echo $selected_data['email']; ?>">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">

                                                                        <div class="modal-title mt-3">
                                                                            <span class="form-label fs-5 text-danger fw-bold"><i class="bi bi-exclamation-circle-fill text-danger"></i> Attention</span>
                                                                        </div>

                                                                        <div class="modal-body">    
                                                                            <div class="row g-3">   
                                                                                <span class="text-black fw-bold fs-6">If you delete a user, all the data related to that user will be deleted.</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger rounded rounded-5" onclick="deleteUser('<?php echo $selected_data['email']; ?>')">Yes</button>
                                                                            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary rounded rounded-5">Cancel</button>                                               
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- modal -->

                                                        <?php

                                                        }
                                                        
                                                        ?>
                                                    
                                                </tbody>

                                            </table>
                                        </div>

                                        <!-- pagination -->
                                        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination pagination-sm justify-content-center">
                                                    <li class="page-item">

                                                        <a class="page-link" href="<?php if($pageno <= 1){
                                                                                            echo("#");
                                                                                        }else{
                                                                                            echo("?page=" . ($pageno - 1));
                                                                                        }  
                                                                                        ?>" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>

                                                        <?php
                                                        
                                                        for ($x = 1; $x <= $number_of_page; $x++) {
                                                            if ($x == $pageno) {
            
                                                        ?>
                                                                <li class="page-item active">
                                                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                                </li>
                                                            <?php
            
                                                            } else {
                                                            ?>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                                </li>
                                                        <?php
                                                            }
                                                        }
            
                                                        ?>


                                                        <a class="page-link" href="<?php if($pageno >= $number_of_page){
                                                                                            echo("#");
                                                                                        }else{
                                                                                            echo("?page=" . ($pageno + 1));
                                                                                        }  
                                                                                        ?>" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <!-- pagination -->

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