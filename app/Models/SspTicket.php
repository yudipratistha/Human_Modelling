<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SspTicket extends Model
{
    use HasFactory;

    public function SspTime(){
        return $this->hasMany('App\Models\SspTime', 'ssp_ticket_id');
    }
    public function SspTicketHistory(){
        return $this->hasMany('App\Models\SspTicketHistory', 'ssp_ticket_id');
    }
}
