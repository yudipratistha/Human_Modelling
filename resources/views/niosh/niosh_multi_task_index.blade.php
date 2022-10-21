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
                                    <h3>NIOSH Calculation</h3>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                                        <li class="breadcrumb-item active">NIOSH Calculation</li>
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
                                                <table id="table-job-variable" class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="3">No Pekerjaan</th>
                                                            <th colspan="2">Berat Beban</th>
                                                            <th colspan="4">Lokasi Tangan</th>
                                                            <th rowspan="1">Jarak Vertikal</th>
                                                            <th colspan="2">Sudut Asimetri</th>
                                                            <th colspan="1">Rata-Rata Frekuensi</th>
                                                            <th colspan="1">Durasi</th>
                                                            <th rowspan="1">Kopling Objek</th>
                                                            <th rowspan="3">Action</th>
                                                        </tr>
                                                        <tr>
                                                            <th rowspan="2">L (Rata-rata)</th>
                                                            <th rowspan="2">L (Max)</th>
                                                            <th colspan="2">Origin</th>
                                                            <th colspan="2">Destination</th>
                                                            <th rowspan="1"></th>
                                                            <th colspan="1">Origin</th>
                                                            <th colspan="1">Destination</th>
                                                            <th colspan="1">Lift/Min</th>
                                                            <th rowspan="1">Jam</th>
                                                            <th rowspan="1"></th>
                                                        </tr>
                                                        <tr>
                                                            <th>H</th>
                                                            <th>V</th>
                                                            <th>H</th>
                                                            <th>V</th>
                                                            <th>D</th>
                                                            <th>A</th>
                                                            <th>A</th>
                                                            <th>F</th>
                                                            <th></th>
                                                            <th>C</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr id="tr-job-variable-1" class="tr-job-variable">
                                                            <td id="no-pekerjaan-1">
                                                                1
                                                            </td>
                                                            <td>
                                                                <div id="beban-kerja-L-avg-div-1">
                                                                    <input class="form-control" id="beban-kerja-L-avg-1" name="beban_kerja_L_avg_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="beban-kerja-L-max-div-1">
                                                                    <input class="form-control" id="beban-kerja-L-max-1" name="beban_kerja_L_max_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="lokasi-tangan-origin-h-div-1">
                                                                    <input class="form-control" id="lokasi-tangan-origin-h-1" name="lokasi_tangan_origin_h_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="lokasi-tangan-origin-v-div-1">
                                                                    <input class="form-control" id="lokasi-tangan-origin-v-1" name="lokasi_tangan_origin_v_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="lokasi-tangan-dest-h-div-1">
                                                                    <input class="form-control" id="lokasi-tangan-dest-h-1" name="lokasi_tangan_dest_h_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="lokasi-tangan-dest-v-div-1">
                                                                    <input class="form-control" id="lokasi-tangan-dest-v-1" name="lokasi_tangan_dest_v_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="jarak-vertical-d-div-1">
                                                                    <input class="form-control" id="jarak-vertical-d-1" name="jarak_vertical_d_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="sudut-asimetri-origin-a-div-1">
                                                                    <input class="form-control" id="sudut-asimetri-origin-a-1" name="sudut_asimetri_origin_a_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="sudut-asimetri-dest-a-div-1">
                                                                    <input class="form-control" id="sudut-asimetri-dest-a-1" name="sudut_asimetri_dest_a_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="avg-freq-div-1">
                                                                    <input class="form-control" id="avg-freq-1" name="avg_freq_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="duration-div">
                                                                    <input class="form-control" id="duration-1" name="duration_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="object-clutch-c-div-1">
                                                                    <input class="form-control" id="object-clutch-c-1" name="object_clutch_c_1" type="text" value="" placeholder="..." required="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <!-- <button type="button" class="btn btn-outline-danger" id="delete-data-ssp-rula" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px; margin-right:5px;"><i class="fa fa-trash" style="font-size:20px;"></i></button> -->
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                            <button class="btn btn-primary" type="button" onclick="jobVariable()">Calculate Job Variable</button>
                                            <button class="btn btn-primary" type="button" onclick="addJobVariable()">Add Job Variable</button>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Calculate Multiplier</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <form id="form-multiplier" method="POST">
                                                <table id="table-calculate-multiplier" class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 132px;">No Pekerjaan</th>
                                                            <th>LC</th>
                                                            <th>HM</th>
                                                            <th>VM</th>
                                                            <th>DM</th>
                                                            <th>AM</th>
                                                            <th>CM</th>
                                                            <th>FIRWL</th>
                                                            <th>FM</th>
                                                            <th>STRWL</th>
                                                            <th>FILI</th>
                                                            <th>STLI</th>
                                                            <th>No Pekerjaan Baru</th>
                                                            <th>F</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody-multiplier">
                                                        <tr id="tr-multiplier">
                                                            <td>
                                                                <span id="no-pekerjaan">-</span>
                                                            </td>
                                                            <td>
                                                                <span id="lc-value">-</span>
                                                                <input id="lc" name="lc" type="hidden" value="23">
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
                                                            </td>
                                                            <td>
                                                                <span id="cm-value">-</span>
                                                                <input id="cm" name="cm" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                                <span id="firwl-value">-</span>
                                                                <input id="firwl" name="firwl" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                                <span id="fm-value">-</span>
                                                                <input id="fm" name="fm" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                                <span id="strwl-value">-</span>
                                                                <input id="strwl" name="strwl" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                                <span id="fili-value">-</span>
                                                                <input id="fili" name="fili" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                                <span id="stli-value">-</span>
                                                                <input id="stli" name="stli" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                                <span id="no-pekerjaan-baru-value">-</span>
                                                                <input id="no-pekerjaan-baru" name="no_pekerjaan_baru" type="hidden" value="">
                                                            </td>
                                                            <td>
                                                                <span id="f">-</span>
                                                                <input id="f" name="f" type="hidden" value="">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                            <button class="btn btn-primary" type="button" onclick="addComposeLiftingIndex()">Add Compose Lifting Index</button>
                                        </div>
                                    </div>
                                    <!-- <div class="card">
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
                                    </div> -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Compose Lifting Index</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-sm">
                                                    <tbody id="tbody-compose-lifting-index">
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
    var lokasi_tangan_v= 0;
    var jobVarArr = new Array();
    var multiplierArr = new Array();
    var stliArr = new Array();
    var stliArrSort = new Array();
    var filiArr = new Array();
    var filiArrSort = new Array();
    
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

    function frequencyMultiplierFunc(fm, duration, lokasi_tangan_v){
        $.each(frequencyMultiplierArr, function(index, frequencyMultiplierValue){
            $.each(frequencyMultiplierValue, function(frequencyIndex, frequencyValue){
                if(frequencyValue === fm){
                    frequencyIndexFound = frequencyIndex;
                    
                }else if(frequencyValue === 'moreThan15' && fm > 15){
                    frequencyIndexFound = frequencyIndex;
                }

                if(frequencyValue !== 'moreThan15' &&  Object.keys(frequencyValue).length !== 0){
                    $.each(frequencyValue, function(index, value){
                        
                        if(frequencyIndex === 'cond1' && duration <= 1){
                            if(index === 'lessThan75' && lokasi_tangan_v < 75){
                                frequencyMultiplier = value[frequencyIndexFound];
                            }else if(index === 'moreThan75' && lokasi_tangan_v >= 75){
                                frequencyMultiplier = value[frequencyIndexFound];
                            }
                        }else if(frequencyIndex === 'cond2' && duration > 1 && duration <= 2){
                            if(index === 'lessThan75' && lokasi_tangan_v < 75){
                                frequencyMultiplier = value[frequencyIndexFound];
                            }else if(index === 'moreThan75' && lokasi_tangan_v >= 75){
                                frequencyMultiplier = value[frequencyIndexFound];
                            }
                        }else if(frequencyIndex === 'cond3' && duration > 2 && duration <= 8){
                            if(index === 'lessThan75' && lokasi_tangan_v < 75){
                                frequencyMultiplier = value[frequencyIndexFound];
                            }else if(index === 'moreThan75' && lokasi_tangan_v >= 75){
                                frequencyMultiplier = value[frequencyIndexFound];
                            }
                        }
                    });
                }
            });
        });

        return frequencyMultiplier;
    }

    $(document).ready(function () {
        var tableJobVariable = $('#table-job-variable').DataTable({
            searching: false,
            ordering:  false,
            paging: false,
            bInfo: false
        });

        var tableRwl = $('#table-calculate-multiplier').DataTable({
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

        $('#form-job-variable-score').on("click", ".delete-tr-job-variable", function(e){
            e.stopPropagation();
            
            var prevElementLength = $(this).parent().parent().prevUntil().length;
            var nextElementLength = $(this).parent().parent().nextUntil().length;
            var nextElement = $(this).parent().parent().nextUntil();
            console.log(nextElement)
            for(let totalPekerjaan= 0; totalPekerjaan< nextElementLength; totalPekerjaan++){
                var totalPekerjaanNext = totalPekerjaan + prevElementLength +1;

                $(nextElement[totalPekerjaan]).find('.no-pekerjaan').text(totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.beban-kerja-L-avg-div').attr('id', 'beban-kerja-L-avg-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.beban-kerja-L-avg').attr('name', 'beban_kerja_L_avg_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.beban-kerja-L-avg').attr('id', 'beban-kerja-L-avg-'+totalPekerjaanNext);
                
                $(nextElement[totalPekerjaan]).find('.beban-kerja-L-max-div').attr('id', 'beban-kerja-L-max-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.beban-kerja-L-max').attr('name', 'beban_kerja_L_max_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.beban-kerja-L-max').attr('id', 'beban-kerja-L-max-'+totalPekerjaanNext);

                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-origin-h-div').attr('id', 'lokasi-tangan-origin-h-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-origin-h').attr('name', 'lokasi_tangan_origin_h_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-origin-h').attr('id', 'lokasi-tangan-origin-h-'+totalPekerjaanNext);

                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-origin-v-div').attr('id', 'lokasi-tangan-origin-v-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-origin-v').attr('name', 'lokasi_tangan_origin_v_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-origin-v').attr('id', 'lokasi-tangan-origin-v-'+totalPekerjaanNext);

                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-dest-h-div').attr('id', 'lokasi-tangan-dest-h-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-dest-h').attr('name', 'lokasi_tangan_dest_h_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-dest-h').attr('id', 'lokasi-tangan-dest-h-'+totalPekerjaanNext);

                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-dest-v-div').attr('id', 'lokasi-tangan-dest-v-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-dest-v').attr('name', 'lokasi_tangan_dest_v_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.lokasi-tangan-dest-v').attr('id', 'lokasi-tangan-dest-v-'+totalPekerjaanNext);

                $(nextElement[totalPekerjaan]).find('.jarak-vertical-d-div').attr('id', 'jarak-vertical-d-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.jarak-vertical-d').attr('name', 'jarak_vertical_d_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.jarak-vertical-d').attr('id', 'jarak-vertical-d-'+totalPekerjaanNext);

                $(nextElement[totalPekerjaan]).find('.sudut-asimetri-origin-a-div').attr('id', 'sudut-asimetri-origin-a-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.sudut-asimetri-origin-a').attr('name', 'sudut_asimetri_origin_a_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.sudut-asimetri-origin-a').attr('id', 'sudut-asimetri-origin-a-'+totalPekerjaanNext);

                $(nextElement[totalPekerjaan]).find('.sudut-asimetri-dest-a-div').attr('id', 'sudut-asimetri-dest-a-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.sudut-asimetri-dest-a').attr('name', 'sudut_asimetri_dest_a_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.sudut-asimetri-dest-a').attr('id', 'sudut-asimetri-dest-a-'+totalPekerjaanNext);

                $(nextElement[totalPekerjaan]).find('.avg-freq-div').attr('id', 'avg-freq-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.avg-freq').attr('name', 'avg_freq_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.avg-freq').attr('id', 'avg-freq-'+totalPekerjaanNext);

                $(nextElement[totalPekerjaan]).find('.duration-div').attr('id', 'duration-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.duration').attr('name', 'duration_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.duration').attr('id', 'duration-'+totalPekerjaanNext);

                $(nextElement[totalPekerjaan]).find('.object-clutch-c-div').attr('id', 'object-clutch-c-div-'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.object-clutch-c').attr('name', 'object_clutch_c_'+totalPekerjaanNext);
                $(nextElement[totalPekerjaan]).find('.object-clutch-c').attr('id', 'object-clutch-c-'+totalPekerjaanNext);
            }

            $(this).parent().parent().remove();
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

    function addJobVariable(){
        var trJobVariableCount = $('.tr-job-variable').length + 1;
        console.log(trJobVariableCount)
        $('.tr-job-variable').last().parent().append('<tr id="tr-job-variable-'+ trJobVariableCount +'" class="tr-job-variable">\
            <td class="no-pekerjaan">\
                '+ trJobVariableCount +'\
            </td>\
            <td>\
                <div id="beban-kerja-L-avg-div-'+ trJobVariableCount +'" class="beban-kerja-L-avg-div">\
                    <input class="form-control beban-kerja-L-avg" id="beban-kerja-L-avg-'+ trJobVariableCount +'" name="beban_kerja_L_avg_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="beban-kerja-L-max-div-'+ trJobVariableCount +'" class="beban-kerja-L-max-div">\
                    <input class="form-control beban-kerja-L-max" id="beban-kerja-L-max-'+ trJobVariableCount +'" name="beban_kerja_L_max_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="lokasi-tangan-origin-h-div-'+ trJobVariableCount +'" class="lokasi-tangan-origin-h-div">\
                    <input class="form-control lokasi-tangan-origin-h" id="lokasi-tangan-origin-h-'+ trJobVariableCount +'" name="lokasi_tangan_origin_h_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="lokasi-tangan-origin-v-div-'+ trJobVariableCount +'" class="lokasi-tangan-origin-v-div">\
                    <input class="form-control lokasi-tangan-origin-v" id="lokasi-tangan-origin-v-'+ trJobVariableCount +'" name="lokasi_tangan_origin_v_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="lokasi-tangan-dest-h-div-'+ trJobVariableCount +'" class="lokasi-tangan-dest-h-div">\
                    <input class="form-control lokasi-tangan-dest-h" id="lokasi-tangan-dest-h-'+ trJobVariableCount +'" name="lokasi_tangan_dest_h_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="lokasi-tangan-dest-v-div-'+ trJobVariableCount +'" class="lokasi-tangan-dest-v-div">\
                    <input class="form-control lokasi-tangan-dest-v" id="lokasi-tangan-dest-v-'+ trJobVariableCount +'" name="lokasi_tangan_dest_v_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="jarak-vertical-d-div-'+ trJobVariableCount +'" class="jarak-vertical-d-div">\
                    <input class="form-control jarak-vertical-d" id="jarak-vertical-d-'+ trJobVariableCount +'" name="jarak_vertical_d_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="sudut-asimetri-origin-a-div-'+ trJobVariableCount +'" class="sudut-asimetri-origin-a-div">\
                    <input class="form-control sudut-asimetri-origin-a" id="sudut-asimetri-origin-a-'+ trJobVariableCount +'" name="sudut_asimetri_origin_a_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="sudut-asimetri-dest-a-div-'+ trJobVariableCount +'" class="sudut-asimetri-dest-a-div">\
                    <input class="form-control sudut-asimetri-dest-a" id="sudut-asimetri-dest-a-'+ trJobVariableCount +'" name="sudut_asimetri_dest_a_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="avg-freq-div-'+ trJobVariableCount +'" class="avg-freq-div">\
                    <input class="form-control avg-freq" id="avg-freq-'+ trJobVariableCount +'" name="avg_freq_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="duration-div-'+ trJobVariableCount +'" class="duration-div">\
                    <input class="form-control duration" id="duration-'+ trJobVariableCount +'" name="duration_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <div id="object-clutch-c-div-'+ trJobVariableCount +'" class="object-clutch-c-div">\
                    <input class="form-control object-clutch-c" id="object-clutch-c-'+ trJobVariableCount +'" name="object_clutch_c_'+ trJobVariableCount +'" type="text" value="" placeholder="..." required="">\
                </div>\
            </td>\
            <td>\
                <button type="button" class="btn btn-outline-danger delete-tr-job-variable" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px; margin-right:5px;"><i class="fa fa-trash" style="font-size:20px;"></i></button>\
            </td>\
        </tr>');
    }

    function jobVariable(){
        var frequencyIndexFound;
        var frequencyMultiplier = 0;
        var cmIndex;
        var couplingMultiplier;
        var objectClutchFlag;
        var formJobVariableScoreSerialize = $("#form-job-variable-score").serialize();
        var jobVariableObj = JSON.parse('{"' + decodeURI(formJobVariableScoreSerialize.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');
        lokasi_tangan_v= 0;
        jobVarArr = new Array();
        multiplierArr = new Array();
        stliArr = new Array();
        stliArrSort = new Array();
        filiArr = new Array();
        filiArrSort = new Array();

        /*if(jobVariableObj.hand_location_h.length === 0){
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
        }*/

        

        for(let totalPekerjaan= 1; totalPekerjaan <= $('.tr-job-variable').length; totalPekerjaan++){
            loadConstant = {'lc': 23 }

            if(jobVariableObj["lokasi_tangan_origin_h_"+totalPekerjaan] <= jobVariableObj["lokasi_tangan_dest_h_"+totalPekerjaan]){
                horizontalMultiplier = {'hm': 25/jobVariableObj["lokasi_tangan_dest_h_"+totalPekerjaan] };
            }else if(jobVariableObj["lokasi_tangan_origin_h_"+totalPekerjaan] >= jobVariableObj["lokasi_tangan_dest_h_"+totalPekerjaan]){
                horizontalMultiplier = {'hm': 25/jobVariableObj["lokasi_tangan_origin_h_"+totalPekerjaan] };
            }

            if(jobVariableObj["lokasi_tangan_origin_v_"+totalPekerjaan] < jobVariableObj["lokasi_tangan_dest_v_"+totalPekerjaan]){
                lokasi_tangan_v = {'lokasi_tangan_v': jobVariableObj["lokasi_tangan_dest_v_"+totalPekerjaan] };
                verticalMultiplier = {'vm': 1-0.003*Math.abs(jobVariableObj["lokasi_tangan_dest_v_"+totalPekerjaan]-75) };
            }else if(jobVariableObj["lokasi_tangan_origin_v_"+totalPekerjaan] > jobVariableObj["lokasi_tangan_dest_v_"+totalPekerjaan]){
                lokasi_tangan_v = {'lokasi_tangan_v': jobVariableObj["lokasi_tangan_origin_v_"+totalPekerjaan] };
                verticalMultiplier = {'vm': 1-0.003*Math.abs(jobVariableObj["lokasi_tangan_origin_v_"+totalPekerjaan]-75) };
            }
            
            distanceMultiplier = {'dm': 0.82+4.5/jobVariableObj["jarak_vertical_d_"+totalPekerjaan] };

            if(jobVariableObj["sudut_asimetri_origin_a_"+totalPekerjaan] <= jobVariableObj["sudut_asimetri_dest_a_"+totalPekerjaan]){
                asymetricMultiplier = {'am': 1-(jobVariableObj["sudut_asimetri_dest_a_"+totalPekerjaan]*0.0032) };
            }else if(jobVariableObj["sudut_asimetri_origin_a_"+totalPekerjaan] >= jobVariableObj["sudut_asimetri_dest_a_"+totalPekerjaan]){
                asymetricMultiplier = {'am': 1-(jobVariableObj["sudut_asimetri_origin_a_"+totalPekerjaan]*0.0032) };
            }

            if(jobVariableObj["object_clutch_c_"+totalPekerjaan].toLowerCase() === 'good' || jobVariableObj["object_clutch_c_"+totalPekerjaan].toLowerCase() === 'bagus') object_cluth_c = 'good';
            if(jobVariableObj["object_clutch_c_"+totalPekerjaan].toLowerCase() === 'fair' || jobVariableObj["object_clutch_c_"+totalPekerjaan].toLowerCase() === 'sedang') object_cluth_c = 'fair';
            if(jobVariableObj["object_clutch_c_"+totalPekerjaan].toLowerCase() === 'poor' || jobVariableObj["object_clutch_c_"+totalPekerjaan].toLowerCase() === 'jelek') object_cluth_c = 'poor';
            
            $.each(couplingMultiplierArr, function(couplingMultiplierArrIndex, couplingMultiplierArrValue){
                $.each(couplingMultiplierArrValue, function(couplingMultiplierIndex, couplingMultiplierValue){
                    if(couplingMultiplierValue === object_cluth_c){
                        cmIndex = couplingMultiplierIndex;
                    }
                    
                    if(Object.keys(couplingMultiplierArrValue).length === 2){
                        if(couplingMultiplierIndex === 'lessThan75' && lokasi_tangan_v.lokasi_tangan_v < 75){
                            couplingMultiplier = {'cm': couplingMultiplierValue[cmIndex]};
                        }else if(couplingMultiplierIndex === 'moreThan75' && lokasi_tangan_v.lokasi_tangan_v >= 75){
                            couplingMultiplier = {'cm': couplingMultiplierValue[cmIndex]};
                        }
                    }
                });
            });

            firwl = {'firwl': loadConstant.lc * horizontalMultiplier.hm * verticalMultiplier.vm * distanceMultiplier.dm * asymetricMultiplier.am * couplingMultiplier.cm }

            // $.each(frequencyMultiplierArr, function(index, frequencyMultiplierValue){
            //     $.each(frequencyMultiplierValue, function(frequencyIndex, frequencyValue){
            //         if(frequencyValue === parseInt(jobVariableObj["avg_freq_"+totalPekerjaan])){
            //             frequencyIndexFound = frequencyIndex;
            //         }else if(frequencyValue === 'moreThan15' && parseInt(jobVariableObj["avg_freq_"+totalPekerjaan]) > 15){
            //             frequencyIndexFound = frequencyIndex;
            //         }

            //         if(frequencyValue !== 'moreThan15' &&  Object.keys(frequencyValue).length !== 0){
            //             $.each(frequencyValue, function(index, value){
            //                 if(frequencyIndex === 'cond1' && jobVariableObj["duration_"+totalPekerjaan] <= 1){
            //                     if(index === 'lessThan75' && lokasi_tangan_v.lokasi_tangan_v < 75){
            //                         frequencyMultiplier = {'fm': value[frequencyIndexFound] };
            //                     }else if(index === 'moreThan75' && lokasi_tangan_v.lokasi_tangan_v >= 75){
            //                         frequencyMultiplier = {'fm': value[frequencyIndexFound] };
            //                     }
            //                 }else if(frequencyIndex === 'cond2' && jobVariableObj["duration_"+totalPekerjaan] > 1 && jobVariableObj["duration_"+totalPekerjaan] <= 2){
            //                     if(index === 'lessThan75' && lokasi_tangan_v.lokasi_tangan_v < 75){
            //                         frequencyMultiplier = {'fm': value[frequencyIndexFound] };
            //                     }else if(index === 'moreThan75' && lokasi_tangan_v.lokasi_tangan_v >= 75){
            //                         frequencyMultiplier = {'fm': value[frequencyIndexFound] };
            //                     }
            //                 }else if(frequencyIndex === 'cond3' && jobVariableObj["duration_"+totalPekerjaan] > 2 && jobVariableObj["duration_"+totalPekerjaan] <= 8){
            //                     if(index === 'lessThan75' && lokasi_tangan_v.lokasi_tangan_v < 75){
            //                         frequencyMultiplier = {'fm': value[frequencyIndexFound] };
            //                     }else if(index === 'moreThan75' && lokasi_tangan_v.lokasi_tangan_v >= 75){
                                    
            //                     }
            //                 }
            //             });
            //         }
            //     });
            // });
            frequencyMultiplier = {'fm': frequencyMultiplierFunc(parseInt(jobVariableObj["avg_freq_"+totalPekerjaan]), jobVariableObj["duration_"+totalPekerjaan], lokasi_tangan_v.lokasi_tangan_v) };
            strwl = {'strwl': firwl.firwl * frequencyMultiplier.fm };

            if(jobVariableObj["beban_kerja_L_avg_"+totalPekerjaan] <= jobVariableObj["beban_kerja_L_max_"+totalPekerjaan]){
                loadWeight = jobVariableObj["beban_kerja_L_max_"+totalPekerjaan];
            }else if(jobVariableObj["beban_kerja_L_avg_"+totalPekerjaan] >= jobVariableObj["beban_kerja_L_max_"+totalPekerjaan]){
                loadWeight = jobVariableObj["beban_kerja_L_avg_"+totalPekerjaan];
            }

            fili = {'fili': loadWeight / firwl.firwl };

            filiArr.push(loadWeight / firwl.firwl);
            filiArrSort.push(loadWeight / firwl.firwl);

            stli = {'stli': loadWeight / strwl.strwl };

            stliArrSort.push(loadWeight / strwl.strwl);
            stliArr.push(loadWeight / strwl.strwl);

            frequency = {'f': parseInt(jobVariableObj["avg_freq_"+totalPekerjaan]) };

            duration = {'duration': parseInt(jobVariableObj["duration_"+totalPekerjaan]) };

            jobVarArr.push(Object.assign(lokasi_tangan_v, duration));
            multiplierArr.push(Object.assign(loadConstant, horizontalMultiplier, verticalMultiplier, distanceMultiplier, asymetricMultiplier, couplingMultiplier, firwl, frequencyMultiplier, strwl, fili, stli, frequency));
        }

        stliArrSort.sort(function(a,b) {
            return b - a;
        });

        filiArrSort.sort(function(a,b) {
            return b - a;
        });
        
        $("#tbody-multiplier").children().remove();
        for(let totalPekerjaan=0; totalPekerjaan< multiplierArr.length; totalPekerjaan++){
            Object.assign(multiplierArr[totalPekerjaan], {'no_pekerjaan_baru': parseInt(Object.keys(stliArr).find(key => stliArr[key] === stliArrSort[totalPekerjaan])) + 1}) ;

            $("#tbody-multiplier").append('<tr id="tr-multiplier-'+totalPekerjaan+'">\
                    <td>\
                        <span id="no-pekerjaan-'+totalPekerjaan+'">'+(totalPekerjaan +1)+'</span>\
                    </td>\
                    <td>\
                        <span id="lc-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].lc +'</span>\
                        <input id="lc-'+totalPekerjaan+'" name="lc_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].lc +'">\
                    </td>\
                    <td>\
                        <span id="hm-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].hm.toFixed(6) +'</span>\
                        <input id="hm-'+totalPekerjaan+'" name="hm_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].hm +'">\
                    </td>\
                    <td>\
                        <span id="vm-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].vm +'</span>\
                        <input id="vm-'+totalPekerjaan+'" name="vm_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].vm +'">\
                    </td>\
                    <td>\
                        <span id="dm-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].dm +'</span>\
                        <input id="dm-'+totalPekerjaan+'" name="dm_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].dm +'">\
                    </td>\
                    <td>\
                        <span id="am-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].am +'</span>\
                        <input id="am-'+totalPekerjaan+'" name="am_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].am +'">\
                    </td>\
                    <td>\
                        <span id="cm-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].cm +'</span>\
                        <input id="cm-'+totalPekerjaan+'" name="cm_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].cm +'">\
                    </td>\
                    <td>\
                        <span id="firwl-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].firwl.toFixed(6) +'</span>\
                        <input id="firwl-'+totalPekerjaan+'" name="firwl_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].firwl +'">\
                    </td>\
                    <td>\
                        <span id="fm-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].fm +'</span>\
                        <input id="fm-'+totalPekerjaan+'" name="fm_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].fm +'">\
                    </td>\
                    <td>\
                        <span id="strwl-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].strwl.toFixed(6) +'</span>\
                        <input id="strwl-'+totalPekerjaan+'" name="strwl_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].strwl +'">\
                    </td>\
                    <td>\
                        <span id="fili-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].fili.toFixed(6) +'</span>\
                        <input id="fili-'+totalPekerjaan+'" name="fili_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].fili +'">\
                    </td>\
                    <td>\
                        <span id="stli-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].stli.toFixed(6) +'</span>\
                        <input id="stli-'+totalPekerjaan+'" name="stli_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].stli +'">\
                    </td>\
                    <td>\
                        <span id="no-pekerjaan-baru-value-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].no_pekerjaan_baru +'</span>\
                        <input id="no-pekerjaan-baru-'+totalPekerjaan+'" name="no_pekerjaan_baru_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].no_pekerjaan_baru +'">\
                    </td>\
                    <td>\
                        <span id="f-'+totalPekerjaan+'">'+ multiplierArr[totalPekerjaan].f +'</span>\
                        <input id="f-'+totalPekerjaan+'" name="f_'+totalPekerjaan+'" type="hidden" value="'+ multiplierArr[totalPekerjaan].f +'">\
                    </td>\
                </tr>'
            )
        }

        

        // if(objectClutchFlag === 0 && formJobVariableScoreSerialize.indexOf('=&') === -1){

            /*$("#hm-value").text(hand_location_h.toFixed(6));
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
            $('#cm').val(couplingMultiplier);*/
        // }
    }

    function addComposeLiftingIndex(){
        var fm1 = 0;
        var fm2 = 0;
        var frequencyMultiplier;
        var stliVal= 0;
        var filiVal= 0;

        $("#tbody-compose-lifting-index").children().remove();
        for(let totalPekerjaan= 0; totalPekerjaan < stliArrSort.length; totalPekerjaan++){
            fm1 = multiplierArr[totalPekerjaan].f + fm1;
            if(fm1 >= 2) fm2 = multiplierArr[totalPekerjaan].f + fm2;

            if(totalPekerjaan === 0){
                stliVal = stliArrSort[totalPekerjaan];

                $("#tbody-compose-lifting-index").append(' <tr>\
                    <td scope="row" style="width: 5%;padding-left: 0px;padding-right: 0px;">STLI1 +</td>\
                    <td style="width: 5px;padding-left: 0px;padding-right: 0px;">:</td>\
                    <th id="stli-1" class="cli-value" style="padding-left: 0px;">'+stliArrSort[totalPekerjaan].toFixed(9)+'</th>\
                </tr>')
            }
            if(totalPekerjaan >= 1){
                var fili = filiArrSort[totalPekerjaan] * ((1/frequencyMultiplierFunc(fm1, jobVarArr[totalPekerjaan].duration, jobVarArr[totalPekerjaan].lokasi_tangan_v))-(1/frequencyMultiplierFunc(fm2, jobVarArr[totalPekerjaan].duration, jobVarArr[totalPekerjaan].lokasi_tangan_v)))
                filiVal = fili + filiVal;
                
                $("#tbody-compose-lifting-index").last().append('<tr>\
                    <td scope="row" style="width: 5%;padding-left: 0px;padding-right: 0px;">FILI'+(totalPekerjaan +1)+' +</td>\
                    <td style="width: 5px;padding-left: 0px;padding-right: 0px;">:</td>\
                    <th id="fili-2" class="cli-value" style="padding-left: 0px;">'+fili.toFixed(9)+'</th>\
                </tr>')
            }
        }
        $('#cli-total').text(stliVal + filiVal);
        
        
        // $("#hand-location-h").removeClass("is-valid");
        // $("#hand-location-v").removeClass("is-valid");
        // $("#vertical-distance-d").removeClass("is-valid");
        // $("#assymetric-angle-a").removeClass("is-valid");
        // $("#average-frequency-f").removeClass("is-valid");
        // $("#duration").removeClass("is-valid");
        // $("#object-clutch-c").removeClass("is-valid");
        // $("#object-weight").removeClass("is-valid");
        // $("#lc").removeClass("is-valid");
        // $('#hm-value').text('-');
        // $('#vm-value').text('-');
        // $('#dm-value').text('-');
        // $('#am-value').text('-');
        // $('#cm-value').text('-');
        // $('#rwl-score-value').text('-');
        // $('#lifting-index-score-val').text('-');
        // $('#btn-add-compose-li').addClass('disabled');

        // $('#form-job-variable-score')[0].reset();
        // $('#form-rwl-score')[0].reset();
        // $('#lifting-index-score').val("");
    }
</script>
@endsection