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
        $this->validate($request,[
            'job_analyst' => 'required',
            'csvFile' => 'required',
        ]);

        try{
            $ticket = SspTicket::find($request->ticket_id);
            $ticket->ssp_ticket_status = 2;
            $ticket->ssp_ticket_job_analyst = $request->job_analyst;
            $ticket->save();

            $ticketHistory = new SspTicketHistory;
            $ticketHistory->ssp_ticket_id = $request->ticket_id;
            $ticketHistory->ssp_ticket_histories_status = 2;
            $ticketHistory->save();
            
            $path = $request->file('csvFile');
            $csvData = Excel::toArray(new ProcessingDataController, $path);
            
            $csvTableNameArray = [];
            $csvDataArray = [];
            $columnLength=0;
            $columnCount = 0;
            $lastArrFoundStats= false;

            foreach(array_reverse($csvData[0][9]) as $tableNameKey => $tableNameValue){
                if(!empty($tableNameValue)){
                    $csvTableNameArray[substr(strtolower(str_replace(" ", "_", $tableNameValue)), 0, strrpos($tableNameValue, "(") -1)] = $columnLength+1;
                    $columnLength=0;
                }else{
                    $columnLength++;
                }
            }

            for(end($csvTableNameArray); key($csvTableNameArray)!==null; prev($csvTableNameArray)){
                $csvColumnNameKey = key($csvTableNameArray);
                $csvColumnNameValue = current($csvTableNameArray);
                for($i = 0; $i < $csvColumnNameValue; $i++){
                    for($j= 11; $j < count($csvData[0]); $j++){
                        if(!preg_match('/^[a-z0\h]+$/s', $csvData[0][$j][$columnCount]) && $csvData[0][10][$columnCount] === "Task"){
                            $csvDataArray[$j-11][$csvColumnNameKey][$csvColumnNameKey. "_" .strtolower(str_replace(" ", "_", $csvData[0][10][$columnCount]))] = ltrim($csvData[0][$j][$columnCount]);
                            $emptyColumnTask = ltrim($csvData[0][$j][$columnCount]);
                        }else if($csvData[0][10][$columnCount] === "Task"){
                            $csvDataArray[$j-11][$csvColumnNameKey][$csvColumnNameKey. "_" .strtolower(str_replace(" ", "_", $csvData[0][10][$columnCount]))] = $emptyColumnTask;
                        }else if($csvData[0][$j][$columnCount] !== NULL && $csvData[0][10][$columnCount] === "Action"){
                            $csvDataArray[$j-11][$csvColumnNameKey][$csvColumnNameKey. "_" .strtolower(str_replace(" ", "_", $csvData[0][10][$columnCount]))] = $csvData[0][$j][$columnCount];
                            $emptyColumnAction = $csvData[0][$j][$columnCount];
                        }else if($csvData[0][10][$columnCount] === "Action"){
                            $csvDataArray[$j-11][$csvColumnNameKey][$csvColumnNameKey. "_" .strtolower(str_replace(" ", "_", $csvData[0][10][$columnCount]))] = $emptyColumnAction;
                        }else{
                            $csvDataArray[$j-11][$csvColumnNameKey][$csvColumnNameKey. "_" .strtolower(str_replace(" ", "_", $csvData[0][10][$columnCount]))] = $csvData[0][$j][$columnCount];
                        }
                        if(strpos($csvData[0][$j][$columnCount], 'Report generated by Task Simulation Builder - Jack') !== false){
                            $lastArrFoundStats= true;
                            $lastArrFoundVal= $j-11;
                        }
                    }
                    $columnCount++;
                }
            }
            
            if($lastArrFoundStats) unset($csvDataArray[$lastArrFoundVal]);
            
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
                    'action' => $csvDataArrayValue['time']['time_action'])
                );
            }
            SspTime::insert($timesDataArr);
            
            $i = 0;
            foreach(SspTime::where('ssp_ticket_id', $request->ticket_id)->cursor()->toArray() as $sspTimes){
                // echo "<pre>".print_r($csvDataArray[$i],true)."</pre>";

                $jointAnglesDataArr[$i]["id_ssp_times"] = $sspTimes["id"];
                foreach($csvDataArray[$i]['joint_angles'] as $dataKey => $dataValue){
                    $jointAnglesDataArr[$i][$dataKey]= $dataValue;
                }
                
                $jointTorquesDataArr[$i]["id_ssp_times"] = $sspTimes["id"];
                foreach($csvDataArray[$i]['joint_torques'] as $dataKey => $dataValue){
                    $jointTorquesDataArr[$i][$dataKey]= $dataValue;
                }

                $meanStrengthsDataArr[$i]["id_ssp_times"] = $sspTimes["id"];
                foreach($csvDataArray[$i]['mean_strengths'] as $dataKey => $dataValue){
                    $meanStrengthsDataArr[$i][$dataKey]= $dataValue;
                }

                $strengthStdDevsDataArr[$i]["id_ssp_times"] = $sspTimes["id"];
                foreach($csvDataArray[$i]['percent_capables'] as $dataKey => $dataValue){
                    $strengthStdDevsDataArr[$i][$dataKey]= $dataValue;
                }

                $percentCapablesDataArr[$i]["id_ssp_times"] = $sspTimes["id"];
                foreach($csvDataArray[$i]['strength_std_devs'] as $dataKey => $dataValue){
                    $percentCapablesDataArr[$i][$dataKey]= $dataValue;
                }
                $i++;
            }

            SspJointAngle::insert($jointAnglesDataArr);
            SspJointTorque::insert($jointTorquesDataArr);
            SspMeanStrength::insert($meanStrengthsDataArr);
            SspPercentCapable::insert($strengthStdDevsDataArr);
            SspStrengthStdDev::insert($percentCapablesDataArr);
            
            // DB::select('CALL generate_rula_data(?)', [$request->ticket_id]);

            return response()->json('success');
        } catch (HttpException $exception) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
