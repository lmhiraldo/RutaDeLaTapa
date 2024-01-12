<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarTapaRequest extends FormRequest
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
                'tapas' => 'required|array|exists:tapas,id',
                'bars' => 'required|array',
                'bars.*' => 'exists:bars,id',
                'name' => 'required|string|max:100',
                'img' => 'required|max:10000|mimes:jpg,png,jpg',
                'description' => 'required|string|max:2000',
                'price' => 'required|numeric|between:0,99.99',
            ];
        }
    
    

    
}
