<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            // 'name' => 'required|unique:products|max:255',
            'name' => [
                'required',
                'max:255',
                Rule::unique('products')->ignore($this->product),
            ],
            'content' => 'nullable',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ];
    }

    //
    public function messages() {
        return [
            'name.unique' => 'SAN PHAM NAY DA TON TAI'
        ];
    }
}
