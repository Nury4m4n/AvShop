<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUmrahPackageRequest extends FormRequest
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
            'main_package_name' => 'required|unique:umrah_packages|string|max:255',
            'image' => 'nullable|image|max:15360',
            'price' => 'required|numeric|min:0|max:99999999999999999999.99',
        ];
    }
}
