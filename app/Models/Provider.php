<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $guareded = [];

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }
}
