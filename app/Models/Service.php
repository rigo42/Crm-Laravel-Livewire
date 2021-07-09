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

    public function startDateToString(){
        return Carbon::parse($this->start_date)->toFormattedDateString();
    }

    public function dueDateToString(){
        $due = $this->due();
        return Carbon::parse($due)->toFormattedDateString();
    }

    public function due(){
        if($this->type == 'Proyecto'){
            return Carbon::parse($this->due_date);
        }else{
            //now date
            $nowDate = date('Y-m-d');
            //now day
            $nowDay = date("d", strtotime($nowDate));
            //Due day
            $dueDay = $this->due_day;
            //Month start service
            $startDay = Carbon::parse($this->start_date)->format('j');
            //Month start service
            $startMonth = Carbon::parse($this->start_date)->format('m');
            //Year start service
            $startYear = Carbon::parse($this->start_date)->format('Y');
            //Days in this month
            $daysInThisMontht = date('t', strtotime($nowDate));

            if(strtotime($this->start_date) > strtotime(date('Y-m-d'))){
                //Days in these month
                $daysInThisMontht = date('t', strtotime($this->start_date));
                $diff = Carbon::parse(date('Y-m-d'))->diffInDays($this->start_date);
                $sum = ($daysInThisMontht + ($dueDay - $nowDay) + $diff);            

            }else{
                if($dueDay == date('j')){
                    $sum = 0;
                }
                elseif($dueDay < date('j')){
                    //dd($dueDay.' == '.date('j'));
                    $sum = ($daysInThisMontht + ($dueDay - $nowDay)); 
                   
                }
                elseif($dueDay > date('j')){
                    $sum = ($dueDay - $nowDay); 
                }
            }
            

            return Carbon::parse(date('Y-m-d', strtotime('+'.$sum.' day', strtotime($nowDate))));
            
            
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

    static function dayCutService(){
        $thisDay = Carbon::now()->format('j');

        $services = Service::query()
                            ->whereNull('finished')
                            ->where('due_day', $thisDay)
                            ->whereMonth('start_date', '<', date('m'))
                            ->orWhereYear('start_date', '<', date('Y'))
                            ->whereDoesntHave('payments', function ($query) use($thisDay) {
                                $query->whereDate('date', date('Y-m-d'));
                            })->get();
                            
        $services->payment_date = date('Y-m-d');
        return $services;
    }

    static function weekCutService(){
        //Obtener rango de esta semana
        $firstDayThisWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $finishedDayThisWeek = Carbon::now()->endOfWeek()->format('Y-m-d');
        
        //Obtener los servicios que no tienen un pago en esta semana
        $services = Service::query()
                            ->orderBy('due_day', 'desc')
                            ->whereNull('finished')
                            ->whereMonth('start_date', '<', date('m'))
                            ->orWhereYear('start_date', '<', date('Y'))
                            ->whereDoesntHave('payments', function ($query) use($firstDayThisWeek, $finishedDayThisWeek) {
                                $query->whereBetween('date', [$firstDayThisWeek, $finishedDayThisWeek]);
                            });
        
        $datesThisWeek = [];
        for($i = 1; $i <=7; $i++){ //7 dias de la semana
            //Obtener fechas desde el primer inicio de la semana pasada
            $otherDay = Carbon::parse($firstDayThisWeek)->addDays(($i - 1)); 

            //Rellenar array que contendrá el día y la fecha de cada día recorrido de la semana pasada
            array_push($datesThisWeek, array('day' => $otherDay->format('j'), 'date' => $otherDay->format('Y-m-d')));
        }

        $daysArray = array();
        foreach($datesThisWeek as $dateThisWeek){
            array_push($daysArray, $dateThisWeek['day']);
        }
            
        $services = $services->whereIn('due_day', $daysArray)->get();

        $services->map(function($service) use($datesThisWeek) {
            foreach ($datesThisWeek as $dateThisWeek) {
                if($dateThisWeek['day'] == $service->due_day){
                    $service->payment_date = $dateThisWeek['date'];
                }
            }            
        });

        return $services;
    }



    static function backCutService(){
        $firstBackWeek = Carbon::now()->startOfWeek()->subDay(1)->format('Y-m-d');
        
        $services = Service::query()
                            ->orderBy('due_day', 'desc')
                            ->whereNull('finished')
                            ->where('due_day', '<=', Carbon::now()->startOfWeek()->subDay(1)->format('j'))
                            ->whereMonth('start_date', '<', date('m'))
                            ->orWhereYear('start_date', '<', date('Y'))
                            ->whereDoesntHave('payments', function ($query) use($firstBackWeek) {
                                $query->where('date', '<', $firstBackWeek);
                            })->get();


        return $services;
    }
}
