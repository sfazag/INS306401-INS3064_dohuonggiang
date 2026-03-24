<?php
/**
 * Secure Avatar Upload Script
 * Objectives: Handle binary data, validate MIME/Size, and rename to Unique ID.
 */

// 1. Check if the request is a POST and the file exists
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    
    $file = $_FILES['avatar'];
    $uploadDir = 'uploads/';
    
    // Create directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // 2. Validate PHP Upload Errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors = [
            UPLOAD_ERR_INI_SIZE   => "File exceeds upload_max_filesize in php.ini.",
            UPLOAD_ERR_FORM_SIZE  => "File exceeds MAX_FILE_SIZE in HTML form.",
            UPLOAD_ERR_PARTIAL    => "File was only partially uploaded.",
            UPLOAD_ERR_NO_FILE    => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        ];
        die("System Error: " . ($errors[$file['error']] ?? "Unknown upload error."));
    }

    // 3. Validate Size (Max 2MB: 2 * 1024 * 1024 bytes)
    $maxSize = 2 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        die("Validation Error: File size exceeds the 2MB limit.");
    }

    // 4. Validate MIME Type (Using finfo for security)
    $allowedMimes = ['image/jpeg', 'image/png'];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $detectedMime = $finfo->file($file['tmp_name']);

    if (!in_array($detectedMime, $allowedMimes)) {
        die("Validation Error: Only image/jpeg and image/png are allowed.");
    }

    // 5. Generate Unique ID filename to prevent overwrites
    // We determine the extension based on the actual MIME type
    $extension = ($detectedMime === 'image/jpeg') ? '.jpg' : '.png';
    $uniqueName = bin2hex(random_bytes(10)) . '_' . time() . $extension;
    $destination = $uploadDir . $uniqueName;

    // 6. Move the file from temp storage to destination
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        echo "<h2>Upload Successful!</h2>";
        echo "Saved as: " . htmlspecialchars($uniqueName);
    } else {
        echo "Error: Could not move the file. Check folder permissions.";
    }

} else {
    // Redirect or error if accessed directly without a form submission
    echo "Please use the upload form to submit your avatar.";
}
?>