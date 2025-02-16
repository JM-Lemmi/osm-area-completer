<?php
$project = isset($_GET['project']) ? $_GET['project'] : '';

if ($project && is_dir('projects/'. $project)) {
    $files = scandir('./projects/'. $project);
    $gpxFiles = array_filter($files, function($file) use ($project) {
        return pathinfo($file, PATHINFO_EXTENSION) === 'gpx';
    });

    echo json_encode(array_values($gpxFiles));
} else {
    http_response_code(404);
    header('X-Error: Project not found');
    echo json_encode([]);
}
?>
