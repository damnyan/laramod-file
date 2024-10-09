<?php

use Illuminate\Http\UploadedFile;
use Modules\File\Action\MoveTmpToUploadFiles;
use Modules\File\Exceptions\TempFileNotExistException;
use Modules\File\Tests\Helpers\FakeFile;

it('should move tmp file to upload files', function () {
    /** @var \Tests\TestCase $this */
    FakeFile::fakeStorages();

    $file = UploadedFile::fake()
        ->create(
            name: 'test.jpg',
            kilobytes: 2048,
        );

    $tmpFiles = tmp_files();
    $uploadFiles = upload_files();

    $tmpPath = $tmpFiles->putFile(path: $file);
    expect($tmpFiles->exists($tmpPath))->toBeTrue();

    $action = new MoveTmpToUploadFiles();
    $newPath = $action->handle($tmpPath);
    expect($tmpFiles->exists($tmpPath))->toBeFalse();
    expect($uploadFiles->exists($newPath))->toBeTrue();
});

it('should throw TempFileNotExistException on invalid temp file', function () {
    /** @var \Tests\TestCase $this */
    FakeFile::fakeTmp();
    $this->expectException(TempFileNotExistException::class);
    $action = new MoveTmpToUploadFiles();
    $action->handle('asdf.jpg');
});
