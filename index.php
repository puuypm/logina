<?php
session_start();
session_regenerate_id(true);
include 'com/connection.php';

// $accounts = [
//     [
//         "id" => "1",
//         "email"=> "user@gmail.com",
//         "password"=> "1234",
//         "level"=> "user",
//     ],
//     [
//         "id" => "2",
//         "email"=> "admin@gmail.com",
//         "password"=> "4321",
//         "level"=> "admin",
//     ]


//     ];


require_once "com/function.php";

if (isset($_POST['masuk'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $opt = htmlspecialchars($_POST['lvl']);

    if ($opt == '2') {
        $query = "SELECT * FROM user WHERE email = ?";
    } else if ($opt == "3") {
        $query = "SELECT * FROM user WHERE email = ?";
    } else {
        header("Location: index.php");
        die();
    }
    $result = $db->prepare($query);
    $result->bindParam(1, $email);
    $result->execute();

    $autentication = false;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($row['password'] == $_POST['password']) {
            if ($opt == "2" && $row['id_level'] == $opt) {
                $autentication = true;
                $_SESSION['email'] = $row['email'];
                header("Location: user.php");
                die();
            } else if ($opt == "3" && $row['id_level'] == $opt) {
                $autentication = true;
                $_SESSION['emailAdmin'] = $row['email'];
                header("Location: admin.php");
                die();
            }
        }
    }
}

if (isset($_SESSION['email'])) {
    header("Location: user.php");
    exit();
}
if (isset($_SESSION['emailAdmin'])) {
    header("Location: admin.php");
    exit();
}

// if (isset($_POST['email']) && isset($_POST['password'])) {
//     foreach ($accounts as $account) {
//         if (
//             $account['email'] == $_POST['email'] &&
//             $account['password'] == $_POST['password']
//             && $account['level'] == $_POST['lvl']

//             ) {
//                 $_SESSION['email'] = $_POST['email'];
//                 if ($account['level'] == 'admin') {
//                     header("Location: admin.php");
//                 } else {
//                     header("Location: user.php");
//                 }
//                 exit;
//             }
//         }
//     }
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Home Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Email Anda..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukkan Password Anda..." name="password">
                                        </div>

                                        <div>
                                            <select class="form-control" name="lvl">
                                                <option selected disabled="">Pilih Level</option>
                                                <option value="3">Admin</option>
                                                <option value="2">User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button name="masuk" type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="register.html">Create an Account!</a>
                                        </div>
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