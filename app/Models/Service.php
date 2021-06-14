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

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function priceToString(){
        return '$'.number_format($this->price, 2, '.', ',');
    }

    public function start(){
        return Carbon::parse($this->start_date)->format('d-m-Y');
    }

    public function due(){
        if($this->type == 'Proyecto'){
            return Carbon::parse($this->due_date)->format('d-m-Y');
        }else{
            //Today
            $nowDay = date("d", strtotime(now()));
            //Due day
            $dueDay = $this->due_day;
            //Days in this monht
            $daysInThisMontht = date('t', strtotime(now()));
            //Get sum
            $sum = ($daysInThisMontht + $dueDay - $nowDay);
            $dueDate = strtotime('+'.$sum.' day', strtotime(now()));
            return Carbon::parse($dueDate)->format('d-m-Y');
        }
    }

    public function progressByProject(){
        $now = now()->toDateString();
        $nowDay = date("d", strtotime(now()));
        $start = $this->start_date;
        $due = $this->due_date;

        if($now > $due){
            return 100;
        }else{
            $diferenceGeneral = Carbon::parse($due)->diffInDays($start);
            $progress = floor(($nowDay * 100) / $diferenceGeneral);
            return $progress;
        }
    }

    public function progressByMohts(){
        return today()->diffInDays($this->due()).' días restantes';
    }

}
