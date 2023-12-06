<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    protected $fillable = ['footballer_id','price'];

    public function seller()
    {
        return $this->belongsTo(User::class);
    }
    public function footballers()
    {
        return $this->hasMany(Footballer::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
