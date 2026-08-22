<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SMF AdminSignin</title>
        <link rel="icon" href="resources/logo.jpeg"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body class="body">
    
        <div class="container-fluid vh-100 d-flex justify-content-center">
            <div class="row align-content-center">

            <!-- signin -->
                <div class="col-12 col-lg-6 offset-lg-3 offset-0 signin">
                    <div class="row g-4">
                        <div class="col-12 mt-5">
                            <p class="title2 text-center">Admin SignIn</p>
                                <p class="title2_1 text-center">Please Login to use platform</p>
                            <span class="text-danger"></span>
                        </div>

                        

                        <div class="col-lg-8 col-12 offset-0 offset-lg-2">
                            <input type="text" class="form-control" placeholder="Enter Email" id="email"/>
                        </div>
                        <div class="col-lg-8 col-12 offset-0 offset-lg-2">
                            <input type="password" class="form-control" placeholder="Enter Password" id="pw"/>
                        </div>

                        <div class="col-lg-5 col-8 offset-lg-2 offset-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"/>
                                <label class="form-check-label">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-lg-5 col-8 offset-lg-0 offset-3">
                            <a onclick="changeAdminPwModel();" class="link-primary">Change Password?</a>
                        </div>
                        <div class="col-6 col-lg-6 offset-3 d-grid mb-5">
                        <button class="signinbtn text-white" onclick="adminSignin();">SIGN IN</button>
                        </div>
                    </div>
                </div>
                <!-- signin -->

                <!-- modal -->
            
                    <div class="modal" tabindex="-1" id="forgotAdminPasswordModal">
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
                                            <label class="form-label">Verification Code</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="vcode"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class="form-label">New Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="np"/>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Re-type Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="rp"/>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    
                                    <button type="button" class="btn btn-primary" onclick="changeAdminPw();">Reset Password</button>
                                </div>
                            </div>

                        </div>
                    </div>
                
                <!-- modal -->

            </div>
        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

</html>