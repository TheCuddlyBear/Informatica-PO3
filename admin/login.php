<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Login - DeDemiFanShop</title>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">

<?php
include("../config.php");

$formUsername = $_POST['username'];
$formPassword = $_POST['password'];
session_start();

if(!empty($_SESSION['loggedin'])){
  header("location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($formPassword) && !empty($formUsername)){
      // Put login code here
      $query = "SELECT * FROM users WHERE username = '" . $formUsername . "'";
      $result = mysqli_query($conn, $query);
      $rowcount = mysqli_num_rows($result);

      if($rowcount == 1){
        $resultarray = mysqli_fetch_assoc($result);
        $username = $resultarray['username'];
        $fullname = $resultarray['fullname'];
        $avatar = $resultarray['avatar'];
        $passwordHash = $resultarray['password'];

        if(password_verify($formPassword, $passwordHash)){
          $_SESSION['loggedin'] = $username;
          $_SESSION['fullname'] = $fullname;
          $_SESSION['avatar'] = $avatar;
          header("location: index.php");
        }else{
          echo "Username or password is wrong";
        }
      }else{
        echo "That user does not exit";
        echo $rowcount;
      }

    }else {
      echo "Username or Password cannot be empty";
    }
}


?>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(https://i.imgur.com/KGiwQNj.jpg);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">DeDemiFanShop.nl - Admin Area</h4>
                                    </div>
                                    <form class="user" action="" method="post">
                                        <div class="form-group"><input class="form-control form-control-user" type="text" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username..." name="username"></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password"></div>
										<button class="btn btn-primary btn-block text-white btn-user" type="submit">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>
</html>