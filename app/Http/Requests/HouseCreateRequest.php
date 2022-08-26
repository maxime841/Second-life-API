<?php

namespace App\Http\Requests;

use App\Models\House;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HouseCreateRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique(House::class)],
            'presentation' => ['required'],
            'prims' => ['required', 'integer'],
            'remaining_house_prims' => ['required', 'integer'],
        ];
    }
}
