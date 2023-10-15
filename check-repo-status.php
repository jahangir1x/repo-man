<!DOCTYPE html>
<html>

<head>
    <title>Git Update Checker</title>
</head>

<body>
    <?php
    // Define the base directory where your PHP file resides
    // $baseDir = __DIR__;
    $baseDir = '/var/www/html';

    // Function to execute Git commands
    function gitCommand($command, $dir = null)
    {
        $dir = $dir ? " -C $dir" : '';
        $fullCommand = "git$dir $command";
        return shell_exec($fullCommand);
    }

    // Get list of folders in the base directory
    $folders = array_filter(glob($baseDir . '/*'), 'is_dir');

    // Process each folder
    foreach ($folders as $folder) {
        $folderName = basename($folder);

        // Check if the folder is a Git repository
        if (is_dir($folder . '/.git')) {
            echo "<h2>Folder: $folderName</h2>";

            // Check if remote repository is ahead of local repository
            gitCommand('fetch --dry-run', $folder); // Update remote tracking branch (origin/main)
            $status = gitCommand('status -uno', $folder);
            if (strpos($status, 'Your branch is behind') !== false) {
                echo '<p>Remote repository is ahead of local repository.</p>';
                echo '<form method="post" action="index.php">';
                echo "<input type='hidden' name='folder' value='$folderName'>";
                echo '<button type="submit" name="action" value="check">Check for Updates</button>';
                echo '<button type="submit" name="action" value="pull">Pull Updates</button>';
                echo '<button type="submit" name="action" value="discard">Discard Changes</button>';
                echo '</form>';
            } else {
                echo '<p>Local repository is up-to-date with remote repository.</p>';
            }
        }
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['folder'])) {
        $folderName = $_POST['folder'];
        $action = $_POST['action'];

        // Execute Git pull command
        if ($action === 'pull') {
            $output = gitCommand('pull', $baseDir . '/' . $folderName);
            echo '<pre>' . $output . '</pre>';
        }
        // Check for updates
        elseif ($action === 'check') {
            $output = gitCommand('fetch -p && git status -uno', $baseDir . '/' . $folderName);
            echo '<pre>' . $output . '</pre>';
        }
        // Discard local changes
        elseif ($action === 'discard') {
            $output = gitCommand('reset --hard HEAD', $baseDir . '/' . $folderName);
            echo '<pre>' . $output . '</pre>';
            echo '<p>Local changes have been discarded.</p>';
        }
    }
    ?>
</body>

</html>