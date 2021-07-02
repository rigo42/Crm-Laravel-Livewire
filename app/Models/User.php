<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function clients(){
        return $this->hasMany(Client::class);
    }

    public function prospects(){
        return $this->hasMany(Prospect::class);
    }

    public function quotations(){
        return $this->hasMany(Quotation::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function paymentTotal(){
        $payments = $this->payments()->sum('monto');
        return '$'.number_format($payments, 2, '.', ',');
    }
    
    public function expenseTotal(){
        $expenses = $this->expenses()->sum('monto');
        return '$'.number_format($expenses, 2, '.', ',');
    }
}
