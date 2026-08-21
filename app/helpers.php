<?php

declare(strict_types=1);

function project_path(string $path = ''): string
{
    $root = dirname(__DIR__);
    return $path === '' ? $root : $root . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function ensure_empty_directory(string $directory): void
{
    if (is_dir($directory)) {
        remove_directory_contents($directory);
        return;
    }

    if (!mkdir($directory, 0775, true) && !is_dir($directory)) {
        throw new RuntimeException("Impossible de créer le dossier: {$directory}");
    }
}

function remove_directory_contents(string $directory): void
{
    $items = new FilesystemIterator($directory, FilesystemIterator::SKIP_DOTS);

    foreach ($items as $item) {
        $path = $item->getPathname();
        if ($item->isDir() && !$item->isLink()) {
            remove_directory_contents($path);
            if (!rmdir($path)) {
                throw new RuntimeException("Impossible de supprimer le dossier: {$path}");
            }
            continue;
        }

        if (!unlink($path)) {
            throw new RuntimeException("Impossible de supprimer le fichier: {$path}");
        }
    }
}

function copy_file(string $source, string $target): void
{
    if (!is_file($source)) {
        throw new RuntimeException("Fichier introuvable: {$source}");
    }

    $targetDirectory = dirname($target);
    if (!is_dir($targetDirectory) && !mkdir($targetDirectory, 0775, true) && !is_dir($targetDirectory)) {
        throw new RuntimeException("Impossible de créer le dossier: {$targetDirectory}");
    }

    if (!copy($source, $target)) {
        throw new RuntimeException("Impossible de copier {$source} vers {$target}");
    }
}

function copy_directory(string $source, string $target): void
{
    if (!is_dir($source)) {
        throw new RuntimeException("Dossier introuvable: {$source}");
    }

    if (!is_dir($target) && !mkdir($target, 0775, true) && !is_dir($target)) {
        throw new RuntimeException("Impossible de créer le dossier: {$target}");
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $item) {
        $destination = $target . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        if ($item->isDir()) {
            if (!is_dir($destination) && !mkdir($destination, 0775, true) && !is_dir($destination)) {
                throw new RuntimeException("Impossible de créer le dossier: {$destination}");
            }
            continue;
        }

        copy_file($item->getPathname(), $destination);
    }
}

function write_file(string $path, string $contents): void
{
    $directory = dirname($path);
    if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
        throw new RuntimeException("Impossible de créer le dossier: {$directory}");
    }

    if (file_put_contents($path, $contents) === false) {
        throw new RuntimeException("Impossible d'écrire le fichier: {$path}");
    }
}
