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
                'alpha',
            ],
            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'alpha',
            ],
            // The email field does not validate for special characters, since those can legally be a part of email address
            // see: https://knowledge.validity.com/s/articles/What-are-the-rules-for-email-address-syntax
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:subscriptions,email',
            ],
            'user_type' => [
                'required',
                'string',
                new Enum(UserTypeEnum::class),
            ],
        ];
    }
}
