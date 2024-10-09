<?php

use Modules\File\Rules\FileExists;
use Modules\File\Tests\Helpers\FakeFile;

it('should check upload files', function () {
    /** @var \Tests\TestCase $this */
    $path = FakeFile::uploadImage();

    $rule = new FileExists();
    $outMessage = 'test';

    $rule->validate('attribute', $path, function ($message) use (&$outMessage) {
        $outMessage = $message;
    });

    expect($outMessage)->toBe('test');
});

it('should fail on non existent file', function () {
    /** @var \Tests\TestCase $this */
    FakeFile::fakeStorages();
    $rule = new FileExists();
    $outMessage = 'executed';
    $rule->validate('attribute', 'asdf', function ($message) use (&$outMessage) {
        $outMessage = $message;
    });

    expect($outMessage)->toBe('Invalid :attribute.');
});
