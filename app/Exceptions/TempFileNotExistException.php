<?php

namespace Modules\File\Exceptions;

use Dmn\Exceptions\Exception;

class TempFileNotExistException extends Exception
{
    protected $httpStatusCode = 400;

    protected $code = 'temp_file_not_exist';

    public $message = 'Temporary file not exists.';
}
