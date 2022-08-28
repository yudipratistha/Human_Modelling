@extends('layouts.app')

@section('title', 'List Data Ticket')

@section('plugin_css')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/sweetalert2.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/fixedColumns.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/datatables.css')}}">
<!-- Plugins css Ends-->
@endsection

@section('content')
<!-- page-wrapper Start       -->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    @include('layouts.header')
    <!-- Page Header End-->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        @include('layouts.sidebar')
        <!-- Page Sidebar End-->
        <div class="page-body">
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3>NIOSH Calculation Single Task</h3>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                                        <li class="breadcrumb-item active">NIOSH Calculation Single Task</li>
                                    </ol>
                                </div>
                                <div class="col-sm-6">
                                    <!-- Bookmark Start-->
                                    <div class="bookmark">
                                        <ul>
                                            <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                                            <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                                            <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                                            <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                                            <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                                            <form class="form-inline search-form">
                                                <div class="form-group form-control-search">
                                                    <input type="text" placeholder="Search..">
                                                </div>
                                            </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Bookmark Ends-->
                                </div>
                            </div>
                        </div>
                        <!-- Container-fluid starts-->
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-12 box-col-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Job Variable</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <form id="form-job-variable-score" method="POST">
                                                <div class="row g-2">
                                                    <div class="col-md-6" id="hand-location-h-div">
                                                        <label class="form-label" for="hand-location-h">Lokasi Tangan H (cm)</label>
                                                        <input class="form-control" id="hand-location-h" name="hand_location_h" type="text" value="" placeholder="..." required="">
                                                    </div>
                                                    <div class="col-md-6" id="hand-location-v-div">
                                                        <label class="form-label" for="hand-location-v">Lokasi Tangan V (cm)</label>
                                                        <input class="form-control" id="hand-location-v" name="hand_location_v" type="text" value="" placeholder="..." required="">
                                                    </div>
                                                </div>
                                                <div class="row g-2 mt-2">
                                                    <div class="col-md-6" id="vertical-distance-d-div">
                                                        <label class="form-label" for="vertical-distance-d">Jarak Vertical D (cm)</label>
                                                        <input class="form-control" id="vertical-distance-d" name="vertical_distance_d" type="text" value="" placeholder="..." required="">
                                                    </div>
                                                    <div class="col-md-6" id="assymetric-angle-a-div">
                                                        <label class="form-label" for="assymetric-angle-a">Sudut Asimetri A (derajat)</label>
                                                        <input class="form-control" id="assymetric-angle-a" name="assymetric_angle_a" type="text" value="" placeholder="..." required="">
                                                    </div>
                                                </div>
                                                <div class="row g-2 mt-2">
                                                    <div class="col-md-6" id="average-frequency-f-div">
                                                        <label class="form-label" for="average-frequency-f">Average Frequency F (lift/min)</label>
                                                        <input class="form-control" id="average-frequency-f" name="average_frequency_f" type="text" value="" placeholder="..." required="">
                                                    </div>
                                                    <div class="col-md-6" id="duration-div">
                                                        <label class="form-label" for="duration">Durasi (jam)</label>
                                                        <input class="form-control" id="duration" name="duration" type="text" value="" placeholder="..." required="">
                                                    </div>
                                                </div>
                                                <div class="row g-2 mt-2">
                                                    <div class="col-md-6" id="object-clutch-c-div">
                                                        <label class="form-label" for="object-clutch-c">Kopling Objek C</label>
                                                        <input class="form-control" id="object-clutch-c" name="object_cluth_c" type="text" value="" placeholder="..." required="">
                                                    </div>
                                                    <div class="col-md-6 mb-3" id="object-weight-div">
                                                        <label class="form-label" for="object-weight">Berat Benda</label>
                                                        <input class="form-control" id="object-weight" name="object_weight" type="text" value="" placeholder="..." required="">
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="button" onclick="jobVariable()">Calculate Job Variable</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>RWL</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <table id="table-rwl" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 215px;">LC</th>
                                                        <th>HM</th>
                                                        <th>VM</th>
                                                        <th>DM</th>
                                                        <th>AM</th>
                                                        <th id='fm-th'>FM</th>
                                                        <th>CM</th>
                                                        <th>Score RWL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <form id="form-rwl-score" method="POST">
                                                            <td>
                                                                <div id="lc-div">
                                                                    <input class="form-control" id="lc" name="lc" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span id="hm-value">-</span>
                                                                <input id="hm" name="hm" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                               <span id="vm-value">-</span>
                                                                <input id="vm" name="vm" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                                <span id="dm-value">-</span>
                                                                <input id="dm" name="dm" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                                <span id="am-value">-</span>
                                                                <input id="am" name="am" type="hidden" value="">
                                                                <!-- <div id="am-div">
                                                                    <input class="form-control" id="am" name="am" type="text" value="" placeholder="..." required="">
                                                                </div> -->
                                                            </td>
                                                            <td id="fm-td">
                                                                <span id="fm-value">-</span>
                                                                <input id="fm" name="fm" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                                <span id="cm-value">-</span>
                                                                <input id="cm" name="cm" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                               <span id="rwl-score-value">-</span>
                                                                <input id="rwl-score" name="rwl_score" type="hidden" value="">
                                                            </td>
                                                        </form>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary" type="button" onclick="rwl()">Calculate RWL</button>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Lifting Index</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <table id="table-lifting-index" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Lifting Index Score</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <form id="form-lifting-index" method="POST">
                                                            <td>
                                                                <span id="lifting-index-score-val">-</span>
                                                                <input id="lifting-index-score" name="lifting_index_score" type="hidden" value="">
                                                            </td>
                                                        </form>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary" type="button" onclick="liftingIndex()">Calculate Lifting Index</button>
                                            <button id="btn-add-compose-li" class="btn btn-primary" type="button" onclick="addComposeLiftingIndex()">Add Compose Lifting Index</button>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Compose Lifting Index</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row" style="width: 5%;padding-left: 0px;padding-right: 0px;">STLI1 +</td>
                                                            <td style="width: 5px;padding-left: 0px;padding-right: 0px;">:</td>
                                                            <th id="stli-1" class="cli-value" style="padding-left: 0px;"></th>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" style="width: 5%;padding-left: 0px;padding-right: 0px;">FILI2 +</td>
                                                            <td style="width: 5px;padding-left: 0px;padding-right: 0px;">:</td>
                                                            <th id="fili-2" class="cli-value" style="padding-left: 0px;"></th>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" style="width: 5%;padding-left: 0px;padding-right: 0px;">FILI3 +</td>
                                                            <td style="width: 5px;padding-left: 0px;padding-right: 0px;">:</td>
                                                            <th id="fili-3" class="cli-value" style="padding-left: 0px;"></th>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" style="width: 5%;padding-left: 0px;padding-right: 0px;">FILI4 +</td>
                                                            <td style="width: 5px;padding-left: 0px;padding-right: 0px;">:</td>
                                                            <th id="fili-4" class="cli-value" style="padding-left: 0px;"></th>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" style="width: 5%;padding-left: 0px;padding-right: 0px;">FILI5 +</td>
                                                            <td style="width: 5px;padding-left: 0px;padding-right: 0px;">:</td>
                                                            <th id="fili-5" class="cli-value" style="padding-left: 0px;"></th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="table table-borderless table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row" style="width: 18%;padding-left: 0px;padding-right: 0px;">Compose Lifting Index Total</td>
                                                            <td style="width: 5px;padding-left: 0px;padding-right: 0px;">:</td>
                                                            <th id="cli-total" class="cli-total" style="padding-left: 0px;"></th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
    </div>
    <!-- footer start-->
    @include('layouts.footer')
