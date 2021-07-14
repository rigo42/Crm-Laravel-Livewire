<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function priceToString(){
        return '$'.number_format($this->price, 2, '.', ',');
    }
}
