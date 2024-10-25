<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST["user_id"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    
    try{
        require_once "database_conn.php";
        
        $query = "UPDATE users_asd SET username = :username, email= :email, pwd = :pwd WHERE id = 2;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $user_id);
        $stmt->bindParam(":email", $email);
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