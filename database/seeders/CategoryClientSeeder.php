<?php

namespace Database\Seeders;

use App\Models\CategoryClient;
use Illuminate\Database\Seeder;

class CategoryClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryClient::create([
            'name' => 'A',
            'description' => 'Ingresos menores a $10,000',
        ]);
        CategoryClient::create([
            'name' => 'AA',
            'description' => 'Ingresos entre $10,000 a $20,000',
        ]);CategoryClient::create([
            'name' => 'AAA',
            'description' => 'Ingresos mayores a $20,000',
        ]);
    }
}
