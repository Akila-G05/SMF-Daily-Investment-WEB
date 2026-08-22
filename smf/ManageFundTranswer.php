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
                                            <span class="form-label fs-2 fst-italic text-white my-3">Manage FundTransfer <i class="bi bi-share-fill"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-5">

                                        <div class="col-12 col-lg-12 overflow-auto mb-2"  style="height: 400px;">
                                            <table class="table">

                                                <thead>
                                                    <tr class="border border-2 rounded rounded-5 border-light bg-gradient text-white" style="background-color:#221f3f; font-family: 'Quicksand';">
                                                        <th class="text-center text-white">No</th>
                                                        <th class="text-center text-white">Email</th>
                                                        <th class="text-center text-white">Day</th>
                                                        <th class="text-center text-white">Transferd Email</th>
                                                        <th class="text-center text-white">Status</th>
                                                        <th class="text-center text-white">amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="result">
                                                    

                                                    <?php

                                                    if(isset($_GET["page"])){
                                                        $pageno = $_GET["page"];
                                                    }else{
                                                        $pageno = 1;
                                                    }

                                                    $ft_rs = Database::search("SELECT * FROM `fund_transfer` INNER JOIN `user` ON `fund_transfer`.`user_email` = `user`.`email`");
                                                    $ft_num = $ft_rs->num_rows;

                                                    $results_per_page = 30;
                                                    $number_of_page = ceil($ft_num/$results_per_page);

                                                    $page_results = ($pageno - 1) * $results_per_page;

                                                    $selected_rs = Database::search("SELECT * FROM `fund_transfer` INNER JOIN `user` ON `fund_transfer`.`user_email` = `user`.`email` ORDER BY `date` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");
                                                    $selected_num = $selected_rs->num_rows;

                                                    for($x = 0; $x < $selected_num; $x++){

                                                        $selected_data = $selected_rs->fetch_assoc();

                                                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$selected_data["to"]."'");
                                                        $user_data = $user_rs->fetch_assoc();

                                                    ?>

                                                        <tr class="bg-secondary bg-opacity-25 text-dark" >
                                                            <td class="text-center pt-3 border-white"><?php echo $x + 1; ?></td>
                                                            <td class=" text-center pt-1 border-white">
                                                                <?php echo $selected_data["email"]; ?>
                                                                </br>
                                                                <?php echo $selected_data["mobile"]; ?>
                                                            </td>
                                                            <td class="text-center pt-3 border-white"><?php echo $selected_data["date"]; ?></td>
                                                            <td class=" text-center pt-1 border-white">
                                                                <?php echo $selected_data["to"]; ?>
                                                                </br>
                                                                <?php echo $user_data["mobile"]; ?>
                                                            </td>
                                                            <td class=" text-center pt-3 border-white"><?php echo $selected_data["amount"]; ?>$</td>
                                                            <td class="text-center pt-2 border-white">
                                                                <?php

                                                                if($selected_data["ft_status_id"] == 1){
                                                                    ?>
                                                                    <select class="form-control-sm rounded rounded-5 bg-secondary text-white mt-1" onchange="confirmFtStatus('<?php echo $selected_data['id']; ?>');" id="status">       
                                                                        
                                                                        <?php
                                                                        
                                                                        $ft_rs = Database::search("SELECT * FROM `ft_status`");
                                                                        $ft_num = $ft_rs->num_rows;

                                                                        for($y = 0; $y < $ft_num; $y++){

                                                                            $ft_data = $ft_rs->fetch_assoc();
                                                                            
                                                                            ?>
                                                                            
                                                                            <option value="<?php echo $ft_data["id"]; ?>"><?php echo $ft_data["ft_name"]; ?></option>
                                                                            
                                                                            <?php

                                                                        }

                                                                        ?>                                               

                                                                    </select>
                                                                    <?php
                                                                }else if($selected_data["ft_status_id"] == 2){
                                                                    ?>
                                                                    <button class="btn btn-sm rounded rounded-5 form-label text-success fw-bold mt-2" >Confirmed</button>
                                                                    <?php
                                                                }else if($selected_data["ft_status_id"] == 3){
                                                                    ?>
                                                                    <button class="btn btn-sm rounded rounded-5 form-label text-danger fw-bold mt-2" >Failed</button>
                                                                    <?php
                                                                }

                                                                ?>
                                                            </td>
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