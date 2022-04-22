<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:10'],
            'live_link' => ['nullable', 'url'],
            'code_link' => ['nullable', 'url'],
            'description' => ['required', 'min:20'],
            'contribution' => ['required', 'min:20'],
            'show' => ['nullable', 'boolean'],
            'image' => ['required', 'image', 'max:1024'],
        ];
    }
}
