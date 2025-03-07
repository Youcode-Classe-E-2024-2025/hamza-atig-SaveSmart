<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the profile creation process.
     *
     * @return void
     */
    public function testStoreProfile()
    {
        $user = User::create([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'family_members' => 2,
            'my_income' => 1000,
            'other_family_income' => 500,
        ]);
        $this->actingAs($user);

        Storage::fake('public');

        $avatar = UploadedFile::fake()->image('avatar.png');

        $response = $this->post('/createprofile', [
            'user_id' => $user->id,
            'avatar' => $avatar,
            'full_name' => 'John Doe',
            'password' => 'password123',
            'spended' => 10,
        ]);

        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'spended' => 10,
        ]);

        Storage::disk('public')->assertExists('images/' . $avatar->hashName());

        $response->assertRedirect(route('profile'));
    }

    /**
     * Test the profile destroy method.
     *
     * @return void
     */
    public function testDestroyProfile()
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

        $response = $this->delete('/logout-profile');

        $this->assertAuthenticated();

        $this->assertDatabaseMissing('profiles', [
            'id' => $profile->id,
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'spended' => 10,
            'password' => bcrypt('password123'),
            'avatar' => 'avatar.png',
        ]);
    }

    /**
     * Test the profile delete method.
     *
     * @return void
     */
    public function testDeleteProfile()
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

        $this->assertDatabaseMissing('profiles', [
            'id' => $profile->id,
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'spended' => 10,
            'password' => bcrypt('password123'),
            'avatar' => 'avatar.png',
        ]);
    }
}
