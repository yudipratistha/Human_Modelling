@extends('layouts.app')

@section('title', 'Data Ticket')

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
                                                <th scope="row" style="width: 10%;padding-left: 0px;padding-right: 0px;">Job Title</th>
                                                <td style="padding-left: 0px;">: {{$ticket->ssp_ticket_job_title}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 10%;padding-left: 0px;padding-right: 0px;">Job Analyst</th>
                                                <td style="padding-left: 0px;">: {{$ticket->ssp_ticket_job_analyst}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 10%;padding-left: 0px;padding-right: 0px;">Job Date</th>
                                                <td style="padding-left: 0px;">: {{date('d-m-Y', strtotime($ticket->ssp_ticket_job_date))}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 10%;padding-left: 0px;padding-right: 0px;">Job Description</th>
                                                <td style="padding-left: 0px;">: {{$ticket->ssp_ticket_job_description}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 10%;padding-left: 0px;padding-right: 0px;">Job Location</th>
                                                <td style="padding-left: 0px;">: {{$ticket->ssp_ticket_job_location}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 10%;padding-left: 0px;padding-right: 0px;">Approval Status</th>
                                                <td style="padding-left: 0px;">: @if($ticket->ssp_ticket_status == 2) {{"Validation Process!"}} @elseif($ticket->ssp_ticket_status == 3) {{"Validation Success!"}} @endif</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr/>
                                    @if($ticket->ssp_ticket_status != 3)
                                        <button class="btn btn-pill btn-outline-secondary btn-air-secondary btn-sm" type="button" onclick="approveTicket({{$ticket->id}}, '{{$ticket->ssp_ticket_job_title}}')" title="Approve Ticket" style="border-radius: 0px !important;">Approve Ticket</button>
                                        <button class="btn btn-pill btn-outline-primary btn-air-secondary btn-sm" type="button" onclick="recalculateRulaData({{$ticket->id}}, '{{$ticket->ssp_ticket_job_title}}')" title="Recalculate Rula Data" style="border-radius: 0px !important;">Recalculate Rula Data</button>

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>Line Chart</h5>
                            </div>
                            <div class="card-body">
                                <div id="area-spaline"></div>
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

<!-- Modal Edit Data Ergonomic-->
<div class="modal fade" id="editDataErgonomic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col-md-12" id="edit-body-data-ergonomic">

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
<script src="{{url('/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{url('/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<!-- <script src="{{url('/assets/js/chart/apex-chart/chart-custom.js')}}"></script> -->
<script src="{{url('/assets/js/tooltip-init.js')}}"></script>
<!-- Plugins JS Ends-->

<script>
    function ucwords(str) {
        str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        return str;
    }

    $.ajax({
        type: "GET",
        url: "{{route('admin.sspRulaData.getDataSspRulaChart', $ticketId)}}",
        dataType: "json",
        contentType: 'application/json',
        success: function(data) {
            // var morris_chart = {
            //     init: function() {
            //         Morris.Line({
            //             element: "morris-line-chart",
            //             data: data,
            //             xkey: ["ssp_time"],
            //             ykeys: ["ssp_rula_table_c"],
            //             lineColors: [vihoAdminConfig.primary],
            //             labels: ["test"],
            //             parseTime: !1,
            //             ymax: 8,
            //             ymin: 1,
            //         });
            //     }
            // }
            // morris_chart.init()

            // area spaline chart
            var options1 = {
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar:{
                    show: true
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                series: [{
                    name: 'series1',
                    data: data
                }],

                xaxis: {
                    labels: {
                formatter: function(val) {
                return Math.floor(val)
                }    
                            }            },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
                colors:[vihoAdminConfig.primary, vihoAdminConfig.secondary]
            }

            var chart1 = new ApexCharts(
                document.querySelector("#area-spaline"),
                options1
            );

            chart1.render();
            console.log(data)
        }
    });

//     "use strict";
// var morris_chart = {
//     init: function() {
//          Morris.Line({
//             element: "morris-line-chart",
//             data: [{
//                 ssp_rula_table_c: "0.1",
//                 ssp_time: 100
//                 },
//                 {
//                     ssp_rula_table_c: "2012",
//                     ssp_time: 75
//                 },
//                 {
//                     ssp_rula_table_c: "2013",
//                     ssp_time: 50
//                 },
//                 {
//                     ssp_rula_table_c: "2014",
//                     ssp_time: 75
//                 },
//                 {
//                     ssp_rula_table_c: "2015",
//                     ssp_time: 50
//                 },
//                 {
//                     ssp_rula_table_c: "2016",
//                     ssp_time: 75
//                 },
//                 {
//                     ssp_rula_table_c: "2017",
//                     ssp_time: 100
//                 }],
//             xkey: "ssp_rula_table_c",
//             ykeys: ["ssp_time"],
//             lineColors: [vihoAdminConfig.primary, vihoAdminConfig.secondary],
//             labels: ["Series A"],
//             parseTime: !1,
//         })
        
//     }
// };
// (function($) {
//     "use strict";
//     morris_chart.init()
// })(jQuery);


    $('#editDataErgonomic').on('hidden.bs.modal', function () {
        $('#edit-body-data-ergonomic').children().remove();
    })

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
        { orderable: false, defaultContent: '\
            <button type="button" class="btn btn-outline-primary" id="edit-data-ergonomic" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px; margin-right:5px;"><i class="fa fa-edit" style="font-size:20px;"></i></button>\
            <button type="button" class="btn btn-outline-danger" id="delete-data-ergonomic" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px; margin-right:5px;"><i class="fa fa-trash" style="font-size:20px;"></i></button>',
            render: function (data, type, row) { if(row.ssp_ticket_status === 3) table.column(0).visible(false); }
        },
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
        order: [[ 1, "asc" ]],
        fixedColumns:{left: 1},
        initComplete:function( settings, json){
            // $("div.dataTables_length").append('&nbsp<span onclick="approveTicket()" class="btn btn-pill btn-outline-secondary btn-air-secondary btn-sm">Approve Ticket</span>');
            $('#data-ergonomic_length').appendTo('#length-data-ergonomic');
            $('#data-ergonomic_info').appendTo('#pagination-data-ergonomic');
            $('#data-ergonomic_paginate').appendTo('#pagination-data-ergonomic');
            $('#data-ergonomic tbody').on('click', "#edit-data-ergonomic", function() {
                let row = $(this).parents('tr')[0];
                console.log(table.row(row).data().ssp_time_id);
                
                $('#edit-body-data-ergonomic').append('<input type="hidden" id="ticket-id" name="ticket_id" value="'+table.row(row).data().ssp_ticket_id+'">\
                    <input type="hidden" id="time-id" name="time_id" value="'+table.row(row).data().ssp_time_id+'">');

                Object.keys(table.row(row).data()).forEach(function(item, index) {
                    if(index >= 6){
                        $('#edit-body-data-ergonomic').append('\
                            <div class="form-group row" id="job-analyst-div">\
                                <label class="col-xl-3 col-sm-4 col-form-label">'+ucwords(item.replace(/_/g, " "))+'</label>\
                                <div class="col-xl-9 col-sm-8">\
                                    <input type="text" class="form-control" id="'+item.replace(/_/g, "-")+'" name="'+item+'" placeholder="'+ucwords(item.replace(/_/g, " "))+'..." value="'+table.row(row).data()[item]+'">\
                                </div>\
                            </div>');
                    }
                })
                $('#editDataErgonomic').modal('show');
            });

            $('#data-ergonomic tbody').on('click', "#delete-data-ergonomic", function() {
                let row = $(this).parents('tr')[0];
                deleteDataErgonomic(table.row(row).data().ssp_time_id);
            });
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

    function recalculateRulaData(ticketId, ticketTitle){
        link = "{{route('admin.processingData.recalculateRulaData', ':id')}}";
        link = link.replace(':id', ticketId);
        
		swal.fire({
			title: "Recalculate Rula Data Ticket "+ticketTitle+"?",
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

    function updateErgonomicData(){
        link = "{{route('admin.ticketData.updateErgonomicData', ':timeId')}}";
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
        link = "{{route('admin.ticketData.destroyErgonomicData', ':id')}}";
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

    var table;
    var api;
    table = $('#data-ssp-rula').DataTable({
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
        url: "{{route('admin.sspRulaData.getDataSspRula', $ticketId)}}",
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
        { data: 'time' },
        { orderable: false,
            defaultContent:'',
            render: function (data, type, row) {
                 if(row.ssp_rula_table_c === 1 || row.ssp_rula_table_c === 2) return 'Level 1'; 
                 if(row.ssp_rula_table_c === 3 || row.ssp_rula_table_c === 4) return 'Level 2';
                 if(row.ssp_rula_table_c === 5 || row.ssp_rula_table_c === 6) return 'Level 3';
                 if(row.ssp_rula_table_c === 7) return 'Level 4';
            }
        },
        { data: 'ssp_rula_table_c' }, { data: 'ssp_rula_table_b' }, { data: 'ssp_rula_table_a' }, 
        { data: 'ssp_rula_upper_arm_left' }, { data: 'ssp_rula_upper_arm_right' }, { data: 'ssp_rula_lower_arm_left' }, { data: 'ssp_rula_lower_arm_right' }, { data: 'ssp_rula_wrist_left' },
        { data: 'ssp_rula_wrist_right' }, { data: 'ssp_rula_wrist_twist_left' }, { data: 'ssp_rula_wrist_twist_right' }, { data: 'ssp_rula_neck' }, { data: 'ssp_rula_trunk_position' },
        { data: 'ssp_rula_legs' },
        ],
        initComplete:function( settings, json){
            // $("div.dataTables_length").append('&nbsp<span onclick="approveTicket()" class="btn btn-pill btn-outline-secondary btn-air-secondary btn-sm">Approve Ticket</span>');
            $('#data-ssp-rula_length').appendTo('#length-data-ssp-rula');
            $('#data-ssp-rula_info').appendTo('#pagination-data-ssp-rula');
            $('#data-ssp-rula_paginate').appendTo('#pagination-data-ssp-rula');
        }
    });
        
    // });
</script>
@endsection