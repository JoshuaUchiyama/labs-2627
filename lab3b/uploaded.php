<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = 'uploads/';

// Create uploads folder if it does not exist
if (!file_exists($upload_directory)) {
    mkdir($upload_directory);
}

// Check if a file was uploaded
if (isset($_FILES['image_file'])) {

    $file_name = $_FILES['image_file']['name'];
    $temporary_file = $_FILES['image_file']['tmp_name'];

    // Get the file extension
    $file_extension = strtolower(
        pathinfo($file_name, PATHINFO_EXTENSION)
    );

    // Allowed image extensions
    $allowed_extensions = [
        'jpg',
        'jpeg',
        'png',
        'gif',
        'webp'
    ];

    // Check if the file is an image
    if (!in_array($file_extension, $allowed_extensions)) {
        die('Only image files are allowed.');
    }

    // Create a unique filename
    $new_file_name = uniqid('image_', true) . '.' . $file_extension;

    $uploaded_file = $upload_directory . $new_file_name;
    $relative_file = $relative_path . $new_file_name;

    // Move the uploaded file
    if (move_uploaded_file($temporary_file, $uploaded_file)) {

        echo '<h2>Image uploaded successfully!</h2>';

        echo '<p>Uploaded file: '
            . htmlspecialchars($file_name)
            . '</p>';

        // Display the uploaded image
        echo '<img
                src="' . htmlspecialchars($relative_file) . '"
                alt="Uploaded image"
                style="max-width: 800px; height: auto;">';

    } else {

        echo 'Failed to upload file.';

    }

} else {

    echo 'No file was uploaded.';

}

?>