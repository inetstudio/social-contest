<?php

namespace InetStudio\SocialContest\Statuses\Http\Requests\Back\Resource;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Resource\EditRequestContract;

class EditRequest extends FormRequest implements EditRequestContract
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
