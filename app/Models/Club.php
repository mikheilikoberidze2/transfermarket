<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function footballers()
    {
        return $this->hasMany(Footballer::class);
    }

    public function manager()
    {
        return $this->hasOne(User::class,'manager_id')->whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        });
    }
    public function president()
    {
        return $this->hasOne(User::class,'president_id')->whereHas('roles', function ($query) {
            $query->where('name', 'president');
        });
    }
}
