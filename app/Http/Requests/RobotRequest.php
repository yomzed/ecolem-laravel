<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RobotRequest extends FormRequest
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
        return [
            'name'        => 'bail|required|string|min:3',
            'description' => 'bail|required|string',
            'status'      => 'bail|required|in:published,unpublished,draft',
            'category_id' => 'bail|nullable|exists:categories,id',
            'tags.*'      => 'exists:tags,id',
            'picture'     => 'file|image|max:'.env('MAX_UPLOAD', 2000)
        ];
    }
}
