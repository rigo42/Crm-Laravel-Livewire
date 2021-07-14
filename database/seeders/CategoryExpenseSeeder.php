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
            'name' => 'Ventas',
        ]);
        CategoryExpense::create([
            'name' => 'Marketing',
        ]);
        CategoryExpense::create([
            'name' => 'Infraestructura y servicios',
        ]);
        CategoryExpense::create([
            'name' => 'IT',
        ]);
        CategoryExpense::create([
            'name' => 'Viajes y representación ',
        ]);
        CategoryExpense::create([
            'name' => 'Servicios',
        ]);
        CategoryExpense::create([
            'name' => 'Finanzas',
        ]);
        CategoryExpense::create([
            'name' => 'Otros',
        ]);
    }
}
