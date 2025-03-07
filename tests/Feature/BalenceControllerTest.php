<?php

namespace Tests\Feature;

use App\Models\Balence;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class BalenceControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the update method for balance.
     *
     * @return void
     */
    public function test_update_balance()
    {
        $user = User::create([
            'full_name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
            'family_members' => 3,
            'my_income' => 3000,
            'other_family_income' => 2000,
        ]);

        $this->actingAs($user);

        $balance = Balence::create([
            'user_id' => $user->id,
            'Montly_income' => 5000,
            'balance' => 5000,
        ]);

        $newIncome = 6000;

        $response = $this->post(route('updateIncome'), [
            'Montly_income' => $newIncome,
        ]);

        $this->assertDatabaseHas('balences', [
            'user_id' => $user->id,
            'Montly_income' => $newIncome,
        ]);

        $response->assertRedirect(route('dash'));
    }
}
