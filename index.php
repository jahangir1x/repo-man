<?php
require_once 'Utils.php';
Utils::init();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Git Update Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php foreach (Utils::getAllRepoFolders() as $folder): ?>
            <h2>Folder:
                <?= $folder ?>
            </h2>
            <form class="check-repo-form">
                <div class="result">
                </div>
                <input type='hidden' class='folder' value=<?= $folder ?>>
                <button type="submit">Check for Updates</button>
            </form>
            <form class="update-repo-form">
                <div class="result">
                </div>
                <input type='hidden' class='folder' value=<?= $folder ?>>
                <button type="submit">Update Repo</button>
            </form>
        <?php endforeach; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>