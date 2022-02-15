<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\BaseRequest;

class CreateAccountRequest extends BaseRequest
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
            'user_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:100'],
            'amount' => ['required', 'numeric']
        ];
    }
}
