<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'content' => ['required'],
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
