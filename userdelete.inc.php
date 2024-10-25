<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST["user_id"];
    $pass = $_POST["pass"];

    
    try{
        require_once "database_conn.php";
        
        $query = "DELETE FROM users_asd WHERE username = :username AND pwd = :pwd;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $user_id);
        $stmt->bindParam(":pwd", $pass);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../Study/select_update.html");

        die();

    } catch (PDOException $e) {
        die("Query failed:" . $e->getMessage());
    }
}else{
    header("Location: ../log_in.html");  
}