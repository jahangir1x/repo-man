<?php
class Git
{
    // Check if remote repository is ahead of local repository
    public static function isRemoteAhead($folder): bool
    {

        if (Utils::isValidDirectory($folder)) {
            $output = shell_exec("git -C " . $folder . " fetch --dry-run; git -C " . $folder . " status -uno" . " 2>&1");
            return strpos($output, 'Your branch is behind') !== false;
        } else {
            return false;
        }
    }

    // Pull updates from remote repository (discard local changes)
    public static function pull($folder): void
    {
        if (Utils::isValidDirectory($folder)) {
            shell_exec("git -C " . $folder . " --rest HEAD; git -C " . $folder . " pull" . " 2>&1");
        }
    }

    // Get remote repository URL
    public static function getRemoteUrl($folder): string
    {
        if (Utils::isValidDirectory($folder)) {
            return shell_exec("git -C " . $folder . " config --get remote.origin.url" . " 2>&1");
        } else {
            return "o_O could not find url";
        }
    }
}