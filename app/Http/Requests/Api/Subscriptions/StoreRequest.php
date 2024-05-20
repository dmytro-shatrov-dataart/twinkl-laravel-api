<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Subscriptions;

use App\Enum\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:subscriptions,email'
            ],
            'user_type' => [
                'required',
                'string',
                new Enum(UserTypeEnum::class),
            ],
        ];
    }
}
