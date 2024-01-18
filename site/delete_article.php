<!DOCTYPE html>
<html>
<head>
    <title>Delete Article</title>
</head>
<body>

<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $article_id = $_GET['id'];

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
    $sql = "DELETE FROM articles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $article_id);

    if ($stmt->execute() === TRUE) {
        echo "Article deleted successfully";
    } else {
        echo "Error deleting article: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid article ID";
}
?>

</body>
</html>
