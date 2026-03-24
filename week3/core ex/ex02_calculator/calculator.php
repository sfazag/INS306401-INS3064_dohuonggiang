<?php
$result = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $num1 = $_POST["num1"] ?? "";
    $num2 = $_POST["num2"] ?? "";
    $operator = $_POST["operator"] ?? "";

    // Check empty
    if ($num1 === "" || $num2 === "") {
        $error = "Missing Data";
    }
    // Check numeric
    elseif (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Inputs must be numeric.";
    }
    else {
        $num1 = (float)$num1;
        $num2 = (float)$num2;

        switch ($operator) {
            case "+":
                $calc = $num1 + $num2;
                break;
            case "-":
                $calc = $num1 - $num2;
                break;
            case "*":
                $calc = $num1 * $num2;
                break;
            case "/":
                if ($num2 == 0) {
                    $error = "Cannot divide by zero.";
                } else {
                    $calc = $num1 / $num2;
                }
                break;
            default:
                $error = "Invalid operator.";
        }

        if (!$error) {
            $result = "$num1 $operator $num2 = $calc";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Arithmetic Calculator</title>
</head>
<body>

<h2>Arithmetic Calculator</h2>

<form method="POST" action="">
    <input type="number" name="num1" step="any" required>

    <select name="operator">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>

    <input type="number" name="num2" step="any" required>

    <button type="submit">Calculate</button>
</form>

<br>

<?php
if ($error) {
    echo "<p style='color:red;'>$error</p>";
}

if ($result) {
    echo "<p style='color:green;'>$result</p>";
}
?>

</body>
</html>