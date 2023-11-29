<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class National extends Model
{
    use HasFactory;

    protected $fillable = ['name','manager_id'];

    public function footballers()
    {
        return $this->hasMany(Footballer::class);
    }

    public function manager()
    {
        return $this->BelongsTo(User::class)->whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        });
    }

    public function president()
    {
        return $this->BelongsTo(User::class)->whereHas('roles', function ($query) {
            $query->where('name', 'president');
        });
    }
}
