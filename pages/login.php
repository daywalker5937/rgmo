<?php

//   include_once '../objects/session.php';

//   $ses = Session::getInstance();
//   $ses->destroy();

  // if(isset($ses->id)) {
    
  //   switch ($ses->role[0]) {
  //     case 5:
  //       header('location: ../index');
  //     break;
      
  //     default:
  //       header('location: risk_form');
  //     break;
  //   }

  // }
  // else {
  //   $ses->destroy();
  // }



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Risk | Log in</title>
  <link rel="icon" href="../images/dof_icon.ico" type="image/icon type">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  

</head>



<style>

  .container-fluid-width {
    width: 80%;
  }
  .picSize {
    height: 350px;
    width: 100%;
    border-radius: 4px;
  }
  .card-desc {
    margin-top: 10px;
  }

  .div-agreement, .div-footer {
    width: 100%;
  }

  #caps-text {
    display: none;
    color: red;
    font-weight: bold;
  }

</style>

<body class="hold-transition login-page"> <!-- whole page -->

<!-- Main content -->

  <div class="container-fluid container-fluid-width">
    <div class="row">

      <!-- login column -->
      <div class="col-lg-5 mx-auto">

        <!-- <div class="login-box"> -->
          <div class="card"></div>
          <div class="card-header text-center">
            <img src="../images/dof_icon.ico" alt="DOF logo"
              height="150" width="150">
          </div>
          <div class="card card-outline card-primary">
            <div class="card-header text-center">
              <a href="#" class="h3"><b>Risk</b> Management</a>
            </div>

            <div class="card-body">
                
              <form autocomplete="off" id="loginForm">

                <div class="input-group mb-3">
                  <input type="text" class="form-control" 
                    placeholder="Username" name="userName">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                </div>

                <div class="input-group mb-3">

                  <input type="password" class="form-control" 
                    placeholder="Password" name="userPass" 
                    id="id_password">

                  <div class="input-group-append" data-toggle="tooltip"
                    title="Click here to show password">
                    <div class="input-group-text">     
                      <i class="fa fa-eye" id="togglePassword"
                        style="cursor: pointer"></i>
                    </div>
                  </div>
                  
                </div>
                <p id="caps-text">Caps Lock is ON</p>

                <!-- div Sign in button -->
                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block"
                      name="login_user" id="login-user">Sign In</button>
                  </div>
                </div>

              </form>

            </div> <!-- card-body -->

          </div> <!-- card outline card primary -->
        
        <!-- <hr> -->
        <!-- <div class="div-footer-agreement"> -->
  
          <!-- Agreement div -->
          <!-- <div class="div-agreement">
            <span>
              By continuing, you agree to the <a href="#">RMS Customer Agreement</a>
              or other agreement for RMS services, and the <a href="#">Privacy Notice.</a>
            </span>
          </div>
          <hr>
          <div class="div-footer">
            <span class="span-footer">
              <strong>Copyright &copy; 2022 <a href="https://www.dof.gov.ph/">Risk Management</a>.</strong> All rights reserved.
            </span>
          </div> -->

        <!-- </div> -->
        <!-- div agreement and footer -->
        


      </div> <!-- col-lg-5 -->

      <!-- System Description column -->
      
      <!-- <div class="col-lg-7">
        <div class="card"></div>
        <img class="picSize" src="../images/android-headphones.jpg" alt="Login picture">
        
        <div class="card card-outline card-primary card-desc">
          <div class="card-header">
            <h3 class="m-0">Risk Management System (RMS)</h3>
          </div>

          <div class="card-body">
            <h6 class="card-title">Description</h6>

            <p class="card-text">         
              A Risk Management Information System (RMIS) is an integrated computer information system used to aggregate risk data and to help decision makers evaluate business risks.
              This information includes risk exposure, protection measures and risk management. Examples of stored information include loss-control measures, property values, records of prior claims and relevant insurance policies.
              Like other computerized information systems, a RMIS SYSTEM is easy to access from different locations and on different devices. It is flexible and agile, able to allow for the changing needs of a modern workplace. At the same time, it is tailored to support your business’ risk concerns, exposures, protection measures and risk management.
            </p>

          </div>

        </div>  -->
        
        <!-- card -->
      
      <!-- </div> col-lg-6 -->

    </div> <!-- row -->

  </div> <!-- container fluid -->


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>

</body>
</html>