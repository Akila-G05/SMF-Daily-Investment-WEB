<?php

require "connection.php";

$txt = $_POST["txt"];

$query = "SELECT * FROM `user`";

if(!empty($txt)){
    $query .= " WHERE `email` LIKE '%" . $txt . "%' OR `b_id` LIKE '%" . $txt . "%'";
}

?>

<div class="align-items-start">

    <?php
    
    if ("0" != ($_POST["page"])) {
        $pageno = $_POST["page"];
    } else {
        $pageno = 1;
    }

    $user_rs = Database::search($query);
    $user_num = $user_rs->num_rows;

    $results_per_page = 10;
    $number_of_page = ceil($user_num/$results_per_page);

    $page_results = ($pageno - 1) * $results_per_page;

    $selected_rs = Database::search($query . " ORDER BY `r_date` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");
    $selected_num = $selected_rs->num_rows;

    for($x = 0; $x < $selected_num; $x++){
        $selected_data = $selected_rs->fetch_assoc();

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
        </tr>

    <?php

    }
    
    ?>

    </div>