<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMF Register</title> 
        <link rel="icon" href="resources/logo.jpeg"/>    
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>

    <body class="main-body">
        
        <div class="container-fluid overflow-hidden">
            <div class="row align-content-center ">
                <div class="col-11 mx-auto">
                    <div class="row">

                        <div class="col-12 mt-lg-5 mt-3 border-2 bg-white rounded rounded-5">
                            <div class="row">

                                <div class="col-5 rounded-4 my-2 d-none d-lg-block">
                                    <div class="">
                                        <img src="resources/bg4.jpg" style="height: 560px; border-radius: 33px;">
                                    </div>
                                </div>

<!-- SignUp -->
                                <div class="col-lg-7 col-12 bg-white rounded-lg-5 rounded-0 rounded-start">
                                    <div class="row my-3">
                                        <div class="col-lg-11 col-12 mx-auto">
                                            <div class="row">
                                            
                                                <div class="col-12">
                                                    <div class="row">
                                                        <span class="text-center fs-1 fw-bold">SignUp</span>
                                                        <span class="text-center">Already have an account? <a href="index.php">Sign in here</a></span>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <hr class="border border-1 my-3 border-dark rounded-0 rounded-lg-5">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-10 text-center offset-1 ">

                                                    <!--  -->
                                                    <div class="col-12 d-none" id="msgdiv" >                              
                                                        <div class="alert alert-danger d-flex align-items-center" role="alert" id="alertdiv">
                                                            <div>
                                                                <i class="bi bi-x-octagon-fill" id="msg"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--  -->

                                                    <div class="col-12 text-center">
                                                        <div class="input-group  my-3">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-person"></i></span>
                                                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="uname" placeholder="UserName....">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <div class="input-group my-2">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-envelope-at"></i></span>
                                                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="email" placeholder="Email....">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6 col-12 text-center">
                                                            <div class="input-group my-2">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-lock"></i></span>
                                                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="pw" placeholder="Password....">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12 text-center">
                                                            <div class="input-group my-2">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-lock"></i></span>
                                                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="repw" placeholder="Reenter Password....">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 text-center">
                                                        <div class="input-group  my-2">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-person-vcard"></i></span>
                                                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="bid" placeholder="Binance Id....">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6 col-12 text-center">
                                                            <div class="input-group my-2">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-telephone"></i></span>
                                                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="mobile" placeholder="mobile....">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12 text-center">
                                                            <div class="input-group my-2">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-gender-female"></i></span>                                                            
                                                        
                                                                <select class="form-control" id="gender" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                                    <option value="0">Select</option>
                                                                    <option value="1">Male</option>
                                                                    <option value="2">Female</option>
                                                                </select>  
                                                            </div>                                                      
                                                        </div>
                                                    </div>

                                                    <div class="col-12 text-center">
                                                        <div class="input-group  my-2">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-people"></i></span>
                                                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="rcode" placeholder="Referral code....">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div class="row">
                                                        <hr class="border border-1 my-3 border-dark rounded rounded-5">
                                                    </div>
                                                </div>

                                                <div class="col-12 text-center offset-3 mt-3">
                                                    <div class="row">
                                                        <div class="col-6 d-grid">
                                                            <div class="row">
                                                            <button class="btn btn-primary rounded rounded-5 fw-bold" onclick="signUp();">SignUp</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!-- SignUp -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="script.js"></script>
    </body>

</html>