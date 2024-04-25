<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title"=>[
                'required',
                'max:225',
                'min:3',
                $this->route()->named('posts.store') ? 'unique:posts,title' : 'unique:posts,title,' . $this->post,
            ],
            "body"=>"required|max:225|min:10",
            'photo' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048',
            //
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'body.required' => 'Body is required',
            'title.min' => 'Title must be at least 3 characters',
            'body.min' => 'Body must be at least 10 characters',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpg, jpeg, png.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.'
        ];
    }
}
