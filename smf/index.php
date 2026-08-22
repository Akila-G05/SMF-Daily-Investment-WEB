<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMF Login</title>   
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

    </head>

    <body class="main-body">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-11 mx-auto overflow-hidden min-vh-100 align-items-center d-flex">
                    <div class="row">

                        <div class="col-12 border-2 bg-white ">
                            <div class="row">

                                <div class="col-lg-5 rounded-4 my-2 d-none d-lg-block">
                                    <div class="">
                                        <img src="resources/bg4.jpg" style="height: 560px; border-radius: 33px;">
                                    </div>
                                </div>
                                

<!-- Signin -->
                                <div class="col-lg-7 col-12 bg-white rounded-5 rounded-start my-2">
                                    <div class="row my-5">
                                        <div class="col-lg-11 mx-lg-auto mx-0 col-12">
                                            <div class="row">
                                            
                                                <div class="col-12 mt-lg-1 mt-0">
                                                    <div class="row">
                                                        <span class="text-center fs-1 fw-bold">SignIn</span>
                                                        <span class="text-center">Don't have an account yet? <a href="signup.php">Sign up here</a></span>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <hr class="border border-1 mt-3 mb-5 border-dark rounded rounded-5">
                                                    </div>
                                                </div>

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
                                                    <div class="input-group mt-3 mb-2">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-envelope-at"></i></span>
                                                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="email" placeholder="Email....">
                                                    </div>
                                                </div>

                                                <div class="col-12 text-center">
                                                    <div class="input-group mt-2 mb-2">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-lock"></i></span>
                                                        <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="pw" placeholder="Password....">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-6 mb-5 text-end">
                                                    <div class="row">
                                                        <button class="btn btn-link" onclick="forgotPw();">Forgot Password</button>
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
                                                            <button class="btn btn-primary rounded rounded-5 fw-bold" onclick="signIn();">SignIn</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- modal -->
           
                                                    <div class="modal" tabindex="-1" id="forgotPasswordModal">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Reset Password</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">    
                                                                    <div class="row g-3">
                                                                        
                                                                        <span class="text-success">Verification Code has sent to your Email. Please check your inbox.</span>
                                                                        <div class="col-6">
                                                                            <label class="form-label">New Password</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="password" class="form-control" id="npi"/>
                                                                                <button class="btn btn-outline-secondary" type="button" onclick="ShowPassword();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <label class="form-label">Re-type Password</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="password" class="form-control" id="rnp"/>
                                                                                <button class="btn btn-outline-secondary" type="button" onclick="ShowPassword2();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label class="form-label">Verification Code</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text" class="form-control" id="vc"/>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    
                                                                    <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                
                                                <!-- modal -->
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!-- Signin -->

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