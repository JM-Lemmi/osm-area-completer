<?php
// Get the project name from the parameters
$projectName = $_GET['project'] ?? null;

if ($projectName === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Project name is required']);
    exit;
}

// Get the JSON body
$jsonBody = file_get_contents('php://input');
$data = json_decode($jsonBody, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON body']);
    exit;
}

// Define the path to the project file
$projectFilePath = "projects/" . $projectName . "/areas.json";

// Load existing data
if (file_exists($projectFilePath)) {
    $existingData = json_decode(file_get_contents($projectFilePath), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(500);
        echo 'Failed to load existing data';
        exit;
    }
} else {
    $existingData = [];
}

// Add the new data to the existing data
$existingData[] = $data;

// Save the updated data back to the file
file_put_contents($projectFilePath, json_encode($existingData, JSON_PRETTY_PRINT));

http_response_code(200);
?>
