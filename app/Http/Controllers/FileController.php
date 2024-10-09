<?php

namespace Modules\File\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Modules\File\Http\Requests\UploadRequest;

/**
 * @tags File
 */
class FileController extends Controller
{
    /**
     * Upload
     *
     * @param UploadRequest $request
     * @return Response
     */
    public function upload(UploadRequest $request): Response
    {
        $storage = Storage::disk(name: 'tmp_files');

        /** @var \Illuminate\Filesystem\FilesystemAdapter $storage */
        $path = $storage->putFile(path: $request->file(key: 'file'));

        $expiration = now()->addHour();
        $temporaryUrl = $storage->temporaryUrl(
            path: $path,
            expiration: $expiration,
        );

        return response(
            content: ['data' => [
                'path' => '/' . $path,
                'url' => $temporaryUrl,
                'expiration' => $expiration,
            ]],
            status: Response::HTTP_CREATED
        );
    }
}
