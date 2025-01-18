<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUmrahPackageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('umrah_package');

        return [
            'main_package_name' => 'nullable|string|max:255|unique:umrah_packages,main_package_name,' . $id,
            'image' => 'nullable|image|max:15360',
            'price' => 'required|numeric|min:0|max:99999999999999999999.99',
        ];
    }
}
