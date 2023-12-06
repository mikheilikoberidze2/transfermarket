<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = ['name','manager_id','budget'];

    public function footballers()
    {
        return $this->hasMany(Footballer::class);
    }

    public function manager()
    {
        return $this->BelongsTo(User::class,'manager_id')->whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        });
    }
    public function president()
    {
        return $this->BelongsTo(User::class,'president_id')->whereHas('roles', function ($query) {
            $query->where('name', 'president');
        });
    }
    public function updateReceiverBudget($amount)
    {
        $this->budget += $amount;
        $this->save();
    }
    public function updateSenderBudget($amount)
    {
        $this->budget -= $amount;
        $this->save();
    }
}
