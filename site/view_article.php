<!DOCTYPE html>
<html>
<head>
    <title>View Article</title>
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

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM articles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $article_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";  // Prevent XSS attacks
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";  // Preserve line breaks and prevent XSS
    } else {
        echo "Article not found";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid article ID";
}
?>

</body>
</html>
