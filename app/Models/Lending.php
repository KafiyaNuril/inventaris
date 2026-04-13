<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'notes',
        'borrow_date',
        'return_date'
    ];

    protected $casts = [
        'borrow_date' => 'datetime',
        'return_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailLendings()
    {
        return $this->hasMany(DetailLending::class);
    }
}
