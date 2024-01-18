<!DOCTYPE html>
<html>
<head>
    <title>Edit Article</title>
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
    $sql = "SELECT * FROM articles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $article_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display a form pre-populated with article data for editing
        ?>
        <h2>Edit Article</h2>
        <form action="update_article.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label>Title:</label><br>
            <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required><br>
            <label>Content:</label><br>
            <textarea name="content" rows="4" cols="50" required><?php echo htmlspecialchars($row['content']); ?></textarea><br>
            <input type="submit" value="Update">
        </form>
        <?php
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
