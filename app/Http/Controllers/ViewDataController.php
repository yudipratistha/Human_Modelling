<?php

namespace App\Http\Controllers;

use App\Models\SspTicket;
use App\Models\SspTime;
use App\Models\SspJointAngle;
use App\Models\SspJointTorque;
use App\Models\SspMeanStrength;
use App\Models\SspPercentCapable;
use App\Models\SspStrengthStdDev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViewDataController extends Controller
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

    public function index()
    {
        $tickets = SspTicket::where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
        return view('admin.viewData.listDataTickets', compact('tickets'));
    }

    public function dataTicketIndex($tiketId)
    {
        // $dataTickets = SspTime::where('user_id', Auth::user()->id)->where('ssp_tickets.id', $tiketId)
        //     ->join('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->join('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
        //     ->cursor()->toArray();

        // $dataTickets = SspTime::select('count(*) as allcount')->where('user_id', Auth::user()->id)->where('ssp_tickets.id', $tiketId)
        //     ->join('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->join('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
        //     ->count();
        // dd($dataTickets);
        return view('admin.viewData.dataTicket', compact('tiketId'));
    }

    public function getDataTicket(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        
        // $totalRecords = SspTime::select('count(*) as allcount')->where('user_id', Auth::user()->id)->where('ssp_tickets.id', $request->tiketId)
        //     ->join('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->join('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
        //     ->count();

        // $totalRecordswithFilter  = SspTime::select('count(*) as allcount')->where('user_id', Auth::user()->id)->where('ssp_tickets.id', $request->tiketId)->where('ssp_times.time', 'like', '%' .$searchValue . '%')
        //     ->join('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->join('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
        //     ->count();


        $totalRecords = DB::table('ssp_times')->select('count(*) as allcount')   
            ->leftJoin('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->leftJoin('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
            ->where('user_id', Auth::user()->id)->where('ssp_tickets.id', $request->tiketId)
            ->count();

        $totalRecordswithFilter  = DB::table('ssp_times')->select('count(*) as allcount')   
            ->leftJoin('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->leftJoin('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
            ->where('user_id', Auth::user()->id)->where('ssp_tickets.id', $request->tiketId)
            ->count();

        $dataTickets = DB::table('ssp_times')->select(
                'ssp_times.time', 'ssp_times.task', 'ssp_times.action',
                'joint_angles_wrist_flex_ext_left', 'joint_angles_wrist_flex_ext_right', 'joint_angles_wrist_rad_ulnar_dev_left', 
                'joint_angles_wrist_rad_ulnar_dev_right', 'joint_angles_forearm_sup_pro_left', 'joint_angles_forearm_sup_pro_left', 'joint_angles_elbow_right', 'joint_angles_elbow_left',
                'joint_angles_shoulder_abd_right', 'joint_angles_shoulder_abd_left', 'joint_angles_shoulder_for_back_right', 'joint_angles_shoulder_for_back_left', 'joint_angles_humeral_rot_right',
                'joint_angles_humeral_rot_left', 'joint_angles_trunk_flex_ext', 'joint_angles_trunk_lateral', 'joint_angles_trunk_rotation', 'joint_angles_hip_flex_ext_right', 'joint_angles_hip_flex_ext_left',
                'joint_angles_knee_flex_ext_right', 'joint_angles_knee_flex_ext_left', 'joint_angles_ankle_flex_ext_right', 'joint_angles_ankle_flex_ext_left',

                'joint_angles_wrist_flex_ext_left', 'joint_torques_wrist_flex_ext_right', 'joint_torques_wrist_rad_ulnar_dev_left', 
                'joint_torques_wrist_rad_ulnar_dev_right', 'joint_torques_forearm_sup_pro_left', 'joint_torques_forearm_sup_pro_left', 'joint_torques_elbow_right', 'joint_torques_elbow_left',
                'joint_torques_shoulder_abd_right', 'joint_torques_shoulder_abd_left', 'joint_torques_shoulder_for_back_right', 'joint_torques_shoulder_for_back_left', 'joint_torques_humeral_rot_right',
                'joint_torques_humeral_rot_left', 'joint_torques_trunk_flex_ext', 'joint_torques_trunk_lateral', 'joint_torques_trunk_rotation', 'joint_torques_hip_flex_ext_right', 'joint_torques_hip_flex_ext_left',
                'joint_torques_knee_flex_ext_right', 'joint_torques_knee_flex_ext_left', 'joint_torques_ankle_flex_ext_right', 'joint_torques_ankle_flex_ext_left',

                'mean_strengths_wrist_flex_ext_left', 'mean_strengths_wrist_flex_ext_right', 'mean_strengths_wrist_rad_ulnar_dev_left', 
                'mean_strengths_wrist_rad_ulnar_dev_right', 'mean_strengths_forearm_sup_pro_left', 'mean_strengths_forearm_sup_pro_left', 'mean_strengths_elbow_right', 'mean_strengths_elbow_left',
                'mean_strengths_shoulder_abd_right', 'mean_strengths_shoulder_abd_left', 'mean_strengths_shoulder_for_back_right', 'mean_strengths_shoulder_for_back_left', 'mean_strengths_humeral_rot_right',
                'mean_strengths_humeral_rot_left', 'mean_strengths_trunk_flex_ext', 'mean_strengths_trunk_lateral', 'mean_strengths_trunk_rotation', 'mean_strengths_hip_flex_ext_right', 'mean_strengths_hip_flex_ext_left',
                'mean_strengths_knee_flex_ext_right', 'mean_strengths_knee_flex_ext_left', 'mean_strengths_ankle_flex_ext_right', 'mean_strengths_ankle_flex_ext_left',

                'percent_capables_wrist_flex_ext_left', 'percent_capables_wrist_flex_ext_right', 'percent_capables_wrist_rad_ulnar_dev_left', 
                'percent_capables_wrist_rad_ulnar_dev_right', 'percent_capables_forearm_sup_pro_left', 'percent_capables_forearm_sup_pro_left', 'percent_capables_elbow_right', 'percent_capables_elbow_left',
                'percent_capables_shoulder_abd_right', 'percent_capables_shoulder_abd_left', 'percent_capables_shoulder_for_back_right', 'percent_capables_shoulder_for_back_left', 'percent_capables_humeral_rot_right',
                'percent_capables_humeral_rot_left', 'percent_capables_trunk_flex_ext', 'percent_capables_trunk_lateral', 'percent_capables_trunk_rotation', 'percent_capables_hip_flex_ext_right', 'percent_capables_hip_flex_ext_left',
                'percent_capables_knee_flex_ext_right', 'percent_capables_knee_flex_ext_left', 'percent_capables_ankle_flex_ext_right', 'percent_capables_ankle_flex_ext_left',

                'strength_std_devs_wrist_flex_ext_left', 'strength_std_devs_wrist_flex_ext_right', 'strength_std_devs_wrist_rad_ulnar_dev_left', 
                'strength_std_devs_wrist_rad_ulnar_dev_right', 'strength_std_devs_forearm_sup_pro_left', 'strength_std_devs_forearm_sup_pro_left', 'strength_std_devs_elbow_right', 'strength_std_devs_elbow_left',
                'strength_std_devs_shoulder_abd_right', 'strength_std_devs_shoulder_abd_left', 'strength_std_devs_shoulder_for_back_right', 'strength_std_devs_shoulder_for_back_left', 'strength_std_devs_humeral_rot_right',
                'strength_std_devs_humeral_rot_left', 'strength_std_devs_trunk_flex_ext', 'strength_std_devs_trunk_lateral', 'strength_std_devs_trunk_rotation', 'strength_std_devs_hip_flex_ext_right', 'strength_std_devs_hip_flex_ext_left',
                'strength_std_devs_knee_flex_ext_right', 'strength_std_devs_knee_flex_ext_left', 'strength_std_devs_ankle_flex_ext_right', 'strength_std_devs_ankle_flex_ext_left'
            )   
                ->leftJoin('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
                ->leftJoin('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
                ->leftJoin('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
                ->leftJoin('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
                ->leftJoin('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
                ->leftJoin('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
                ->where('user_id', Auth::user()->id)->where('ssp_tickets.id', $request->tiketId)
                ->orderBy('ssp_times.id')
                ->simplePaginate(10);



        // $dataTickets = SspTime::select('ssp_times.time', 'ssp_times.task', 'ssp_times.action',
        //     'joint_angles_wrist_flex_ext_left', 'joint_angles_wrist_flex_ext_right', 'joint_angles_wrist_rad_ulnar_dev_left', 
        //     'joint_angles_wrist_rad_ulnar_dev_right', 'joint_angles_forearm_sup_pro_left', 'joint_angles_forearm_sup_pro_left', 'joint_angles_elbow_right', 'joint_angles_elbow_left',
        //     'joint_angles_shoulder_abd_right', 'joint_angles_shoulder_abd_left', 'joint_angles_shoulder_for_back_right', 'joint_angles_shoulder_for_back_left', 'joint_angles_humeral_rot_right',
        //     'joint_angles_humeral_rot_left', 'joint_angles_trunk_flex_ext', 'joint_angles_trunk_lateral', 'joint_angles_trunk_rotation', 'joint_angles_hip_flex_ext_right', 'joint_angles_hip_flex_ext_left',
        //     'joint_angles_knee_flex_ext_right', 'joint_angles_knee_flex_ext_left', 'joint_angles_ankle_flex_ext_right', 'joint_angles_ankle_flex_ext_left',

        //     'joint_angles_wrist_flex_ext_left', 'joint_torques_wrist_flex_ext_right', 'joint_torques_wrist_rad_ulnar_dev_left', 
        //     'joint_torques_wrist_rad_ulnar_dev_right', 'joint_torques_forearm_sup_pro_left', 'joint_torques_forearm_sup_pro_left', 'joint_torques_elbow_right', 'joint_torques_elbow_left',
        //     'joint_torques_shoulder_abd_right', 'joint_torques_shoulder_abd_left', 'joint_torques_shoulder_for_back_right', 'joint_torques_shoulder_for_back_left', 'joint_torques_humeral_rot_right',
        //     'joint_torques_humeral_rot_left', 'joint_torques_trunk_flex_ext', 'joint_torques_trunk_lateral', 'joint_torques_trunk_rotation', 'joint_torques_hip_flex_ext_right', 'joint_torques_hip_flex_ext_left',
        //     'joint_torques_knee_flex_ext_right', 'joint_torques_knee_flex_ext_left', 'joint_torques_ankle_flex_ext_right', 'joint_torques_ankle_flex_ext_left',

        //     'mean_strengths_wrist_flex_ext_left', 'mean_strengths_wrist_flex_ext_right', 'mean_strengths_wrist_rad_ulnar_dev_left', 
        //     'mean_strengths_wrist_rad_ulnar_dev_right', 'mean_strengths_forearm_sup_pro_left', 'mean_strengths_forearm_sup_pro_left', 'mean_strengths_elbow_right', 'mean_strengths_elbow_left',
        //     'mean_strengths_shoulder_abd_right', 'mean_strengths_shoulder_abd_left', 'mean_strengths_shoulder_for_back_right', 'mean_strengths_shoulder_for_back_left', 'mean_strengths_humeral_rot_right',
        //     'mean_strengths_humeral_rot_left', 'mean_strengths_trunk_flex_ext', 'mean_strengths_trunk_lateral', 'mean_strengths_trunk_rotation', 'mean_strengths_hip_flex_ext_right', 'mean_strengths_hip_flex_ext_left',
        //     'mean_strengths_knee_flex_ext_right', 'mean_strengths_knee_flex_ext_left', 'mean_strengths_ankle_flex_ext_right', 'mean_strengths_ankle_flex_ext_left',

        //     'percent_capables_wrist_flex_ext_left', 'percent_capables_wrist_flex_ext_right', 'percent_capables_wrist_rad_ulnar_dev_left', 
        //     'percent_capables_wrist_rad_ulnar_dev_right', 'percent_capables_forearm_sup_pro_left', 'percent_capables_forearm_sup_pro_left', 'percent_capables_elbow_right', 'percent_capables_elbow_left',
        //     'percent_capables_shoulder_abd_right', 'percent_capables_shoulder_abd_left', 'percent_capables_shoulder_for_back_right', 'percent_capables_shoulder_for_back_left', 'percent_capables_humeral_rot_right',
        //     'percent_capables_humeral_rot_left', 'percent_capables_trunk_flex_ext', 'percent_capables_trunk_lateral', 'percent_capables_trunk_rotation', 'percent_capables_hip_flex_ext_right', 'percent_capables_hip_flex_ext_left',
        //     'percent_capables_knee_flex_ext_right', 'percent_capables_knee_flex_ext_left', 'percent_capables_ankle_flex_ext_right', 'percent_capables_ankle_flex_ext_left',

        //     'strength_std_devs_wrist_flex_ext_left', 'strength_std_devs_wrist_flex_ext_right', 'strength_std_devs_wrist_rad_ulnar_dev_left', 
        //     'strength_std_devs_wrist_rad_ulnar_dev_right', 'strength_std_devs_forearm_sup_pro_left', 'strength_std_devs_forearm_sup_pro_left', 'strength_std_devs_elbow_right', 'strength_std_devs_elbow_left',
        //     'strength_std_devs_shoulder_abd_right', 'strength_std_devs_shoulder_abd_left', 'strength_std_devs_shoulder_for_back_right', 'strength_std_devs_shoulder_for_back_left', 'strength_std_devs_humeral_rot_right',
        //     'strength_std_devs_humeral_rot_left', 'strength_std_devs_trunk_flex_ext', 'strength_std_devs_trunk_lateral', 'strength_std_devs_trunk_rotation', 'strength_std_devs_hip_flex_ext_right', 'strength_std_devs_hip_flex_ext_left',
        //     'strength_std_devs_knee_flex_ext_right', 'strength_std_devs_knee_flex_ext_left', 'strength_std_devs_ankle_flex_ext_right', 'strength_std_devs_ankle_flex_ext_left'
        //     )->where('user_id', Auth::user()->id)->where('ssp_tickets.id', $request->tiketId)
        //     ->join('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->join('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
        //     ->join('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
        //     ->cursorPaginate($rowperpage)->toArray();

        // $dataTickets = SspTime::where('ssp_ticket_id', $request->tiketId)->get();

        // $dataTicketArr = array();

        // foreach($dataTickets['data'] as $dataTicketValues){
        //     foreach($dataTicketValues as $dataTicketKey => $dataTicketValue){
        //         $dataTicketArr[$dataTicketKey] = $dataTicketValue;
        //     }
            
        //  }
            
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $dataTickets
         );
         return response()->json($response); 
        //  
        // echo json_encode($response);
        // exit;
        // dd($dataTicketArr);
    }
}
