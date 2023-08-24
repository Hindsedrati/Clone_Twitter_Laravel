<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Storage;

final class ValidFileUpload implements ValidationRule
{
    public function __construct(
        private readonly array $validMimeTypes
    ) {
        //
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Storage::exists($value)) {
            $fail('The file does not exist.');
        }

        if (!in_array(Storage::mimeType($value), $this->validMimeTypes, true)) {
            $fail('The file is not a valid mime type.');
        }
    }
}