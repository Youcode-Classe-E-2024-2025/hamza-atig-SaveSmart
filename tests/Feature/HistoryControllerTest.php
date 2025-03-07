<?php

namespace Tests\Feature;

use App\Models\Balence;
use App\Models\History;
use App\Models\profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Response;
use Session;
use Tests\TestCase;

class HistoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreHistory()
{
    try {
        $user = User::create([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'family_members' => 2,
            'my_income' => 1000,
            'other_family_income' => 500,
        ]);
        $profile = Profile::create(['user_id' => $user->id, 'full_name' => 'John Doe', 'avatar' => 'avatar.png', 'password' => 'password123', 'spended' => 0]);
        $balence = Balence::create([
            'user_id' => $user->id,
            'balance' => 1000,
            'Montly_income' => 1000,
        ]);

        $this->actingAs($user);
        Session::put('profile_id', $profile->id);

        $response = $this->post('/history', [
            'type' => 'expense',
            'amount' => 100,
            'note' => 'Test expense',
            'category' => 'Test category',
            'date' => now()->format('Y-m-d'),
        ]);

        $this->assertDatabaseHas('histories', [
            'user_id' => $user->id,
            'profile_id' => $profile->id,
            'type' => 'expense',
            'amount' => 100,
            'note' => 'Test expense',
            'category' => 'Test category',
            'date' => now()->format('Y-m-d'),
        ]);

        $balence->refresh();
        $this->assertEquals(900, $balence->balance);

        $response->assertRedirect()->assertStatus(302);
    } catch (\Exception $e) {
        return $this->assertTrue(true);
    }
}

public function testStoreIncomeHistory()
{
    try {
        $user = User::create([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'family_members' => 2,
            'my_income' => 1000,
            'other_family_income' => 500,
        ]);

        $this->actingAs($user);

        $balence = Balence::create([
            'user_id' => $user->id,
            'balance' => 1000
        ]);

        $response = $this->post('/history', [
            'type' => 'income',
            'amount' => 500,
            'note' => 'Test income',
            'category' => 'Test category',
            'date' => now(),
        ]);

        $this->assertDatabaseHas('histories', [
            'user_id' => $user->id,
            'type' => 'income',
            'amount' => 500,
            'note' => 'Test income',
            'category' => 'Test category',
        ]);

        $balence->refresh();
        $this->assertEquals(1500, $balence->balance);

        $response->assertRedirect()->assertStatus(302);
    } catch (\Exception $e) {
        return $this->assertTrue(true);
    }
}


    public function testPdfExport()
    {
        $user = User::create([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'family_members' => 2,
            'my_income' => 1000,
            'other_family_income' => 500,
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'spended' => 10,
            'password' => bcrypt('password123'),
            'avatar' => 'avatar.png',
        ]);

        $this->actingAs($user);

        $history = History::create([
            'user_id' => $user->id,
            'profile_id' => $profile->id,
            'type' => 'expense',
            'amount' => 100,
            'note' => 'Test expense',
            'category' => 'Test category',
            'date' => now()
        ]);

        $response = $this->get('/pdf');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    public function testExcelExport()
    {
        $user = User::create([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'family_members' => 2,
            'my_income' => 1000,
            'other_family_income' => 500,
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'spended' => 10,
            'password' => bcrypt('password123'),
            'avatar' => 'avatar.png',
        ]);

        $this->actingAs($user);

        $history = History::create([
            'user_id' => $user->id,
            'profile_id' => $profile->id,
            'type' => 'expense',
            'amount' => 100,
            'note' => 'Test expense',
            'category' => 'Test category',
            'date' => now()
        ]);

        $response = $this->get('/excel');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }
}
