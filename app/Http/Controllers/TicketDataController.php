<?php

namespace App\Http\Controllers;

use App\Models\SspTicket;
use App\Models\SspTicketHistory;
use App\Models\SspTime;
use App\Models\SspJointAngle;
use App\Models\SspJointTorque;
use App\Models\SspMeanStrength;
use App\Models\SspPercentCapable;
use App\Models\SspStrengthStdDev;
use App\Models\SspRula;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TicketDataController extends Controller
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

    public function dataTicketAdminIndex($ticketId){
        try {
            $ticket = SspTicket::whereBetween('ssp_ticket_status', [2, 3])->find($ticketId);
            // dd($ticket->ssp_calc_type);
            if(empty($ticket)){
                abort(404, "Data Not Found");
            }else if($ticket->ssp_calc_type === 1){
                return view('admin.data.ticketData', compact('ticketId', 'ticket'));
            }else if($ticket->ssp_calc_type === 2){
                return view('admin.data.ticketDataReba', compact('ticketId', 'ticket'));
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getDataTicketAdmin(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        // $columnIndex = $columnIndex_arr[0]['column'];
        // $columnName = $columnName_arr[$columnIndex]['data'];
        // $columnSortOrder = $order_arr[0]['dir'];
        // $searchValue = $search_arr['value'];

        $totalRecords = DB::table('ssp_times')->select('count(*) as allcount')
            ->leftJoin('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->leftJoin('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
            ->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->count();

        // $totalRecordswithFilter  = DB::table('ssp_times')->select('count(*) as allcount')
        //     ->leftJoin('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->leftJoin('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
        //     ->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.task', 'like', '%' .$searchValue . '%')
        //     ->count();

        $dataErgonomics = DB::table('ssp_times')->select(
                'ssp_tickets.id as ssp_ticket_id', 'ssp_tickets.ssp_ticket_status',
                'ssp_times.id as ssp_time_id', 'ssp_times.time', 'ssp_times.task', 'ssp_times.action',
                'joint_angles_wrist_flex_ext_left', 'joint_angles_wrist_flex_ext_right', 'joint_angles_wrist_rad_ulnar_dev_left',
                'joint_angles_wrist_rad_ulnar_dev_right', 'joint_angles_forearm_sup_pro_left', 'joint_angles_forearm_sup_pro_right', 'joint_angles_elbow_right', 'joint_angles_elbow_left',
                'joint_angles_shoulder_abd_right', 'joint_angles_shoulder_abd_left', 'joint_angles_shoulder_for_back_right', 'joint_angles_shoulder_for_back_left', 'joint_angles_humeral_rot_right',
                'joint_angles_humeral_rot_left', 'joint_angles_trunk_flex_ext', 'joint_angles_trunk_lateral', 'joint_angles_trunk_rotation', 'joint_angles_hip_flex_ext_right', 'joint_angles_hip_flex_ext_left',
                'joint_angles_knee_flex_ext_right', 'joint_angles_knee_flex_ext_left', 'joint_angles_ankle_flex_ext_right', 'joint_angles_ankle_flex_ext_left',

                'joint_torques_wrist_flex_ext_left', 'joint_torques_wrist_flex_ext_right', 'joint_torques_wrist_rad_ulnar_dev_left',
                'joint_torques_wrist_rad_ulnar_dev_right', 'joint_torques_forearm_sup_pro_left', 'joint_torques_forearm_sup_pro_right', 'joint_torques_elbow_right', 'joint_torques_elbow_left',
                'joint_torques_shoulder_abd_right', 'joint_torques_shoulder_abd_left', 'joint_torques_shoulder_for_back_right', 'joint_torques_shoulder_for_back_left', 'joint_torques_humeral_rot_right',
                'joint_torques_humeral_rot_left', 'joint_torques_trunk_flex_ext', 'joint_torques_trunk_lateral', 'joint_torques_trunk_rotation', 'joint_torques_hip_flex_ext_right', 'joint_torques_hip_flex_ext_left',
                'joint_torques_knee_flex_ext_right', 'joint_torques_knee_flex_ext_left', 'joint_torques_ankle_flex_ext_right', 'joint_torques_ankle_flex_ext_left',

                'mean_strengths_wrist_flex_ext_left', 'mean_strengths_wrist_flex_ext_right', 'mean_strengths_wrist_rad_ulnar_dev_left',
                'mean_strengths_wrist_rad_ulnar_dev_right', 'mean_strengths_forearm_sup_pro_left', 'mean_strengths_forearm_sup_pro_right', 'mean_strengths_elbow_right', 'mean_strengths_elbow_left',
                'mean_strengths_shoulder_abd_right', 'mean_strengths_shoulder_abd_left', 'mean_strengths_shoulder_for_back_right', 'mean_strengths_shoulder_for_back_left', 'mean_strengths_humeral_rot_right',
                'mean_strengths_humeral_rot_left', 'mean_strengths_trunk_flex_ext', 'mean_strengths_trunk_lateral', 'mean_strengths_trunk_rotation', 'mean_strengths_hip_flex_ext_right', 'mean_strengths_hip_flex_ext_left',
                'mean_strengths_knee_flex_ext_right', 'mean_strengths_knee_flex_ext_left', 'mean_strengths_ankle_flex_ext_right', 'mean_strengths_ankle_flex_ext_left',

                'percent_capables_wrist_flex_ext_left', 'percent_capables_wrist_flex_ext_right', 'percent_capables_wrist_rad_ulnar_dev_left',
                'percent_capables_wrist_rad_ulnar_dev_right', 'percent_capables_forearm_sup_pro_left', 'percent_capables_forearm_sup_pro_right', 'percent_capables_elbow_right', 'percent_capables_elbow_left',
                'percent_capables_shoulder_abd_right', 'percent_capables_shoulder_abd_left', 'percent_capables_shoulder_for_back_right', 'percent_capables_shoulder_for_back_left', 'percent_capables_humeral_rot_right',
                'percent_capables_humeral_rot_left', 'percent_capables_trunk_flex_ext', 'percent_capables_trunk_lateral', 'percent_capables_trunk_rotation', 'percent_capables_hip_flex_ext_right', 'percent_capables_hip_flex_ext_left',
                'percent_capables_knee_flex_ext_right', 'percent_capables_knee_flex_ext_left', 'percent_capables_ankle_flex_ext_right', 'percent_capables_ankle_flex_ext_left',

                'strength_std_devs_wrist_flex_ext_left', 'strength_std_devs_wrist_flex_ext_right', 'strength_std_devs_wrist_rad_ulnar_dev_left',
                'strength_std_devs_wrist_rad_ulnar_dev_right', 'strength_std_devs_forearm_sup_pro_left', 'strength_std_devs_forearm_sup_pro_right', 'strength_std_devs_elbow_right', 'strength_std_devs_elbow_left',
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
            ->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $dataErgonomics
        );

        if($dataErgonomics->isEmpty()){
            return response()->json(['error' => "Data Not Found"], 404);
        }else{
            return response()->json($response);
        }
    }

    public function approveDataTicketAdmin($ticketId){
        $ticket = SspTicket::find($ticketId);
        $ticket->ssp_ticket_status = 3;
        $ticket->save();

        $ticketHistory = new SspTicketHistory;
        $ticketHistory->ssp_ticket_id = $ticketId;
        $ticketHistory->ssp_ticket_histories_status = 3;
        $ticketHistory->save();

        return response()->json('success');
    }

    public function updateSspRulaDataAdmin(Request $request){
        DB::table('ssp_rula')
            ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.id', $request->ticket_id)->where('ssp_times.id', $request->time_id)->where('ssp_times.time_status', 1)
            ->update([
                // 'ssp_times.time' => $request->time, 'ssp_times.task' => $request->task,'ssp_times.action' => $request->action,
                'ssp_rula_upper_arm_left' => $request->upper_arm_left, 'ssp_rula_upper_arm_right' => $request->upper_arm_right, 'ssp_rula_lower_arm_left' => $request->lower_arm_left, 'ssp_rula_lower_arm_right' => $request->lower_arm_right, 'ssp_rula_wrist_left' => $request->wrist_left,
                'ssp_rula_wrist_right' => $request->wrist_right, 'ssp_rula_wrist_twist_left' => $request->wrist_twist_left, 'ssp_rula_wrist_twist_right' => $request->wrist_twist_right, 'ssp_rula_neck' => $request->neck, 'ssp_rula_trunk_position' => $request->trunk_position, 'ssp_rula_legs' => $request->legs
            ]);

        return response()->json('success');
    }

    public function destroySspRulaDataAdmin($timeId){
        DB::table('ssp_rula')
            ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_times.id', $timeId)
            ->update(['ssp_rula.ssp_rula_status'=> 0]);

        return response()->json('success');
    }

    public function getDataSspRulaAdmin(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        // $columnIndex = $columnIndex_arr[0]['column'];
        // $columnName = $columnName_arr[$columnIndex]['data'];
        // $columnSortOrder = $order_arr[0]['dir'];
        // $searchValue = $search_arr['value'];

        $totalRecords = DB::table('ssp_rula')->select('count(*) as allcount')
            ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.id', $request->ticketId)->where('ssp_rula.ssp_rula_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->when(isset($request->filterActionLevel), function ($query)  use ($request) {
                if($request->filterActionLevel === "Level 1"){
                    $query->whereRaw('(ssp_rula_table_c = 1 || ssp_rula_table_c = 2)');
               }else if($request->filterActionLevel === "Level 2"){
                   $query->whereRaw('(ssp_rula_table_c = 3 || ssp_rula_table_c = 4)');
               }else if($request->filterActionLevel === "Level 3"){
                   $query->whereRaw('(ssp_rula_table_c = 5 || ssp_rula_table_c = 6)');
               }else if($request->filterActionLevel === "Level 4"){
                   $query->where('ssp_rula_table_c', '>=', 7);
               }
            })
            ->count();

        // $totalRecordswithFilter  = DB::table('ssp_times')->select('count(*) as allcount')
        //     ->leftJoin('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->leftJoin('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
        //     ->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.task', 'like', '%' .$searchValue . '%')
        //     ->count();

        $dataRula = DB::table('ssp_rula')->select(
                'ssp_tickets.id as ssp_ticket_id', 'ssp_tickets.ssp_ticket_status',
                'ssp_times.id as ssp_time_id', 'ssp_times.time',
                'ssp_rula_table_c', 'ssp_rula_table_b', 'ssp_rula_table_a',
                'ssp_rula_upper_arm_left', 'ssp_rula_upper_arm_right', 'ssp_rula_lower_arm_left', 'ssp_rula_lower_arm_right', 'ssp_rula_wrist_left',
                'ssp_rula_wrist_right', 'ssp_rula_wrist_twist_left', 'ssp_rula_wrist_twist_right', 'ssp_rula_neck', 'ssp_rula_trunk_position', 'ssp_rula_legs'
            )
            ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.id', $request->ticketId)->where('ssp_rula.ssp_rula_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->when(isset($request->filterActionLevel), function ($query)  use ($request) {
                if($request->filterActionLevel === "Level 1"){
                     $query->whereRaw('(ssp_rula_table_c = 1 || ssp_rula_table_c = 2)');
                }else if($request->filterActionLevel === "Level 2"){
                    $query->whereRaw('(ssp_rula_table_c = 3 || ssp_rula_table_c = 4)');
                }else if($request->filterActionLevel === "Level 3"){
                    $query->whereRaw('(ssp_rula_table_c = 5 || ssp_rula_table_c = 6)');
                }else if($request->filterActionLevel === "Level 4"){
                    $query->where('ssp_rula_table_c', '>=', 7);
                }
            })
            ->skip($start)
            ->take($rowperpage)
            ->get();

        if($dataRula->isEmpty()){
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecords,
                "aaData" => []
            );
            return response()->json($response);
        }else{
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecords,
                "aaData" => $dataRula
            );
            return response()->json($response);
        }
    }

    public function getDataSspRebaAdmin(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        // $columnIndex = $columnIndex_arr[0]['column'];
        // $columnName = $columnName_arr[$columnIndex]['data'];
        // $columnSortOrder = $order_arr[0]['dir'];
        // $searchValue = $search_arr['value'];

        $totalRecords = DB::table('ssp_reba')->select('count(*) as allcount')
            ->leftJoin('ssp_times', 'ssp_reba.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_reba.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.id', $request->ticketId)->where('ssp_reba.ssp_reba_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->when(isset($request->filterActionLevel), function ($query)  use ($request) {
                if($request->filterActionLevel === "Level 1"){
                    $query->whereRaw('(ssp_reba_table_c = 1 || ssp_reba_table_c = 2)');
               }else if($request->filterActionLevel === "Level 2"){
                   $query->whereRaw('(ssp_reba_table_c = 3 || ssp_reba_table_c = 4)');
               }else if($request->filterActionLevel === "Level 3"){
                   $query->whereRaw('(ssp_reba_table_c = 5 || ssp_reba_table_c = 6)');
               }else if($request->filterActionLevel === "Level 4"){
                   $query->where('ssp_reba_table_c', '>=', 7);
               }
            })
            ->count();

        // $totalRecordswithFilter  = DB::table('ssp_times')->select('count(*) as allcount')
        //     ->leftJoin('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->leftJoin('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
        //     ->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.task', 'like', '%' .$searchValue . '%')
        //     ->count();

        $dataRula = DB::table('ssp_reba')->select(
                'ssp_tickets.id as ssp_ticket_id', 'ssp_tickets.ssp_ticket_status',
                'ssp_times.id as ssp_time_id', 'ssp_times.time',
                'ssp_reba_table_c', 'ssp_reba_table_b', 'ssp_reba_table_a',
                'ssp_reba_upper_arm_left', 'ssp_reba_upper_arm_right', 'ssp_reba_lower_arm_left', 'ssp_reba_lower_arm_right', 'ssp_reba_wrist_left',
                'ssp_reba_wrist_right', 'ssp_reba_wrist_twist_left', 'ssp_reba_wrist_twist_right', 'ssp_reba_neck', 'ssp_reba_trunk_position', 'ssp_reba_legs'
            )
            ->leftJoin('ssp_times', 'ssp_reba.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_reba.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.id', $request->ticketId)->where('ssp_reba.ssp_reba_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->when(isset($request->filterActionLevel), function ($query)  use ($request) {
                if($request->filterActionLevel === "Level 1"){
                     $query->whereRaw('(ssp_reba_table_c = 1 || ssp_reba_table_c = 2)');
                }else if($request->filterActionLevel === "Level 2"){
                    $query->whereRaw('(ssp_reba_table_c = 3 || ssp_reba_table_c = 4)');
                }else if($request->filterActionLevel === "Level 3"){
                    $query->whereRaw('(ssp_reba_table_c = 5 || ssp_reba_table_c = 6)');
                }else if($request->filterActionLevel === "Level 4"){
                    $query->where('ssp_reba_table_c', '>=', 7);
                }
            })
            ->skip($start)
            ->take($rowperpage)
            ->get();

        if($dataRula->isEmpty()){
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecords,
                "aaData" => []
            );
            return response()->json($response);
        }else{
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecords,
                "aaData" => $dataRula
            );
            return response()->json($response);
        }
    }

    public function getDataSspRulaChartAdmin($ticketId){
        $dataRula = array();
        $dataRulaChart = DB::table('ssp_rula')->select('ssp_rula_table_c', 'ssp_times.time')
            ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->get();

        // $dataRulaChartX = DB::table('ssp_rula')->select('ssp_times.time AS x')
        //     ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
        //     ->get();

        // $dataRula['dataRulaChart'] = $dataRulaChart;
        // $dataRula['dataRulaChartX'] = $dataRulaChartX;
        if($dataRulaChart->isEmpty()){
            return response()->json(['error' => "Data Not Found"], 404);
        }else{
            return response()->json($dataRulaChart);
        }
    }

    public function getDataSspRebaChartAdmin($ticketId){
        // dd('aa');
        $dataReba = array();
        $dataRebaChart = DB::table('ssp_reba')->select('ssp_reba_table_c', 'ssp_times.time')
            ->leftJoin('ssp_times', 'ssp_reba.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_reba.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->get();


        // $dataRulaChartX = DB::table('ssp_rula')->select('ssp_times.time AS x')
        //     ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
        //     ->get();

        // $dataRula['dataRulaChart'] = $dataRulaChart;
        // $dataRula['dataRulaChartX'] = $dataRulaChartX;
        if($dataRebaChart->isEmpty()){
            return response()->json(['error' => "Data Not Found"], 404);
        }else{
            return response()->json($dataRebaChart);
        }
    }

    public function getDataActionLevelChartAdmin($ticketId){
        $arrActionLevelChart= array();

        $i=0;
        $dataRula = DB::table('ssp_rula')->select('ssp_rula_table_c', 'ssp_times.time')
            ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->get();

        foreach (array_chunk($dataRula->toArray(),1000) as $chunkDataRula){
            foreach ($chunkDataRula as $dataRulaChunkResult){
                if($dataRulaChunkResult->ssp_rula_table_c === 1 || $dataRulaChunkResult->ssp_rula_table_c === 2){
                    $arrActionLevelChart[$i]['time'] = $dataRulaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = 1;
                }else if($dataRulaChunkResult->ssp_rula_table_c === 3 || $dataRulaChunkResult->ssp_rula_table_c === 4){
                    $arrActionLevelChart[$i]['time'] = $dataRulaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = 2;
                }else if($dataRulaChunkResult->ssp_rula_table_c === 5 || $dataRulaChunkResult->ssp_rula_table_c === 6){
                    $arrActionLevelChart[$i]['time'] = $dataRulaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = 3;
                }else if($dataRulaChunkResult->ssp_rula_table_c >= 7){
                    $arrActionLevelChart[$i]['time'] = $dataRulaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = 4;
                }else{
                    $arrActionLevelChart[$i]['time'] = $dataRulaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = null;
                }
                $i++;
            }
        }
        // dd(collect([$arrActionLevelChart]));
        if($dataRula->isEmpty()){
            return response()->json(['error' => "Data Not Found"], 404);
        }else{
            return response()->json($arrActionLevelChart);
        }
    }

    public function getDataActionLevelRebaChartAdmin($ticketId){
        $arrActionLevelChart= array();

        $i=0;
        $dataReba = DB::table('ssp_reba')->select('ssp_reba_table_c', 'ssp_times.time')
            ->leftJoin('ssp_times', 'ssp_reba.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_reba.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->get();

        foreach (array_chunk($dataReba->toArray(),1000) as $chunkDataReba){
            foreach ($chunkDataReba as $dataRebaChunkResult){
                if($dataRebaChunkResult->ssp_reba_table_c === 1){
                    $arrActionLevelChart[$i]['time'] = $dataRebaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = '1';
                }else if($dataRebaChunkResult->ssp_reba_table_c >= 2 && $dataRebaChunkResult->ssp_reba_table_c <= 3){
                    $arrActionLevelChart[$i]['time'] = $dataRebaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = '2 To 3';
                }else if($dataRebaChunkResult->ssp_reba_table_c >= 4 && $dataRebaChunkResult->ssp_reba_table_c <= 7){
                    $arrActionLevelChart[$i]['time'] = $dataRebaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = '4 To 7';
                }else if($dataRebaChunkResult->ssp_reba_table_c >= 8 && $dataRebaChunkResult->ssp_reba_table_c <= 10){
                    $arrActionLevelChart[$i]['time'] = $dataRebaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = '8 To 10';
                }else if($dataRebaChunkResult->ssp_reba_table_c >= 11){
                    $arrActionLevelChart[$i]['time'] = $dataRebaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = 'Above 11';
                }else{
                    $arrActionLevelChart[$i]['time'] = $dataRebaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = null;
                }


                // if($tableC->ssp_reba_table_c === 1){
                //     $level1++;
                // }else if($tableC->ssp_reba_table_c >= 2 && $tableC->ssp_reba_table_c <= 3){
                //     //
                //     $level2To3++;
                // }else if($tableC->ssp_reba_table_c >= 4 && $tableC->ssp_reba_table_c <= 7){
                //     // var_dump($tableC->ssp_reba_table_c);
                //     $level4To7++;
                // }else if($tableC->ssp_reba_table_c >= 8 && $tableC->ssp_reba_table_c <= 10){
                //     $level8To10++;
                // }else if($tableC->ssp_reba_table_c >= 11){
                //     $aboveLevel11++;
                // }
                $i++;
            }
        }
        // dd(collect([$arrActionLevelChart]));
        if($dataReba->isEmpty()){
            return response()->json(['error' => "Data Not Found"], 404);
        }else{
            return response()->json($arrActionLevelChart);
        }
    }

    public function getDataSspRulaFrequencyAdmin($ticketId){
        $arrTableC= array();
        $allDataActionLevel= 0;
        $level1= 0;
        $level2= 0;
        $level3= 0;
        $level4= 0;

        $dataTableC = DB::table('ssp_rula')->select('ssp_rula_table_c')
        ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
        ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
        ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
        ->get();

        foreach (array_chunk($dataTableC->toArray(),1000) as $chunkTableC){
            foreach ($chunkTableC as $tableC){
                $allDataActionLevel++;
                if($tableC->ssp_rula_table_c === 1 || $tableC->ssp_rula_table_c === 2){
                    $level1++;
                }else if($tableC->ssp_rula_table_c === 3 || $tableC->ssp_rula_table_c === 4){
                    $level2++;
                }else if($tableC->ssp_rula_table_c === 5 || $tableC->ssp_rula_table_c === 6){
                    $level3++;
                }else if($tableC->ssp_rula_table_c >= 7){
                    $level4++;
                }
            }
        }

        for($i=0; $i<=4; $i++){
            if($i+1 === 1){
                $arrTableC[$i]['score'] = $i+1;
                $arrTableC[$i]['frequency'] = $level1;
            }else if ($i+1 === 2){
                $arrTableC[$i]['score'] = $i+1;
                $arrTableC[$i]['frequency'] = $level2;
            }else if($i+1 === 3){
                $arrTableC[$i]['score'] = $i+1;
                $arrTableC[$i]['frequency'] = $level3;
            }else if($i+1 === 4) {
                $arrTableC[$i]['score'] = $i+1;
                $arrTableC[$i]['frequency'] = $level4;
            }
        }

        $response = array(
            "arrTableC" => $arrTableC,
            "allDataActionLevel" => $allDataActionLevel
        );

        return response()->json($response);
    }

    public function getDataSspRebaFrequencyAdmin($ticketId){
        $arrTableC= array();
        $allDataActionLevel= 0;
        $level1= 0;
        $level2To3= 0;
        $level4To7= 0;
        $level8To10= 0;
        $aboveLevel11= 0;

        $dataTableC = DB::table('ssp_reba')->select('ssp_reba_table_c')
        ->leftJoin('ssp_times', 'ssp_reba.ssp_time_id', '=', 'ssp_times.id')
        ->leftJoin('ssp_tickets', 'ssp_reba.ssp_ticket_id', '=', 'ssp_tickets.id')
        ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
        ->get();


        foreach (array_chunk($dataTableC->toArray(),1000) as $chunkTableC){
            foreach ($chunkTableC as $tableC){
                $allDataActionLevel++;

                if($tableC->ssp_reba_table_c === 1){
                    $level1++;
                }else if($tableC->ssp_reba_table_c >= 2 && $tableC->ssp_reba_table_c <= 3){
                    //
                    $level2To3++;
                }else if($tableC->ssp_reba_table_c >= 4 && $tableC->ssp_reba_table_c <= 7){
                    // var_dump($tableC->ssp_reba_table_c);
                    $level4To7++;
                }else if($tableC->ssp_reba_table_c >= 8 && $tableC->ssp_reba_table_c <= 10){
                    $level8To10++;
                }else if($tableC->ssp_reba_table_c >= 11){
                    $aboveLevel11++;
                }
            }
        }

        for($i=0; $i<=5; $i++){
            if($i+1 === 1){
                $arrTableC[$i]['score'] = $i+1;
                $arrTableC[$i]['frequency'] = $level1;
            }else if ($i+1 === 2){
                $arrTableC[$i]['score'] = '2 To 3';
                $arrTableC[$i]['frequency'] = $level2To3;
            }else if($i+1 === 3){
                $arrTableC[$i]['score'] = '4 To 7';
                $arrTableC[$i]['frequency'] = $level4To7;
            }else if($i+1 === 4) {
                $arrTableC[$i]['score'] = '8 To 10';
                $arrTableC[$i]['frequency'] = $level8To10;
            }else if($i+1 === 5) {
                $arrTableC[$i]['score'] = 'Above 11';
                $arrTableC[$i]['frequency'] = $aboveLevel11;
            }
        }

        $response = array(
            "arrTableC" => $arrTableC,
            "allDataActionLevel" => $allDataActionLevel
        );

        return response()->json($response);
    }


    public function dataTicketUserIndex($ticketId){
        try {
            $ticket = SspTicket::where('user_id', Auth::user()->id)->whereBetween('ssp_ticket_status', [2, 3])->find($ticketId);

            if(empty($ticket)){
                abort(404, "Data Not Found");
            }else if($ticket->ssp_calc_type === 1){
                return view('user.data.ticketData', compact('ticketId', 'ticket'));
            }else if($ticket->ssp_calc_type === 2){
                return view('user.data.ticketDataReba', compact('ticketId', 'ticket'));
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getDataTicketUser(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        // $columnIndex = $columnIndex_arr[0]['column'];
        // $columnName = $columnName_arr[$columnIndex]['data'];
        // $columnSortOrder = $order_arr[0]['dir'];
        // $searchValue = $search_arr['value'];

        $totalRecords = DB::table('ssp_times')->select('count(*) as allcount')
            ->leftJoin('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->leftJoin('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
            ->leftJoin('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
            ->where('user_id', Auth::user()->id)->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->count();

        // $totalRecordswithFilter  = DB::table('ssp_times')->select('count(*) as allcount')
        //     ->leftJoin('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->leftJoin('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
        //     ->where('user_id', Auth::user()->id)->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.task', 'like', '%' .$searchValue . '%')
        //     ->count();

        $dataErgonomics = DB::table('ssp_times')->select(
                'ssp_tickets.id as ssp_ticket_id', 'ssp_tickets.ssp_ticket_status',
                'ssp_times.id as ssp_time_id', 'ssp_times.time', 'ssp_times.task', 'ssp_times.action',
                'joint_angles_wrist_flex_ext_left', 'joint_angles_wrist_flex_ext_right', 'joint_angles_wrist_rad_ulnar_dev_left',
                'joint_angles_wrist_rad_ulnar_dev_right', 'joint_angles_forearm_sup_pro_left', 'joint_angles_forearm_sup_pro_right', 'joint_angles_elbow_right', 'joint_angles_elbow_left',
                'joint_angles_shoulder_abd_right', 'joint_angles_shoulder_abd_left', 'joint_angles_shoulder_for_back_right', 'joint_angles_shoulder_for_back_left', 'joint_angles_humeral_rot_right',
                'joint_angles_humeral_rot_left', 'joint_angles_trunk_flex_ext', 'joint_angles_trunk_lateral', 'joint_angles_trunk_rotation', 'joint_angles_hip_flex_ext_right', 'joint_angles_hip_flex_ext_left',
                'joint_angles_knee_flex_ext_right', 'joint_angles_knee_flex_ext_left', 'joint_angles_ankle_flex_ext_right', 'joint_angles_ankle_flex_ext_left',

                'joint_torques_wrist_flex_ext_left', 'joint_torques_wrist_flex_ext_right', 'joint_torques_wrist_rad_ulnar_dev_left',
                'joint_torques_wrist_rad_ulnar_dev_right', 'joint_torques_forearm_sup_pro_left', 'joint_torques_forearm_sup_pro_right', 'joint_torques_elbow_right', 'joint_torques_elbow_left',
                'joint_torques_shoulder_abd_right', 'joint_torques_shoulder_abd_left', 'joint_torques_shoulder_for_back_right', 'joint_torques_shoulder_for_back_left', 'joint_torques_humeral_rot_right',
                'joint_torques_humeral_rot_left', 'joint_torques_trunk_flex_ext', 'joint_torques_trunk_lateral', 'joint_torques_trunk_rotation', 'joint_torques_hip_flex_ext_right', 'joint_torques_hip_flex_ext_left',
                'joint_torques_knee_flex_ext_right', 'joint_torques_knee_flex_ext_left', 'joint_torques_ankle_flex_ext_right', 'joint_torques_ankle_flex_ext_left',

                'mean_strengths_wrist_flex_ext_left', 'mean_strengths_wrist_flex_ext_right', 'mean_strengths_wrist_rad_ulnar_dev_left',
                'mean_strengths_wrist_rad_ulnar_dev_right', 'mean_strengths_forearm_sup_pro_left', 'mean_strengths_forearm_sup_pro_right', 'mean_strengths_elbow_right', 'mean_strengths_elbow_left',
                'mean_strengths_shoulder_abd_right', 'mean_strengths_shoulder_abd_left', 'mean_strengths_shoulder_for_back_right', 'mean_strengths_shoulder_for_back_left', 'mean_strengths_humeral_rot_right',
                'mean_strengths_humeral_rot_left', 'mean_strengths_trunk_flex_ext', 'mean_strengths_trunk_lateral', 'mean_strengths_trunk_rotation', 'mean_strengths_hip_flex_ext_right', 'mean_strengths_hip_flex_ext_left',
                'mean_strengths_knee_flex_ext_right', 'mean_strengths_knee_flex_ext_left', 'mean_strengths_ankle_flex_ext_right', 'mean_strengths_ankle_flex_ext_left',

                'percent_capables_wrist_flex_ext_left', 'percent_capables_wrist_flex_ext_right', 'percent_capables_wrist_rad_ulnar_dev_left',
                'percent_capables_wrist_rad_ulnar_dev_right', 'percent_capables_forearm_sup_pro_left', 'percent_capables_forearm_sup_pro_right', 'percent_capables_elbow_right', 'percent_capables_elbow_left',
                'percent_capables_shoulder_abd_right', 'percent_capables_shoulder_abd_left', 'percent_capables_shoulder_for_back_right', 'percent_capables_shoulder_for_back_left', 'percent_capables_humeral_rot_right',
                'percent_capables_humeral_rot_left', 'percent_capables_trunk_flex_ext', 'percent_capables_trunk_lateral', 'percent_capables_trunk_rotation', 'percent_capables_hip_flex_ext_right', 'percent_capables_hip_flex_ext_left',
                'percent_capables_knee_flex_ext_right', 'percent_capables_knee_flex_ext_left', 'percent_capables_ankle_flex_ext_right', 'percent_capables_ankle_flex_ext_left',

                'strength_std_devs_wrist_flex_ext_left', 'strength_std_devs_wrist_flex_ext_right', 'strength_std_devs_wrist_rad_ulnar_dev_left',
                'strength_std_devs_wrist_rad_ulnar_dev_right', 'strength_std_devs_forearm_sup_pro_left', 'strength_std_devs_forearm_sup_pro_right', 'strength_std_devs_elbow_right', 'strength_std_devs_elbow_left',
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
            ->where('user_id', Auth::user()->id)->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $dataErgonomics
        );

        if($dataErgonomics->isEmpty()){
            return response()->json(['error' => "Data Not Found"], 404);
        }else{
            return response()->json($response);
        }
    }

    public function getDataSspRulaUser(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        // $columnIndex = $columnIndex_arr[0]['column'];
        // $columnName = $columnName_arr[$columnIndex]['data'];
        // $columnSortOrder = $order_arr[0]['dir'];
        // $searchValue = $search_arr['value'];

        $totalRecords = DB::table('ssp_rula')->select('count(*) as allcount')
            ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.user_id', Auth::user()->id)
            ->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->when(isset($request->filterActionLevel), function ($query)  use ($request) {
                if($request->filterActionLevel === "Level 1"){
                    $query->whereRaw('(ssp_rula_table_c = 1 || ssp_rula_table_c = 2)');
               }else if($request->filterActionLevel === "Level 2"){
                   $query->whereRaw('(ssp_rula_table_c = 3 || ssp_rula_table_c = 4)');
               }else if($request->filterActionLevel === "Level 3"){
                   $query->whereRaw('(ssp_rula_table_c = 5 || ssp_rula_table_c = 6)');
               }else if($request->filterActionLevel === "Level 4"){
                   $query->where('ssp_rula_table_c', '>=', 7);
               }
            })
            ->count();

        // $totalRecordswithFilter  = DB::table('ssp_times')->select('count(*) as allcount')
        //     ->leftJoin('ssp_tickets', 'ssp_times.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->leftJoin('ssp_joint_angles', 'ssp_joint_angles.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_joint_torques', 'ssp_joint_torques.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_mean_strengths', 'ssp_mean_strengths.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_percent_capables', 'ssp_percent_capables.id_ssp_times', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_strength_std_devs', 'ssp_strength_std_devs.id_ssp_times', '=', 'ssp_times.id')
        //     ->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.task', 'like', '%' .$searchValue . '%')
        //     ->count();

        $dataRula = DB::table('ssp_rula')->select(
                'ssp_tickets.id as ssp_ticket_id', 'ssp_tickets.ssp_ticket_status',
                'ssp_times.id as ssp_time_id', 'ssp_times.time',
                'ssp_rula_table_c', 'ssp_rula_table_b', 'ssp_rula_table_a',
                'ssp_rula_upper_arm_left', 'ssp_rula_upper_arm_right', 'ssp_rula_lower_arm_left', 'ssp_rula_lower_arm_right', 'ssp_rula_wrist_left',
                'ssp_rula_wrist_right', 'ssp_rula_wrist_twist_left', 'ssp_rula_wrist_twist_right', 'ssp_rula_neck', 'ssp_rula_trunk_position', 'ssp_rula_legs'
            )
            ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.user_id', Auth::user()->id)
            ->where('ssp_tickets.id', $request->ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->when(isset($request->filterActionLevel), function ($query)  use ($request) {
                if($request->filterActionLevel === "Level 1"){
                     $query->whereRaw('(ssp_rula_table_c = 1 || ssp_rula_table_c = 2)');
                }else if($request->filterActionLevel === "Level 2"){
                    $query->whereRaw('(ssp_rula_table_c = 3 || ssp_rula_table_c = 4)');
                }else if($request->filterActionLevel === "Level 3"){
                    $query->whereRaw('(ssp_rula_table_c = 5 || ssp_rula_table_c = 6)');
                }else if($request->filterActionLevel === "Level 4"){
                    $query->where('ssp_rula_table_c', '>=', 7);
                }
            })
            ->skip($start)
            ->take($rowperpage)
            ->get();

        if($dataRula->isEmpty()){
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecords,
                "aaData" => []
            );
            return response()->json($response);
        }else{
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecords,
                "aaData" => $dataRula
            );
            return response()->json($response);
        }
    }

    public function getDataSspRulaChartUser($ticketId){
        $dataRula = array();
        $dataRulaChart = DB::table('ssp_rula')->select('ssp_rula_table_c', 'ssp_times.time')
            ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.user_id', Auth::user()->id)
            ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->get();

        // $dataRulaChartX = DB::table('ssp_rula')->select('ssp_times.time AS x')
        //     ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
        //     ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
        //     ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
        //     ->get();

        // $dataRula['dataRulaChart'] = $dataRulaChart;
        // $dataRula['dataRulaChartX'] = $dataRulaChartX;
        if($dataRulaChart->isEmpty()){
            return response()->json(['error' => "Data Not Found"], 404);
        }else{
            return response()->json($dataRulaChart);
        }
    }

    public function getDataActionLevelChartUser($ticketId){
        $arrActionLevelChart= array();

        $i=0;
        $dataRula = DB::table('ssp_rula')->select('ssp_rula_table_c', 'ssp_times.time')
            ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
            ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
            ->where('ssp_tickets.user_id', Auth::user()->id)
            ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
            ->get();

        foreach (array_chunk($dataRula->toArray(),1000) as $chunkDataRula){
            foreach ($chunkDataRula as $dataRulaChunkResult){
                if($dataRulaChunkResult->ssp_rula_table_c === 1 || $dataRulaChunkResult->ssp_rula_table_c === 2){
                    $arrActionLevelChart[$i]['time'] = $dataRulaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = 1;
                }else if($dataRulaChunkResult->ssp_rula_table_c === 3 || $dataRulaChunkResult->ssp_rula_table_c === 4){
                    $arrActionLevelChart[$i]['time'] = $dataRulaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = 2;
                }else if($dataRulaChunkResult->ssp_rula_table_c === 5 || $dataRulaChunkResult->ssp_rula_table_c === 6){
                    $arrActionLevelChart[$i]['time'] = $dataRulaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = 3;
                }else if($dataRulaChunkResult->ssp_rula_table_c >= 7){
                    $arrActionLevelChart[$i]['time'] = $dataRulaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = 4;
                }else{
                    $arrActionLevelChart[$i]['time'] = $dataRulaChunkResult->time;
                    $arrActionLevelChart[$i]['action_level'] = null;
                }
                $i++;
            }
        }
        // dd(collect([$arrActionLevelChart]));
        if($dataRula->isEmpty()){
            return response()->json(['error' => "Data Not Found"], 404);
        }else{
            return response()->json($arrActionLevelChart);
        }
    }

    public function getDataSspRulaFrequencyUser($ticketId){
        $arrTableC= array();
        $allDataActionLevel= 0;
        $level1= 0;
        $level2= 0;
        $level3= 0;
        $level4= 0;


        $dataTableC = DB::table('ssp_rula')->select('ssp_rula_table_c')
        ->leftJoin('ssp_times', 'ssp_rula.ssp_time_id', '=', 'ssp_times.id')
        ->leftJoin('ssp_tickets', 'ssp_rula.ssp_ticket_id', '=', 'ssp_tickets.id')
        ->where('ssp_tickets.user_id', Auth::user()->id)
        ->where('ssp_tickets.id', $ticketId)->where('ssp_times.time_status', 1)->whereBetween('ssp_ticket_status', [2, 3])
        ->get();

        foreach (array_chunk($dataTableC->toArray(),1000) as $chunkTableC){
            foreach ($chunkTableC as $tableC){
                $allDataActionLevel++;
                if($tableC->ssp_rula_table_c === 1 || $tableC->ssp_rula_table_c === 2){
                    $level1++;
                }else if($tableC->ssp_rula_table_c === 3 || $tableC->ssp_rula_table_c === 4){
                    $level2++;
                }else if($tableC->ssp_rula_table_c === 5 || $tableC->ssp_rula_table_c === 6){
                    $level3++;
                }else if($tableC->ssp_rula_table_c >= 7){
                    $level4++;
                }
            }
        }

        for($i=0; $i<=4; $i++){
            if($i+1 === 1){
                $arrTableC[$i]['score'] = $i+1;
                $arrTableC[$i]['frequency'] = $level1;
            }else if ($i+1 === 2){
                $arrTableC[$i]['score'] = $i+1;
                $arrTableC[$i]['frequency'] = $level2;
            }else if($i+1 === 3){
                $arrTableC[$i]['score'] = $i+1;
                $arrTableC[$i]['frequency'] = $level3;
            }else if($i+1 === 4) {
                $arrTableC[$i]['score'] = $i+1;
                $arrTableC[$i]['frequency'] = $level4;
            }
        }

        $response = array(
            "arrTableC" => $arrTableC,
            "allDataActionLevel" => $allDataActionLevel
        );

        return response()->json($response);
    }
}