</div> 

@section('plugin_js')
<!-- Plugins JS start-->
<script src="{{url('/assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{url('/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/datatable/datatable-extension/dataTables.fixedColumns.min.js')}}"></script>
<script src="{{url('/assets/js/tooltip-init.js')}}"></script>
<!-- Plugins JS Ends-->

<script>
    var cliTotal= 0;
    var fmRemoveFlag= 0;

    $(document).ready(function () {
        var tableRwl = $('#table-rwl').DataTable({
            searching: false,
            ordering:  false,
            paging: false,
            bInfo: false
        });

        var tableLiftingIndex = $('#table-lifting-index').DataTable({
            searching: false,
            ordering:  false,
            paging: false,
            bInfo: false
        });
    });

    $('#hand-location-h').on("change", function(){ 
        $("#hand-location-h").removeClass("is-invalid");
        $("#error-msg-hand-location-h").remove();
        $("#hand-location-h").addClass("is-valid");
    });
    $('#hand-location-v').on("change", function(){ 
        $("#hand-location-v").removeClass("is-invalid");
        $("#error-msg-hand-location-v").remove();
        $("#hand-location-v").addClass("is-valid");
    });
    $('#vertical-distance-d').on("change", function(){ 
        $("#vertical-distance-d").removeClass("is-invalid");
        $("#error-msg-vertical-distance-d").remove();
        $("#vertical-distance-d").addClass("is-valid");
    });
    $('#assymetric-angle-a').on("change", function(){ 
        $("#assymetric-angle-a").removeClass("is-invalid");
        $("#error-msg-assymetric-angle-a").remove();
        $("#assymetric-angle-a").addClass("is-valid");
    });
    $('#average-frequency-f').on("change", function(){ 
        $("#average-frequency-f").removeClass("is-invalid");
        $("#error-msg-average-frequency-f").remove();
        $("#average-frequency-f").addClass("is-valid");
    });
    $('#duration').on("change", function(){ 
        $("#duration").removeClass("is-invalid");
        $("#error-msg-duration").remove();
        $("#duration").addClass("is-valid");
    });
    $('#object-clutch-c').on("change", function(){ 
        $("#object-clutch-c").removeClass("is-invalid");
        $("#error-msg-object-clutch-c").remove();
        $("#object-clutch-c").addClass("is-valid");
    });
    $('#object-weight').on("change", function(){ 
        $("#object-weight").removeClass("is-invalid");
        $("#error-msg-object-weight").remove();
        $("#object-weight").addClass("is-valid");
    });
    $('#lc').on("change", function(){ 
        $("#lc").removeClass("is-invalid");
        $("#error-msg-lc").remove();
        $("#lc").addClass("is-valid");
    });
    $('#am').on("change", function(){ 
        $("#am").removeClass("is-invalid");
        $("#error-msg-am").remove();
        $("#am").addClass("is-valid");
    });
    $('#fm').on("change", function(){ 
        $("#fm").removeClass("is-invalid");
        $("#error-msg-fm").remove();
        $("#fm").addClass("is-valid");
    });
    $('#cm').on("change", function(){ 
        $("#cm").removeClass("is-invalid");
        $("#error-msg-cm").remove();
        $("#cm").addClass("is-valid");
    });

    $('#btn-add-compose-li').addClass('disabled');

    function jobVariable(){
        var frequencyIndexFound;
        var frequencyMultiplier = 0;
        var cmIndex;
        var couplingMultiplier;
        var objectClutchFlag;
        var formJobVariableScoreSerialize = $("#form-job-variable-score").serialize();
        var jobVariableObj = JSON.parse('{"' + decodeURI(formJobVariableScoreSerialize.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');

        const frequencyMultiplierArr = { //If frequency greater than 15 minute all condition 0.00
            'frequency':[0.2, 0.5, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 'moreThan15'], // per minute "condition minute less than equal to 0.2"
            'workingTimeDuration':{
                'cond1':{ //Greater Than Equal To 1 Hour
                    'lessThan75':[1.00, 0.97, 0.94, 0.91, 0.88, 0.84, 0.80, 0.75, 0.70, 0.60, 0.52, 0.45, 0.41, 0.37, 0.00, 0.00, 0.00, 0.00], // V Less Than 75
                    'moreThan75':[1.00, 0.97, 0.94, 0.91, 0.88, 0.84, 0.80, 0.75, 0.70, 0.60, 0.52, 0.45, 0.41, 0.37, 0.34, 0.31, 0.28, 0.00], // V Greater Than Equal To 75
                },
                'cond2':{ //Greater Than 1 Hour And Less Than Equal To 2 Hour
                    'lessThan75':[0.95, 0.92, 0.88, 0.84, 0.79, 0.72, 0.60, 0.50, 0.42, 0.35, 0.30, 0.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00], // V Less Than 75
                    'moreThan75':[0.95, 0.92, 0.88, 0.84, 0.79, 0.72, 0.60, 0.50, 0.42, 0.35, 0.30, 0.26, 0.23, 0.21, 0.00, 0.00, 0.00, 0.00], // V Greater Than Equal To 75
                },
                'cond3':{ //Greater Than 2 Hour And Less Than Equal To 8 Hour
                    'lessThan75':[0.85, 0.81, 0.75, 0.65, 0.55, 0.45, 0.35, 0.27, 0.22, 0.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00], // V Less Than 75
                    'moreThan75':[0.85, 0.81, 0.75, 0.65, 0.55, 0.45, 0.35, 0.27, 0.22, 0.18, 0.15, 0.13, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00], // V Greater Than Equal To 75
                }
            }
        }
        const couplingMultiplierArr = {
            'couplingType':['good', 'fair', 'poor'],
            'couplingMultiplier':{
                'lessThan75':[1.00, 0.95, 0.90], // V Less Than 75
                'moreThan75':[1.00, 1.00, 0.90], // V Greater Than Equal To 75
            }
        }

        if(jobVariableObj.hand_location_h.length === 0){
            $("#error-msg-hand-location-h").remove();
            $("#hand-location-h").addClass("is-invalid");
            $('#hand-location-h-div').append('<div id="error-msg-hand-location-h" class="text-danger">The hand location H field is required.</div>');
        }
        if(jobVariableObj.hand_location_v.length === 0){
            $("#error-msg-hand-location-v").remove();
            $("#hand-location-v").addClass("is-invalid");
            $('#hand-location-v-div').append('<div id="error-msg-hand-location-v" class="text-danger">The hand location V field is required.</div>');
        }
        if(jobVariableObj.vertical_distance_d.length === 0){
            $("#error-msg-vertical-distance-d").remove();
            $("#vertical-distance-d").addClass("is-invalid");
            $('#vertical-distance-d-div').append('<div id="error-msg-vertical-distance-d" class="text-danger">The vertical distance d field is required.</div>');
        }
        if(jobVariableObj.assymetric_angle_a.length === 0){
            $("#error-msg-assymetric-angle-a").remove();
            $("#assymetric-angle-a").addClass("is-invalid");
            $('#assymetric-angle-a-div').append('<div id="error-msg-assymetric-angle-a" class="text-danger">The assymetric angle a field is required.</div>');
        }
        if(jobVariableObj.average_frequency_f.length === 0){
            $("#error-msg-average-frequency-f").remove();
            $("#average-frequency-f").addClass("is-invalid");
            $('#average-frequency-f-div').append('<div id="error-msg-average-frequency-f" class="text-danger">The average frequency f field is required.</div>');
        }
        if(jobVariableObj.duration.length === 0){
            $("#error-msg-duration").remove();
            $("#duration").addClass("is-invalid");
            $('#duration-div').append('<div id="error-msg-duration" class="text-danger">The duration field is required.</div>');
        }
        if(jobVariableObj.object_cluth_c.length === 0){
            $("#error-msg-object-clutch-c").remove();
            $("#object-clutch-c").addClass("is-invalid");
            $('#object-clutch-c-div').append('<div id="error-msg-object-clutch-c" class="text-danger">The object clutch c field is required.</div>');
        }else{
            if(jobVariableObj.object_cluth_c.toLowerCase() === 'good' || jobVariableObj.object_cluth_c.toLowerCase() === 'bagus' || jobVariableObj.object_cluth_c.toLowerCase() === 'fair' || jobVariableObj.object_cluth_c.toLowerCase() === 'sedang' || jobVariableObj.object_cluth_c.toLowerCase() === 'poor' || jobVariableObj.object_cluth_c.toLowerCase() === 'jelek'){
                objectClutchFlag = 0;
            }else{
                objectClutchFlag = 1;
                $("#error-msg-object-clutch-c").remove();
                $("#object-clutch-c").addClass("is-invalid");
                $('#object-clutch-c-div').append('<div id="error-msg-object-clutch-c" class="text-danger">The object clutch c not matching.</div>');
            }
        }

        if(jobVariableObj.object_weight.length === 0){
            $("#error-msg-object-weight").remove();
            $("#object-weight").addClass("is-invalid");
            $('#object-weight-div').append('<div id="error-msg-object-weight" class="text-danger">The object weight field is required.</div>');
        }
        
        if(objectClutchFlag === 0 && formJobVariableScoreSerialize.indexOf('=&') === -1){
            var hand_location_h = 25/jobVariableObj.hand_location_h;
            var hand_location_v = 1-0.003*Math.abs(jobVariableObj.hand_location_v-75);
            var vertical_distance_d = 0.82+4.5/jobVariableObj.vertical_distance_d;
            // var assymetric_angle_a = jobVariableObj.assymetric_angle_a;
            // var average_frequency_f = jobVariableObj.average_frequency_f;
            // var duration = jobVariableObj.duration;
            // var object_weight = jobVariableObj.object_weight;

            var asymetricMultiplier = 1-(jobVariableObj.assymetric_angle_a*0.0032);
            var object_cluth_c;

            if(jobVariableObj.object_cluth_c.toLowerCase() === 'good' || jobVariableObj.object_cluth_c.toLowerCase() === 'bagus') object_cluth_c = 'good';
            if(jobVariableObj.object_cluth_c.toLowerCase() === 'fair' || jobVariableObj.object_cluth_c.toLowerCase() === 'sedang') object_cluth_c = 'fair';
            if(jobVariableObj.object_cluth_c.toLowerCase() === 'poor' || jobVariableObj.object_cluth_c.toLowerCase() === 'jelek') object_cluth_c = 'poor';
            
            $.each(frequencyMultiplierArr, function(index, frequencyMultiplierValue){
                $.each(frequencyMultiplierValue, function(frequencyIndex, frequencyValue){
                    if(frequencyValue === parseInt(jobVariableObj.average_frequency_f)){
                        frequencyIndexFound = frequencyIndex;
                    }else if(frequencyValue === 'moreThan15' && parseInt(jobVariableObj.average_frequency_f) > 15){
                        frequencyIndexFound = frequencyIndex;
                    }

                    if(frequencyValue !== 'moreThan15' &&  Object.keys(frequencyValue).length !== 0){
                        $.each(frequencyValue, function(index, value){
                            if(frequencyIndex === 'cond1' && jobVariableObj.duration <= 1){
                                if(index === 'lessThan75' && jobVariableObj.hand_location_v < 75){
                                    frequencyMultiplier = value[frequencyIndexFound];
                                }else if(index === 'moreThan75' && jobVariableObj.hand_location_v >= 75){
                                    frequencyMultiplier = value[frequencyIndexFound];
                                }
                            }else if(frequencyIndex === 'cond2' && jobVariableObj.duration > 1 && jobVariableObj.duration <= 2){
                                if(index === 'lessThan75' && jobVariableObj.hand_location_v < 75){
                                    frequencyMultiplier = value[frequencyIndexFound];
                                }else if(index === 'moreThan75' && jobVariableObj.hand_location_v >= 75){
                                    frequencyMultiplier = value[frequencyIndexFound];
                                }
                            }else if(frequencyIndex === 'cond3' && jobVariableObj.duration > 2 && jobVariableObj.duration <= 8){
                                if(index === 'lessThan75' && jobVariableObj.hand_location_v < 75){
                                    frequencyMultiplier = value[frequencyIndexFound];
                                }else if(index === 'moreThan75' && jobVariableObj.hand_location_v >= 75){
                                    frequencyMultiplier = value[frequencyIndexFound];
                                }
                            }
                        });
                    }
                });
            });
            
            $.each(couplingMultiplierArr, function(couplingMultiplierArrIndex, couplingMultiplierArrValue){
                $.each(couplingMultiplierArrValue, function(couplingMultiplierIndex, couplingMultiplierValue){
                    if(couplingMultiplierValue === object_cluth_c){
                        cmIndex = couplingMultiplierIndex;
                    }
                    
                    if(Object.keys(couplingMultiplierArrValue).length === 2){
                        if(couplingMultiplierIndex === 'lessThan75' && jobVariableObj.hand_location_v < 75){
                            couplingMultiplier = couplingMultiplierValue[cmIndex];
                        }else if(couplingMultiplierIndex === 'moreThan75' && jobVariableObj.hand_location_v >= 75){
                            couplingMultiplier = couplingMultiplierValue[cmIndex];
                        }
                    }
                });
            });

            $("#hm-value").text(hand_location_h.toFixed(6));
            $("#hm").val(hand_location_h);
            $("#vm-value").text(hand_location_v);
            $("#vm").val(hand_location_v);
            $("#dm-value").text(vertical_distance_d.toFixed(6));
            $("#dm").val(vertical_distance_d);
            $('#am-value').text(asymetricMultiplier);
            $('#am').val(asymetricMultiplier);
            $('#fm-value').text(frequencyMultiplier);
            $('#fm').val(frequencyMultiplier);
            $('#cm-value').text(couplingMultiplier);
            $('#cm').val(couplingMultiplier);
        }
    }

    function rwl(){
        var formJobVariableScoreSerialize = $("#form-job-variable-score").serialize();
        var formRwlScoreSerialize = $("#form-rwl-score").serialize();
        var rwl = JSON.parse('{"' + decodeURI(formRwlScoreSerialize.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');

        if(rwl.lc.length === 0){
            $("#error-msg-lc").remove();
            $("#lc").addClass("is-invalid");
            $('#lc-div').append('<div id="error-msg-lc" class="text-danger">The lc field is required.</div>');
        }
        if(rwl.am.length === 0){
            $("#error-msg-am").remove();
            $("#am").addClass("is-invalid");
            $('#am-div').append('<div id="error-msg-am" class="text-danger">The am field is required.</div>');
        }
        if (typeof rwl.fm !== "undefined") {
            if(rwl.fm.length === 0){
                $("#error-msg-fm").remove();
                $("#fm").addClass("is-invalid");
                $('#fm-div').append('<div id="error-msg-fm" class="text-danger">The fm field is required.</div>');
            }
        }
        if(rwl.cm.length === 0){
            $("#error-msg-cm").remove();
            $("#cm").addClass("is-invalid");
            $('#cm-div').append('<div id="error-msg-cm" class="text-danger">The cm field is required.</div>');
        }
        
        if(formJobVariableScoreSerialize.indexOf('=&') === -1 && formRwlScoreSerialize.indexOf('=&') === -1){
            $('.cli-value').each(function (currentValue, index, arr) {
                if(currentValue <= 4){
                    if($(this).text().length === 0){
                        if($(this).attr('id') === 'stli-1'){
                            var rwlScore = rwl.lc * rwl.hm * rwl.vm * rwl.dm * rwl.am * rwl.fm * rwl.cm;
                            console.log('with fm');
                            $("#rwl-score-value").text(rwlScore.toFixed(5));
                            $("#rwl-score").val(rwlScore);
                        }else{
                            var rwlScore = rwl.lc * rwl.hm * rwl.vm * rwl.dm * rwl.am * rwl.cm;
                            console.log('no fm');
                            $("#rwl-score-value").text(rwlScore.toFixed(5));
                            $("#rwl-score").val(rwlScore);
                        }
                        return false;
                    }
                }
            });
        }else{
            var jobVariableObj = JSON.parse('{"' + decodeURI(formJobVariableScoreSerialize.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');

            if(jobVariableObj.hand_location_h.length === 0){
                $("#error-msg-hand-location-h").remove();
                $("#hand-location-h").addClass("is-invalid");
                $('#hand-location-h-div').append('<div id="error-msg-hand-location-h" class="text-danger">The hand location H field is required.</div>');
            }
            if(jobVariableObj.hand_location_v.length === 0){
                $("#error-msg-hand-location-v").remove();
                $("#hand-location-v").addClass("is-invalid");
                $('#hand-location-v-div').append('<div id="error-msg-hand-location-v" class="text-danger">The hand location V field is required.</div>');
            }
            if(jobVariableObj.vertical_distance_d.length === 0){
                $("#error-msg-vertical-distance-d").remove();
                $("#vertical-distance-d").addClass("is-invalid");
                $('#vertical-distance-d-div').append('<div id="error-msg-vertical-distance-d" class="text-danger">The vertical distance d field is required.</div>');
            }
            if(jobVariableObj.assymetric_angle_a.length === 0){
                $("#error-msg-assymetric-angle-a").remove();
                $("#assymetric-angle-a").addClass("is-invalid");
                $('#assymetric-angle-a-div').append('<div id="error-msg-assymetric-angle-a" class="text-danger">The assymetric angle a field is required.</div>');
            }
            if(jobVariableObj.average_frequency_f.length === 0){
                $("#error-msg-average-frequency-f").remove();
                $("#average-frequency-f").addClass("is-invalid");
                $('#average-frequency-f-div').append('<div id="error-msg-average-frequency-f" class="text-danger">The average frequency f field is required.</div>');
            }
            if(jobVariableObj.duration.length === 0){
                $("#error-msg-duration").remove();
                $("#duration").addClass("is-invalid");
                $('#duration-div').append('<div id="error-msg-duration" class="text-danger">The duration field is required.</div>');
            }
            if(jobVariableObj.object_cluth_c.length === 0){
                $("#error-msg-object-clutch-c").remove();
                $("#object-clutch-c").addClass("is-invalid");
                $('#object-clutch-c-div').append('<div id="error-msg-object-clutch-c" class="text-danger">The object clutch c field is required.</div>');
            }
            if(jobVariableObj.object_weight.length === 0){
                $("#error-msg-object-weight").remove();
                $("#object-weight").addClass("is-invalid");
                $('#object-weight-div').append('<div id="error-msg-object-weight" class="text-danger">The object weight field is required.</div>');
            }
        }
    }

    function liftingIndex(){
        var formJobVariableScoreSerialize = $("#form-job-variable-score").serialize();
        var formRwlScoreSerialize = $("#form-rwl-score").serialize();
        var rwl = JSON.parse('{"' + decodeURI(formRwlScoreSerialize.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');

        if(formJobVariableScoreSerialize.indexOf('=&') === -1 && formRwlScoreSerialize.indexOf('=&') === -1){
            var objectWeight = $("#object-weight").val();
            var rwlScore = $("#rwl-score").val();
            let liftingIndexScore = objectWeight/rwlScore;
            
            $("#lifting-index-score-val").text(liftingIndexScore.toFixed(5));
            $("#lifting-index-score").val(liftingIndexScore);

            $('#btn-add-compose-li').removeClass('disabled');
        }else{
            var jobVariableObj = JSON.parse('{"' + decodeURI(formJobVariableScoreSerialize.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');
            var rwl = JSON.parse('{"' + decodeURI(formRwlScoreSerialize.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');

            if(jobVariableObj.hand_location_h.length === 0){
                $("#error-msg-hand-location-h").remove();
                $("#hand-location-h").addClass("is-invalid");
                $('#hand-location-h-div').append('<div id="error-msg-hand-location-h" class="text-danger">The hand location H field is required.</div>');
            }
            if(jobVariableObj.hand_location_v.length === 0){
                $("#error-msg-hand-location-v").remove();
                $("#hand-location-v").addClass("is-invalid");
                $('#hand-location-v-div').append('<div id="error-msg-hand-location-v" class="text-danger">The hand location V field is required.</div>');
            }
            if(jobVariableObj.vertical_distance_d.length === 0){
                $("#error-msg-vertical-distance-d").remove();
                $("#vertical-distance-d").addClass("is-invalid");
                $('#vertical-distance-d-div').append('<div id="error-msg-vertical-distance-d" class="text-danger">The vertical distance d field is required.</div>');
            }
            if(jobVariableObj.assymetric_angle_a.length === 0){
                $("#error-msg-assymetric-angle-a").remove();
                $("#assymetric-angle-a").addClass("is-invalid");
                $('#assymetric-angle-a-div').append('<div id="error-msg-assymetric-angle-a" class="text-danger">The assymetric angle a field is required.</div>');
            }
            if(jobVariableObj.average_frequency_f.length === 0){
                $("#error-msg-average-frequency-f").remove();
                $("#average-frequency-f").addClass("is-invalid");
                $('#average-frequency-f-div').append('<div id="error-msg-average-frequency-f" class="text-danger">The average frequency f field is required.</div>');
            }
            if(jobVariableObj.duration.length === 0){
                $("#error-msg-duration").remove();
                $("#duration").addClass("is-invalid");
                $('#duration-div').append('<div id="error-msg-duration" class="text-danger">The duration field is required.</div>');
            }
            if(jobVariableObj.object_cluth_c.length === 0){
                $("#error-msg-object-clutch-c").remove();
                $("#object-clutch-c").addClass("is-invalid");
                $('#object-clutch-c-div').append('<div id="error-msg-object-clutch-c" class="text-danger">The object clutch c field is required.</div>');
            }
            if(jobVariableObj.object_weight.length === 0){
                $("#error-msg-object-weight").remove();
                $("#object-weight").addClass("is-invalid");
                $('#object-weight-div').append('<div id="error-msg-object-weight" class="text-danger">The object weight field is required.</div>');
            }

            if(rwl.lc.length === 0){
                $("#error-msg-lc").remove();
                $("#lc").addClass("is-invalid");
                $('#lc-div').append('<div id="error-msg-lc" class="text-danger">The lc field is required.</div>');
            }
            if(rwl.am.length === 0){
                $("#error-msg-am").remove();
                $("#am").addClass("is-invalid");
                $('#am-div').append('<div id="error-msg-am" class="text-danger">The am field is required.</div>');
            }
            if(rwl.fm.length === 0){
                $("#error-msg-fm").remove();
                $("#fm").addClass("is-invalid");
                $('#fm-div').append('<div id="error-msg-fm" class="text-danger">The fm field is required.</div>');
            }
            if(rwl.cm.length === 0){
                $("#error-msg-cm").remove();
                $("#cm").addClass("is-invalid");
                $('#cm-div').append('<div id="error-msg-cm" class="text-danger">The cm field is required.</div>');
            }
        }
    }

    function addComposeLiftingIndex (){
        $('.cli-value').each(function (currentValue, index, arr) {
            if(currentValue <= 4){
                if($(this).text().length === 0){
                    if($(this).attr('id') === 'stli-1'){
                        $("#stli-1").text(parseFloat($("#lifting-index-score").val()).toFixed(7));
                        $('#fm').val("");
                        $('#fm-th').remove();
                        $('#fm-td').remove();
                    }else{
                        var fili = parseFloat($("#lifting-index-score").val()) * ((1/0.65)-(1/0.75));

                        $("#"+$(this).attr('id')).text(fili.toFixed(9));
                    }
                    cliTotal = cliTotal + parseFloat($(this).text());
                    $('#cli-total').text(cliTotal.toFixed(9));

                    return false;
                }else{
                    // 
                }
            }
        });
        
        $("#hand-location-h").removeClass("is-valid");
        $("#hand-location-v").removeClass("is-valid");
        $("#vertical-distance-d").removeClass("is-valid");
        $("#assymetric-angle-a").removeClass("is-valid");
        $("#average-frequency-f").removeClass("is-valid");
        $("#duration").removeClass("is-valid");
        $("#object-clutch-c").removeClass("is-valid");
        $("#object-weight").removeClass("is-valid");
        $("#lc").removeClass("is-valid");
        $('#hm-value').text('-');
        $('#vm-value').text('-');
        $('#dm-value').text('-');
        $('#am-value').text('-');
        $('#cm-value').text('-');
        $('#rwl-score-value').text('-');
        $('#lifting-index-score-val').text('-');
        $('#btn-add-compose-li').addClass('disabled');

        $('#form-job-variable-score')[0].reset();
        $('#form-rwl-score')[0].reset();
        $('#lifting-index-score').val("");
    }
</script>
@endsection