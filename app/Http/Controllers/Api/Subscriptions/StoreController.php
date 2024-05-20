<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Subscriptions;

use App\Http\Requests\Api\Subscriptions\StoreRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreController
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        $subscription = Subscription::query()->create($request->validated());

        return new JsonResponse(SubscriptionResource::make($subscription), Response::HTTP_CREATED);
    }
}
