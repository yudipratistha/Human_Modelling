<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NioshController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function nioshCalculationSingleTask(){
        return view('niosh.niosh_single_task_index');
    }

    public function nioshCalculationMultiTask(){
        return view('niosh.niosh_multi_task_index');
    }
}
