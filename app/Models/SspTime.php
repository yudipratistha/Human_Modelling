<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SspTime extends Model
{
    use HasFactory;
    // protected $primaryKey = "id";
    // public function createManyRecord(array $records){
    //     foreach ($records as $record) {
    //         $this->insert($record);
    //     }
    //     return $this;
    // }
    // protected $fillable = ['time', 'task', 'action'];

    public function SspTicket(){
        return $this->belongsTo('App\Models\SspTicket', 'ssp_ticket_id', 'id');
    }    
    
    public function SspJointAngle(){
        return $this->hasMany('App\Models\SspJointAngle', 'id_ssp_times');
    }

    public function SspJointTorque(){
        return $this->hasMany('App\Models\SspJointTorque', 'id_ssp_times');
    }

    public function SspMeanStrength(){
        return $this->hasMany('App\Models\SspMeanStrength', 'id_ssp_times');
    }
    
    public function SspPercentCapable(){
        return $this->hasMany('App\Models\SspPercentCapable', 'id_ssp_times');
    }

    public function SspStrengthStdDev(){
        return $this->hasMany('App\Models\SspStrengthStdDev', 'id_ssp_times');
    }
}
