<?php

namespace InetStudio\SocialContest\Statuses\Http\Requests\Back\Resource;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\SocialContest\Statuses\Contracts\Http\Requests\Back\Resource\UpdateRequestContract;

/**
 * Class UpdateRequest.
 */
class UpdateRequest extends FormRequest implements UpdateRequestContract
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
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'alias' => 'required|max:255|unique:social_contest_statuses,alias,'.$this->input('id'),
        ];
    }
}
