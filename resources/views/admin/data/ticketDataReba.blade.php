@extends('layouts.app')

@section('title', 'Data Ticket Reba')

@section('plugin_css')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/sweetalert2.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/fixedColumns.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/chartist.css')}}">
<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
</style>
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
        @include('layouts.sidebar', ['activeMenu' => 'active'])
        <!-- Page Sidebar End-->
        <div class="page-body">
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Data Ergonomic {{$ticket->ssp_ticket_job_title}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.ticketsList.index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.ticketsList.index')}}">Tickets List</a></li>
                            <li class="breadcrumb-item active">Data Ergonomic {{$ticket->ssp_ticket_jkob_title}}</li>
                        </ol>
                    </div>
                    <!-- Ajax data source array start-->
                    <div class="col-sm-12">
                        <div class="card" style="margin-bottom: 10px;">
                            <!-- <div class="card-header">

                            </div> -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                            <tr>
                                                <td scope="row" style="width: 13%;padding-left: 0px;padding-right: 0px;">Job Title</td>
                                                <th style="padding-left: 0px;">: {{$ticket->ssp_ticket_job_title}}</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 13%;padding-left: 0px;padding-right: 0px;">Person In Charge Name</td>
                                                <th style="padding-left: 0px;">: {{$ticket->ssp_ticket_person_in_charge_name}}</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 13%;padding-left: 0px;padding-right: 0px;">Person In Charge Telephone</td>
                                                <th style="padding-left: 0px;">: {{$ticket->ssp_ticket_person_in_charge_telephone}}</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 13%;padding-left: 0px;padding-right: 0px;">Job Analyst</td>
                                                <th style="padding-left: 0px;">: {{$ticket->ssp_ticket_job_analyst}}</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 13%;padding-left: 0px;padding-right: 0px;">Job Date</td>
                                                <th style="padding-left: 0px;">: {{date('d-m-Y', strtotime($ticket->ssp_ticket_job_date))}}</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 13%;padding-left: 0px;padding-right: 0px;">Job Description</td>
                                                <th style="padding-left: 0px;">: {{$ticket->ssp_ticket_job_description}}</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 13%;padding-left: 0px;padding-right: 0px;">Job Location</td>
                                                <th style="padding-left: 0px;">: {{$ticket->ssp_ticket_job_location}}</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 10%;padding-left: 0px;padding-right: 0px;">Approval Status</td>
                                                <th style="padding-left: 0px;">: @if($ticket->ssp_ticket_status == 2) {{"Validation Process!"}} @elseif($ticket->ssp_ticket_status == 3) {{"Validation Success!"}} @endif</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr/>
                                    @if($ticket->ssp_ticket_status != 3)
                                        <button class="btn btn-pill btn-outline-secondary btn-air-secondary btn-sm" type="button" onclick="approveTicket({{$ticket->id}}, '{{$ticket->ssp_ticket_job_title}}')" title="Approve Ticket" style="border-radius: 0px !important;">Approve Ticket</button>
                                        <button id="btn-modal-import-csv" class="btn btn-pill btn-outline-primary btn-air-secondary btn-sm" type="button" onclick="modalImportCSV({{$ticket->id}})" title="Re-Upload CSV Data" style="border-radius: 0px !important;">Re-Upload CSV Data</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>Reba Chart</h5>
                            </div>
                            <div class="card-body">
                                <div id="reba-chart" class="col-md-12" style="width: 430px; min-width: 110%; height:430px;"></div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>Action Level Chart</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                            <tr>
                                                <td scope="row" style="width: 7%;padding-left: 0px;padding-right: 0px;">Level 1</td>
                                                <th style="padding-left: 0px;">: Negligible Risk</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 7%;padding-left: 0px;padding-right: 0px;">Level 2 to 3</td>
                                                <th style="padding-left: 0px;">: Low risk, change may be needed</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 7%;padding-left: 0px;padding-right: 0px;">Level 4 to 7</td>
                                                <th style="padding-left: 0px;">: Medium risk, further investigation, change soon</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 7%;padding-left: 0px;padding-right: 0px;">Level 8 to 10</td>
                                                <th style="padding-left: 0px;">: High risk, investigate and implement change</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 7%;padding-left: 0px;padding-right: 0px;">Level above 11</td>
                                                <th style="padding-left: 0px;">: Very high risk, implement change</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="action-level-chart" class="col-md-12" style="width: 430px; min-width: 110%; height:430px;"></div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5>Action Level Frequency</h5>
                            </div>
                            <div class="card-body">
                                <table class="display" id="data-action-level" style="table-layout: fixed !important;width: 98% !important;">
                                    <thead>
                                        <tr>
                                            <th>Score</th>
                                            <th>Frequency</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5>Simulation Video</h5>
                            </div>
                            <div class="card-body pt-0">
                                <video id="my_video_1" class="video-js vjs-default-skin" width="640px" height="360px"
                                    controls preload="none" poster='url'
                                    data-setup='{ "aspectRatio":"640:267", "playbackRates": [1, 1.5, 2] }'>
                                    <source src="{!!Storage::url($ticket->ssp_ticket_simulation_video_path)!!}" type='video/mp4' />
                                    <source src="{!!Storage::url($ticket->ssp_ticket_simulation_video_path)!!}" type='video/webm' />
                                </video>
                            </div>
                        </div>

                        <div class="card mb-1 d-flex aligns-items-center">
                            <div class="card-body pb-2 pt-2">
                                <label class="col-form-label pb-1">Filter Action Level:</label>
                                <div class="form-group m-t-5 m-checkbox-inline mb-0 custom-radio-ml">
                                    <div class="radio radio-primary">
                                        <input class="filter-checkbox" id="filter-all" type="radio" checked="checked" value="All">
                                        <label for="filter-all">All <span id="filter-all-count" class="fw-bold"></span></label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input class="filter-checkbox" id="level-1" type="radio" value="Level 1">
                                        <label for="level-1">Level<span class="digits"> 1 </span><span id="level-1-count" class="fw-bold"></span></label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input class="filter-checkbox" id="level-2" type="radio" class="radio" value="Level 2 to 3">
                                        <label for="level-2">Level<span class="digits"> 2 to 3 </span><span id="level-2-to-3-count" class="fw-bold"></span></label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input class="filter-checkbox" id="level-3" type="radio" class="radio" value="Level 4 to 7">
                                        <label for="level-3">Level<span class="digits"> 4 to 7 </span><span id="level-4-to-7-count" class="fw-bold"></span></label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input class="filter-checkbox" id="level-4" type="radio" class="radio" value="Level 8 to 10">
                                        <label for="level-4">Level<span class="digits"> 8 to 10 </span><span id="level-8-to-10-count" class="fw-bold"></span></label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input class="filter-checkbox" id="level-4" type="radio" class="radio" value="Level above 11">
                                        <label for="level-4">Level<span class="digits"> 11+ </span><span id="level-above-11-count" class="fw-bold"></span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <!-- <div class="card-header">
                                <h5>Data Ergonomic</h5>
                            </div> -->
                            <div class="card-body">
                                <div id="length-data-ssp-reba" class="dataTables_wrapper"></div>
                                <div class="table-responsive">
                                    <table class="display datatables" id="data-ssp-reba">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 90px">Action</th>
                                                <th>Time</th>
                                                <th>Action Level</th>
                                                <th>Reba Score Table C</th>
                                                <th>Reba Score Table B</th>
                                                <th>Reba Score Table A</th>
                                                <th>Upper Arm Left</th>
                                                <th>Upper Arm Right</th>
                                                <th>Lower Arm Left</th>
                                                <th>Lower Arm Right</th>
                                                <th>wrist Left</th>
                                                <th>Wrist Right</th>
                                                <th>Wrist Twist Left</th>
                                                <th>Wrist Twist Right</th>
                                                <th>Neck</th>
                                                <th>Trunk Position</th>
                                                <th>Legs</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div id="pagination-data-ssp-reba" class="dataTables_wrapper"></div>
                            </div>
                        </div>

                        <div class="card">
                            <!-- <div class="card-header">
                                <h5>Data Ergonomic</h5>
                            </div> -->
                            <div class="card-body">
                                <div id="length-data-ergonomic" class="dataTables_wrapper"></div>
                                <div class="table-responsive">
                                    <table class="display datatables" id="data-ergonomic">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Task</th>
                                                <th>Action</th>
                                                <th>Joint Angles Wrist Flex Ext Left</th>
                                                <th>Joint Angles Wrist Flex Ext Right</th>
                                                <th>Joint Angles Wrist Rad Ulnar Dev Left</th>
                                                <th>Joint Angles Wrist Rad Ulnar Dev Right</th>
                                                <th>Joint Angles Forearm Sup Pro Left</th>
                                                <th>Joint Angles Forearm Sup Pro Right</th>
                                                <th>Joint Angles Elbow Right</th>
                                                <th>Joint Angles Elbow Left</th>
                                                <th>Joint Angles Shoulder Abd Right</th>
                                                <th>Joint Angles Shoulder Abd Left</th>
                                                <th>Joint Angles Shoulder For Back Right</th>
                                                <th>Joint Angles Shoulder For Back Left</th>
                                                <th>Joint Angles Humeral Rot Right</th>
                                                <th>Joint Angles Humeral Rot Left</th>
                                                <th>Joint Angles Trunk Flex Ext</th>
                                                <th>Joint Angles Trunk Lateral</th>
                                                <th>Joint Angles Trunk Rotation</th>
                                                <th>Joint Angles Hip Flex Ext Right</th>
                                                <th>Joint Angles Hip Flex Ext Left</th>
                                                <th>Joint Angles Knee Flex Ext Right</th>
                                                <th>Joint Angles Knee Flex Ext Left</th>
                                                <th>Joint Angles Ankle Flex Ext Right</th>
                                                <th>Joint Angles Ankle Flex Ext Left</th>
                                                <th>Joint Torques Wrist Flex Ext Left</th>
                                                <th>Joint Torques Wrist Flex Ext Right</th>
                                                <th>Joint Torques Wrist Rad Ulnar Dev Left</th>
                                                <th>Joint Torques Wrist Rad Ulnar Dev Right</th>
                                                <th>Joint Torques Forearm Sup Pro Left</th>
                                                <th>Joint Torques Forearm Sup Pro Right</th>
                                                <th>Joint Torques Elbow Right</th>
                                                <th>Joint Torques Elbow Left</th>
                                                <th>Joint Torques Shoulder Abd Right</th>
                                                <th>Joint Torques Shoulder Abd Left</th>
                                                <th>Joint Torques Shoulder For Back Right</th>
                                                <th>Joint Torques Shoulder For Back Left</th>
                                                <th>Joint Torques Humeral Rot Right</th>
                                                <th>Joint Torques Humeral Rot Left</th>
                                                <th>Joint Torques Trunk Flex Ext</th>
                                                <th>Joint Torques Trunk Lateral</th>
                                                <th>Joint Torques Trunk Rotation</th>
                                                <th>Joint Torques Hip Flex Ext Right</th>
                                                <th>Joint Torques Hip Flex Ext Left</th>
                                                <th>Joint Torques Knee Flex Ext Right</th>
                                                <th>Joint Torques Knee Flex Ext Left</th>
                                                <th>Joint Torques Ankle Flex Ext Right</th>
                                                <th>Joint Torques Ankle Flex Ext Left</th>
                                                <th>Mean Strengths Wrist Flex Ext Left</th>
                                                <th>Mean Strengths Wrist Flex Ext Right</th>
                                                <th>Mean Strengths Wrist Rad Ulnar Dev Left</th>
                                                <th>Mean Strengths Wrist Rad Ulnar Dev Right</th>
                                                <th>Mean Strengths Forearm Sup Pro Left</th>
                                                <th>Mean Strengths Forearm Sup Pro Right</th>
                                                <th>Mean Strengths Elbow Right</th>
                                                <th>Mean Strengths Elbow Left</th>
                                                <th>Mean Strengths Shoulder Abd Right</th>
                                                <th>Mean Strengths Shoulder Abd Left</th>
                                                <th>Mean Strengths Shoulder For Back Right</th>
                                                <th>Mean Strengths Shoulder For Back Left</th>
                                                <th>Mean Strengths Humeral Rot Right</th>
                                                <th>Mean Strengths Humeral Rot Left</th>
                                                <th>Mean Strengths Trunk Flex Ext</th>
                                                <th>Mean Strengths Trunk Lateral</th>
                                                <th>Mean Strengths Trunk Rotation</th>
                                                <th>Mean Strengths Hip Flex Ext Right</th>
                                                <th>Mean Strengths Hip Flex Ext Left</th>
                                                <th>Mean Strengths Knee Flex Ext Right</th>
                                                <th>Mean Strengths Knee Flex Ext Left</th>
                                                <th>Mean Strengths Ankle Flex Ext Right</th>
                                                <th>Mean Strengths Ankle Flex Ext Left</th>

                                                <th>Strength Std Devs Wrist Flex Ext Left</th>
                                                <th>Strength Std Devs Wrist Flex Ext Right</th>
                                                <th>Strength Std Devs Wrist Rad Ulnar Dev Left</th>
                                                <th>Strength Std Devs Wrist Rad Ulnar Dev Right</th>
                                                <th>Strength Std Devs Forearm Sup Pro Left</th>
                                                <th>Strength Std Devs Forearm Sup Pro Right</th>
                                                <th>Strength Std Devs Elbow Right</th>
                                                <th>Strength Std Devs Elbow Left</th>
                                                <th>Strength Std Devs Shoulder Abd Right</th>
                                                <th>Strength Std Devs Shoulder Abd Left</th>
                                                <th>Strength Std Devs Shoulder For Back Right</th>
                                                <th>Strength Std Devs Shoulder For Back Left</th>
                                                <th>Strength Std Devs Humeral Rot Right</th>
                                                <th>Strength Std Devs Humeral Rot Left</th>
                                                <th>Strength Std Devs Trunk Flex Ext</th>
                                                <th>Strength Std Devs Trunk Lateral</th>
                                                <th>Strength Std Devs Trunk Rotation</th>
                                                <th>Strength Std Devs Hip Flex Ext Right</th>
                                                <th>Strength Std Devs Hip Flex Ext Left</th>
                                                <th>Strength Std Devs Knee Flex Ext Right</th>
                                                <th>Strength Std Devs Knee Flex Ext Left</th>
                                                <th>Strength Std Devs Ankle Flex Ext Right</th>
                                                <th>Strength Std Devs Ankle Flex Ext Left</th>

                                                <th>Percent Capables Wrist Flex Ext Left</th>
                                                <th>Percent Capables Wrist Flex Ext Right</th>
                                                <th>Percent Capables Wrist Rad Ulnar Dev Left</th>
                                                <th>Percent Capables Wrist Rad Ulnar Dev Right</th>
                                                <th>Percent Capables Forearm Sup Pro Left</th>
                                                <th>Percent Capables Forearm Sup Pro Right</th>
                                                <th>Percent Capables Elbow Right</th>
                                                <th>Percent Capables Elbow Left</th>
                                                <th>Percent Capables Shoulder Abd Right</th>
                                                <th>Percent Capables Shoulder Abd Left</th>
                                                <th>Percent Capables Shoulder For Back Right</th>
                                                <th>Percent Capables Shoulder For Back Left</th>
                                                <th>Percent Capables Humeral Rot Right</th>
                                                <th>Percent Capables Humeral Rot Left</th>
                                                <th>Percent Capables Trunk Flex Ext</th>
                                                <th>Percent Capables Trunk Lateral</th>
                                                <th>Percent Capables Trunk Rotation</th>
                                                <th>Percent Capables Hip Flex Ext Right</th>
                                                <th>Percent Capables Hip Flex Ext Left</th>
                                                <th>Percent Capables Knee Flex Ext Right</th>
                                                <th>Percent Capables Knee Flex Ext Left</th>
                                                <th>Percent Capables Ankle Flex Ext Right</th>
                                                <th>Percent Capables Ankle Flex Ext Left</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div id="pagination-data-ergonomic" class="dataTables_wrapper"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Ajax data source array end-->
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
    </div>
    <!-- footer start-->
    @include('layouts.footer')
</div>

<!-- Modal Upload CSV-->
<div class="modal fade" id="importCSVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Import CSV</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="theme-form" id="dataImportCSV" enctype="multipart/form-data" action="" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="ticket-id" name="ticket_id" value="">
                            <div class="form-group row" id="job-analyst-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Analyst</label>
                                <div class="col-xl-10 col-sm-9">
                                <input type="text" class="form-control" id="job-analyst" name="job_analyst" placeholder="Analyst..." >
                                </div>
                            </div>
                            <div class="form-group row" id="movement-type-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Movement Type</label>
                                <div class="col-xl-10 col-sm-9">
                                    <select class="form-select" id="movement-type" name="movement_type" required="">
                                        <option selected="" disabled="" value="">Choose...</option>
                                        <option value="1">Static</option>
                                        <option value="2">Intermitten</option>
                                        <option value="3">Repeated</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="weight-of-object-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Weight of Object Being Transported</label>
                                <div class="col-xl-10 col-sm-9">
                                <input type="number" class="form-control" id="weight-of-object" name="weight_of_object" placeholder="1231..." >
                                </div>
                            </div>
                            <div class="form-group row" id="video-simulation-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Upload Simulation Video</label>
                                <video width="400" controls>
                                    <source src="" id="video_here">
                                    Your browser does not support HTML5 video.
                                </video>
                                <div class="image-preview" id="image-preview-foto-lapangan-1"></div>
                                <div class="col-xl-10 col-sm-9">
                                    <button id="btn-video-simulation" class="btn btn-primary" type="button">Browse File</button>
                                    <input type="file" class="form-control" name="video_simulation" id="video-simulation" aria-label="video" accept="video/mp4,video/x-m4v,video/*" size="1" style="display:none;">
                                </div>
                            </div>
                            <div class="form-group row" id="csv-file-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">CSV file to Import</label>
                                <div class="col-xl-10 col-sm-9">
                                    <input type="file" class="form-control" name="csvFile" id="csv-file" aria-label="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                </div>
                            </div>
                            <div  style="display: none" class="progress mt-3" style="height: 25px">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-square btn-outline-light txt-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="process-csv-data" onclick="parseCSVData()" class="btn btn-square btn-outline-secondary">Process CSV Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data Ergonomic-->
<div class="modal fade" id="modal-edit-data-ssp-reba" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Data Ergonomic</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="theme-form" id="editDataFormErgonomic" enctype="multipart/form-data" action="" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" id="edit-body-data-ssp-reba">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-square btn-outline-light txt-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="updateErgonomicData()" class="btn btn-square btn-outline-secondary">Update Ergonomics Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('plugin_js')
<!-- Plugins JS start-->
<script src="{{url('/assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{url('/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/datatable/datatable-extension/dataTables.fixedColumns.min.js')}}"></script>
<!-- <script src="{{url('/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{url('/assets/js/chart/apex-chart/stock-prices.js')}}"></script> -->

<script src="{{url('/assets/js/chart/echarts/echarts.min.js')}}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0"></script>
<script src="https://hammerjs.github.io/dist/hammer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.2.1/chartjs-plugin-zoom.min.js"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3"></script>
<script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script> -->
<!-- <script src="{{url('/assets/js/chart/chartjs/chartjs-plugin-zoom.min.js')}}"></script> -->
<!-- <script src="{{url('/assets/js/chart/chartjs/chart.custom.js')}}"></script> -->

<!-- <script src="{{url('/assets/js/chart/apex-chart/chart-custom.js')}}"></script> -->
<script src="{{url('/assets/js/tooltip-init.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
<!-- Plugins JS Ends-->

<script>
    var filterActionLevel = "All";

    $('.filter-checkbox').prop('checked', false);
    $('#filter-all').prop('checked', true);
    $('.filter-checkbox').on('change', function() {
        $('.filter-checkbox').not(this).prop('checked', false);
    });

    function ucwords(str) {
        str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        return str;
    }

    tableDataActionLevel = $('#data-action-level').DataTable({
        bFilter: false,
        lengthChange: false,
        serverSide: false,
        info: false,
        paging: false,
        // scrollY: false,
        // scrollX: false,
        ordering: false,
        columns: [
            { data: 'score' },
            { data: 'frequency' },
        ]
    });

    $.ajax({
        type: "POST",
        url: "{{route('admin.sspRebaData.getDataSspRebaFrequencyAdmin', $ticketId)}}",
        data: {
            "_token": "{{ csrf_token() }}",
        },
        dataType: "json",
        success:function(data){
            console.log('test data reba ', data.arrTableC)
            $("#filter-all-count").text('('+data.allDataActionLevel+')');
            $("#level-1-count").text('('+data.arrTableC[0].frequency+')');
            $("#level-2-to-3-count").text('('+data.arrTableC[1].frequency+')');
            $("#level-4-to-7-count").text('('+data.arrTableC[2].frequency+')');
            $("#level-8-to-10-count").text('('+data.arrTableC[3].frequency+')');
            $("#level-above-11-count").text('('+data.arrTableC[4].frequency+')');
            $('#data-action-level').DataTable().clear().rows.add(data.arrTableC).draw();
        }
    });

    $.ajax({
        type: "GET",
        url: "{{route('admin.sspRebaData.getDataSspRebaChart', $ticketId)}}",
        dataType: "json",
        contentType: 'application/json',
        success: function(data) {
            var dataLabels = data.map(function(e) {
                return e.time;
            });
            var dataCharts = data.map(function(e) {
                return e.ssp_reba_table_c;
            });

            var rebaChart = echarts.init(document.getElementById('reba-chart'));

            var option = {
                tooltip: {
                    trigger: 'none',
                    axisPointer: {
                    type: 'cross'
                    }
                },
                dataZoom: [{
                    type: 'slider',
                    xAxisIndex: 0,
                    filterMode: 'weakFilter',
                    height: 20,
                    bottom: 0,
                    handleIcon:
                    'path://M10.7,11.9H9.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4h1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                    handleSize: '80%',
                    showDetail: true
                }],
                toolbox: {
                    right: '9%',
                    feature: {
                        restore: {},
                        saveAsImage: {}
                    }
                },
                grid: {
                    left:'4%',
                    right: '13%',
                    bottom:'20%'
                },
                title: {
                    text: 'Reba Chart',
                    left: 'center',
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    min: 0,
                    axisTick: {
                        show: false,
                        alignWithLabel: true
                    },
                    axisLine: {
                        show: true
                    },
                    axisPointer: {
                    label: {
                        formatter: function (params) {
                        return (
                            'Reba Score ' +

                            (params.seriesData.length ? params.seriesData[0].data : '') + ' ：' + params.value + ' Time (s)'
                        );
                        }
                    }
                    },
                    splitLine: {
                        lineStyle: {
                            color: '#73c0de'
                        }
                    },
                    axisLabel: {
                        rotate: 45,
                    },
                    name: 'Time (s)',
                    nameLocation: 'middle',
                    nameGap: 40,
                    data: dataLabels
                },
                yAxis: {
                    type: 'value',
                    min: 1,
                    max: 11,
                    name: 'Reba Score',
                    nameLocation: 'middle',
                    nameGap: 40,
                    splitNumber:10,
                    axisLabel: {
                        interval: 0,
                        formatter: function (value) {
                            if (Math.floor(value) === value) {
                                return value;
                            }
                        }
                    },
                },
                series: [{
                    data: dataCharts,
                    type: 'line',
                    areaStyle: {color: '#9dd3e8'},
                    lineStyle: {
                        color: '#73c0de'
                    },
                    itemStyle: {
                        color: '#73c0de'
                    }
                }]
            };

            rebaChart.setOption(option);
            console.log(data)
        }
    });

    $.ajax({
        type: "GET",
        url: "{{route('admin.sspRebaData.getDataActionLevelRebaChartAdmin', $ticketId)}}",
        dataType: "json",
        contentType: 'application/json',
        success: function(data) {
            var dataLabels = data.map(function(e) {
                return e.time;
            });
            var dataCharts = data.map(function(e) {
                return e.action_level;
            });

            var rebaChart = echarts.init(document.getElementById('action-level-chart'));

            var option = {
                tooltip: {
                    trigger: 'none',
                    axisPointer: {
                    type: 'cross'
                    }
                },
                dataZoom: [{
                    type: 'slider',
                    xAxisIndex: 0,
                    filterMode: 'weakFilter',
                    height: 20,
                    bottom: 0,
                    handleIcon:
                    'path://M10.7,11.9H9.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4h1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                    handleSize: '80%',
                    showDetail: true
                }],
                toolbox: {
                    right: '9%',
                    feature: {
                        restore: {},
                        saveAsImage: {}
                    }
                },
                grid: {
                    left:'4%',
                    right: '13%',
                    bottom:'20%'
                },
                title: {
                    text: 'Action Level Chart',
                    left: 'center',
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    min: 0,
                    axisTick: {
                        show: false,
                        alignWithLabel: true
                    },
                    axisLine: {
                        show: true
                    },
                    axisPointer: {
                        label: {
                            formatter: function (params) {
                            return (
                                'Action Level ' +

                                (params.seriesData.length ? params.seriesData[0].data : '') + ' ：' + params.value + ' Time (s)'
                            );
                            }
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: '#73c0de'
                        }
                    },
                    axisLabel: {
                        rotate: 45,
                    },
                    name: 'Time (s)',
                    nameLocation: 'middle',
                    nameGap: 40,
                    data: dataLabels
                },
                yAxis: {
                    type: 'category',
                    // min: 1,
                    // max: 11,
                    boundaryGap: false,
                    name: 'Action Level',
                    nameLocation: 'middle',
                    nameGap: 55,
                    data: ['1', '2 To 3', '4 To 7', '8 To 10', 'Above 11'],
                    // splitNumber:11,
                    // axisLabel: {
                    //     interval: 1,
                    //     formatter: function (value) {
                    //         console.log('test 'value)
                    //         // if (Math.floor(value) === value) {
                    //         //     return value;
                    //         // }
                    //     }
                    // }
                },
                series: [{
                    data: dataCharts,
                    type: 'line',
                    areaStyle: {color: '#9dd3e8'},
                    lineStyle: {
                        color: '#73c0de'
                    },
                    itemStyle: {
                        color: '#73c0de'
                    }
                }]
            };

            rebaChart.setOption(option);
            console.log('test ', dataCharts)
        }
    });


    $('#modal-edit-data-ssp-reba').on('hidden.bs.modal', function () {
        $('#edit-body-data-ssp-reba').children().remove();
    })

    var table;
    var api;
    table = $('#data-ergonomic').DataTable({
    bFilter: false,
    processing: true,
    serverSide: true,
    ordering: false,
    // scrollY: true,
    // scrollX: true,
    // paging: true,
    // searching: { "regex": true },
    preDrawCallback: function(settings) {
        api = new $.fn.dataTable.Api(settings);
    },
    ajax: {
        type: "POST",
        url: "{{route('admin.ticketData.getTicketData', $ticketId)}}",
        dataType: "json",
        contentType: 'application/json',
        data: function (data) {
            var form = {};
            $.each($("form").serializeArray(), function (i, field) {
                form[field.name] = field.value || "";
            });
            // Add options used by Datatables
            var info = { "start": api.page.info().start, "length": api.page.info().length, "draw": api.page.info().draw };
            $.extend(form, info);
            return JSON.stringify(form);
        },
        "complete": function(response) {

        }
    },
    columns: [
        // { orderable: false, defaultContent: '\
        //     <button type="button" class="btn btn-outline-primary" id="edit-data-ergonomic" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px; margin-right:5px;"><i class="fa fa-edit" style="font-size:20px;"></i></button>\
        //     <button type="button" class="btn btn-outline-danger" id="delete-data-ergonomic" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px; margin-right:5px;"><i class="fa fa-trash" style="font-size:20px;"></i></button>',
        //     render: function (data, type, row) { if(row.ssp_ticket_status === 3) table.column(0).visible(false); }
        // },
        { orderable: false, data: 'time' },{ data: 'task' },{ data: 'action' },
        { orderable: false, data: 'joint_angles_wrist_flex_ext_left' }, { data: 'joint_angles_wrist_flex_ext_right' }, { data: 'joint_angles_wrist_rad_ulnar_dev_left' },
        { orderable: false, data: 'joint_angles_wrist_rad_ulnar_dev_right' }, { data: 'joint_angles_forearm_sup_pro_left' }, { data: 'joint_angles_forearm_sup_pro_right' }, { data: 'joint_angles_elbow_right' }, { data: 'joint_angles_elbow_left' },
        { orderable: false, data: 'joint_angles_shoulder_abd_right' }, { data: 'joint_angles_shoulder_abd_left' }, { data: 'joint_angles_shoulder_for_back_right' }, { data: 'joint_angles_shoulder_for_back_left' }, { data: 'joint_angles_humeral_rot_right' },
        { orderable: false, data: 'joint_angles_humeral_rot_left' }, { data: 'joint_angles_trunk_flex_ext' }, { data: 'joint_angles_trunk_lateral' }, { data: 'joint_angles_trunk_rotation' }, { data: 'joint_angles_hip_flex_ext_right' }, { data: 'joint_angles_hip_flex_ext_left' },
        { orderable: false, data: 'joint_angles_knee_flex_ext_right' }, { data: 'joint_angles_knee_flex_ext_left' }, { data: 'joint_angles_ankle_flex_ext_right' }, { data: 'joint_angles_ankle_flex_ext_left' },

        { orderable: false, data: 'joint_torques_wrist_flex_ext_left' }, { data: 'joint_torques_wrist_flex_ext_right' }, { data: 'joint_torques_wrist_rad_ulnar_dev_left' },
        { orderable: false, data: 'joint_torques_wrist_rad_ulnar_dev_right' }, { data: 'joint_torques_forearm_sup_pro_left' }, { data: 'joint_torques_forearm_sup_pro_right' }, { data: 'joint_torques_elbow_right' }, { data: 'joint_torques_elbow_left' },
        { orderable: false, data: 'joint_torques_shoulder_abd_right' }, { data: 'joint_torques_shoulder_abd_left' }, { data: 'joint_torques_shoulder_for_back_right' }, { data: 'joint_torques_shoulder_for_back_left' }, { data: 'joint_torques_humeral_rot_right' },
        { orderable: false, data: 'joint_torques_humeral_rot_left' }, { data: 'joint_torques_trunk_flex_ext' }, { data: 'joint_torques_trunk_lateral' }, { data: 'joint_torques_trunk_rotation' }, { data: 'joint_torques_hip_flex_ext_right' }, { data: 'joint_torques_hip_flex_ext_left' },
        { orderable: false, data: 'joint_torques_knee_flex_ext_right' }, { data: 'joint_torques_knee_flex_ext_left' }, { data: 'joint_torques_ankle_flex_ext_right' }, { data: 'joint_torques_ankle_flex_ext_left' },

        { orderable: false, data: 'mean_strengths_wrist_flex_ext_left' }, { data: 'mean_strengths_wrist_flex_ext_right' }, { data: 'mean_strengths_wrist_rad_ulnar_dev_left' },
        { orderable: false, data: 'mean_strengths_wrist_rad_ulnar_dev_right' }, { data: 'mean_strengths_forearm_sup_pro_left' }, { data: 'mean_strengths_forearm_sup_pro_right' }, { data: 'mean_strengths_elbow_right' }, { data: 'mean_strengths_elbow_left' },
        { orderable: false, data: 'mean_strengths_shoulder_abd_right' }, { data: 'mean_strengths_shoulder_abd_left' }, { data: 'mean_strengths_shoulder_for_back_right' }, { data: 'mean_strengths_shoulder_for_back_left' }, { data: 'mean_strengths_humeral_rot_right' },
        { orderable: false, data: 'mean_strengths_humeral_rot_left' }, { data: 'mean_strengths_trunk_flex_ext' }, { data: 'mean_strengths_trunk_lateral' }, { data: 'mean_strengths_trunk_rotation' }, { data: 'mean_strengths_hip_flex_ext_right' }, { data: 'mean_strengths_hip_flex_ext_left' },
        { orderable: false, data: 'mean_strengths_knee_flex_ext_right' }, { data: 'mean_strengths_knee_flex_ext_left' }, { data: 'mean_strengths_ankle_flex_ext_right' }, { data: 'mean_strengths_ankle_flex_ext_left' },

        { orderable: false, data: 'percent_capables_wrist_flex_ext_left' }, { data: 'percent_capables_wrist_flex_ext_right' }, { data: 'percent_capables_wrist_rad_ulnar_dev_left' },
        { orderable: false, data: 'percent_capables_wrist_rad_ulnar_dev_right' }, { data: 'percent_capables_forearm_sup_pro_left' }, { data: 'percent_capables_forearm_sup_pro_right' }, { data: 'percent_capables_elbow_right' }, { data: 'percent_capables_elbow_left' },
        { orderable: false, data: 'percent_capables_shoulder_abd_right' }, { data: 'percent_capables_shoulder_abd_left' }, { data: 'percent_capables_shoulder_for_back_right' }, { data: 'percent_capables_shoulder_for_back_left' }, { data: 'percent_capables_humeral_rot_right' },
        { orderable: false, data: 'percent_capables_humeral_rot_left' }, { data: 'percent_capables_trunk_flex_ext' }, { data: 'percent_capables_trunk_lateral' }, { data: 'percent_capables_trunk_rotation' }, { data: 'percent_capables_hip_flex_ext_right' }, { data: 'percent_capables_hip_flex_ext_left' },
        { orderable: false, data: 'percent_capables_knee_flex_ext_right' }, { data: 'percent_capables_knee_flex_ext_left' }, { data: 'percent_capables_ankle_flex_ext_right' }, { data: 'percent_capables_ankle_flex_ext_left' },

        { orderable: false, data: 'strength_std_devs_wrist_flex_ext_left' }, { data: 'strength_std_devs_wrist_flex_ext_right' }, { data: 'strength_std_devs_wrist_rad_ulnar_dev_left' },
        { orderable: false, data: 'strength_std_devs_wrist_rad_ulnar_dev_right' }, { data: 'strength_std_devs_forearm_sup_pro_left' }, { data: 'strength_std_devs_forearm_sup_pro_right' }, { data: 'strength_std_devs_elbow_right' }, { data: 'strength_std_devs_elbow_left' },
        { orderable: false, data: 'strength_std_devs_shoulder_abd_right' }, { data: 'strength_std_devs_shoulder_abd_left' }, { data: 'strength_std_devs_shoulder_for_back_right' }, { data: 'strength_std_devs_shoulder_for_back_left' }, { data: 'strength_std_devs_humeral_rot_right' },
        { orderable: false, data: 'strength_std_devs_humeral_rot_left' }, { data: 'strength_std_devs_trunk_flex_ext' }, { data: 'strength_std_devs_trunk_lateral' }, { data: 'strength_std_devs_trunk_rotation' }, { data: 'strength_std_devs_hip_flex_ext_right' }, { data: 'strength_std_devs_hip_flex_ext_left' },
        { orderable: false, data: 'strength_std_devs_knee_flex_ext_right' }, { data: 'strength_std_devs_knee_flex_ext_left' }, { data: 'strength_std_devs_ankle_flex_ext_right' }, { data: 'strength_std_devs_ankle_flex_ext_left' },
        ],
        order: [[ 0, "asc" ]],
        // fixedColumns:{left: 1},
        initComplete:function( settings, json){
            // $("div.dataTables_length").append('&nbsp<span onclick="approveTicket()" class="btn btn-pill btn-outline-secondary btn-air-secondary btn-sm">Approve Ticket</span>');
            $('#data-ergonomic_length').appendTo('#length-data-ergonomic');
            $('#data-ergonomic_info').appendTo('#pagination-data-ergonomic');
            $('#data-ergonomic_paginate').appendTo('#pagination-data-ergonomic');
            // $('#data-ssp-reba tbody').on('click', "#edit-data-ssp-reba", function() {
            //     let row = $(this).parents('tr')[0];
            //     console.log(table.row(row).data().ssp_time_id);

            //     $('#edit-body-data-ssp-reba').append('<input type="hidden" id="ticket-id" name="ticket_id" value="'+table.row(row).data().ssp_ticket_id+'">\
            //         <input type="hidden" id="time-id" name="time_id" value="'+table.row(row).data().ssp_time_id+'">');

            //     Object.keys(table.row(row).data()).forEach(function(item, index) {
            //         if(index >= 5){
            //             $('#edit-body-data-ssp-reba').append('\
            //                 <div class="form-group row" id="job-analyst-div">\
            //                     <label class="col-xl-3 col-sm-4 col-form-label">'+ucwords(item.replace(/_/g, " "))+'</label>\
            //                     <div class="col-xl-9 col-sm-8">\
            //                         <input type="text" class="form-control" id="'+item.replace(/_/g, "-")+'" name="'+item+'" placeholder="'+ucwords(item.replace(/_/g, " "))+'..." value="'+table.row(row).data()[item]+'">\
            //                     </div>\
            //                 </div>');
            //         }
            //     })
            //     $('#edit-data-ssp-reba').modal('show');
            // });

            // $('#data-ssp-reba tbody').on('click', "#delete-data-ssp-reba", function() {
            //     let row = $(this).parents('tr')[0];
            //     deleteDataErgonomic(table.row(row).data().ssp_time_id);
            // });
        }
    });

    function approveTicket(ticketId, ticketTitle){
        link = "{{route('admin.ticketData.approveTicketData', ':id')}}";
        link = link.replace(':id', ticketId);

		swal.fire({
			title: "Approve Ticket "+ticketTitle+"?",
			text: "Ticket "+ticketTitle+" will be approved on tickets list!",
			icon: "warning",
			showCancelButton: true,
			// confirmButtonClass: "btn-danger",
			confirmButtonText: "Approve",
            closeOnConfirm: true,
            preConfirm: (login) => {
                return $.ajax({
                    type: "POST",
                    url: link,
                    datatype : "json",
                    data:{id:ticketId, "_token": "{{ csrf_token() }}"},
                    success: function(data) {

                    },
                    error: function(data){
                        swal.fire({title:"Ticket Failed to Approved!", text:"This ticket was not approved successfully", icon:"error"});
                    }
                });
            }
		}).then((result) => {
            if(result.value){
                swal.fire({title:"Ticket Approved!", text:"This ticket has been approved on tickets list", icon:"success"})
                .then(function(){
                    window.location.href = "{{ route('admin.ticketsList.index')}}";
                });
            }
        })
    }

    function recalculateRebaData(ticketId, ticketTitle){
        link = "{{route('admin.processingData.recalculateRebaData', ':id')}}";
        link = link.replace(':id', ticketId);

		swal.fire({
			title: "Recalculate Reba Data Ticket "+ticketTitle+"?",
			text: "Ticket "+ticketTitle+" will be approved on tickets list!",
			icon: "warning",
			showCancelButton: true,
			// confirmButtonClass: "btn-danger",
			confirmButtonText: "Approve",
            closeOnConfirm: true,
            preConfirm: (login) => {
                return $.ajax({
                    type: "POST",
                    url: link,
                    datatype : "json",
                    data:{id:ticketId, "_token": "{{ csrf_token() }}"},
                    success: function(data) {

                    },
                    error: function(data){
                        swal.fire({title:"Ticket Failed to Approved!", text:"This ticket was not approved successfully", icon:"error"});
                    }
                });
            }
		}).then((result) => {
            if(result.value){
                swal.fire({title:"Ticket Approved!", text:"This ticket has been approved on tickets list", icon:"success"})
                .then(function(){
                    window.location.href = "{{ route('admin.ticketsList.index')}}";
                });
            }
        })
    }

    var tableDataSspReba;
    var api;
    tableDataSspReba = $('#data-ssp-reba').DataTable({
        bFilter: false,
        processing: true,
        serverSide: true,
        ordering: false,
        // scrollY: true,
        // scrollX: true,
        // paging: true,
        // searching: { "regex": true },
        preDrawCallback: function(settings) {
            api = new $.fn.dataTable.Api(settings);
        },
        ajax: {
            type: "POST",
            url: "{{route('admin.sspRebaData.getDataSspReba', $ticketId)}}",
            dataType: "json",
            contentType: 'application/json',
            data: function (data) {
                var form = {};
                $.each($("form").serializeArray(), function (i, field) {
                    form[field.name] = field.value || "";
                });
                // Add options used by Datatables
                var info = { "start": api.page.info().start, "length": api.page.info().length, "draw": api.page.info().draw, "filterActionLevel" : filterActionLevel };
                $.extend(form, info);
                return JSON.stringify(form);
            },
            "complete": function(response) {

            }
        },
        columns: [
            { orderable: false, defaultContent: '\
                <button type="button" class="btn btn-outline-primary" id="edit-data-ssp-reba" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px; margin-right:5px;"><i class="fa fa-edit" style="font-size:20px;"></i></button>\
                <button type="button" class="btn btn-outline-danger" id="delete-data-ssp-reba" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px; margin-right:5px;"><i class="fa fa-trash" style="font-size:20px;"></i></button>',
                render: function (data, type, row) {
                    if(row.ssp_ticket_status === 3) table.column(0).visible(false);
                }
            },
            { orderable: false, data: 'time',
                render: function (data, type, row) {
                    return '<span id="simulation-video" style="cursor: pointer;" onclick="simulationVideoCurrentTime('+row.time+')">'+row.time+'</span>';
                }
            },
            { orderable: false,
                defaultContent:'',
                render: function (data, type, row) {
                    if(row.ssp_reba_table_c === 1 || row.ssp_reba_table_c === 2) return 'Level 1';
                    if(row.ssp_reba_table_c === 3 || row.ssp_reba_table_c === 4) return 'Level 2';
                    if(row.ssp_reba_table_c === 5 || row.ssp_reba_table_c === 6) return 'Level 3';
                    if(row.ssp_reba_table_c === 7) return 'Level 4';
                }
            },
            { data: 'ssp_reba_table_c' }, { data: 'ssp_reba_table_b' }, { data: 'ssp_reba_table_a' },
            { data: 'ssp_reba_upper_arm_left' }, { data: 'ssp_reba_upper_arm_right' }, { data: 'ssp_reba_lower_arm_left' }, { data: 'ssp_reba_lower_arm_right' }, { data: 'ssp_reba_wrist_left' },
            { data: 'ssp_reba_wrist_right' }, { data: 'ssp_reba_wrist_twist_left' }, { data: 'ssp_reba_wrist_twist_right' }, { data: 'ssp_reba_neck' }, { data: 'ssp_reba_trunk_position' },
            { data: 'ssp_reba_legs' },
        ],
        fixedColumns:{left: 1},
        order: [[ 1, "desc" ]],
        initComplete:function( settings, json){
            // $("div.dataTables_length").append('&nbsp<span onclick="approveTicket()" class="btn btn-pill btn-outline-secondary btn-air-secondary btn-sm">Approve Ticket</span>');
            $('#data-ssp-reba_length').appendTo('#length-data-ssp-reba');
            $('#data-ssp-reba_info').appendTo('#pagination-data-ssp-reba');
            $('#data-ssp-reba_paginate').appendTo('#pagination-data-ssp-reba');
            $('#data-ssp-reba tbody').on('click', "#edit-data-ssp-reba", function() {
                let row = $(this).parents('tr')[0];
                console.log(tableDataSspReba.row(row).data().ssp_time_id);

                $('#edit-body-data-ssp-reba').append('<input type="hidden" id="ticket-id" name="ticket_id" value="'+tableDataSspReba.row(row).data().ssp_ticket_id+'">\
                    <input type="hidden" id="time-id" name="time_id" value="'+tableDataSspReba.row(row).data().ssp_time_id+'">');

                Object.keys(tableDataSspReba.row(row).data()).forEach(function(item, index) {
                    console.log(item)
                    if(index >= 7){

                        $('#edit-body-data-ssp-reba').append('\
                            <div class="form-group row" id="job-analyst-div">\
                                <label class="col-xl-3 col-sm-4 col-form-label">'+ucwords(item.replace('ssp_reba_','').replace(/_/g, " "))+'</label>\
                                <div class="col-xl-9 col-sm-8">\
                                    <input type="text" class="form-control" id="'+item.replace(/_/g, "-")+'" name="'+item.replace('ssp_reba_','')+'" placeholder="'+ucwords(item.replace('ssp_reba_','').replace(/_/g, " "))+'..." value="'+tableDataSspReba.row(row).data()[item]+'">\
                                </div>\
                            </div>');
                    }
                })
                $('#modal-edit-data-ssp-reba').modal('show');
            });

            $('#data-ssp-reba tbody').on('click', "#delete-data-ssp-reba", function() {
                let row = $(this).parents('tr')[0];
                deleteDataErgonomic(tableDataSspReba.row(row).data().ssp_time_id);
            });
        }
    });

    function updateErgonomicData(){
        link = "{{route('admin.ticketData.updateSspRebaDataAdmin', ':timeId')}}";
        link = link.replace(":timeId", $("#updateErgonomicData").find("#time-id").val());
        swal.fire({
            title: "Update Ergonomics Data",
            text: "Do you will to update this ergonomics data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Save",
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                var form = $("#editDataFormErgonomic").get(0)
                return $.ajax({
                    type: "POST",
                    url: link,
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: new FormData(form),
                    success: function(data) {
                    var request = 'success';
                    },
                    error: function(xhr, status, error){
                        if(xhr.responseText.search("Call to a member function getRealPath() on null")){
                            $(document).ready(function (){
                                // console.log(xhr.responseJSON.errors)
                                swal.fire({title:"Ergonomics data failed Update!", text: "This ergonomics data failed to updated!", icon:"error"});
                                var errorMsg = $('');

                                $.each(xhr.responseJSON.errors, function (i, field) {
                                    if(i == "job_title"){
                                        $("#edit-job-title").addClass("is-invalid");
                                        $('#edit-job-title-div').append('<div id="error-msg-edit-job-title" class="text-danger">The job title field is required.</div>');
                                    }else if(i == "job_date"){
                                        $("#edit-job-date").addClass("is-invalid");
                                        $('#edit-job-date-div').append('<div id="error-msg-edit-job-date" class="text-danger">The job date field is required.</div>');
                                    }else if(i == "job_description"){
                                        $("#edit-job-description").addClass("is-invalid");
                                        $('#edit-job-description-div').append('<div id="error-msg-edit-job-description" class="text-danger">The job comments field is required.</div>');
                                    }else if(i == "job_location"){
                                        $("#edit-job-location").addClass("is-invalid");
                                        $('#edit-job-location-div').append('<div id="error-msg-edit-job-location" class="text-danger">The job location field is required.</div>');
                                    }else if(i == "job_lat_location"){
                                        $("#edit-job-lat-location").addClass("is-invalid");
                                        $('#edit-job-lat-location-div').append('<div id="error-msg-edit-job-lat-location" class="text-danger">The job latitude location field is required.</div>');
                                    }else if(i == "job_lng_location"){
                                        $("#edit-job-lng-location").addClass("is-invalid");
                                        $('#edit-job-lng-location-div').append('<div id="error-msg-edit-job-lng-location" class="text-danger">The job longitude location field is required.</div>');
                                    }

                                });
                            });
                        }else{
                            console.log(xhr)
                        }
                    }
                });
            }
        }).then((result) => {
        console.log("sadsa ", result.value)
            if(result.value){
            swal.fire({title:"Update Ergonomics Data Success!", text:"Successfully updated this ergonomics data!", icon:"success"})
            .then(function(){
                window.location.reload();
            });
            }
        })
    }

    function deleteDataErgonomic(timeId){
        link = "{{route('admin.ticketData.destroySspRebaDataAdmin', ':id')}}";
        link = link.replace(':id', timeId);

		swal.fire({
			title: "Delete Ergonomics Data?",
			text: "Ergonomics Data will deleted on your ergonomics data table!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Delete",
            closeOnConfirm: true,
            preConfirm: (login) => {
                return $.ajax({
                    type: "DELETE",
                    url: link,
                    datatype : "json",
                    data:{id:timeId, "_token": "{{ csrf_token() }}"},
                    success: function(data) {

                    },
                    error: function(data){
                        swal.fire({title:"Ergonomics Data Failed to Deleted!", text:"This ergonomics data was not deleted successfully", icon:"error"});
                    }
                });
            }
		}).then((result) => {
            if(result.value){
                swal.fire({title:"Ergonomics Data Deleted!", text:"This ergonomics data has been deleted on your ergonomics data table", icon:"success"})
                .then(function(){
                    window.location.reload();
                });
            }
        })
    }

    function simulationVideoCurrentTime(value) {
        console.log(value)
        var video = document.getElementById("my_video_1");
        video.currentTime = value;
    }

    $(".filter-checkbox").change(function() {
        filterActionLevel = this.value;
        console.log(filterActionLevel);
        $('#data-ssp-reba').DataTable().ajax.reload();
    });

    function modalImportCSV($ticketId){
        let browseFile = $('#video-simulation');
        var resumable = new Resumable({
            target: "{{ route('admin.processingData.uploadLargeFiles') }}",
            query:{_token:'{{ csrf_token() }}', ticketId:$ticketId},
            fileType: ['mp4'],
            chunkSize: 10*1024*1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept' : 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        $('#btn-video-simulation').click(function () {
            $('#video-simulation').trigger('click');
        })
        $('#video-simulation').change(function(e){
            console.log(e.target.files[0].name)
        });

        resumable.assignBrowse(browseFile[0]);

        $("#importCSVModal").find("#ticket-id").val($ticketId);
        $("#importCSVModal").modal('show');
    }

    function parseCSVData(){
        swal.fire({
            title: "Import CSV Data",
            text: "Add new CSV data? ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Process CSV Data",
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                var request;
                 resumable.upload();

                resumable.on('fileProgress', function (file) { // trigger when file progress update
                    updateProgress(Math.floor(file.progress() * 100));
                });

                resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
                    response = JSON.parse(response)
                    request = 'success';
                    alert('Success')
                    $('#videoPreview').attr('src', response.path);
                    $('.card-footer').show();
                });

                resumable.on('fileError', function (file, response) { // trigger when there is any error
                    alert('file uploading error.')
                });


                let progress = $('.progress');
                function showProgress() {
                    // swal.showLoading();
                    progress.find('.progress-bar').css('width', '0%');
                    progress.find('.progress-bar').html('0%');
                    progress.find('.progress-bar').removeClass('bg-success');
                    progress.show();
                }

                function updateProgress(value) {
                    progress.find('.progress-bar').css('width', `${value}%`)
                    progress.find('.progress-bar').html(`${value}%`)
                }

                function hideProgress() {
                    progress.hide();
                }

                var form = $("#dataImportCSV").get(0)

                link = "{{route('admin.processingData.updateDataCSV', ':ticketId')}}";
                link = link.replace(":ticketId", $('#ticket-id').val());
                return $.ajax({
                    type: "POST",
                    url: link,
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: new FormData(form),
                    success: function(data) {
                        var request = 'success';
                    },
                    error: function(xhr, status, error){
                        if(xhr.responseText.search("Call to a member function getRealPath() on null")){
                            $(document).ready(function (){
                                console.log(xhr.responseJSON)
                                swal.fire({title:"Add Data CSV Error!", text: "File Not Found!", icon:"error"});
                                var errorMsg = $('');

                                $.each(xhr.responseJSON.errors, function (i, field) {
                                    if(i == "job_analyst"){
                                        $("#job-analyst").addClass("is-invalid");
                                        $('#job-analyst-div').append('<div id="error-msg-job-analyst" class="text-danger">The job analyst field is required.</div>');
                                    }else if(i == "csvFile"){
                                        $("#csv-file").addClass("is-invalid");
                                        $('#csv-file-div').append('<div id="error-msg-csv-file" class="text-danger">Please select the file first.</div>');
                                    }else if(i == "video_simulation"){
                                        $("#video-simulation").addClass("is-invalid");
                                        $('#video-simulation-div').append('<div id="error-msg-video-simulation" class="text-danger">Please select the video file first.</div>');
                                    }
                                });
                            });
                        }else{
                            console.log(xhr)
                        }

                    }
                });
            }
        })
        .then((result) => {
        console.log("sadsa ", result)
            if(result.value){
            swal.fire({title:"New CSV Data Added", text:"Successfuly add new CSV data!", icon:"success"})
            .then(function(){
                window.location.reload(true);
            });
            }
        })
    }
</script>
@endsection


