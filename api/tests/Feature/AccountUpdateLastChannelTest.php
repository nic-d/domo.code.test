<?php

namespace Tests\Feature;

use Laravel\Passport\Passport;
use App\Domain\Chat\Models\Channel;
use App\Domain\Infrastructure\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountUpdateLastChannelTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateWithValidDataReturnsSuccess()
    {
        $this->refreshDatabase();

        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->create();
        Passport::actingAs($user);

        $response = $this->patchJson('/chat/account/last-channel', [
            'channel' => $channel->uuid,
        ]);

        $response->assertSuccessful();
    }

    public function testUpdateReturnsLastChannel()
    {
        $this->refreshDatabase();

        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->create();
        Passport::actingAs($user);

        $response = $this->patchJson('/chat/account/last-channel', [
            'channel' => $channel->uuid,
        ]);

        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'last_channel' => $channel->uuid,
            ],
        ]);
    }
}
