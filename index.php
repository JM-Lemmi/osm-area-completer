<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Projects</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Project Name</th>
                    <th scope="col">Track Count</th>
                    <th scope="col">Latest Change</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="projects-table-body">
            <?php
                $directory = 'projects/';
                $folders = array_filter(glob($directory . '*'), 'is_dir');
                $projects = [];

                foreach ($folders as $folder) {
                    $files = glob($folder . '/*');
                    $fileCount = count(array_filter($files, function ($file) {
                        return pathinfo($file, PATHINFO_EXTENSION) === 'gpx';
                    }));
                    $newestFile = array_reduce($files, function ($newest, $file) {
                        return filemtime($file) > filemtime($newest) ? $file : $newest;
                    }, $files[0]);

                    echo '<tr>';
                    echo '<td><a href="map.html?project=' . basename($folder) . '">' . basename($folder) . '</a></td>';
                    echo '<td>' . ($fileCount) . '</td>';
                    echo '<td>' . date('Y-m-d H:i:s', filemtime($newestFile)) . '</td>';
                    echo '<td>unknown</td>';
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
