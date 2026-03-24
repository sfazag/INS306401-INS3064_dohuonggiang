<?php
// utils.php

/**
 * Strips whitespace and escapes special characters to prevent XSS.
 */
function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Validates email format using PHP's built-in filter.
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Checks if a string length is within a specific range.
 */
function validateLength($str, $min, $max) {
    $len = strlen($str);
    return ($len >= $min && $len <= $max);
}

/**
 * Checks for at least 8 chars and at least one special character.
 */
function validatePassword($pass) {
    $hasMinLength = strlen($pass) >= 8;
    $hasSpecialChar = preg_match('/[\W]/', $pass); // \W matches any non-word character
    return $hasMinLength && $hasSpecialChar;
}