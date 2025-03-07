<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receivepayment extends Model
{
    protected $fillable = [
        'userid',
        'siteid',
        'purpose',
        'amount',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'siteid');
    }
}
