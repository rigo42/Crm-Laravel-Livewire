<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $guareded = [];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
