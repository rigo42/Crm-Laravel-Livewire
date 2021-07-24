<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Expense extends Model
{
    use LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Gastos';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Un gasto ha sido {$eventName}";
    }


    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function categoryExpense(){
        return $this->belongsTo(CategoryExpense::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
    
    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    public function dateToString(){
        return Carbon::parse($this->date)->toFormattedDateString();
    }

    public function createdAtToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }

    public function montoToString(){
        return '$'.number_format($this->monto, 2, '.', ',');
    }
}
