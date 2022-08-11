<?php
    try {
        $user = '';
        $pass = '';

        $con = new PDO('mysql:host=localhost;dbname=seuDb', $user, $pass);

        return $con;
        
    } catch (PDOException $e) {
        $erroMsg = "Error!: " . $e->getMessage() . "<br/>";
        return $erroMsg;
        die();
    }
?>