<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

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

    public function invoices(){
        return $this->belongsToMany(Invoice::class)->withTimestamps();
    }

    public function payments(){
        return $this->belongsToMany(Payment::class)->withTimestamps();
    }

    public function expenses(){
        return $this->belongsToMany(Expense::class)->withTimestamps();
    }

    public function incomeByInvoiceTotal(){
        $invoiceTotal = $this->invoices()->sum('total');
        return '$'.number_format($invoiceTotal, 2, '.', ',');
    }

    public function paymentTotal(){
        $payments = $this->payments()->sum('monto');
        return '$'.number_format($payments, 2, '.', ',');
    }
    
    public function expenseTotal(){
        $expenses = $this->expenses()->sum('monto');
        return '$'.number_format($expenses, 2, '.', ',');
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
            return 'Día '.$this->due_day;
        }
    }

    public function progressByProject(){
        $now = date('Y-m-d');
        $start = $this->start_date;
        $due = $this->due_date;

        if(strtotime($now) > strtotime($due)){
            return 100;
        }elseif(strtotime($now) < strtotime($start)){
            return 0;
        }else{
            $diferenceGeneral = Carbon::parse($start)->diffInDays($due);
            $diferenceDue = $diferenceGeneral - Carbon::parse($now)->diffInDays($due);
            $progress = floor((100 * $diferenceDue) / $diferenceGeneral);
            return $progress;
        }
    }

    static function weekCutService(){
        $userPresent = User::find(Auth::id());
        $firstDayThisWeek = Carbon::now()->startOfWeek();
        $endDayThisWeek = Carbon::now()->endOfWeek();
        $services = Service::orderBy('due_day', 'desc')->whereNull('finished');

        if(!$userPresent->hasRole('Administrador')){
            $services = $services->whereHas('client', function($query) use($userPresent) {
                $query('user_id', $userPresent->id);
            });
        }
        
        $daysArray = [];
        for($i = 1; $i <=7; $i++){
            $otherDay = Carbon::parse($firstDayThisWeek)->addDays(($i - 1));
            array_push($daysArray, $otherDay->format('j'));
        }

        $services = $services->whereIn('due_day', $daysArray);

        return $services = $services->get();
    }
}
