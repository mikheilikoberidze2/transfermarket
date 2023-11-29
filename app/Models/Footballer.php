<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footballer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lastname', 'club_id', 'national_id'];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function national()
    {
        return $this->belongsTo(National::class);
    }

}
