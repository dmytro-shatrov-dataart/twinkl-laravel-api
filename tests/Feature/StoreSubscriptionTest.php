<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\BannedIp;
use App\Models\Subscription;
use App\Notifications\WelcomeNotification;
use Database\Factories\SubscriptionFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class StoreSubscriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_subscription_endpoint_returns_http_403_when_ip_is_banned(): void
    {
        BannedIp::query()->create(['address' => '123.456.7.8']);

        $this
            ->withServerVariables([
                'REMOTE_ADDR' => '123.456.7.8',
            ])
            ->postJson('api/subscriptions')
            ->assertStatus(403);
    }

    public static function store_subscription_invalid_payload(): array
    {
        return [
            [
                'data' => [],
                'errors' => [
                    'first_name',
                    'last_name',
                    'email',
                    'user_type',
                ],
            ],
            [
                'data' => [
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'user_type' => '',
                ],
                'errors' => [
                    'first_name',
                    'last_name',
                    'email',
                    'user_type',
                ],
            ],
            [
                'data' => [
                    'first_name' => -1,
                    'last_name' => -1,
                    'email' => -1,
                    'user_type' => -1,
                ],
                'errors' => [
                    'first_name',
                    'last_name',
                    'email',
                    'user_type',
                ],
            ],
            [
                'data' => [
                    'first_name' => 'gasdh!.',
                    'last_name' => '*&+ lksdj',
                    'email' => 'non-email',
                    'user_type' => 'random',
                ],
                'errors' => [
                    'first_name',
                    'last_name',
                    'email',
                    'user_type',
                ],
            ],
            [
                'data' => [
                    'first_name' => 'a',
                    'last_name' => 'a',
                    'email' => '1234',
                    'user_type' => 'random',
                ],
                'errors' => [
                    'first_name',
                    'last_name',
                    'email',
                    'user_type',
                ],
            ],
        ];
    }

    /**
     * @dataProvider store_subscription_invalid_payload
     */
    public function test_store_subscription_validation_rules(array $data, array $errors): void
    {
        $this->postJson('api/subscriptions', $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors($errors);

        self::assertDatabaseCount('subscriptions', 0);
    }

    public function test_store_subscription_email_should_be_unique(): void
    {
        $existing = (new SubscriptionFactory())->createOne();

        $this->postJson('api/subscriptions', [
            'first_name' => 'Dmytro',
            'last_name' => 'Shatrov',
            'email' => $existing->email,
            'user_type' => 'student',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('email');

        self::assertDatabaseCount('subscriptions', 1);
    }

    public function test_store_subscription_endpoint_creates_subscription_and_sends_welcome_email(): void
    {
        Notification::fake();

        $this->postJson('api/subscriptions', [
            'first_name' => 'Dmytro',
            'last_name' => 'Shatrov',
            'email' => 'dmytro.shatrov@example.com',
            'user_type' => 'student',
        ])
            ->assertCreated()
            ->assertHeader('Content-Type', 'application/json');

        self::assertDatabaseHas('subscriptions', [
            'first_name' => 'Dmytro',
            'last_name' => 'Shatrov',
            'email' => 'dmytro.shatrov@example.com',
            'user_type' => 'student',
        ]);

        Notification::assertSentTo(Subscription::query()->first(), WelcomeNotification::class);
    }
}
