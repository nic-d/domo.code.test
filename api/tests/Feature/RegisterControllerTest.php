<?php

namespace Tests\Feature;

use App\Domain\Infrastructure\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testValidDataReturnsSuccess()
    {
        $this->refreshDatabase();

        $response = $this->postJson('/infrastructure/register', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'confirm_password' => 'password',
        ]);

        $response->assertStatus(201);
    }

    public function testInvalidDataReturnsError()
    {
        $this->refreshDatabase();

        $response = $this->postJson('/infrastructure/register', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'confirm_password' => 'not_matching_password',
        ]);

        $response->assertStatus(422);
    }

    public function testRegisterCreatesUser()
    {
        $this->refreshDatabase();

        $response = $this->postJson('/infrastructure/register', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'confirm_password' => 'password',
        ]);

        $response->assertStatus(201);
        $this->assertEquals(1, User::count());
    }

    public function testRegisterReturnsUserResource()
    {
        $this->refreshDatabase();
        $name = $this->faker->name;

        $response = $this->postJson('/infrastructure/register', [
            'name' => $name,
            'email' => $this->faker->email,
            'password' => 'password',
            'confirm_password' => 'password',
        ]);

        $response->assertStatus(201);
        $response->assertJson(['data' => [
            'name' => $name,
        ]]);
    }
}
