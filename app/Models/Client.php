<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function incomeByInvoiceTotal(){
        $invoiceTotal = $this->invoices()->sum('total');
        return '$'.number_format($invoiceTotal, 2, '.', ',');
    }

    public function paymentTotal(){
        $payments = $this->payments()->sum('monto');
        return '$'.number_format($payments, 2, '.', ',');
    }
    
    public function expenseTotal(){
        $expenses = $this->expenses()->sum('monto');
        return '$'.number_format($expenses, 2, '.', ',');
    }
}
