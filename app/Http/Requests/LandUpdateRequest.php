<?php

namespace App\Http\Requests;

use App\Models\Land;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LandUpdateRequest extends FormRequest
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
            'prims' => ['required'],
            'remaining_prims' => ['required'],
            'date_buy' => ['required'],
        ];
    }
}
