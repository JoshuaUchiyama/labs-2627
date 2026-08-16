<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = 'uploads/';

// Create uploads folder if it does not exist
if (!file_exists($upload_directory)) {
    mkdir($upload_directory);
}

// Check if a file was uploaded
if (isset($_FILES['audio_file'])) {

    $file_name = $_FILES['audio_file']['name'];
    $temporary_file = $_FILES['audio_file']['tmp_name'];

    // Get the file extension
    $file_extension = strtolower(
        pathinfo($file_name, PATHINFO_EXTENSION)
    );

    // Only allow MP3 files
    if ($file_extension !== 'mp3') {
        die('Only MP3 files are allowed.');
    }

    // Create a unique filename
    $new_file_name = uniqid('audio_', true) . '.mp3';

    $uploaded_file = $upload_directory . $new_file_name;
    $relative_file = $relative_path . $new_file_name;

    // Move the uploaded file
    if (move_uploaded_file($temporary_file, $uploaded_file)) {

        echo '<h2>Audio uploaded successfully!</h2>';

        echo '<p>Uploaded file: '
            . htmlspecialchars($file_name)
            . '</p>';

        // Display the audio player
        echo '<audio controls>
                <source src="' . htmlspecialchars($relative_file) . '" type="audio/mpeg">
                Your browser does not support the audio element.
              </audio>';

    } else {

        echo 'Failed to upload file.';

    }

} else {

    echo 'No file was uploaded.';

}
?>