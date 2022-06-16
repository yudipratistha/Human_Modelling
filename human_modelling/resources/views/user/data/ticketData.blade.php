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
                            <li class="breadcrumb-item"><a href="{{route('user.ticketsList.index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('user.ticketsList.index')}}">Tickets List</a></li>
                            <li class="breadcrumb-item active">Data Ergonomic {{$ticket->ssp_ticket_job_title}}</li>
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
                                </div>
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
<!-- Plugins JS Ends-->

<script>
    function ucwords(str) {
        str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        return str;
    }

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
        
    // });
</script>
@endsection