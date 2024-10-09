<?php

use Illuminate\Http\UploadedFile;
use Modules\File\Tests\Helpers\FakeFile;

it('should upload to temp files', function () {
    /** @var \Tests\TestCase $this */
    FakeFile::fakeTmp();
    $payload = [
        'file' => UploadedFile::fake()
            ->create(
                name: 'test.jpg',
                kilobytes: 2048,
            ),
    ];

    $response = $this->postJson(
        uri: route(
            name: 'api.file.upload',
            parameters: [],
        ),
        data: $payload,
    );

    tmp_files()->assertExists($response->json('data.path'));
    $response->assertCreated();
});
