<!DOCTYPE html>
<html>
<head>
    <title>Simple Blog</title>
</head>
<body>

<h2>Articles</h2>
<ul>
<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// MySQL connection details
$hostname = "localhost";
$username = "root";
$password = "aboussakkine";  // If you set a password, include it here
$database = "aboussakkine";  // Replace with your actual database name

// Create a new mysqli connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select articles
$sql = "SELECT id, title FROM articles";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Display articles
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li><a href="view_article.php?id=' . $row['id'] . '">' . $row['title'] . '</a> | 
        <a href="edit_article.php?id=' . $row['id'] . '">Edit</a> | 
        <a href="delete_article.php?id=' . $row['id'] . '">Delete</a></li>';
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
</ul>

<a href="add_article.php">Add New Article</a>

</body>
</html>
