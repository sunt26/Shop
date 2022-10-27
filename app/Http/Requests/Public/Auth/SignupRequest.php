<?php

namespace App\Http\Requests\Public\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return false;
        }
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
            'email' => 'bail|required|regex:/(.+)@(.+)\.(.+)/i',
            'name' => 'bail|required|string',
            'password' => 'bail|required|min:6',
            'city' => 'bail|required|integer',
            'district' => 'bail|required|integer',
            'ward' => 'bail|required|integer',
            'phone' => 'bail|required',
            'street' => 'bail|required|string',
        ];
    }

    public function convert()
    {
        return [
            'user_email' => $this->email,
            'user_name' => $this->name,
            'user_password' => bcrypt($this->password),
            'locate_city' => $this->city,
            'locate_district' => $this->district,
            'locate_ward' => $this->ward,
            'locate_phone' => $this->phone,
            'locate_street' => $this->street,
            'locate_receiver'=>$this->name,
        ];
    }
}