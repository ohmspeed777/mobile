<?php

require "./connect.php";

$sql = "SELECT * FROM `brandproduct` order by `brand_id` ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();

$tabHeader = '';
$brand_id = $_GET['brand_id'] ?? 1;
$i = 1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($i == $brand_id) {
        $tabHeader .= <<<html
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./?brand_id=${row['brand_id']}">
                            ${row['brand_name']}</a>
                        </li>
                        html;
        
    } else {
        $tabHeader .= <<<html
                        <li class="nav-item">
                            <a class="nav-link" href="./?brand_id=${row['brand_id']}">${row['brand_name']}</a>
                        </li>
                        html;
    }

    $i++;
}


$sql = "SELECT * FROM `product` WHERE `brand_id` = '$brand_id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$tab_content = '';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $tab_content .= <<<html
                        <div class="col-4">
                            <div class="card">
                                <img src="img/${row['product_image']}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">${row['product_name']}</h5>
                                    <p class="card-text">Some quick example text to build on the card   title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    html;

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>

    <div class="container ">
        <h1 class="text-center">Mobiles</h1>
        <ul class="nav nav-pills justify-content-center mt-4">
            <?php echo $tabHeader; ?>
        </ul>
        <div class="row">
            <?php echo $tab_content; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>

</html>