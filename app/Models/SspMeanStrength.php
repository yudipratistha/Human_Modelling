<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SspMeanStrength extends Model
{
    use HasFactory;

    public function SspTime(){
        return $this->belongsTo('App\Models\SspTime', 'id_ssp_times', 'id');
    }
}
