<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Admin\Entities\Role;
use Illuminate\Validation\Rules;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', ],
            'name' => ['required', 'string', 'regex:/^[\pL\s\-]+$/u'],
            'role' => ['string', 'nullable', Rule::exists(Role::class, 'id')],
            'is_superuser' => ['nullable', 'boolean'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
