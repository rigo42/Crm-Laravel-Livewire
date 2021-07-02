<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public function totalToString(){
        return '$'.number_format($this->total, 2, '.', ',');
    }

    public function startDateToString(){
        return Carbon::parse($this->start_date)->format('d-m-Y');
    }

    public function dueDateToString(){
        return Carbon::parse($this->due_date)->format('d-m-Y');
    }
}
