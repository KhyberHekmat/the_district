<?php

try {
    $host = "localhost";
    //$port = 0;
    $user = "admin";
    $pass = "Afpa1234";
    $dbname = "the_district";
    $conn = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: ". $e->getMessage();
}

?>