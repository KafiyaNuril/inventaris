<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'total',
        'repair'
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function detailLendings()
    {
        return $this->hasMany(DetailLending::class);
    }

    public function getAvailableAttribute()
    {
        $lending = $this->detailLendings()
            ->whereHas('lending', fn($q) => $q->whereNull('return_date'))
            ->sum('qty');

        return $this->total - ( $this->repair ?? 0 ) - $lending;
    }
}
