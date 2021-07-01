<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'date' => '2021-01-01', //Enero
            'concept' => 'Pago por rigo',
            'client_id' => 1,
            'account_id' => 1,
            'payment_type_id' => 1,
            'monto' => 500,
            'user_id' => 10,
        ]);
        Payment::create([
            'date' => '2021-02-10',
            'concept' => 'Pago por rigo2', //Febrero
            'client_id' => 1,
            'account_id' => 1,
            'payment_type_id' =>3,
            'monto' => 600,
            'user_id' => 10,
        ]);
        Payment::create([
            'date' => '2021-03-01', //Marzo
            'concept' => 'Pago por nicole',
            'client_id' => 2,
            'account_id' => 1,
            'payment_type_id' => 2,
            'monto' => 1000,
            'user_id' => 10,
        ]);
        Payment::create([
            'date' => '2021-03-01', //Marzo
            'concept' => 'Pago por azael',
            'client_id' => 3,
            'account_id' => 1,
            'payment_type_id' => 2,
            'monto' => 2000,
            'user_id' => 10,
        ]);
    }
}
