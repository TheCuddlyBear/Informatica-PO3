<!DOCTYPE HTML>
<html>
<head>
    <title>DeDemiFanShop.nl | Home</title>
    <?php require("config.php");
    date_default_timezone_set('Europe/Amsterdam');
    session_start();

    $orderid = $_SESSION['order_id'];

    // Adres gegevens
    $unNaam = $_POST['voornaam'] . ' ' . $_POST['achternaam'];
    $naam = htmlentities($unNaam, ENT_QUOTES);
    $email = $_POST['email'];
    $adres = $_POST['straathuis'] . ' ' . $_POST['stad'] . ' ' .  $_POST['provincie'] . ', ' . $_POST['postcode'];

    $betaalmethode = $_POST['betaalmethode'];
    $date = date('d-m-Y');


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = "SELECT * FROM klant WHERE email  = '" . $email . "'";
        $result = mysqli_query($conn, $sql);

        $bestelRegels = "SELECT * FROM bestelregel WHERE order_id = $orderid";
        $regelsResult = mysqli_query($conn, $bestelRegels);
        $totaalprijs = 0;

        while($row = $regelsResult->fetch_assoc()){
            $prijs = $row['product_prijs'] * $row['aantal'];
            $totaalprijs = $totaalprijs + $prijs;
        }

        if(mysqli_num_rows($result) > 0){
            $updateBestelling = "UPDATE bestelling SET completed = 1, email = '" . $email . "', betaalmethode = '" . $betaalmethode . "', datum = '" . $date . "', totalprice = $totaalprijs WHERE order_id = $orderid";
            mysqli_query($conn, $updateBestelling);

            $trackentrace = "INSERT INTO trackentrace (order_id, status) VALUES ($orderid , 1)";
            mysqli_query($conn, $trackentrace);

            unset($_SESSION['order_id']);
            header("location: voltooid.php?id=$orderid");
        }else{
            $maakKlant = "INSERT INTO klant (email, naam, adres) VALUES ('". $email . "', '" . $naam . "', '" . $adres . "')";
            $query = mysqli_query($conn, $maakKlant);
            if($query) {
                $updateBestelling = "UPDATE bestelling SET completed = 1, email = '" . $email . "', betaalmethode = '" . $betaalmethode . "', datum = '" . $date . "', totalprice = $totaalprijs WHERE order_id = $orderid";
                mysqli_query($conn, $updateBestelling);

                $trackentrace = "INSERT INTO trackentrace (order_id, status) VALUES ($orderid , 1)";
                mysqli_query($conn, $trackentrace);

                unset($_SESSION['order_id']);
                header("location: voltooid.php?id=$orderid");
            }else {
                echo 'FOUT';
            }


        }
    }

    if(!empty($_GET['action'])){
        if($_GET['action'] == 'remove'){
            $getRegel = "SELECT * FROM bestelregel WHERE regel_id = " . $_GET['id'];
            $result = mysqli_query($conn, $getRegel);
            $array = mysqli_fetch_assoc($result);

            if($array['aantal'] == 1){
                $sql = "DELETE FROM bestelregel WHERE regel_id = " . $_GET['id'];
                mysqli_query($conn, $sql);
                header("location: winkelmand.php");
            }else{
                $aantal = $array['aantal'] - 1;
                $sql = "UPDATE bestelregel SET aantal = $aantal WHERE regel_id = " . $_GET['id'];
                mysqli_query($conn, $sql);
                header("location: winkelmand.php");
            }

        }else if($_GET['action'] == 'add'){
            $getRegel = "SELECT * FROM bestelregel WHERE regel_id = " . $_GET['id'];
            $result = mysqli_query($conn, $getRegel);
            $array = mysqli_fetch_assoc($result);

            $aantal = $array['aantal'] + 1;
            $sql = "UPDATE bestelregel SET aantal = $aantal WHERE regel_id = " . $_GET['id'];
            mysqli_query($conn, $sql);
            header("location: winkelmand.php");
        }
    }

    ?> <!-- Include the Config file -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
</head>
<body>

