<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Status - DeDemiFanShop</title>
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
                'The product has been deleted.',
                'success'
            )
        }

        function deleteFailed(){
            Swal.fire(
                'Not deleted!',
                'The product has not been deleted.',
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

    if (!empty($_GET['status'])) {
        $status = $_GET['status'];
        $id = $_GET['id'];

        $sql = 'UPDATE trackentrace SET status = ' . $status . ' WHERE order_id = ' . $id;
        mysqli_query($conn, $sql);
        header("location: status.php");

    }

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
                <li class="nav-item" role="presentation"><a class="nav-link" href="orders.php"><i class="fas fa-table"></i><span>Orders</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link active" href="status.php"><i class="fas fa-table"></i><span>Status</span></a></li>
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
                <h3 class="text-dark mb-4">Status</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Status</p>
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
                                    <th>Order ID</th>
                                    <th>Status</th>
                                    <th>Pas Status Aan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT * FROM trackentrace";
                                $result = $conn->query($query);

                                while($row = $result->fetch_assoc()){
                                    echo "<tr>";
                                    echo "<td>" . $row['order_id'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    if($row['status'] == 1){
                                        echo "<td><form action='' method='get'><input hidden name='id' type='number' value='" . $row['order_id'] . "'><select class='form-control form-control-lg' name='status' onchange='this.form.submit()'><option>1</option><option>2</option><option>3</option><option>4</option></select></form></td>";
                                    }else if($row['status'] == 2){
                                        echo "<td><form action='' method='get'><input hidden name='id' type='number' value='" . $row['order_id'] . "'><select class='form-control form-control-lg' name='status' onchange='this.form.submit()'><option>1</option><option selected>2</option><option>3</option><option>4</option></select></form></td>";
                                    }else if($row['status'] == 3){
                                        echo "<td><form action='' method='get'><input hidden name='id' type='number' value='" . $row['order_id'] . "'><select class='form-control form-control-lg' name='status' onchange='this.form.submit()'><option>1</option><option>2</option><option selected>3</option><option>4</option></select></form></td>";
                                    }else {
                                        echo "<td><form action='' method='get'><input hidden name='id' type='number' value='" . $row['order_id'] . "'><select class='form-control form-control-lg' name='status' onchange='this.form.submit()'><option>1</option><option>2</option><option>3</option><option selected>4</option></select></form></td>";
                                    }
                                    echo "</tr>";
                                }


                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td><strong>Order ID</strong></td>
                                    <td><strong>Status</strong></td>
                                    <td><strong>Pas Status Aan</strong></td>
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
