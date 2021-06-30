<?php

namespace Database\Seeders;

use App\Models\CategoryExpense;
use Illuminate\Database\Seeder;

class CategoryExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryExpense::create([
            'name' => 'Facebook Ads',
        ]);
        CategoryExpense::create([
            'name' => 'Google Ads',
        ]);
        CategoryExpense::create([
            'name' => 'Cumpleaños',
        ]);
        CategoryExpense::create([
            'name' => 'Hosting y Dominio',
        ]);
        CategoryExpense::create([
            'name' => 'Hosting',
        ]);
        CategoryExpense::create([
            'name' => 'Dominio',
        ]);
        CategoryExpense::create([
            'name' => 'Plantilla web',
        ]);
    }
}
