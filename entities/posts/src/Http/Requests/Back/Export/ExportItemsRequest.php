<?php

namespace InetStudio\SocialContest\Posts\Http\Requests\Back\Export;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Export\ExportItemsRequestContract;

class ExportItemsRequest extends FormRequest implements ExportItemsRequestContract
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
