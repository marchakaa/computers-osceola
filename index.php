<?php
    require 'connections.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header"><p>OSCEOLA<br>Computers</p></div>
    <div class="selector-menu">
        <div class="selector devices">
            <p>Devices</p>
            <div class="options">
                <div>PCs</div>
                <div>Laptops</div>
                <div>Phones</div>
                <div>Tablets</div>
            </div>
        </div>

        <div class="selector devices">
            <p>Hardware</p>
            <div class="options">
                <div>Motherboards</div>
                <div>Processors</div>
                <div>Graphic Cards</div>
                <div>RAM</div>
                <div>Power Supply</div>
                <div>Storage</div>
            </div>
        </div>

        <div class="selector devices">
            <p>Accessories</p>
            <div class="options">
                <div>Mouses</div>
                <div>Keyboards</div>
                <div>Headphones</div>
                <div>Microphones</div>
                <div>Monitors</div>
            </div>
        </div>

    </div> 

    <div class="store">
        <p class="selectors"></p>
        <ul class="items">
            <?php

                $selectParam =  "All";
                $categorieParam =  "All";
                $url = $_SERVER['REQUEST_URI'];
                $url_components = parse_url($url);
                parse_str($url_components['query'], $params);
                // echo $params['select'];
                $selectParam =  $params['select'];
                $categorieParam =  $params['categorie'];
                // echo $categorieParam;
                
                if ($selectParam == "") $selectParam = "All";
                if ($categorieParam == "") $categorieParam = "All";

                $sql = "SELECT name, price FROM $categorieParam";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // echo "Name: " . $row["name"] . "<br>"; 
                        echo '<a>' .
                        '<p class="item-price">' . $row["price"] . ' лв.</p>' .
                        '<p class="item-name">' . $row["name"] . '</p>' .
                    '</a>';
                    }
                }
            ?>
        </ul>
    </div>
    <div class="images">
    <?php 
        //Display Images from CloudInary
        $sql = "SELECT * FROM `$categorieParam`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                
                echo '<p class="imageUrl">' . $row["image"] . '</p>';
            }
        }

    ?>
    </div>
    <script src="scripts.js"></script>
</body>
</html>