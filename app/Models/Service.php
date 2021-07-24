<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
{
    use LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Servicios';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Un servicio ha sido {$eventName}";
    }

    
    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function serviceType(){
        return $this->belongsTo(ServiceType::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function invoices(){
        return $this->belongsToMany(Invoice::class)->withTimestamps();
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function grossIncome(){
        $sumPayments = $this->payments()->sum('monto');
        $sumExpenses = $this->expenses()->sum('monto');
        $grossIncome = $sumPayments - $sumExpenses;
        return '$'.number_format($grossIncome, 2, '.', ',');
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
            return Carbon::parse($this->due_date)->format('Y-m-d');
        }else{
            //now date
            $nowDate = date('Y-m-d');
            //now day
            $nowDay = date("d", strtotime($nowDate));
            //Due day
            $dueDay = $this->due_day;
            //Month start service
            $startMonth = Carbon::parse($this->start_date)->format('m');
            //Year start service
            $startYear = Carbon::parse($this->start_date)->format('Y');
            //Start service
            $startServiceStr = strtotime($this->start_date);
            //Days in this month
            $daysInThisMontht = date('t', strtotime($nowDate));

            if($startServiceStr >= strtotime(date('Y-m-d'))){
                //Days in these month
                $daysInThisMontht = date('t', strtotime($this->start_date));
                $diff = Carbon::parse(date('Y-m-d'))->diffInDays($this->start_date);
                $sum = ($daysInThisMontht + ($dueDay - $nowDay) + $diff); 

            }else{
                if($startYear < date('Y')){
                    if($dueDay == date('j') && $startMonth == date('m')){
                        $sum = ($dueDay - $nowDay); 
                    }
                    elseif($dueDay == date('j') && $startMonth < date('m')){
                        $sum = ($dueDay - $nowDay);
    
                    }
                    elseif($dueDay < date('j') && $startMonth <= date('m')){
                        $sum = ($daysInThisMontht + ($dueDay - $nowDay));  
    
                    }
                    elseif($dueDay > date('j') && $startMonth < date('m')){
                        $sum = ($dueDay - $nowDay);
                        
                    }
                    else{
                        $sum = ($daysInThisMontht + ($dueDay - $nowDay));
                    }
                }else{
                    if($dueDay == date('j') && $startMonth == date('m')){
                        $sum = ($daysInThisMontht + ($dueDay - $nowDay)); 
    
                    }
                    elseif($dueDay == date('j') && $startMonth < date('m')){
                        $sum = ($dueDay - $nowDay);
    
                    }
                    elseif($dueDay < date('j') && $startMonth < date('m')){
                        $sum = ($daysInThisMontht + ($dueDay - $nowDay));  
    
                    }
                    elseif($dueDay > date('j') && $startMonth < date('m')){
                        $sum = ($dueDay - $nowDay);
                    }
                    else{
                        $sum = ($daysInThisMontht + ($dueDay - $nowDay));
                        
                    }
                }
                
            }
                
            return Carbon::parse(date('Y-m-d', strtotime('+'.$sum.' day', strtotime($nowDate))))->format('Y-m-d');
            
            
        }
    }

    public function pendingByPaymentTotal(){
        $totalMontos = $this->payments()->sum('monto');

        if ($this->type == 'Proyecto') {
            if($totalMontos < $this->price){
                $diffTotal =  $this->price - $totalMontos;
                
            }else{
                $diffTotal = 0;
            }

            return '$'.number_format($diffTotal, 2, '.', ',');
            
        }else{
            $monthsWithThisService = Carbon::parse($this->start_date)->diffInMonths(now());
            $diffTotal = 0;

            if($monthsWithThisService == 0){
                $diffTotal = 0;
    
                if($totalMontos < $this->price){
                    $diffTotal = $this->price - $totalMontos;
                }

            }else{
                $totalIncomeWouldBe = $this->price * $monthsWithThisService;

                $diffTotal = 0;
    
                if($totalMontos < $totalIncomeWouldBe){
                    $diffTotal = $totalIncomeWouldBe - $totalMontos;
                }
            }

            

            return '$'.number_format($diffTotal, 2, '.', ',');
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
            if($diferenceGeneral == 0){
                return 100;
            }else{
                $diferenceDue = $diferenceGeneral - Carbon::parse($now)->diffInDays($due);
                $progress = floor((100 * $diferenceDue) / $diferenceGeneral);
                return $progress;
            }
            
        }
    }

    static function dayCutService(){
        $thisDay = Carbon::now()->format('j');

        $services = Service::query()
                            ->whereNull('finished')
                            ->where('type', 'Mensual')
                            ->where('due_day', $thisDay)
                            ->whereDoesntHave('payments', function ($query) {
                                $query->whereDate('cutoff_date', date('Y-m-d'));
                            })
                            ->whereMonth('start_date', '<', date('m'))
                            ->orWhereYear('start_date', '<', date('Y'))
                            ->get();
        
        $servicesArray = array();  

        foreach ($services as $service) {
            $service->payment_date = date('Y-m-d');
                    
            $serviceObjectNew = new Service($service->toArray());
        
            array_push($servicesArray, $serviceObjectNew);
        }

        return $servicesArray;
    }

    static function weekCutService(){
        //Obtener rango de esta semana
        $firstDayThisWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $finishedDayThisWeek = Carbon::now()->endOfWeek()->format('Y-m-d');
        
        //Obtener los servicios que no tienen un pago en esta semana
        $services = Service::query()
                            ->orderBy('due_day', 'desc')
                            ->whereNull('finished')
                            ->where('type', 'Mensual')
                            ->whereDoesntHave('payments', function ($query) use($firstDayThisWeek, $finishedDayThisWeek) {
                                $query->whereBetween('cutoff_date', [$firstDayThisWeek, $finishedDayThisWeek]);
                            })
                            ->whereMonth('start_date', '<', date('m'))
                            ->orWhereYear('start_date', '<', date('Y'))
                            ;
        
        $datesThisWeek = [];
        for($i = 1; $i <=7; $i++){ //7 dias de la semana
            //Obtener fechas desde el primer inicio de la semana pasada
            $otherDay = Carbon::parse($firstDayThisWeek)->addDays(($i - 1)); 

            //Rellenar array que contendrá el día y la fecha de cada día recorrido de la semana pasada
            array_push($datesThisWeek, array('day' => $otherDay->format('j'), 'date' => $otherDay->format('Y-m-d')));
        }

        $daysArray = array();
        $servicesArray = array();  

        foreach($datesThisWeek as $dateThisWeek){
            array_push($daysArray, $dateThisWeek['day']);
        }
            
        $services = $services->whereIn('due_day', $daysArray)->get();

        foreach ($services as $service) {
            foreach ($datesThisWeek as $dateThisWeek) {
                if($dateThisWeek['day'] == $service->due_day){

                    $service->payment_date = $dateThisWeek['date'];
                    
                    $serviceObjectNew = new Service($service->toArray());
                
                    array_push($servicesArray, $serviceObjectNew);

                    
                }
            }   
        }         
        
        return $servicesArray;
    }

    static function backCutService(){
        $minStartDate = Service::whereNull('finished')->min('start_date');
        //Obtener rango de este mes
        $firstDateService = Carbon::parse($minStartDate);
        $finishedBackCutDateService = Carbon::now()->startOfWeek()->subDay(1);
        
        //Obtener los servicios que no tienen un pago desde que iniciaron
        $services = Service::query()
                            ->orderBy('due_day', 'desc')
                            ->whereNull('finished')
                            ->where('type', 'Mensual')
                            ->whereDoesntHave('payments', function ($query) use($firstDateService, $finishedBackCutDateService) {
                                $query->whereBetween('cutoff_date', [$firstDateService->format('Y-m-d'), $finishedBackCutDateService->format('Y-m-d')]);
                            })
                            ->whereMonth('start_date', '<', date('m'))
                            ->orWhereYear('start_date', '<', date('Y'))
                            ;
        
        $datesCuts = array();
        $daysArray = array();

        $diff = $firstDateService->diffInDays($finishedBackCutDateService);

        for($i = 1; $i <= $diff; $i++){ 
            //Obtener fechas
            $otherDay = Carbon::parse($firstDateService)->addDays(($i - 1)); 

            //Rellenar array que contendrá el día y la fecha de cada día recorrido de la semana pasada
            array_push($datesCuts, array(
                                        'day' => $otherDay->format('j'), 
                                        'month' => $otherDay->format('m'), 
                                        'year' => $otherDay->format('Y'), 
                                        'date' => $otherDay->format('Y-m-d')
                                    )
                        );
            array_push($daysArray, $otherDay->format('j'));
        }

        $datesCuts = array_reverse($datesCuts);
        
        $services = $services->get();

        $servicesArray = array();  
        
        foreach ($services as $service) {
            foreach ($datesCuts as $dateCut) {

                if($dateCut['day'] == $service->due_day){
                    
                    $servicesIf = $service->whereDoesntHave('payments', function ($query) use($dateCut) {
                                            $query->whereMonth('date', $dateCut['month'])
                                                    ->whereYear('date', $dateCut['year']);
                                        })->count();

                    if($servicesIf){

                       if((int) $dateCut['month'] > (int) Carbon::parse($service->start_date)->format('m') || (int) $dateCut['year'] > (int) Carbon::parse($service->start_date)->format('Y')){
                            $service->payment_date = $dateCut['date'];
                            $serviceObjectNew = new Service($service->toArray());
    
                            array_push($servicesArray, $serviceObjectNew);
                            
                        }
                        
                        
                        
                    }
                    
                }
            }   

        }

        return $servicesArray;
    }

    
}
