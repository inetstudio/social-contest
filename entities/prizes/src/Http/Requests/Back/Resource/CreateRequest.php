<?php

namespace InetStudio\SocialContest\Prizes\Http\Requests\Back\Resource;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SocialContest\Prizes\Contracts\Http\Requests\Back\Resource\CreateRequestContract;

/**
 * Class CreateRequest.
 */
class CreateRequest extends FormRequest implements CreateRequestContract
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
