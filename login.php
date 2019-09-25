<?php
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
    
    if(isset($_SESSION['username'])){
        header('location: ../spcf-its');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SPCF - PPFO - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" href="img/favicon.png" type="image/gif" sizes="16x16"> 
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
<style>
  .bg-gradient-primary {
    background-color: #0f1e5d !important;
    background-image: -webkit-gradient(linear,left top,left bottom,color-stop(50%,#4e73df),to(#0f1e5d)) !important;
    background-image: linear-gradient(180deg,#4e73df 10%,#0f1e5d 100%) !important;
    background-size: cover !important;
}
</style>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <!-- Alert Here -->
          <?php
            if(isset($_SESSION['logInError'])){
          ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
              echo $_SESSION['logInError'];
              unset($_SESSION['logInError']);
            ?>
          </div>
          <?php
            }
          ?>
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" action="process_login.php" method="POST">
                    <div class="form-group">
                      <input type="name" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                    </div>
                    <button class="btn btn-primary btn-block" name="login" style="background-color: #0f1e5d; border-color: #0f1e5d;">Login</button>
                    <hr>
                  </form>
                  <hr>
                  <div class="copyright text-center my-auto">
                    <span>Copyright &copy; SYSTEMS PLUS COLLEGE FOUNDATION - ITS 2019</span>
                    <br/>
                    <img src='img/logo.png' height="50px;">
                    <img src='img/favicon.png' height="40px;">
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>