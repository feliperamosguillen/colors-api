<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
            case 'PUT': {
                return [
                        'name' => 'required|min:3|max:100|unique:colors',
                        'color' => 'required|min:3|max:100',
                        'pantone' => 'required|min:3|max:100',
                        'year' => 'required|numeric',
                   ];
            }
        }
    }
}
