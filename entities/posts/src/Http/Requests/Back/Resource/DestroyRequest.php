<?php

namespace InetStudio\SocialContest\Posts\Http\Requests\Back\Resource;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\Resource\DestroyRequestContract;

/**
 * Class DestroyRequest.
 */
class DestroyRequest extends FormRequest implements DestroyRequestContract
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
