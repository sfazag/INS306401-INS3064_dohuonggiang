<?php
// Determine which method was used to access the page
$method = $_SERVER['REQUEST_METHOD'];
$data = ($method === 'POST') ? $_POST : $_GET;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GET vs POST Toggle</title>
    <style>
        body { font-family: sans-serif; margin: 40px; line-height: 1.6; }
        .result-box { background: #f4f4f4; padding: 15px; border-left: 5px solid #333; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        pre { background: #eee; padding: 10px; }
    </style>
</head>
<body>

    <h2>HTTP Method Visualization</h2>

    <div class="result-box">
        <strong>Detected Method:</strong> <?php echo $method; ?><br>
        <strong>Superglobal Content:</strong>
        <?php if (!empty($data)): ?>
            <pre><?php print_r($data); ?></pre>
        <?php else: ?>
            <p>No data submitted yet.</p>
        <?php endif; ?>
    </div>

    <form id="toggleForm" action="method_toggle.php" method="GET">
        <div class="form-group">
            <label>Name:</label><br>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Select Method:</label><br>
            <input type="radio" name="method_choice" value="GET" checked onclick="updateMethod('GET')"> GET
            <input type="radio" name="method_choice" value="POST" onclick="updateMethod('POST')"> POST
        </div>

        <button type="submit">Submit Data</button>
    </form>

    <script>
        function updateMethod(method) {
            // Dynamically change the form's method attribute
            document.getElementById('toggleForm').method = method;
            console.log("Form method changed to: " + method);
        }
    </script>

</body>
</html>