<?php
require_once 'Config.php';

class Utils
{
    private static $repoList;
    public static function init(): void
    {
        self::$repoList = array_filter(glob(self::getBaseDirectory() . '/*'), function ($folder) {
            return is_dir($folder . '/.git');
        });
    }
    public static function getAllRepoFolders(): array
    {
        return self::$repoList;
    }

    public static function getBaseDirectory(): string
    {
        return realpath(Config::$baseDirectory);
    }

    public static function isValidDirectory($folder): bool
    {
        return in_array($folder, self::getAllRepoFolders());
    }
}