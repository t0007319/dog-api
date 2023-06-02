<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssociateTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // could do required if not exists e.g. name is required if park does not exist
        return [
            'park_id' => 'int|sometimes',
            'breed' => 'string|max:255|sometimes',
        ];
    }
}
