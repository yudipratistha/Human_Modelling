<?php

namespace App\Http\Controllers;

use App\Models\SspTicket;
use App\Models\SspTicketHistory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TicketListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ticketsListAdminIndex(){
        $tickets = SspTicket::whereBetween('ssp_ticket_status', [1, 3])->orderBy('id','DESC')->paginate(10);
        // dd($tickets);
        return view('admin.data.ticketsList', compact('tickets'));
    }

    public function ticketAdminGetEditData($ticketId){
        $ticket = SspTicket::find($ticketId);
        return response()->json($ticket);
    }

    public function updateTicketDataAdmin(Request $request){
        $this->validate($request,[
            'edit_job_title' => 'required',
            'edit_job_location' => 'required',
            'edit_job_date' => 'required',
            'edit_job_description' => 'required',
            'edit_job_lat_location' => 'required',
            'edit_job_lng_location' => 'required'
        ]);

        $ticket = SspTicket::find($request->ticket_id);
        $ticket->ssp_ticket_job_title = $request->edit_job_title;
        $ticket->ssp_ticket_job_date = date('Y-m-d', strtotime($request->edit_job_date));
        $ticket->ssp_ticket_job_description = $request->edit_job_description;
        $ticket->ssp_ticket_job_location = $request->edit_job_location;
        $ticket->ssp_ticket_job_lat_location = $request->edit_job_lat_location;
        $ticket->ssp_ticket_job_lng_location = $request->edit_job_lng_location;
        $ticket->save();

        return response()->json('success');
    }

    public function destroyTicketDataAdmin($ticketId){
        $ticket = SspTicket::where('ssp_tickets.id', $ticketId)->where('user_id', Auth::user()->id)
        ->update(['ssp_ticket_status'=> 0]);

        $ticketHistory = new SspTicketHistory;
        $ticketHistory->ssp_ticket_id = $ticketId;
        $ticketHistory->ssp_ticket_histories_status = 0;
        $ticketHistory->save();

        return response()->json('success');
    }
    

    public function ticketDataUserStore(Request $request){
        $this->validate($request,[
            'job_title' => 'required',
            'job_location' => 'required',
            'job_date' => 'required',
            'job_description' => 'required',
            'job_lat_location' => 'required',
            'job_lng_location' => 'required'
        ]);

        $ticket = new SspTicket;
        $ticket->user_id = Auth::user()->id;
        $ticket->ssp_ticket_job_title = $request->job_title;
        $ticket->ssp_ticket_job_analyst = "-";
        $ticket->ssp_ticket_job_date = date('Y-m-d', strtotime($request->job_date));
        $ticket->ssp_ticket_job_description = $request->job_description;
        $ticket->ssp_ticket_job_location = $request->job_location;
        $ticket->ssp_ticket_job_lat_location = $request->job_lat_location;
        $ticket->ssp_ticket_job_lng_location = $request->job_lng_location;
        $ticket->ssp_ticket_status = 1;
        $ticket->save();

        $ticketHistory = new SspTicketHistory;
        $ticketHistory->ssp_ticket_id = $ticket->id;
        $ticketHistory->ssp_ticket_histories_status = 1;
        $ticketHistory->save();

        return response()->json('success');
    }

    public function ticketsListUserIndex(){
        $tickets = SspTicket::where('user_id', Auth::user()->id)->whereBetween('ssp_ticket_status', [1, 3])->orderBy('id','DESC')->paginate(10);
        // dd($tickets);
        return view('user.data.ticketsList', compact('tickets'));
    }

    public function ticketUserGetEditData($ticketId){
        $ticket = SspTicket::find($ticketId);
        return response()->json($ticket);
    }

    public function updateTicketDataUser(Request $request){
        $this->validate($request,[
            'edit_job_title' => 'required',
            'edit_job_location' => 'required',
            'edit_job_date' => 'required',
            'edit_job_description' => 'required',
            'edit_job_lat_location' => 'required',
            'edit_job_lng_location' => 'required'
        ]);

        $ticket = SspTicket::find($request->ticket_id);
        $ticket->ssp_ticket_job_title = $request->edit_job_title;
        $ticket->ssp_ticket_job_date = date('Y-m-d', strtotime($request->edit_job_date));
        $ticket->ssp_ticket_job_description = $request->edit_job_description;
        $ticket->ssp_ticket_job_location = $request->edit_job_location;
        $ticket->ssp_ticket_job_lat_location = $request->edit_job_lat_location;
        $ticket->ssp_ticket_job_lng_location = $request->edit_job_lng_location;
        $ticket->save();

        return response()->json('success');
    }

    public function destroyTicketDataUser($ticketId){
        $ticket = SspTicket::where('ssp_tickets.id', $ticketId)->where('user_id', Auth::user()->id)
        ->update(['ssp_ticket_status'=> 0]);

        $ticketHistory = new SspTicketHistory;
        $ticketHistory->ssp_ticket_id = $ticketId;
        $ticketHistory->ssp_ticket_histories_status = 0;
        $ticketHistory->save();

        return response()->json('success');
    }
}
