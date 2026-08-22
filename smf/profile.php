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
        <title>SMF Profile</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>
    <body style="background-color:#221f3f; font-family: Quicksand;">

        <div class="container-fluid" >
            <div class="row">

                <?php include "slidebar.php"; ?>

                <div class="col-11 mx-5 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-11 offset-lg-1 offset-0">
                                    <div class="row">
                                        <!-- <div class="col-12">
                                            <div class="row"> -->

                                                <div class="col-md-5 border-end">
                                                    
                                                    <div class="row ">

                                                        <div class="col-md-10 mx-lg-4 border-bottom border-1 mb-2">
                                                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                                                <?php

                                                                $addres_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$user["email"]."'");
                                                                $addres_data = $addres_rs->fetch_assoc();

                                                                $img_rs = Database::search("SELECT * FROM `img_path` WHERE `user_email`='".$user["email"]."'");
                                                                $img_num = $img_rs->num_rows;

                                                                if($img_num > 0){

                                                                    $img_data = $img_rs->fetch_assoc();
                                                                    ?>
                                                                    <img src="<?php echo $img_data["path"]; ?>" style="width:150px;   border-radius: 150px;" id="viewImg"/>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <img src="resources/emptyuser.jpg" style="width:150px;   border-radius: 150px;" id="viewImg"/>
                                                                    <?php
                                                                }

                                                                ?>

                                                                <span class="fw-bold text-white mt-2"><?php echo $user["user_name"]; ?></span>
                                                                <span class=" text-white"><?php echo $user["email"]; ?></span>

                                                                <input type="file" class="d-none" id="profileimg" accept="img/*"/>
                                                                <label for="profileimg" class="btn btn-primary mt-3" onclick="changeImage();">Update Profile Image</label>

                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-10 text-center">

                                                            <div class="mt-3  offset-1 offset-lg-0">
                                                                <span class="form-label text-white fw-bold" style="font-size: 14px;"><i class="bi bi-geo-alt-fill text-white"></i> From</span>
                                                                <span class="offset-3 text-end text-white" style="font-size: 14px;"><?php echo $addres_data["country"]; ?></span>
                                                            </div>

                                                            <div class="mt-3  offset-1 offset-lg-0">
                                                                <span class="form-label text-white fw-bold" style="font-size: 14px;"><i class="bi bi-person-fill text-white"></i> User Since</span>
                                                                <span class="offset-1 text-end text-white" style="font-size: 14px;"><?php echo $user["r_date"]; ?></span>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-lg-7 col-12 mx-4 mx-lg-0 my-3">
                                                    <div class="">

                                                    <div class="col-lg-10 col-12">
                                                        <div class="row">

                                                        

                                                        <div class="d-flex justify-content-between align-items-center mb3">
                                                            <h4 class="fw-bold text-white">Profile Setting</h4>
                                                        </div>

                                                        <div class="row mt-5 text-white">

                                                            <div class="col-12">
                                                                <label class="form-label">User Name</label>
                                                                <input type="text" class="form-control" id="uname" value="<?php echo $user["user_name"]; ?>">
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label">Mobile</label>
                                                                <input type="text" class="form-control" id="mobile" value="<?php echo $user["mobile"]; ?>">                                                
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label">Password</label>
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" readonly value="<?php echo $user["password"]; ?>">                                                        <span class="input-group-text bg-primary" id="basic-addon2">
                                                                    <i class="bi bi-eye-slash text-white"></i>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label">Binance Id</label>
                                                                <input type="text" class="form-control" readonly value="<?php echo $user["b_id"]; ?>">
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label">Email</label>
                                                                <input type="text" class="form-control" readonly value="<?php echo $user["email"]; ?>">
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label">Registered Date</label>
                                                                <input type="text" class="form-control" readonly value="<?php echo $user["r_date"]; ?>">
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label">Address</label>
                                                                <input type="text" class="form-control" id="line1" value="<?php echo $addres_data["address"]; ?>"/>
                                                            </div> 

                                                            <div class="col-6">
                                                                <label class="form-label">City</label>
                                                                <input type="text" class="form-control" id="city" value="<?php echo $addres_data["city"]; ?>"/>
                                                            </div> 

                                                            <div class="col-6">
                                                                <label class="form-label">Country</label>
                                                                <input type="text" class="form-control" id="country" value="<?php echo $addres_data["country"]; ?>"/>
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label">Postal Code</label>
                                                                <input type="text" class="form-control" id="pcode" value="<?php echo $addres_data["postal_code"]; ?>"/>
                                                            </div>
                                                            
                                                            <div class="col-12">
                                                                <label class="form-label">Gender</label>
                                                                <?php
                                                            
                                                                if($user["gender_id"] == 1){
                                                                    ?>
                                                                    <input type="text" class="form-control" readonly value="Male">
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <input type="text" class="form-control" readonly value="Female">
                                                                    <?php
                                                                }
                                                                
                                                                ?>
                                                                
                                                            </div>

                                                            <div class="col-12 d-grid mt-3">
                                                                <button class="btn btn-primary" onclick="updateProfile();">Update My Profile</button>
                                                            </div>

                                                        </div>

                                                        </div>
                                                    </div>

                                                    </div>
                                                </div>

                                            <!-- </div>
                                        </div> -->
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