<?php

namespace Modules\File\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FileExists implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (tmp_files()->exists($value)) {
            return;
        }

        if (upload_files()->exists($value)) {
            return;
        }

        $fail('Invalid :attribute.');
    }
}
