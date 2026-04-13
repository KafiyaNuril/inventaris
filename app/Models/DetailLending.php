<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailLending extends Model
{
    protected $fillable = [
        'lending_id',
        'item_id',
        'qty',
    ];

    public function lending() 
    {
        return $this->belongsTo(Lending::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
