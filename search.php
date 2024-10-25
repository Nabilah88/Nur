<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userSearch = $_POST["usersearch"];

    try{
        require_once "database_conn.php";
        
        $query = "SELECT * FROM comments WHERE username = :usersearch;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":usersearch", $userSearch);
       
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;    

    } catch (PDOException $e) {
        die("Query failed:" . $e->getMessage());
    }
}else {
    header("Location: ../search_form.php");  
}

?>

<style>
body{
    font-family:Arial, Helvetica, sans-serif;
    height: 100vh;
    background-color: rgb(185, 140, 228);
}

h3{
    text-align:center;
    font-size: 16px;
    font-weight:600;
    color:black;

}

 </style>


<html>
    <head>
        <title>Search</title>
</head>
<body>
    <section>
    <h3>Search Results:</h3>
    <?php

    if(empty($results)) {
        echo "<div>";
        echo "<p>There were no results!</p>";
        echo "</div>";
    } else {
        foreach ($results as $row) {
            echo "<div>";
            echo "<h4>". htmlspecialchars($row["username"]) . "</h4>";
            echo "<p>". htmlspecialchars($row["comment_text"]) . "</p>";
            echo "<p>". htmlspecialchars($row["created_at"]) . "</p>";
            echo "</div>";
        }
    }

    ?>
    </section>

</body>
</html>