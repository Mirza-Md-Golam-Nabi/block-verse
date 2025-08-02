<?php
namespace Database\Seeders;

use App\Models\RoleUser;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);

        RoleUser::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
