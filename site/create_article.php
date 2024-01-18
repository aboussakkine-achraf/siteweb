<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);

    // Database connection details
    $hostname = "localhost";
    $username = "root";
    $password = "aboussakkine";
    $database = "aboussakkine";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO articles (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute() === TRUE) {
        echo "Article created successfully";
    } else {
        echo "Error creating article: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
