<?php

use Illuminate\Database\Eloquent\Model;
use Modules\File\Casts\UploadFile;
use Modules\File\Tests\Helpers\FakeFile;

/**
 * Get model
 *
 * @return Model
 */
function getModel(): Model
{
    return new class extends Model {
        protected $fillable = [
            'upload_url',
        ];
        protected function casts(): array
        {
            return [
                'upload_url' => UploadFile::class,
            ];
        }
    };
}

it('It should handle empty path', function () {
    /** @var \Tests\TestCase $this */
    $model = getModel();
    $model->upload_url = '';

    expect($model->upload_url)->toBeNull();
});

it('It should move the file to upload files if file is in temp', function () {
    /** @var \Tests\TestCase $this */
    FakeFile::fakeStorages();
    $file = FakeFile::tmpImage(false);
    $model = getModel();
    $model->upload_url = $file;

    expect(filter_var($model->upload_url, FILTER_VALIDATE_URL))
        ->not
        ->toBeTrue();
    expect(tmp_files()->exists($file))->toBeFalse();
    expect(upload_files()->exists($file))->toBeTrue();
});

it('It should not change path on existing in upload files', function () {
    /** @var \Tests\TestCase $this */
    $file = FakeFile::uploadImage();
    $model = getModel();
    $model->upload_url = $file;

    expect(filter_var($model->upload_url, FILTER_VALIDATE_URL))
        ->not
        ->toBeTrue();

    expect(tmp_files()->exists($file))->toBeFalse();
    expect(upload_files()->exists($file))->toBeTrue();
});
