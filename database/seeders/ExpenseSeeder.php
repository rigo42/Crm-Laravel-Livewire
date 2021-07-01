<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expense::create([
            'date' => '2021-01-01',
            'concept' => 'gasto por rigo',
            'client_id' => 1,
            'account_id' => 1,
            'monto' => 100,
            'user_id' => 10,
        ]);
        Expense::create([
            'date' => '2021-01-01',
            'concept' => 'gasto por rigo',
            'client_id' => 1,
            'account_id' => 1,
            'monto' => 200,
            'user_id' => 10,
        ]);
        Expense::create([
            'date' => '2021-03-01',
            'concept' => 'gasto por nicole',
            'client_id' => 2,
            'account_id' => 1,
            'monto' => 150,
            'user_id' => 10,
        ]);
        Expense::create([
            'date' => '2021-03-01',
            'concept' => 'gasto por azael',
            'client_id' => 3,
            'account_id' => 1,
            'monto' => 150,
            'user_id' => 10,
        ]);
    }
}
