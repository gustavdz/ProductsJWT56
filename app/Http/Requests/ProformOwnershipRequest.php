<?php

namespace Products_JWT\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Products_JWT\proform;

class ProformOwnershipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $proformId = $this->route('proform_id');


        return proform::where('id', $proformId)
            ->where('user_id', $this->user()->id)->exists();
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
        ];
    }
}
