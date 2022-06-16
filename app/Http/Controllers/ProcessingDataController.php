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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use File;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
// use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use Maatwebsite\Excel\Facades\Excel;

class ProcessingDataController extends Controller
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
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.data.processingData');
    }

    public function storeDataCSV(Request $request)
    {
        ini_set('memory_limit','256M');
        $this->validate($request,[
            'job_analyst' => 'required',
            'csvFile' => 'required',
        ]);

        try{
            $path = $request->file('csvFile');
            $reader = $reader = ReaderFactory::createFromType(Type::CSV);
            $reader->open($path);

            $status = false;
            foreach ($reader->getSheetIterator() as $sheet){
                foreach ($sheet->getRowIterator() as $row){
                    if($row->toArray()[0] === "Time (sec)"){
                        $status = true;
                    }
                    if($status){
                        $csvData[] = $row->toArray();
                    }
                }
            }
            $reader->close();
            
            $csvTableNameArray = [];
            $csvDataArray = [];
            $columnLength=0;
            $columnCount = 0;
            $lastArrFoundStats= false;
            
            array_pop($csvData);
            // array_pop($csvData[0]);
            foreach(array_reverse($csvData[0]) as $tableNameKey => $tableNameValue){
                if(!empty($tableNameValue)){
                    $csvTableNameArray[substr(strtolower(str_replace(" ", "_", ltrim($tableNameValue))), 0, strrpos(ltrim($tableNameValue), "(") -1)] = $columnLength+1;
                    $columnLength=0;
                }else{
                    $columnLength++;
                }
            }
            
            for(end($csvTableNameArray); key($csvTableNameArray)!==null; prev($csvTableNameArray)){
                $csvColumnNameKey = key($csvTableNameArray);
                $csvColumnNameValue = current($csvTableNameArray);
                for($i = 0; $i < $csvColumnNameValue; $i++){
                    for($j= 2; $j < count($csvData); $j++){
                        if(!preg_match('/^[a-z0\h]+$/s', $csvData[$j][$columnCount]) && $csvData[1][$columnCount] === "Task"){
                            $csvDataArray[$j-2][$csvColumnNameKey][$csvColumnNameKey. "_" .strtolower(str_replace(" ", "_", $csvData[1][$columnCount]))] = ltrim($csvData[$j][$columnCount]);
                            $emptyColumnTask = ltrim($csvData[$j][$columnCount]);
                        }else if($csvData[1][$columnCount] === "Task"){
                            $csvDataArray[$j-2][$csvColumnNameKey][$csvColumnNameKey. "_" .strtolower(str_replace(" ", "_", $csvData[1][$columnCount]))] = $emptyColumnTask;
                        }else if(!empty($csvData[$j][$columnCount]) && $csvData[1][$columnCount] === "Action"){
                            $csvDataArray[$j-2][$csvColumnNameKey][$csvColumnNameKey. "_" .strtolower(str_replace(" ", "_", $csvData[1][$columnCount]))] = $csvData[$j][$columnCount];
                            $emptyColumnAction = $csvData[$j][$columnCount];
                        }else if($csvData[1][$columnCount] === "Action"){
                            $csvDataArray[$j-2][$csvColumnNameKey][$csvColumnNameKey. "_" .strtolower(str_replace(" ", "_", $csvData[1][$columnCount]))] = $emptyColumnAction;
                        }else{
                            $csvDataArray[$j-2][$csvColumnNameKey][$csvColumnNameKey. "_" .strtolower(str_replace(" ", "_", $csvData[1][$columnCount]))] = $csvData[$j][$columnCount];
                        }
                    }
                    $columnCount++;
                }
            }
            
            $timesDataArr = array();
            $jointAnglesDataArr = array();
            $jointTorquesDataArr = array();
            $meanStrengthsDataArr = array();
            $strengthStdDevsDataArr = array();
            $percentCapablesDataArr = array();

            foreach($csvDataArray as $csvDataArrayKey => $csvDataArrayValue){
                array_push($timesDataArr, array(
                    'ssp_ticket_id' => $request->ticket_id,
                    'time' => $csvDataArrayValue['time']['time_time'],
                    'task' => $csvDataArrayValue['time']['time_task'],
                    'action' => $csvDataArrayValue['time']['time_action'],
                    'time_status' => 1)
                );
            }
            
            foreach (array_chunk($timesDataArr,1000) as $timesData){
                SspTime::insert($timesData);
            }
            
            $i = 0;
            foreach(SspTime::where('ssp_ticket_id', $request->ticket_id)->cursor()->toArray() as $sspTimes){
                // echo "<pre>".print_r($csvDataArray[$i],true)."</pre>";
                
                $jointAnglesDataArr[$i]["id_ssp_times"] = $sspTimes["id"];
                $jointTorquesDataArr[$i]["id_ssp_times"] = $sspTimes["id"];
                $meanStrengthsDataArr[$i]["id_ssp_times"] = $sspTimes["id"];
                $strengthStdDevsDataArr[$i]["id_ssp_times"] = $sspTimes["id"];
                $percentCapablesDataArr[$i]["id_ssp_times"] = $sspTimes["id"];
                for($j=0; $j< count($csvDataArray[$i]['joint_angles']); $j++){
                    $jointAnglesDataArr[$i][array_keys($csvDataArray[$i]['joint_angles'])[$j]]= $csvDataArray[$i]['joint_angles'][array_keys($csvDataArray[$i]['joint_angles'])[$j]];
                    $jointTorquesDataArr[$i][array_keys($csvDataArray[$i]['joint_torques'])[$j]]= $csvDataArray[$i]['joint_torques'][array_keys($csvDataArray[$i]['joint_torques'])[$j]];
                    $meanStrengthsDataArr[$i][array_keys($csvDataArray[$i]['mean_strengths'])[$j]]= $csvDataArray[$i]['mean_strengths'][array_keys($csvDataArray[$i]['mean_strengths'])[$j]];
                    $strengthStdDevsDataArr[$i][array_keys($csvDataArray[$i]['percent_capables'])[$j]]= $csvDataArray[$i]['percent_capables'][array_keys($csvDataArray[$i]['percent_capables'])[$j]];
                    $percentCapablesDataArr[$i][array_keys($csvDataArray[$i]['strength_std_devs'])[$j]]= $csvDataArray[$i]['strength_std_devs'][array_keys($csvDataArray[$i]['strength_std_devs'])[$j]];
                }
                $i++;
            }
            
            foreach(array_chunk($jointAnglesDataArr,1000) as $jointAnglesData){
                SspJointAngle::insert($jointAnglesData);
            }

            foreach(array_chunk($jointTorquesDataArr,1000) as $jointTorquesData){
                SspJointTorque::insert($jointTorquesData);
            }

            foreach(array_chunk($meanStrengthsDataArr,1000) as $meanStrengthsData){
                SspMeanStrength::insert($meanStrengthsData);
            }

            foreach(array_chunk($strengthStdDevsDataArr,1000) as $strengthStdDevsData){
                SspPercentCapable::insert($strengthStdDevsData);
            }

            foreach(array_chunk($percentCapablesDataArr,1000) as $percentCapablesData){
                SspStrengthStdDev::insert($percentCapablesData);
            }
            
            $ticket = SspTicket::find($request->ticket_id);
            $ticket->ssp_ticket_status = 2;
            $ticket->ssp_ticket_job_analyst = $request->job_analyst;
            $ticket->movement_type = $request->movement_type;
            $ticket->weight_of_object = $request->weight_of_object;
            $ticket->save();

            $ticketHistory = new SspTicketHistory;
            $ticketHistory->ssp_ticket_id = $request->ticket_id;
            $ticketHistory->ssp_ticket_histories_status = 2;
            $ticketHistory->save();

            DB::select('CALL generate_rula_data(?)', [$request->ticket_id]);

            return response()->json('success');
        } catch (HttpException $exception) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function recalculateRulaData(Request $request){
        $ticket = SspTicket::where('ssp_tickets.id', $request->$ticketId);
        $ticket->delete();

        DB::select('CALL generate_rula_data(?)', [$request->ticket_id]);
    }
}
