<?php
$value = "25.50";

$floatVal = (float)$value;
$intVal   = (int)$floatVal;

echo gettype($floatVal) . "(" . $floatVal . "), ";
echo gettype($intVal) . "(" . $intVal . ")";
?>
