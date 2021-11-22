<?php

    require 'vendor/autoload.php';
    use Cloudinary\Configuration\Configuration;

    //CloudInary
    Configuration::instance([
        'cloud' => [
        'cloud_name' => 'dj367yxj5', 
        'api_key' => '484875859996143', 
        'api_secret' => '02niOiWY-55X7qyutZ32dsN3OIE'],
        'url' => [
        'secure' => true]]);


    // $data = (new UploadApi())->upload( "https://gplay.bg/UserFiles/Product/gallery_1/18af9316-de6c-b266-a446-8afa74ad8da5.jpg?w=640&h=640&block&cache",
    // ["folder" => "computers", "public_id" => "IMG_486.jpg"]);

    $serverDb = "localhost";
    $userDb = "root";
    $passwordDb = "";
    $database = "computersdb";
    // $serverDb = "sql303.epizy.com";
    // $userDb = "epiz_30416031";
    // $passwordDb = "UfH4nXoMIMKMK9";
    // $database = "epiz_30416031_computersdb";
    $conn = new mysqli($serverDb, $userDb, $passwordDb, $database);
?>