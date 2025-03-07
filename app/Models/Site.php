<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'sitelocation',
        'contactorname',
        'area',
        'sitestartingdate',
        'siteendingdate',
        'siteprice',
    ];

    protected $casts = [
        'sitestartingdate' => 'date',
        'siteendingdate' => 'date',
    ];

    // Relationships
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'siteid');
    }

    public function receivepayments()
    {
        return $this->hasMany(Receivepayment::class, 'siteid');
    }
}