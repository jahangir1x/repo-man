<?php
class Git
{
    // Check if remote repository is ahead of local repository
    public static function isRemoteAhead($folder): bool
    {

        if (Utils::isValidDirectory($folder)) {
            $fullCommand = "git -C " . $folder . " fetch --dry-run; git -C " . $folder . " status -uno" . " 2>&1";
            $output = shell_exec($fullCommand);
            return strpos($output, 'Your branch is behind') !== false;
        } else {
            return false;
        }
    }

    // Pull updates from remote repository (discard local changes)
    public static function pull($folder): void
    {
        if (Utils::isValidDirectory($folder)) {
            $fullCommand = "git -C " . $folder . " --rest HEAD; git -C " . $folder . " pull" . " 2>&1";
            shell_exec($fullCommand);
        }
    }
}