<?php

namespace App\Models;

use App\Enum\UserTypeEnum;
use App\Observers\SubscriptionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property UserTypeEnum $user_type
 */
#[ObservedBy([SubscriptionObserver::class])]
class Subscription extends Model
{
    use HasFactory;
    use Notifiable;

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
