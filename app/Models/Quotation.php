<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Quotation extends Model
{
    use LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Cotizaciones';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Una cotización ha sido {$eventName}";
    }


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
