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
        if (empty($value)) {
            return null;
        }

        return upload_files()->temporaryUrl($value, now()->addHour());
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
        if (empty($value)) {
            return null;
        }

        $uploadFiles = upload_files();

        if ($uploadFiles->exists($value)) {
            return $value;
        }

        $action = new MoveTmpToUploadFiles();
        return $action->handle($value);
    }
}
