<?php

namespace Modules\File\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Modules\File\Action\MoveTmpToUploadFiles;

class UploadFile implements CastsAttributes
{
    /**
     * Get
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return string|null
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): string|null
    {
        if (empty($path)) {
            return null;
        }

        return upload_files()->temporaryUrl($path, now()->addHour());
    }

    /**
     * Set
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return string|null
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string|null
    {
        if (empty($path)) {
            return null;
        }

        $uploadFiles = upload_files();

        if ($uploadFiles->exists($path)) {
            return $path;
        }

        $action = new MoveTmpToUploadFiles();
        return $action->handle($path);
    }
}
