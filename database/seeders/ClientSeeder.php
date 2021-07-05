<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'rigoberto',
            'email' => 'rigoberto.villa42@gmail.com',
            'user_id' => 6
        ]);
        Client::create([
            'name' => 'Nicole Torres',
            'email' => 'nicole@gmail.com',
            'user_id' => 6
        ]);
        Client::create([
            'name' => 'Azael iris',
            'email' => 'azael@gmail.com',
            'user_id' => 6
        ]);
    }
}
