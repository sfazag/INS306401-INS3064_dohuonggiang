<?php
// Lấy giá trị từ GET (nếu tồn tại)
$query = isset($_GET['q']) ? $_GET['q'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Simple Search</title>
</head>
<body>

<h2>Search Page</h2>

<form method="GET" action="">
    <input 
        type="text" 
        name="q" 
        placeholder="Enter search term..."
        value="<?php echo htmlspecialchars($query); ?>"
    >
    <button type="submit">Search</button>
</form>

<?php
// Nếu có nhập dữ liệu thì hiển thị
if (!empty($query)) {
    echo "<p>You searched for: <strong>" . htmlspecialchars($query) . "</strong></p>";
}
?>

</body>
</html>