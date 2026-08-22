<?php

require "connection.php";

if(isset($_GET["c"])){

    $cid = $_GET["c"];

    $bc_rs = Database::search("SELECT * FROM `b_type` WHERE `b_category_id`='".$cid."' And `b_status2_id`='1'");
    $bc_num = $bc_rs->num_rows;

    if($bc_num > 0){

        for($x = 0; $x < $bc_rs->num_rows; $x++){

            $bc_data = $bc_rs->fetch_assoc();

            ?>
            <option value="<?php echo $bc_data["id"]; ?>"><?php echo $bc_data["type"]; ?></option>
            <?php

        }

    }else{

        $bc_rs2 = Database::search("SELECT * FROM `b_type` WHERE `b_status2_id`='1'");

        for($x = 0; $x < $bc_rs2->num_rows; $x++){

            $bc_data2 = $bc_rs2->fetch_assoc();

            ?>
            <option value="<?php echo $bc_data2["id"]; ?>"><?php echo $bc_data2["type"]; ?></option>
            <?php

        }

    }

}

?>