<?php

namespace _5balloons\LaravelSmartAds\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSmartAdRequest extends FormRequest
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
        if($this->form_type == 'edit'){
            $image_rule = "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048";
        }else{
            $image_rule = "required_if:adType,IMAGE|image|mimes:jpg,png,jpeg,gif,svg|max:2048";
        }
        return [
            'name' => [
                'required',
                Rule::unique('smart_ads', 'name')->ignore($this->smartAd)
            ],
            "body" => "required_if:adType,HTML",
            "image" => $image_rule,
            "imageUrl" => "nullable|url"
        ];
    }
}