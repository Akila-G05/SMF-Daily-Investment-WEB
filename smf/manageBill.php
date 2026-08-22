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
                                            <span class="form-label fs-2 fst-italic text-white my-3">Manage Bills <i class="bi bi-upc"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="accordion-item ">
                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed btn btn-primary border border-1 border-primary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Manage Bill
                                                    </button>
                                                    </h2>
                                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body border border-1 border-dark border-top-0">
                                                        
                                                            <div class="col-12 col-lg-12 overflow-auto mt-2 mb-2"  style="height: 300px;">
                                                                <table class="table">

                                                                    <thead>
                                                                        <tr class="border border-2 rounded rounded-5 border-light bg-gradient text-white" style="background-color:#221f3f; font-family: 'Quicksand';">
                                                                            <th class="text-center text-white">No</th>
                                                                            <th class="text-center text-white">Category</th>
                                                                            <th class="text-center text-white">Type</th>
                                                                            <th class="text-center text-white">Status</th>
                                                                            <th class="text-center text-white">Change Status</th>
                                                                            <th class="text-center text-white"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="result">
                                                                        

                                                                            <?php

                                                                            $type_rs = Database::search("SELECT * FROM `b_type`");

                                                                            for($t = 0; $t < $type_rs->num_rows; $t++){

                                                                                $type_data = $type_rs->fetch_assoc();

                                                                                $c_rs = Database::search("SELECT * FROM `b_category` WHERE `id`='".$type_data["b_category_id"]."'");
                                                                                $c_data = $c_rs->fetch_assoc();

                                                                                $type_data['id'];
                                                                                
                                                                            ?>

                                                                                <tr class="bg-secondary bg-opacity-25 text-dark" >
                                                                                    <td class="text-center pt-3 border-white"><?php echo $t + 1; ?></td>
                                                                                    <td class=" text-center pt-3 border-white"><?php echo $c_data["name"]; ?></td>
                                                                                    <td class="text-center pt-3 border-white"><?php echo $type_data["type"]; ?></td>
                                                                                    <?php 
                                                                                    if($type_data["b_status2_id"] == 1){
                                                                                        ?>
                                                                                        <td class="text-center pt-3 border-white text-success fw-bold">Active</td>
                                                                                        <?php
                                                                                    }else{
                                                                                        ?>
                                                                                        <td class="text-center pt-3 border-white text-danger fw-bold">Deactive</td>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                    <td class="text-center pt-3 border-white">
                                                                                        <select class="form-control-sm rounded rounded-5 bg-success text-white" onchange="chageBillTypeStatusProcess('<?php echo $type_data['id']; ?>')" id="bTStatus<?php echo $type_data['id']; ?>">
                                                                                            <option value="0">Select</option>
                                                                                            <?php

                                                                                            $b_status_rs = Database::search("SELECT * FROM `b_status2`");
                                                                                            $b_status_num = $b_status_rs->num_rows;

                                                                                                for($i = 0; $i < $b_status_num; $i++){

                                                                                                    $b_status_data = $b_status_rs->fetch_assoc();

                                                                                                    ?>
                                                                                                    <option value="<?php echo $b_status_data["id"]; ?>"><?php echo $b_status_data["name"]; ?></option>
                                                                                                    <?php

                                                                                                }

                                                                                            ?>

                                                                                        </select>  
                                                                                    </td>
                                                                                    <td class="text-center pt-3 border-white fs-4"><i class="bi bi-trash-fill text-danger" onclick="deleteBillType('<?php echo $type_data['id']; ?>');"></i></td>
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

                                    <?php
                                    
                                    $v_rs = Database::search("SELECT * FROM `convert`");          
                                    
                                    $vdata = $v_rs->fetch_assoc();
                                    $lkr = $vdata["lkr"];
                                    
                                    ?>

                                    <div class="col-lg-6 col-12 mx-auto">
                                        <div class="row">

                                            <div class="col-3 mt-4 mt-lg-3 text-center">
                                                <span class="form-label mt-4 text-start fs-2 text-dark fw-bold fst-italic">
                                                    <i class="bi bi-currency-dollar mb-2 fs-3" ></i> 1
                                                </span>
                                            </div>
                                            <div class="col-2 col-lg-4 text-center mt-lg-4 mt-4 text-dark">
                                                <span class="form-label mt-3 text-center fs-5">-<i class="bi bi-arrow-right"></i></span>
                                            </div>
                                            <div class="col-7 col-lg-5 text-end text-dark mt-lg-3 mt-4">
                                                <div class="input-group">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control fs-5" id="lkr" value="<?php echo $lkr ." "; ?>">
                                                    <button class="btn border border-1 border-secondary border-start-0 border-opacity-50 fs-5" onclick="changeUsdValue()"><i class="bi bi-pencil-square"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-12 mt-3 ">
                                        <div class="row">
                                            <div class="col-lg-8 col-8 mt-2 offset-lg-1 offset-0 ">
                                                <input type="text" class="form-control border-1 border-dark" placeholder="Enter Email..." id="text">
                                            </div>
                                            <div class="col-2 mt-2 d-grid">
                                                <button class="btn btn-outline-primary rounded rounded-5" onclick="">Search</button>
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
                                                        <th class="text-center text-white">AC No</th>
                                                        <th class="text-center text-white">Name</th>
                                                        <th class="text-center text-white">DateTime</th>
                                                        <th class="text-center text-white">Type</th>
                                                        <th class="text-center text-white">Amount</th>
                                                        <th class="text-center text-white">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="result">
                                                    

                                                        <?php

                                                            if(isset($_GET["page"])){
                                                                $pageno = $_GET["page"];
                                                            }else{
                                                                $pageno = 1;
                                                            }

                                                            $user_rs = Database::search("SELECT * FROM `paybill`");
                                                            $user_num = $user_rs->num_rows;

                                                            $results_per_page = 20;
                                                            $number_of_page = ceil($user_num/$results_per_page);

                                                            $page_results = ($pageno - 1) * $results_per_page;

                                                            $selected_rs = Database::search("SELECT * FROM `paybill` ORDER BY `date` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");
                                                            $selected_num = $selected_rs->num_rows;
                                                                                                    
                                                            for($x = 0; $x < $selected_num; $x++){

                                                                $selected_data = $selected_rs->fetch_assoc();

                                                                $type2_rs = Database::search("SELECT * FROM `b_type` INNER JOIN `b_category` ON `b_type`.`b_category_id` = `b_category`.`id` WHERE `b_type`.`id`='".$selected_data["b_type_id"]."'");
                                                                $type2_data = $type2_rs->fetch_assoc();

                                                        ?>

                                                            <tr class="bg-secondary bg-opacity-25 text-dark" >
                                                                <td class="text-center pt-3 border-white"><?php echo $x + 1; ?></td>
                                                                <td class=" text-center pt-3 border-white"><?php echo $selected_data["user_email"]; ?></td>
                                                                <td class="text-center pt-3 border-white"><?php echo $selected_data["ac_no"]; ?></td>
                                                                <td class="text-center pt-3 border-white"><?php echo $selected_data["name"]; ?></td>
                                                                <td class="text-center pt-3 border-white"><?php echo $selected_data["date"]; ?></td>
                                                                <td class="text-center pt-3 border-white"><?php echo $type2_data["name"] ."-". $type2_data["type"] ; ?></td>
                                                                <td class="text-center pt-3 border-white"><?php echo $selected_data["payment"]; ?></td>
                                                                <?php
                                                                
                                                                if($selected_data["b_status_id"] == 1){
                                                                    ?>
                                                                    <td class=" text-center pt-2 border-white">
                                                                        <select class="form-control-sm rounded rounded-5 bg-success text-white" onchange="chageBillStatusProcess('<?php echo $selected_data['id']; ?>')" id="bStatus<?php echo $selected_data['id']; ?>">

                                                                            <?php

                                                                            $bp_status_rs = Database::search("SELECT * FROM `b_status`");
                                                                            $bp_status_num = $bp_status_rs->num_rows;

                                                                            if($bp_status_num > 0){

                                                                                for($i = 0; $i < $bp_status_num; $i++){

                                                                                    $bp_status_data = $bp_status_rs->fetch_assoc();

                                                                                    ?>
                                                                                    <option value="<?php echo $bp_status_data["id"]; ?>"><?php echo $bp_status_data["name"]; ?></option>
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
                                                                    <?php
                                                                }else if($selected_data["b_status_id"] == 2){
                                                                    ?>
                                                                    <td class=" text-center pt-3 border-white" style="color: #006f00">Success</td>                                                                                <?php
                                                                }else if($selected_data["b_status_id"] == 3){
                                                                    ?>
                                                                    <td class=" text-center text-danger pt-3 border-white">Failed</td>
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