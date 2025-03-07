<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Balence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the store method.
     *
     * @return void
     */
    public function test_store()
    {
        $data = [
            'full_name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'family_members' => 3,
            'my_income' => 3000,
            'other_family_income' => 2000,
        ];

        $response = $this->post(route('signup'), $data);

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);

        $this->assertDatabaseHas('balences', [
            'user_id' => User::where('email', 'john.doe@example.com')->first()->id,
            'balance' => 5000,
        ]);

        $response->assertRedirect('login');
    }

    /**
     * Test the login method.
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::create([
            'full_name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'password' => Hash::make('password123'),
            'family_members' => 4,
            'my_income' => 4000,
            'other_family_income' => 3000,
        ]);

        $data = [
            'email' => 'jane.doe@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('login'), $data);

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect('/profile');
    }
}
