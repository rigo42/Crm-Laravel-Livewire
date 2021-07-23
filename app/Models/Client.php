<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Clientes';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Un cliente ha sido {$eventName}";
    }


    public function categoryClient(){
        return $this->belongsTo(CategoryClient::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function incomeByInvoiceTotal(){
        $invoiceTotal = $this->invoices()->sum('total');
        return '$'.number_format($invoiceTotal, 2, '.', ',');
    }

    public function pendingByInvoiceTotal(){
        $pending = 0;
        $invoices = $this->invoices()->cursor();
        foreach ($invoices as $invoice) {

            $invoiceTotal = $invoice->total;
            $serviceTotal = 0;

            foreach ($invoice->services as $service) {
                
                $serviceTotal += $service->price;
            }

            $pending += ($serviceTotal - $invoiceTotal);
        }

        return '$'.number_format($pending, 2, '.', ',');
    }

    public function pendingByPaymentTotal(){
        
        $totalMontos = $this->payments()->sum('monto');

        $monthsWithThisService = Carbon::parse($this->start_date)->diffInMonths(now());

        $totalIncomeWouldBe = $this->price * $monthsWithThisService;

        $diffTotal = 0;

        if($totalMontos < $totalIncomeWouldBe){
            $diffTotal = $totalIncomeWouldBe - $totalMontos;
        }

        return '$'.number_format($diffTotal, 2, '.', ',');
    }

    public function grossIncomeTotal(){
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

    public function starsToHtml(){
        $starsHtml = '';
        for ($i = 1; $i <= 5; $i++){  
            if($i <= $this->stars){
                $starsHtml .= '<i class="fa fa-star text-warning"></i>';
            }else{
                $starsHtml .= '<i class="fa fa-star text-ligth"></i>';
            }

        }
            
        return $starsHtml;
    }
}
