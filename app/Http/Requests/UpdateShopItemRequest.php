<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopItemRequest extends FormRequest
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
        'name' => ['required', 'string', 'max:255'],
        //'slug' => ['required', 'string', 'max:255'],
        'description' => ['sometimes', 'string'],
        'price' => ['required', 'numeric', 'min:0'],
        'category' => ['required', 'in:ebook,merchandise'],
        'thumbnail' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,svg'], // maks 2MB
        //'file_path' => ['required', 'file', 'mimes:pdf', 'max:5120'], // ebook
        //'stock' => ['required', 'integer', 'min:0'], // hanya untuk merch
        ];
    }
}
