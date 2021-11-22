<?php
    require '../connections.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <select name="table" class="table">
            <option value="processors">Processors</option>
            <option value="motherboards">Motherboards</option>
            <option value="gpus">Graphic Cards</option>
            <option value="ram">RAM</option>
            <option value="psu">PSU</option>
            <option value="storage">Storage</option>
        </select>
        <input type="submit" name="change" value="Change" class="change"><br>
        <?php
            
            // $url = $_SERVER['REQUEST_URI'];
            // $url_components = parse_url($url);
            // parse_str($url_components['query'], $params);
            // $table =  $params['table'];
            // $sql = "SHOW COLUMNS FROM `$table`";
            // $result = $conn->query($sql);
            // while ($row = $result->fetch_assoc()) {
            //     $field = $row["Field"];
            //     if ($field != "id") {
            //         echo $field;
            //         if ($field == "socket" || $field == "series" || $field == "chipset" || $field == "brand") {
            //             echo ucfirst($field) . ": " . '<select name="' . $field . '" class="' . $field . '"></select>';
            //         } else {
            //             echo ucfirst($field) . ": " . '<input type="text" class="' . $field . '" name="' . $field . '" required><br>';
            //         }
            //     }
            // }

        ?>
        Name: <input type="text" class="name" name="name" required><br>
        Price: <input type="text" class="price" name="price" required><br>
        Available: <input type="text" class="available" name="available" value="10" required><br>
        Sold: <input type="text" class="sold" name="sold" value="0" required><br>
        Frequency: <input type="text" class="frequency" name="frequency" required><br>
        Max-Frequency: <input type="text" class="max-frequency" name="max-frequency" required><br>
        Logic-cores: <input type="text" class="login-cores" name="logic-cores" required><br>
        Physical-cores<input type="text" class="physical-cores" name="physical-cores" required><br>
        Generation: <input type="text" class="generation" name="generation" required><br>
        Image URL: <input type="text" class="image" name="image" required><br>
        <?php

            //Brand Select Menu
            echo 'Brand: <select name="brand" class="brand">';
            $sql = "SELECT * FROM `brand`";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["id"] . '">' . $row["id"] . ". " . $row["name"] . "</option>";
            }
            echo "</select><br>";

            //Socket Select Menu
            echo 'Socket: <select name="socket" class="socket">';
            $sql = "SELECT * FROM `socket`";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["id"] . '">' . $row["id"] . ". " . $row["name"] . "</option>";
            }
            echo "</select><br>";

            //Series Select Menu
            echo 'Series: <select name="series" class="series">';
            $sql = "SELECT * FROM `series`";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["id"] . '">' . $row["id"] . ". " . $row["name"] . "</option>";
            }
            echo "</select><br>";
        ?>
        <input type="submit" name="submit"><br>
    </form>
    <?php 
        use Cloudinary\Api\Upload\UploadApi;

        if (isset($_POST["submit"])) {
            $table = $_POST["table"];
            $item_name = $_POST["name"];
            $item_price = $_POST["price"];
            $item_available = $_POST["available"];
            $item_sold = $_POST["sold"];
            $item_frequency = $_POST["frequency"];
            $item_max_frequency = $_POST["max-frequency"];
            $item_logic_cores = $_POST["logic-cores"];
            $item_physical_cores = $_POST["physical-cores"];
            $item_generation = $_POST["generation"];
            $item_image = $_POST["image"];
            $item_brand = $_POST["brand"];
            $item_socket = $_POST["socket"];
            $item_series = $_POST["series"];
            $image_name = str_replace(' ', '', $item_name);

            $sql = "INSERT INTO `$table` (`name`, `price`, `available`, `sold`, `frequency`, `maxfrequency`, `logiccores`, `physicalcores`, `generation`, `image`, `brand`, `socket`, `series`)
            VALUES ('$item_name', '$item_price', '$item_available', '$item_sold', '$item_frequency', '$item_max_frequency', '$item_logic_cores', '$item_physical_cores', '$item_generation', '$image_name', '$item_brand', '$item_socket', '$item_series')";
            
            if ($conn->query($sql) === TRUE) {
                $data = (new UploadApi())->upload( $item_image,
                ["folder" => "computers", "public_id" => $image_name]);
                echo "<br>New record created successfully";
            } else {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>
    <script src="script.js"></script>
</body>
</html>