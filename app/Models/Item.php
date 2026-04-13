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
}
