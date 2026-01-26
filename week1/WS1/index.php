<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .container {
            text-align: center;
            background: white;
            padding: 40px 60px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        p {
            color: #666;
        }
        .php-info {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 Hello đỗ hương giang!</h1>
        <p>Chào mừng bạn đến với môn INS306401</p>
        
        <div class="php-info">
            <?php
            // Hiển thị thông tin PHP
            echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
            echo "<p><strong>Server:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
            echo "<p><strong>Thời gian:</strong> " . date("d/m/Y H:i:s") . "</p>";
            ?>
        </div>
    </div>
</body>
</html>