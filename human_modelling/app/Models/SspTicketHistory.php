<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SspTicketHistory extends Model
{
    use HasFactory;

    public function SspTicket(){
        return $this->belongsTo('App\Models\SspTicket', 'ssp_ticket_id', 'id');
    }  
}
