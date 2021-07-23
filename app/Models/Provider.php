<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Provider extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guareded = [];

    //Logs
    protected static $logName = 'Proveedores';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Un proveedor ha sido {$eventName}";
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }
}
