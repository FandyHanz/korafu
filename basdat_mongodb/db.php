<?php
require 'vendor/autoload.php'; 

function connectToMongoDB() {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    return $client->basdatlanj;
}

?>