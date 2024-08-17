<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserWithTodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Atlas',
            'email' => 'atlas@example.com',
            'password' => bcrypt('password123'), 
        ]);

        Todo::factory(10)->create([
            'user_id' => $user->id, 
        ]);
    }
}
