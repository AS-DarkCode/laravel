<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'address',
        'joiningdate',
        'setamount',
        'profile_pic',
        'role',
    ];

    protected $hidden = [   
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'joiningdate' => 'date',
    ];

    // Relationships
    public function sendpayments()
    {
        return $this->hasMany(Sendpayment::class, 'userid');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'userid');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'userid');
    }

    public function receivepayments()
    {
        return $this->hasMany(Receivepayment::class, 'userid');
    }

    // Total Profit = Set Amount * Present Days
    public function getTotalProfitAttribute()
    {
        $presentDays = $this->attendance()->where('status', 'present')->count();
        return $this->setamount * $presentDays;
    }

    // Total Send Amount by Admin
    public function getTotalSendAttribute()
    {
        return $this->sendpayments()->sum('amount');
    }

    // Total Expense by User
    public function getTotalExpenseAttribute()
    {
        return $this->expenses()->sum('amount');
    }

    // Remaining Amount = Total Profit - Total Send - Total Expense
    public function getRemainingAmountAttribute()
    {
        return $this->total_profit - $this->total_send - $this->total_expense;
    }
}