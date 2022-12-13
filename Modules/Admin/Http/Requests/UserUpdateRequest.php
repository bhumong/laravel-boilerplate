<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Admin\Entities\Role;
use Illuminate\Validation\Rules;

class UserUpdateRequest extends FormRequest
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
            'email' => ['string', 'email', 'required'],
            'name' => ['string', 'regex:/^[\pL\s\-]+$/u', 'required'],
            'role' => ['string', 'nullable', Rule::exists(Role::class, 'id')],
            'isSuperadmin' => ['nullable', 'boolean'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
