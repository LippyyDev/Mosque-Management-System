<?php
// Script migrasi file foto profil dari writable/uploads/profiles ke public/uploads/profiles

$from = __DIR__ . '/../writable/uploads/profiles/';
$to = __DIR__ . '/uploads/profiles/';

if (!is_dir($from)) {
    echo "Folder asal ($from) tidak ditemukan.\n";
    exit;
}
if (!is_dir($to)) {
    mkdir($to, 0777, true);
}

$files = scandir($from);
$count = 0;
foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;
    $fromFile = $from . $file;
    $toFile = $to . $file;
    if (is_file($fromFile)) {
        if (file_exists($toFile)) {
            echo "Lewati: $file sudah ada di public/uploads/profiles\n";
            continue;
        }
        if (rename($fromFile, $toFile)) {
            echo "Berhasil pindah: $file\n";
            $count++;
        } else {
            echo "Gagal pindah: $file\n";
        }
    }
}
echo "\nTotal file dipindah: $count\n"; 