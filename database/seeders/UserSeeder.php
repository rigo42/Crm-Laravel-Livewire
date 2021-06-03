<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Rigoberto Villa Rodriguez',
            'email' => 'rigoberto@brandbean.mx',
            'password' => Hash::make('12345678'),
            'position' => 'Programador',
        ]);
    }
}
