<!DOCTYPE html>
<html>
<head>
    <title>Add New Article</title>
</head>
<body>

<h2>Add New Article</h2>
<form action="create_article.php" method="post">
    <label>Title:</label><br>
    <input type="text" name="title" required><br>
    <label>Content:</label><br>
    <textarea name="content" rows="4" cols="50" required></textarea><br>
    <input type="submit" value="Save">
</form>

</body>
</html>
