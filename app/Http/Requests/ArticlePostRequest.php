<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'name' => 'required|unique:articles',
                    'body' => 'required|min:100',
                ];
            }
            case 'PATCH':
            {
                return [
                    'name' => 'required|unique:articles,name,' . $this->id,
                    'body' => 'required|min:100',
                ];
            }
            default:break;
        }
        return [];
    }
}
