<?php

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

if (!function_exists('tmp_files')) {
    function tmp_files(): FilesystemAdapter {
        return Storage::disk('tmp_files');
    }
}

if (!function_exists('upload_files')) {
    function upload_files(): FilesystemAdapter {
        return Storage::disk('upload_files');
    }
}
