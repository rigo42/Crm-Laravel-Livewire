<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function categoryService(){
        return $this->belongsTo(CategoryService::class);
    }

    public function startDateFormat(){
        return Carbon::parse($this->start_date)->format('d-m-Y');
    }

    public function dueDay(){
        //Today
        $nowDate = now();
        $nowDay = date("d", strtotime($nowDate));
        //Due day
        $dueDay = $this->due_day;
        //Days in this monht
        $daysInThisMontht = date('t', strtotime($nowDate));
        //Get sum
        $sum = ($daysInThisMontht + $dueDay - $nowDay);
        return Carbon::parse(date('Y-m-j', strtotime('+'.$sum.' day', strtotime($nowDate))))->format('d-m-Y');
    }

    public function longDayService(){
        return today()->diffInDays($this->start_date).' días';
    }

}
