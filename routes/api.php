<?php

use Illuminate\Support\Facades\Route;
use Modules\File\Http\Controllers\FileController;

Route::post(
    uri: 'file/upload',
    action: [FileController::class, 'upload'],
)->name(name: 'file.upload')
->middleware(['throttle:5,1']);
