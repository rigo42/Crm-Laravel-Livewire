<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function paymentTotal()
    {
        $paymentTotal = $this->payments()->sum('monto');
        return '$'.number_format($paymentTotal, 2, '.', ',');
    }

    public function expenseTotal()
    {
        $expenseTotal = $this->expenses()->sum('monto');
        return '$'.number_format($expenseTotal, 2, '.', ',');
    }

    public function balance()
    {
        $paymentTotal = $this->payments()->sum('monto');
        $expenseTotal = $this->expenses()->sum('monto');
        $balance = $paymentTotal - $expenseTotal;
        return '$'.number_format($balance, 2, '.', ',');
    }
}
