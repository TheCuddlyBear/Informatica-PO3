<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Products - DeDemiFanShop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">

    <?php
    include("../config.php");
    session_start();


    if(empty($_SESSION['loggedin'])){
        header("location: ../admin/index.php");
        die();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productnaam = $_POST['product_naam'];
        $productprijs = $_POST['product_prijs'];
        $productid = $_POST['product_id'];
        $productcategorie = $_POST['product_cat'];
        $productdesc = $_POST['description'];


        $query = "UPDATE product SET product_naam = '$productnaam', description = '$productdesc', prijs = '$productprijs', categorie_naam = '$productcategorie' WHERE id = $productid;";
        $resultaat = mysqli_query($conn, $query);

        if($resultaat) {
            header("location: ../admin/products.php");
        }else{
            echo 'Error: ' . mysqli_error($resultaat);
        }

    }else{
        $productid = $_GET['id'];

        $sql = "SELECT * FROM product WHERE id = " . $productid;
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);

    }

    ?>
</head>

<body id="page-top">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                <div class="sidebar-brand-text mx-3"><span>DDFS.NL</span></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item" role="presentation"><a class="nav-link" href="../admin/index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="../admin/profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link active" href="../admin/products.php"><i class="fas fa-table"></i><span>Products</span></a></li>
            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                        </div>
                    </form>
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                            <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto navbar-search w-100">
                                    <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                        <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow" role="presentation">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $_SESSION['fullname'] ?></span><img class="border rounded-circle img-profile" src=<?php echo "'" . $_SESSION['avatar'] . "'" ?>></a>
                                <div
                                    class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="../admin/profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                    <a
                                        class="dropdown-item" role="presentation" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="../admin/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Edit Product:</p>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="username"><strong>Product ID</strong></label><input class="form-control" type="text" value=<?php echo '"' . $productid . '"'; ?> name="product_id" readonly></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="email"><strong>Product naam</strong></label><input class="form-control" type="text" value=<?php echo '"' . $product['product_naam'] . '"'; ?> name="product_naam"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="first_name"><strong>Product prijs</strong></label><input class="form-control" type="text" value=<?php echo '"' . $product['prijs'] . '"'; ?> name="product_prijs"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="last_name"><strong>Product categorie</strong></label><input class="form-control" type="text" value=<?php echo '"' . $product['categorie_naam'] . '"'; ?> name="product_cat"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1"><b>Product description</b></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"><?php echo $product['description']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Edit product</button>  <button class="btn btn-secondary btn-sm" onclick="goBack()">Cancel</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Brand 2020</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>

<script>
    function goBack() {
        window.history.back();
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/theme.js"></script>
</body>

</html>