<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Domain\Chat\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateDefaultChannelsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreatesDefaultChannelWhenNoChannelsExists()
    {
        $this->assertEquals(0, Channel::count());

        $this->postJson('/infrastructure/register', [
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password',
            'confirm_password' => 'password',
        ]);

        $this->assertEquals(1, Channel::count());
    }

    public function testCreatesNoChannelsWhenChannelsExists()
    {
        // Create first user
        $this->postJson('/infrastructure/register', [
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password',
            'confirm_password' => 'password',
        ]);

        // Create second user
        $this->postJson('/infrastructure/register', [
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password',
            'confirm_password' => 'password',
        ]);

        $this->assertEquals(1, Channel::count());
    }
}
