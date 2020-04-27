<?php

namespace InetStudio\SocialContest\Statuses\Http\Requests\Back\Utility;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Utility\SuggestionsRequestContract;

/**
 * Class SuggestionsRequest.
 */
class SuggestionsRequest extends FormRequest implements SuggestionsRequestContract
{
    /**
     * Определить, авторизован ли пользователь для этого запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Сообщения об ошибках.
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Правила проверки запроса.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
