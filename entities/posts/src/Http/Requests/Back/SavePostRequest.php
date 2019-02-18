<?php

namespace InetStudio\SocialContest\Posts\Http\Requests\Back;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SocialContest\Posts\Contracts\Http\Requests\Back\SavePostRequestContract;

/**
 * Class SavePostRequest.
 */
class SavePostRequest extends FormRequest implements SavePostRequestContract
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
        return [
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @param Request $request
     *
     * @return array
     */
    public function rules(Request $request): array
    {
        return [

        ];
    }
}
