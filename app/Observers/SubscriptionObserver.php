<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Notifications\WelcomeNotification;

class SubscriptionObserver
{
    public function created(Subscription $subscription): void
    {
        $subscription->notify(new WelcomeNotification());
    }
}
