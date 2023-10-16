<?php
require_once 'Git.php';
require_once 'Utils.php';
Utils::init();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>repo-man</title>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="description" content="Personal PHP projects with github repository" />
    <meta name="keywords" content="PHP, Github, GitHub with checking" />
    <meta name="author" content="Jahangir Alam Rocky" />
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="google" content="notranslate" />

    <link id="favicon" rel="icon" href="" />

    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body data-bs-theme="dark">
    <div class="container">
        <div class="text-center py-3">
            <a class="display-6 heading" href="https://github.com/jahangir1x/repo-man" target="_blank">
                Repository Manager 🛠️
            </a>
            <br>
            <i class="description">A PHP-powered tool to stay up-to-date with remote repositories.</i>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Path</th>
                <th>Action</th>
                <th>Repository</th>
            </tr>
    </div>
    <?php foreach (Utils::getAllRepoFolders() as $folder): ?>
        <tr id=<?= $folder ?>>
            <td class="path-url"><a href="<?= "../" . basename($folder) ?>" target="_blank">
                    <?= basename($folder) ?>
                </a>
                <div class="spinner"></div>
                <div class="check"><i class="fas fa-check-circle fa-2x"></i></div>
                <div class="cross"><i class="fas fa-times fa-2x"></i></div>
            </td>
            <td>
                <form class="check-repo-form">
                    <input type="hidden" class="folder" value=<?= $folder ?>>
                    <button class="btn btn-primary btn-sm check-btn" type="submit">Check again</button>
                </form>
                <form class="update-repo-form">
                    <input type='hidden' class='folder' value=<?= $folder ?>>
                    <button class="btn btn-warning btn-sm update-btn" type="submit">Sync with remote</button>
                </form>
            </td>
            <td>
                <a href="<?= Git::getRemoteUrl($folder) ?>" target="_blank">
                    <?= Git::getRemoteUrl($folder) ?>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

</body>

</html>