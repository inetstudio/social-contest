<?php

namespace InetStudio\SocialContest\Points\Http\Requests\Back;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SocialContest\Points\Contracts\Http\Requests\Back\SavePointRequestContract;

/**
 * Class SavePointRequest.
 */
class SavePointRequest extends FormRequest implements SavePointRequestContract
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
            'name.required' => 'Поле «Название» обязательно для заполнения',
            'name.max' => 'Поле «Название» не должно превышать 255 символов',
            'alias.required' => 'Поле «Алиас» обязательно для заполнения',
            'alias.max' => 'Поле «Алиас» не должно превышать 255 символов',
            'alias.unique' => 'Такое значение поля «Алиас» уже существует',
            'numeric.required' => 'Поле «Количество баллов» обязательно для заполнения',
            'numeric.integer' => 'Поле «Количество баллов» должно быть числом',
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
            'name' => 'required|max:255',
            'alias' => 'required|max:255|unique:social_contest_points,alias,'.$request->get('point_id'),
            'numeric' => 'required|integer',
        ];
    }
}
