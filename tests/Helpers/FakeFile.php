<?php

namespace Modules\File\Tests\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FakeFile
{
    /**
     * Fake tmp_files storage
     *
     * @return void
     */
    public static function fakeTmp(): void
    {
        Storage::fake('tmp_files');
    }

    /**
     * Fake upload_files storage
     *
     * @return void
     */
    public static function fakeUpload(): void
    {
        Storage::fake('upload_files');
    }

    /**
     * Fake all storages
     *
     * @return void
     */
    public static function fakeStorages(): void
    {
        self::fakeTmp();
        self::fakeUpload();
    }

    /**
     * Temporary image
     *
     * @return string
     */
    public static function tmpImage(bool $fakeStorage = true): string
    {
        if ($fakeStorage) {
            self::fakeStorages();
        }
        $file = UploadedFile::fake()
            ->create(
                name: 'test.jpg',
                kilobytes: 2048,
            );

        return '/' . tmp_files()->putFile(path: $file);
    }

    /**
     * Upload image
     *
     * @return string
     */
    public static function uploadImage(bool $fakeStorage = true): string
    {
        if ($fakeStorage) {
            self::fakeStorages();
        }
        $file = UploadedFile::fake()
            ->create(
                name: 'test.jpg',
                kilobytes: 2048,
            );

        return '/' . upload_files()->putFile(path: $file);
    }
}