<!-- Navigatie -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">DeDemiFanShop.nl</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><!--g--></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><svg class="bi bi-house-door-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 10.995V14.5a.5.5 0 01-.5.5H2a.5.5 0 01-.5-.5v-7a.5.5 0 01.146-.354l6-6a.5.5 0 01.708 0l6 6a.5.5 0 01.146.354v7a.5.5 0 01-.5.5h-4a.5.5 0 01-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
                        <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5z" clip-rule="evenodd"/>
                    </svg> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg class="bi bi-list" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                    </svg> Categorie&euml;n
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="producten.php?cat=blije_demi">Blije Demi</a>
                    <a class="dropdown-item" href="producten.php?cat=spastische_demi">Spastische Demi</a>
                    <a class="dropdown-item" href="producten.php?cat=gekke_demi">Gekke Demi</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg class="bi bi-phone" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11 1H5a1 1 0 00-1 1v12a1 1 0 001 1h6a1 1 0 001-1V2a1 1 0 00-1-1zM5 0a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V2a2 2 0 00-2-2H5z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M8 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg> Telefoonmerken
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="producten.php?phoneBrand=Samsung">Samsung</a>
                    <a class="dropdown-item" href="producten.php?phoneBrand=Apple">Apple</a>
                    <a class="dropdown-item" href="producten.php?phoneBrand=Huawei">Huawei</a>
                    <a class="dropdown-item" href="producten.php?phoneBrand=LG">LG</a>
                    <a class="dropdown-item" href="producten.php?phoneBrand=Motorola">Motorola</a>
                    <a class="dropdown-item" href="producten.php?phoneBrand=Oneplus">Oneplus</a>
                    <a class="dropdown-item" href="producten.php?phoneBrand=Nokia">Nokia</a>
                    <a class="dropdown-item" href="producten.php?phoneBrand=Xiaomi">Xiaomi</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="producten.php">
                    <svg class="bi bi-list" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                    </svg> Alle producten</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="acties.php"><svg class="bi bi-tag-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 1a1 1 0 00-1 1v4.586a1 1 0 00.293.707l7 7a1 1 0 001.414 0l4.586-4.586a1 1 0 000-1.414l-7-7A1 1 0 006.586 1H2zm4 3.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" clip-rule="evenodd"/>
                    </svg> Acties</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="trackentrace.php"><svg class="bi bi-geo-alt" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 16s6-5.686 6-10A6 6 0 002 6c0 4.314 6 10 6 10zm0-7a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                    </svg> Track & Trace</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php"><svg class="bi bi-at" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z" clip-rule="evenodd"/>
                    </svg> Contact</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a href="winkelmand.php" class="btn btn-primary">&#128722;</a>
        </form>
    </div>
</nav>

<div style="margin: 10px;">

    <!-- Database error -->
    <div id="errormessage" style="float: right;">
        <?php
        if(!empty($error)){
            echo "<div class='alert alert-danger' style='margin:10px' role='alert'>";
            echo "Connection failed: " . $error;
            echo "</div";
        }else if(!empty($_GET['success'])){
            echo "<div class='alert alert-succes' style='margin:10px' role='alert'>";
            echo "Het product is aan uw bestelling toegevoegd";
            echo "</div";
        }
        ?>
    </div>


</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    Producten in winkelwagen
                </div>
                <div class="card-body d-flex">
                    <table class="table">
                        <thead>
                            <th scop="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Prijs</th>
                            <th scope="col">Aantal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT  * FROM bestelregel WHERE order_id = $orderid";
                        $result = mysqli_query($conn, $sql);
                        $regel = 0;
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
                                echo '<td><a class="btn btn-primary" href="winkelmand.php?action=remove&id=' . $row['regel_id'] . '" role="button">-</a>    ' . $row['aantal'] . 'x' . '    <a class="btn btn-primary" href="winkelmand.php?action=add&id=' . $row['regel_id'] . '" role="button">+</a></td>';
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
                    </table>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Adres gegevens
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label for="username"><strong>Voornaam</strong></label><input class="form-control" type="text" name="voornaam"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label for="email"><strong>Achternaam</strong></label><input class="form-control" type="text" name="achternaam"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label for="username"><strong>Email</strong></label><input class="form-control" type="email" name="email"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label for="first_name"><strong>Straat & Huisnummer</strong></label><input class="form-control" type="text" name="straathuis"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label for="last_name"><strong>Stad</strong></label><input class="form-control" type="text" name="stad"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label for="first_name"><strong>Provincie</strong></label><input class="form-control" type="text" name="provincie"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label for="first_name"><strong>Postcode</strong></label><input class="form-control" type="text" name="postcode"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="first_name"><strong>Betaalmethode</strong></label>
                                <select class='form-control form-control-lg mb-3' name="betaalmethode">
                                    <option>Paypal</option>
                                    <option>IDEAL</option>
                                    <option>Creditcard</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-primary" style="width: 100%;" type="submit">Bestel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>