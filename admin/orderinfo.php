<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Orders - DeDemiFanShop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.all.min.js"></script>
    <script>
        function databaseError(){
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Database error!',
                showConfirmButton: false,
                timer: 1500
            })
        }

        function confirmDelete(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    <?php echo 'window.location.href = "../scripts/delete.php?orderid=' . $_GET['orderid'] . '"'; ?>
                }
            })
        }

        function deleteSuccess(){
            Swal.fire(
                'Deleted!',
                'The order has been deleted.',
                'success'
            )
        }

        function deleteFailed(){
            Swal.fire(
                'Not deleted!',
                'The order has not been deleted.',
                'error'
            )
        }
    </script>

    <?php
    include("../config.php");
    session_start();

    if(empty($_SESSION['loggedin'])){
        header("location: index.php");
        die();
    }

    $orderid = $_GET['id'];

    ?>
</head>

<body id="page-top" <?php
if(!empty($error)){
    echo 'onload="databaseError()"';
}else {
    switch ($_GET['alert']){
        case confirmDelete:
            echo 'onload="confirmDelete()"';
            break;
        case removeSuccess:
            echo 'onload="deleteSuccess()"';
            break;
        case removeFailed:
            echo 'onload="deleteFailed()"';
            break;
    }
}
?>>
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                <div class="sidebar-brand-text mx-3"><span>DDFS.NL</span></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item" role="presentation"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link " href="products.php"><i class="fas fa-table"></i><span>Products</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link active" href="orders.php"><i class="fas fa-table"></i><span>Orders</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="status.php"><i class="fas fa-table"></i><span>Status</span></a></li>
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
                                    <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="row">
                <div class="col">
                <h3 class="text-dark mb-4">Order #<?php echo $orderid; ?></h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Producten</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table dataTable my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Prijs</th>
                                    <th>Aantal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT * FROM bestelregel WHERE order_id = $orderid";
                                $result = $conn->query($query);
                                $regel = 0;
                                $prijs = 0;
                                $totaleprijs = 0;
                                $totaalaantal = 0;

                                while($row = $result->fetch_assoc()){
                                    $prijs = $row['product_prijs'] * $row['aantal'];
                                    $product = "SELECT * FROM product WHERE id = " . $row['product_id'];
                                    $productResult = mysqli_query($conn, $product);
                                    $array = mysqli_fetch_assoc($productResult);
                                    $regel = $regel + 1;
                                    $totaleprijs = $totaleprijs + $prijs;
                                    $totaalaantal = $totaalaantal + $row['aantal'];

                                    echo '<tr>';
                                    echo '<td>' . $regel . '</td>';
                                    echo '<td>' . $array['product_naam'] . '</td>';
                                    echo '<td>&#8364;' . $prijs . '</td>';
                                    echo '<td>' . $row['aantal'] . 'x' . '</td>';
                                    echo '</tr>';
                                }


                                ?>
                                <tr>
                                    <td></td>
                                    <td><strong>Totaal: </strong></td>
                                    <td><strong>&#8364;<?php echo $totaleprijs; ?></strong></td>
                                    <td><strong><?php echo $totaalaantal; ?></strong></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td><strong>Order ID</strong></td>
                                    <td><strong>Betaalmethode</strong></td>
                                    <td><strong>Datum</strong></td>
                                    <td><strong>Klant email</strong></td>
                                    <td><strong>Verwijder</strong></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                            </div>
                            <div class="col-md-6">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Adres gegevens
                        </div>
                        <div class="card-body">
                            <?php
                            $getEmail = "SELECT * FROM bestelling WHERE order_id = $orderid";
                            $resultEmail = mysqli_query($conn, $getEmail);
                            $arrayEmail = mysqli_fetch_assoc($resultEmail);
                            $klantEmail = $arrayEmail['email'];

                            $getKlant = "SELECT * FROM klant WHERE email = '" . $klantEmail . "'";
                            $result = mysqli_query($conn, $getKlant);
                            $array = mysqli_fetch_assoc($result);

                            ?>
                            <form action="" method="post">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="username"><strong>Volledige naam</strong></label><input readonly class="form-control" type="text" name="voornaam" value=<?php echo '"' . $array['naam'] . '"'; ?>></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="username"><strong>Email</strong></label><input readonly class="form-control" type="email" value=<?php echo '"' . $array['email'] . '"'; ?> name="email"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="first_name"><strong>Adres</strong></label><input readonly class="form-control" type="text" value=<?php echo '"' . $array['adres'] . '"'; ?> name="straathuis"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="first_name"><strong>Betaalmethode</strong></label>
                                        <select disabled class='form-control form-control-lg mb-3' name="betaalmethode">
                                            <option><?php echo $arrayEmail['betaalmethode']; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Product Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Create product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="createProduct">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="username"><strong>Product merk</strong></label><input class="form-control" type="text" name="product_merk"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="email"><strong>Product naam</strong></label><input class="form-control" type="text" name="product_naam"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="first_name"><strong>Product prijs</strong></label><input class="form-control" type="text" name="product_prijs"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="last_name"><strong>Product categorie</strong></label><input class="form-control" type="text" name="product_cat"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="first_name"><strong>Product image</strong></label><input class="form-control" type="text" name="product_image"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1"><b>Product description</b></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="createProduct" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast -->
        <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
            <div class="toast" id="Success" style="position: absolute; top: 0; right: 0;">
                <div class="toast-header">
                    <img src="..." class="rounded mr-2" alt="...">
                    <strong class="mr-auto">Bootstrap</strong>
                    <small>11 mins ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>
        </div>

        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Brand 2020</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/theme.js"></script>
<script src="assets/js/product-alerts.js"></script>
</body>
</html>
