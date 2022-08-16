<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PresenceRequest extends FormRequest
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
    public function rules(){
        switch($this->method()){
            case 'POST': {
                return [
                    'nim' => 'required|exists:users,nim',
                    'meetings_id' => 'required|exists:meetings,id',
                    'presence_date' => 'required|date',
                    'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
                    'ket' => 'nullable|string|max:1000',
                    'feedback' => 'nullable|string|max:1000',
                    'token' => 'nullable|string|max:10|exists:meetings,token'
                ];
            } break;
            case 'PUT' : {
                return [
                    'nim' => 'required|exists:users,nim',
                    'meetings_id' => 'required|exists:meetings,id',
                    'presence_date' => 'sometimes|date',
                    'status' => 'sometimes|in:Hadir,Izin,Sakit,Alpha',
                    'ket' => 'sometimes|string|max:255',
                    'feedback' => 'sometimes|string|max:1000',
                    'token' => 'nullable|string|max:10|exists:meetings,token'
                ];
            } break;
        }
    }
}
