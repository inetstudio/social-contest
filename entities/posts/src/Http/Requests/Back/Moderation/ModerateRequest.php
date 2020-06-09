<?php

namespace InetStudio\SocialContest\Posts\Http\Requests\Back\Moderation;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Moderation\ModerateRequestContract;

class ModerateRequest extends FormRequest implements ModerateRequestContract
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
