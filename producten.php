<!DOCTYPE HTML>
<html>
<head>
    <title>DeDemiFanShop.nl | Home</title>
    <?php include("config.php") ?> <!-- Include the Config file -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
</head>
<body>

<!-- Navigatie -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">DeDemiFanShop.nl</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><svg class="bi bi-house-door-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 10.995V14.5a.5.5 0 01-.5.5H2a.5.5 0 01-.5-.5v-7a.5.5 0 01.146-.354l6-6a.5.5 0 01.708 0l6 6a.5.5 0 01.146.354v7a.5.5 0 01-.5.5h-4a.5.5 0 01-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
                        <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5z" clip-rule="evenodd"/>
                    </svg> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class=<?php
            $category = $_GET['cat'];
            if(!empty($category)){
                echo "'nav-item dropdown active'";
            }else{
                echo "'nav-item dropdown'";
            }
            ?>>
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
            <li class=<?php
            $phoneBrand = $_GET['phoneBrand'];
            if(!empty($phoneBrand)){
                echo "'nav-item dropdown active'";
            }else{
                echo "'nav-item dropdown'";
            }
            ?>>
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
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">&#128722;</button>
        </form>
    </div>
</nav>


<!-- De Producten -->
<?php
$cat = $_GET['cat'];
$merk = $_GET['phoneBrand'];

if(!empty($cat) && empty($merk)){
    $sql = "SELECT * FROM product WHERE categorie_naam = '$cat'";
}elseif(empty($cat) && !empty($merk)){
    $sql = "SELECT * FROM product WHERE telefoonmerk = '$merk'";
}else{
    $sql = "SELECT * FROM product WHERE telefoonmerk = 'merk' AND categorie_naam = '$cat'";
}


$result = $conn->query($sql);

echo '<div class="container-fluid">';
echo '<div class="row" style="margin: 0;">';

while($row = $result->fetch_assoc()){
    $naamproduct = substr($row['product_naam'],0,23);
    $descriptie = substr($row['description'],0,71) . '...';

    echo '<div class="col" style="margin: 10px;">';
    echo '<div class="card animated fadeIn" style="width: 20rem; height: 500px;">';
    echo '<img src="' . $row['image'] . '" class="card-img-top" style="height: 300px;">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $naamproduct . '</h5>';
    echo '<p class="card-text">' . $descriptie . '</p>';
    echo '<a href="addProduct.php?id=' . $row['id'] . '" class="btn btn-primary">Bestel</a>';
    echo '<p style="float: right;color: gray;">' . '&#8364;' . $row['prijs'] . "</p>";
    echo '</div></div></div>';
}

echo '</div></div>';

?>


<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>