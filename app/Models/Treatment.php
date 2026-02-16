<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public function checkups() {
        return $this->hasMany(Checkup::class);
    }
    protected $fillable = ['name'];

}
