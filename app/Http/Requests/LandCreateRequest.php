<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'owner' => '',
            'presentation' => ['required', 'string'],
            'description' => ['required', 'string'],
            'group' => ['required', 'string'],
            'prims' => ['required', 'string'],
            'remaining_prims' => ['required', 'string'],
            'date_buy' => ['required', 'date']
        ];
    }
}
