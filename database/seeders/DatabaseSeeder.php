<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoryServiceSeeder::class);
        $this->call(CategoryExpenseSeeder::class);
        $this->call(AccountSeeder::class);
        // $this->call(PaymentTypeSeeder::class);
        // $this->call(ClientSeeder::class);
        // $this->call(PaymentSeeder::class);
        // $this->call(ExpenseSeeder::class);
    }
}
