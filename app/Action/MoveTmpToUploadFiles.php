<?php

namespace Modules\File\Action;

use Modules\File\Exceptions\TempFileNotExistException;

class MoveTmpToUploadFiles
{
    /**
     * Handle
     *
     * @param string $path
     * @return string
     */
    public function handle(string $path): string
    {
        $tmpFiles = tmp_files();

        if (!$tmpFiles->exists($path)) {
            throw new TempFileNotExistException();
        }

        upload_files()->writeStream($path, $tmpFiles->readStream($path));
        $tmpFiles->delete($path);

        return $path;
    }
}
