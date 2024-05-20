<?php

namespace App\Models;

use App\Enum\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property UserTypeEnum $user_type
 */
class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'user_type',
    ];

    public $timestamps = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'user_type' => UserTypeEnum::class,
    ];
}
