<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST["user_id"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    
    try{
        require_once "database_conn.php";
        
        $query = "INSERT INTO users_asd (username, email, pwd) VALUES (:username, :email, :pwd);";

        $stmt = $pdo->prepare($query);

        $options = [
            'cost' => 12
        ];
        
        $hashedPwd = password_hash($pass, PASSWORD_BCRYPT, $options);

        $stmt->bindParam(":username", $user_id);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pwd", $hashedPwd);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../Study/sign_up.html");

        die();

    } catch (PDOException $e) {
        die("Query failed:" . $e->getMessage());
    }
}else{
    header("Location: ../Study/sign_up.html");  
    
}
