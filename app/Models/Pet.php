<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    public function owner() {
        return $this->belongsTo(Owner::class);
    }

    public function checkups() {
        return $this->hasMany(Checkup::class);
    }
    protected $fillable = [
        'owner_id',
        'code',
        'name',
        'species',
        'age',
        'weight'
    ];

}
