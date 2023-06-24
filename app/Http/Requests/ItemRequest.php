<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{


    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
            'userId' => 'nullable|exists:users,id',
            'price' => 'required|numeric',
        ];
    }

}
