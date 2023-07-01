@extends('layouts.app')

@section('title', 'Data Ticket Reba')

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
        @include('layouts.sidebar', ['activeMenu' => 'active'])
        <!-- Page Sidebar End-->
        <div class="page-body">
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Data Ergonomic {{$ticket->ssp_ticket_job_title}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('user.ticketsList.index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('user.ticketsList.index')}}">Tickets List</a></li>
                            <li class="breadcrumb-item active">Data Ergonomic {{$ticket->ssp_ticket_job_title}}</li>
                        </ol>
                    </div>
                    <!-- Ajax data source array start-->
                    <div class="col-sm-12">
                        <div class="card" style="margin-bottom: 10px;">
                            <div class="card-header pb-0">
                                <h5>Ticket Summary</h5>
                            </div>
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
                                                <td scope="row" style="width: 13%;padding-left: 0px;padding-right: 0px;">Approval Status</>
                                                <th style="padding-left: 0px;">: @if($ticket->ssp_ticket_status == 2) {{"Validation Process!"}} @elseif($ticket->ssp_ticket_status == 3) {{"Validation Success!"}} @endif</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr/>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>Rula Chart</h5>
                            </div>
                            <div class="card-body">
                                <div id="rula-chart" class="col-md-12" style="width: 430px; min-width: 110%; height:430px;"></div>
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
                                                <td scope="row" style="width: 4%;padding-left: 0px;padding-right: 0px;">Level 1</td>
                                                <th style="padding-left: 0px;">: Negligible Risk</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 4%;padding-left: 0px;padding-right: 0px;">Level 2</td>
                                                <th style="padding-left: 0px;">: Low risk, change may be needed</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 4%;padding-left: 0px;padding-right: 0px;">Level 3</td>
                                                <th style="padding-left: 0px;">: Medium risk, further investigation, change soon</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 4%;padding-left: 0px;padding-right: 0px;">Level 4</td>
                                                <th style="padding-left: 0px;">: High risk, investigate and implement change</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" style="width: 4%;padding-left: 0px;padding-right: 0px;">Level 4</td>
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
                                        <input class="filter-checkbox" id="level-2" type="radio" class="radio" value="Level 2">
                                        <label for="level-2">Level<span class="digits"> 2 </span><span id="level-2-count" class="fw-bold"></span></label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input class="filter-checkbox" id="level-3" type="radio" class="radio" value="Level 3">
                                        <label for="level-3">Level<span class="digits"> 3 </span><span id="level-3-count" class="fw-bold"></span></label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input class="filter-checkbox" id="level-4" type="radio" class="radio" value="Level 4">
                                        <label for="level-4">Level<span class="digits"> 4 </span><span id="level-4-count" class="fw-bold"></span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <!-- <div class="card-header">
                                <h5>Data Ergonomic</h5>
                            </div> -->
                            <div class="card-body">
                                <div id="length-data-ssp-rula" class="dataTables_wrapper"></div>
                                <div class="table-responsive">
                                    <table class="display datatables" id="data-ssp-rula">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Action Level</th>
                                                <th>Rula Score Table C</th>
                                                <th>Rula Score Table B</th>
                                                <th>Rula Score Table A</th>
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
                                <div id="pagination-data-ssp-rula" class="dataTables_wrapper"></div>
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
                                                <th style="min-width: 90px">Action</th>
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
@endsection

@section('plugin_js')
<!-- Plugins JS start-->
<script src="{{url('/assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{url('/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/js/chart/echarts/echarts.min.js')}}"></script>
<script src="{{url('/assets/js/tooltip-init.js')}}"></script>
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
        url: "{{route('user.sspRebaData.getDataSspRebaFrequency', $ticketId)}}",
        data: {
            "_token": "{{ csrf_token() }}",
        },
        dataType: "json",
        success:function(data){
            console.log('test data reba ', data.arrTableC)
            $("#filter-all-count").text('('+data.allDataActionLevel+')');
            $("#level-1-count").text('('+data.arrTableC[0].frequency+')');
            $("#level-2-count").text('('+data.arrTableC[1].frequency+')');
            $("#level-3-count").text('('+data.arrTableC[2].frequency+')');
            $("#level-4-count").text('('+data.arrTableC[3].frequency+')');
            $('#data-action-level').DataTable().clear().rows.add(data.arrTableC).draw();
        }
    })

    $.ajax({
        type: "GET",
        url: "{{route('user.sspRebaData.getDataSspRebaChart', $ticketId)}}",
        dataType: "json",
        contentType: 'application/json',
        success: function(data) {
            var dataLabels = data.map(function(e) {
                return e.time;
            });
            var dataCharts = data.map(function(e) {
                return e.ssp_reba_table_c;
            });

            var rulaChart = echarts.init(document.getElementById('rula-chart'));

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
                    text: 'Rula Chart',
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
                            'Rula Score ' +

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
                    max: 10,
                    name: 'Rula Score',
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

            rulaChart.setOption(option);
            console.log(data)
        }
    });

    $.ajax({
        type: "GET",
        url: "{{route('user.sspRebaData.getDataActionLevelChart', $ticketId)}}",
        dataType: "json",
        contentType: 'application/json',
        success: function(data) {

            var dataLabels = data.map(function(e) {
                return e.time;
            });
            var dataCharts = data.map(function(e) {
                return e.action_level;
            });

            var rulaChart = echarts.init(document.getElementById('action-level-chart'));

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
                    // data: ['Matcha Latte', 'Milk Tea', 'Cheese Cocoa', 'Walnut Brownie'],
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
                    type: 'value',
                    min: 1,
                    max: 4,
                    name: 'Action Level',
                    nameLocation: 'middle',
                    nameGap: 40,
                    splitNumber:4,
                    axisLabel: {
                        interval: 0,
                        formatter: function (value) {
                            console.log(value)
                            if (Math.floor(value) === value) {
                                return value;
                            }
                        }
                    }
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

            rulaChart.setOption(option);
            console.log(data)
        }
    });

    var table;
    var api;
    table = $('#data-ergonomic').DataTable({
    bFilter: false,
    processing: true,
    serverSide: true,
    // scrollY: true,
    // scrollX: true,
    // paging: true,
    // searching: { "regex": true },
    preDrawCallback: function(settings) {
        api = new $.fn.dataTable.Api(settings);
    },
    ajax: {
        type: "POST",
        url: "{{route('user.ticketData.getTicketData', $ticketId)}}",
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
        { data: 'time' },{ data: 'task' },{ data: 'action' },
        { data: 'joint_angles_wrist_flex_ext_left' }, { data: 'joint_angles_wrist_flex_ext_right' }, { data: 'joint_angles_wrist_rad_ulnar_dev_left' },
        { data: 'joint_angles_wrist_rad_ulnar_dev_right' }, { data: 'joint_angles_forearm_sup_pro_left' }, { data: 'joint_angles_forearm_sup_pro_right' }, { data: 'joint_angles_elbow_right' }, { data: 'joint_angles_elbow_left' },
        { data: 'joint_angles_shoulder_abd_right' }, { data: 'joint_angles_shoulder_abd_left' }, { data: 'joint_angles_shoulder_for_back_right' }, { data: 'joint_angles_shoulder_for_back_left' }, { data: 'joint_angles_humeral_rot_right' },
        { data: 'joint_angles_humeral_rot_left' }, { data: 'joint_angles_trunk_flex_ext' }, { data: 'joint_angles_trunk_lateral' }, { data: 'joint_angles_trunk_rotation' }, { data: 'joint_angles_hip_flex_ext_right' }, { data: 'joint_angles_hip_flex_ext_left' },
        { data: 'joint_angles_knee_flex_ext_right' }, { data: 'joint_angles_knee_flex_ext_left' }, { data: 'joint_angles_ankle_flex_ext_right' }, { data: 'joint_angles_ankle_flex_ext_left' },

        { data: 'joint_torques_wrist_flex_ext_left' }, { data: 'joint_torques_wrist_flex_ext_right' }, { data: 'joint_torques_wrist_rad_ulnar_dev_left' },
        { data: 'joint_torques_wrist_rad_ulnar_dev_right' }, { data: 'joint_torques_forearm_sup_pro_left' }, { data: 'joint_torques_forearm_sup_pro_right' }, { data: 'joint_torques_elbow_right' }, { data: 'joint_torques_elbow_left' },
        { data: 'joint_torques_shoulder_abd_right' }, { data: 'joint_torques_shoulder_abd_left' }, { data: 'joint_torques_shoulder_for_back_right' }, { data: 'joint_torques_shoulder_for_back_left' }, { data: 'joint_torques_humeral_rot_right' },
        { data: 'joint_torques_humeral_rot_left' }, { data: 'joint_torques_trunk_flex_ext' }, { data: 'joint_torques_trunk_lateral' }, { data: 'joint_torques_trunk_rotation' }, { data: 'joint_torques_hip_flex_ext_right' }, { data: 'joint_torques_hip_flex_ext_left' },
        { data: 'joint_torques_knee_flex_ext_right' }, { data: 'joint_torques_knee_flex_ext_left' }, { data: 'joint_torques_ankle_flex_ext_right' }, { data: 'joint_torques_ankle_flex_ext_left' },

        { data: 'mean_strengths_wrist_flex_ext_left' }, { data: 'mean_strengths_wrist_flex_ext_right' }, { data: 'mean_strengths_wrist_rad_ulnar_dev_left' },
        { data: 'mean_strengths_wrist_rad_ulnar_dev_right' }, { data: 'mean_strengths_forearm_sup_pro_left' }, { data: 'mean_strengths_forearm_sup_pro_right' }, { data: 'mean_strengths_elbow_right' }, { data: 'mean_strengths_elbow_left' },
        { data: 'mean_strengths_shoulder_abd_right' }, { data: 'mean_strengths_shoulder_abd_left' }, { data: 'mean_strengths_shoulder_for_back_right' }, { data: 'mean_strengths_shoulder_for_back_left' }, { data: 'mean_strengths_humeral_rot_right' },
        { data: 'mean_strengths_humeral_rot_left' }, { data: 'mean_strengths_trunk_flex_ext' }, { data: 'mean_strengths_trunk_lateral' }, { data: 'mean_strengths_trunk_rotation' }, { data: 'mean_strengths_hip_flex_ext_right' }, { data: 'mean_strengths_hip_flex_ext_left' },
        { data: 'mean_strengths_knee_flex_ext_right' }, { data: 'mean_strengths_knee_flex_ext_left' }, { data: 'mean_strengths_ankle_flex_ext_right' }, { data: 'mean_strengths_ankle_flex_ext_left' },

        { data: 'percent_capables_wrist_flex_ext_left' }, { data: 'percent_capables_wrist_flex_ext_right' }, { data: 'percent_capables_wrist_rad_ulnar_dev_left' },
        { data: 'percent_capables_wrist_rad_ulnar_dev_right' }, { data: 'percent_capables_forearm_sup_pro_left' }, { data: 'percent_capables_forearm_sup_pro_right' }, { data: 'percent_capables_elbow_right' }, { data: 'percent_capables_elbow_left' },
        { data: 'percent_capables_shoulder_abd_right' }, { data: 'percent_capables_shoulder_abd_left' }, { data: 'percent_capables_shoulder_for_back_right' }, { data: 'percent_capables_shoulder_for_back_left' }, { data: 'percent_capables_humeral_rot_right' },
        { data: 'percent_capables_humeral_rot_left' }, { data: 'percent_capables_trunk_flex_ext' }, { data: 'percent_capables_trunk_lateral' }, { data: 'percent_capables_trunk_rotation' }, { data: 'percent_capables_hip_flex_ext_right' }, { data: 'percent_capables_hip_flex_ext_left' },
        { data: 'percent_capables_knee_flex_ext_right' }, { data: 'percent_capables_knee_flex_ext_left' }, { data: 'percent_capables_ankle_flex_ext_right' }, { data: 'percent_capables_ankle_flex_ext_left' },

        { data: 'strength_std_devs_wrist_flex_ext_left' }, { data: 'strength_std_devs_wrist_flex_ext_right' }, { data: 'strength_std_devs_wrist_rad_ulnar_dev_left' },
        { data: 'strength_std_devs_wrist_rad_ulnar_dev_right' }, { data: 'strength_std_devs_forearm_sup_pro_left' }, { data: 'strength_std_devs_forearm_sup_pro_right' }, { data: 'strength_std_devs_elbow_right' }, { data: 'strength_std_devs_elbow_left' },
        { data: 'strength_std_devs_shoulder_abd_right' }, { data: 'strength_std_devs_shoulder_abd_left' }, { data: 'strength_std_devs_shoulder_for_back_right' }, { data: 'strength_std_devs_shoulder_for_back_left' }, { data: 'strength_std_devs_humeral_rot_right' },
        { data: 'strength_std_devs_humeral_rot_left' }, { data: 'strength_std_devs_trunk_flex_ext' }, { data: 'strength_std_devs_trunk_lateral' }, { data: 'strength_std_devs_trunk_rotation' }, { data: 'strength_std_devs_hip_flex_ext_right' }, { data: 'strength_std_devs_hip_flex_ext_left' },
        { data: 'strength_std_devs_knee_flex_ext_right' }, { data: 'strength_std_devs_knee_flex_ext_left' }, { data: 'strength_std_devs_ankle_flex_ext_right' }, { data: 'strength_std_devs_ankle_flex_ext_left' },
        ],
        initComplete:function( settings, json){
            $('#data-ergonomic_length').appendTo('#length-data-ergonomic');
            $('#data-ergonomic_info').appendTo('#pagination-data-ergonomic');
            $('#data-ergonomic_paginate').appendTo('#pagination-data-ergonomic');
        }
    });

    var tableDataSspRula;
    var api;
    tableDataSspRula = $('#data-ssp-rula').DataTable({
    bFilter: false,
    processing: true,
    serverSide: true,
    // scrollY: true,
    // scrollX: true,
    // paging: true,
    // searching: { "regex": true },
    preDrawCallback: function(settings) {
        api = new $.fn.dataTable.Api(settings);
    },
    ajax: {
        type: "POST",
        url: "{{route('user.sspRebaData.getDataSspReba', $ticketId)}}",
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
        { data: 'time',
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
        initComplete:function( settings, json){
            // $("div.dataTables_length").append('&nbsp<span onclick="approveTicket()" class="btn btn-pill btn-outline-secondary btn-air-secondary btn-sm">Approve Ticket</span>');
            $('#data-ssp-rula_length').appendTo('#length-data-ssp-rula');
            $('#data-ssp-rula_info').appendTo('#pagination-data-ssp-rula');
            $('#data-ssp-rula_paginate').appendTo('#pagination-data-ssp-rula');
        }
    });

    function simulationVideoCurrentTime(value) {
        console.log(value)
        var video = document.getElementById("my_video_1");
        video.currentTime = value;
    }

    $(".filter-checkbox").change(function() {
        filterActionLevel = this.value;
        console.log(filterActionLevel);
        $('#data-ssp-rula').DataTable().ajax.reload();
    });

    // });
</script>
@endsection
