<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    public function pet() {
        return $this->belongsTo(Pet::class);
    }

    public function treatment() {
        return $this->belongsTo(Treatment::class);
    }
    protected $fillable = ['pet_id','treatment_id','checkup_date','notes'];

}
