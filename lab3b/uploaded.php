<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = 'uploads/';

// Create uploads folder if it does not exist
if (!file_exists($upload_directory)) {
    mkdir($upload_directory);
}

// Check if a file was uploaded
if (isset($_FILES['pdf_file'])) {

    $file_name = $_FILES['pdf_file']['name'];
    $temporary_file = $_FILES['pdf_file']['tmp_name'];

    // Get the original file extension
    $file_extension = strtolower(
        pathinfo($file_name, PATHINFO_EXTENSION)
    );

    // Only allow PDF files
    if ($file_extension !== 'pdf') {
        die('Only PDF files are allowed.');
    }

    // Create a unique file name so existing files are not overwritten
    $new_file_name = uniqid('pdf_', true) . '.pdf';

    $uploaded_file = $upload_directory . $new_file_name;
    $relative_file = $relative_path . $new_file_name;

    // Move the uploaded file
    if (move_uploaded_file($temporary_file, $uploaded_file)) {

        echo '<h2>PDF uploaded successfully!</h2>';

        echo '<p>Uploaded file: '
            . htmlspecialchars($file_name)
            . '</p>';

        // Display the PDF
        echo '<iframe
                src="' . htmlspecialchars($relative_file) . '"
                width="100%"
                height="700px">
              </iframe>';

    } else {

        echo 'Failed to upload file.';

    }

} else {

    echo 'No file was uploaded.';

}
?>