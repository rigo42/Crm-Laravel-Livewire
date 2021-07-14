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

    public function isPendingTotal(){
        $pending = $this->pendingTotal();
        if($pending > 0){
            return true;
        }else{
            return false;
        }
    }

    public function pendingTotalToString(){
        $pending = $this->pendingTotal();
        return '$'.number_format($pending, 2, '.', ',');
    }

    public function pendingTotal(){
        $invoiceTotal = $this->total;
        $pending = 0;
        $serviceTotal = 0;
        $services = $this->services()->cursor();
        foreach ($services as $service) {
            
            $serviceTotal += $service->price;
        }

        return $pending += ($serviceTotal - $invoiceTotal);

    }
}
