<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sendpayment extends Model
{
    protected $fillable = [
        'breif',
        'paymenttype',
        'transationdate',
        'amount',
        'userid',
    ];

    protected $casts = [
        'transationdate' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}