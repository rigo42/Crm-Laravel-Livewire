<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Invoice extends Model
{
    use LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Facturas';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Una factura ha sido {$eventName}";
    }


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

        if($services->count()){
            
            foreach ($services as $service) {
            
                $serviceTotal += $service->price;
            }

            $pending += ($serviceTotal - $invoiceTotal);
        }

        return $pending;

    }
}
