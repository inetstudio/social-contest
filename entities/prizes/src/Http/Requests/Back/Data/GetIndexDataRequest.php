<?php

namespace InetStudio\SocialContest\Prizes\Http\Requests\Back\Data;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Data\GetIndexDataRequestContract;

class GetIndexDataRequest extends FormRequest implements GetIndexDataRequestContract
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [];
    }
}
