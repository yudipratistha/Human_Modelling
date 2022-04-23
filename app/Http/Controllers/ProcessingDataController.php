<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;

// use App\Http\Requests\CsvImportRequest;

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
        return view('admin.processingData');
    }

    public function parseDataCSV(Request $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $csvData = Excel::toArray(new ProcessingDataController, $path);

        $csvTableNameArray = [];
        $csvColumnNameArray = [];
        $csvDataColumnArray = [];
        $columnLength=0;
        $columnCount = 0;
        
        foreach(array_reverse($csvData[0][9]) as $tableNameKey => $tableNameValue){
            if(!empty($tableNameValue)){
                $csvTableNameArray[$tableNameValue] = $columnLength+1;
                $columnLength=0;
            }else{
                $columnLength++;
            }
        }

        foreach(array_reverse($csvTableNameArray) as $csvTableNameKey => $csvColumnLenght){
            for($i = 0; $i < $csvColumnLenght; $i++){ 
                for($j= 11; $j < count($csvData[0]); $j++){
                    for($k= 0; $k < count($csvData[0][$j]); $k++){
                    // foreach($csvData[0][$j] as $valueKey => $value){
                        $csvColumnNameArray[$j][$csvTableNameKey][$csvData[0][10][$columnCount]] = $csvData[0][$j][$k];
                        print($csvData[0][$j][$k] . ' ' . $csvData[0][10][$columnCount].'<br>');
                        
                    }
                    
                    // dd($csvDataColumnArray[$csvColumnNameKey]);
                    // $csvDataColumnArray[$csvColumnNameKey][$csvData[0][10][$columnData]]= array_reverse($csvData[0][$j]);
                }
                
                $columnCount++;
            }
            
        }

        foreach($csvColumnNameArray as $csvColumnNameKey => $csvColumnNameValue){
            for($j= 11; $j < count($csvData[0]); $j++){
                // dd($csvDataColumnArray[$csvColumnNameKey]);
                // $csvDataColumnArray[$csvColumnNameKey][$csvData[0][10][$columnData]]= array_reverse($csvData[0][$j]);
            }
        }
            
        
        // die();
        
    }
}
