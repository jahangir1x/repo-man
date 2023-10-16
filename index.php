<?php
require_once 'Git.php';
require_once 'Utils.php';
Utils::init();
?>
<!DOCTYPE html>
<html>

<head>
    <title>INDEX | jahangir1x</title>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body data-bs-theme="dark">
    <div class="container">
        <h3 class="display-6">All Repositories</h3>
        <table class="table table-striped">
            <tr>
                <th>Path</th>
                <th>Action</th>
                <th>Repository</th>
            </tr>
            <?php foreach (Utils::getAllRepoFolders() as $folder): ?>
                <tr>
                    <td><a href="<?= "../" . basename($folder) ?>">
                            <?= basename($folder) ?>
                        </a>
                    </td>
                    <td>
                        <div class="action">
                            <form class="check-repo-form">
                                <div class="result">
                                </div>
                                <input type='hidden' class='folder' value=<?= $folder ?>>
                                <button type="submit">Check for Updates</button>
                            </form>
                        </div>
                    </td>
                    <td>
                        <a href="<?= Git::getRemoteUrl($folder) ?>">
                            <?= Git::getRemoteUrl($folder) ?>
                        </a>
                    </td>
                    <!-- <form class="update-repo-form">
                        <div class="result">
                        </div>
                        <input type='hidden' class='folder' value=<?= $folder ?>>
                        <button type="submit">Update Repo</button>
                    </form> -->
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