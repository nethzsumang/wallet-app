<?php

namespace App\Http\Requests\Record;

use App\Http\Requests\BaseRequest;

/**
 * CreateRecordRequest class
 * @author Kenneth Sumang
 */
class CreateRecordRequest extends BaseRequest
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
            //
        ];
    }
}
