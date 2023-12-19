<?php

namespace App\Http\Requests\questionnaire;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionnaireRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>['required','string','max:255'],
            'description'=>['required','string'],
            'is_active'=>['required','boolean'],
        ];
    }
}
