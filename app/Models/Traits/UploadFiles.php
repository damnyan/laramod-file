<?php

namespace Modules\File\Models\Traits;

use Modules\File\Action\MoveTmpToUploadFiles;

trait UploadFiles
{
    /**
     * Temporary files to Upload files
     *
     * @param string|null $path
     * @return string|null
     */
    public function tmpToUpload(string $path = null): string|null
    {
        if (empty(trim($path))) {
            return null;
        }

        $uploadFiles = upload_files();

        if ($uploadFiles->exists($path)) {
            return $path;
        }

        $action = new MoveTmpToUploadFiles();
        return $action->handle($path);
    }

    /**
     * Temporary url
     *
     * @param string|null $path
     * @return string|null
     */
    public function tempUrl(string $path = null): string|null
    {
        if (empty($path)) {
            return null;
        }

        return upload_files()->temporaryUrl($path, now()->addHour());
    }
}
