<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article_id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

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
    $sql = "UPDATE articles SET title=?, content=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $article_id);

    if ($stmt->execute() === TRUE) {
        echo "Article updated successfully";
    } else {
        echo "Error updating article: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
