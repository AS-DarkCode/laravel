<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances'; 

    protected $fillable = [
        'userid',
        'siteid',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'status' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'siteid');
    }
}