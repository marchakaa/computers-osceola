<?php
    require '../connections.php';
    $url = $_SERVER['REQUEST_URI'];
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    $itemParam =  $params['item'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
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
    <div class="item">
        <div class="buttons">
            <?php
                //Name
                $sql = "SELECT * FROM `processors` WHERE image='$itemParam'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo '<p class="name">' . $row["name"] . "</p>";
                }

            ?>
            <div class="image"></div>
            <div class="purchase-button">
                <?php
                    //Price
                    $sql = "SELECT * FROM `processors` WHERE image='$itemParam'";
                    $result = $conn->query($sql);
                    
                    while ($row = $result->fetch_assoc()) {
                        echo '<p class="price">' . $row["price"] . " лв.</p>";
                    }
                ?>
                <div>ADD TO CART</div>
                <ion-icon name="cart-outline"></ion-icon>
            </div>
            
        </div>
        <div class="text">
            <?php
                $sql = "SHOW COLUMNS FROM `processors`";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $field = $row["Field"];
                    if ($field != "id" && $field != "image" && $field != "price" && $field != "available" && $field != "sold" && $field != "name") {
                        echo "<p>" . ucfirst($field) . ': </p><br>';
                    }
                }
            ?>
        </div>
        <div class="values">
            <?php
                $sql = "SHOW COLUMNS FROM `processors`";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $field = $row["Field"];
                    if ($field != "id" && $field != "image" && $field != "price" && $field != "available" && $field != "sold" && $field != "name") {
                        
                        $sql = "SELECT `$field` FROM `processors` WHERE image='$itemParam'";
                        $result1 = $conn->query($sql);
                        while ($row1 = $result1->fetch_assoc()) {
                            if ($field == "socket" || $field == "chipset" || $field == "series" || $field == "brand") {
                                $sql = "SELECT name FROM $field WHERE id = '$row1[$field]'";
                                $result2 = $conn->query($sql);
                                while ($row2 = $result2->fetch_assoc()) {
                                    echo "<p>" . $row2["name"] . "</p><br>";
                                }
                            } else {
                                echo "<p>" . $row1[$field] . "</p><br>";
                                
                            }
                        }
                    }
                }
            ?>
        </div>
    </div>
    <script src="scripts.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>