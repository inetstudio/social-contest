<?php

namespace InetStudio\SocialContest\Statuses\Http\Requests\Back\Resource;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Resource\CreateRequestContract;

class CreateRequest extends FormRequest implements CreateRequestContract
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
