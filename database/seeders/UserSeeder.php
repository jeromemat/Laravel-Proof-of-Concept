<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! app()->isLocal()) {
            return;
        }

        if (User::whereEmail('john@doe.com')->exists()) {
            return;
        }

        $user = User::factory()->create([
            'email' => 'john@doe.com',
        ]);        
    }
}
