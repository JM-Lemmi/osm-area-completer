<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    if (isset($_GET['project'])) {
        $projectFolder = $_GET['project'];
        $uploadDir = 'projects/' . $projectFolder . '/';
    } else {
        http_response_code(400);
        echo "No project specified.";
        exit;
    }

    if (!is_dir($uploadDir)) {
        http_response_code(400);
        echo "Directory for project does not exist. This should not be the case.";
        exit;
    }

    $targetFile = $uploadDir . basename($_FILES['file']['name']);

    if (file_exists($targetFile)) {
        http_response_code(409);
        echo "File already exists.";
        exit;
    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        echo "Upload successful." . $targetFile;
    } else {
        http_response_code(500);
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    http_response_code(400);
    echo "No file uploaded or invalid request method.";
}
?>