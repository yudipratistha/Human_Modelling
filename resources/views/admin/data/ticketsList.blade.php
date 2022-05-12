@extends('layouts.app')

@section('title', 'List Data Ticket')

@section('plugin_css')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/sweetalert2.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/leaflet.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/leaflet-gesture-handling.min.css')}}">
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
                                    <h3>Tickets List</h3>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('admin.processingData.index')}}">Home</a></li>
                                        <li class="breadcrumb-item active">Tickets List</li>
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
                                    @if($tickets->count() == 0) <center>You have no ticket</center> @endif
                                    @foreach($tickets as $i => $ticket)	
                                        <div class="card">
                                            <div class="ticket-list">
                                                <div class="card-body">
                                                    <div class="media"><img class="img-40 img-fluid m-r-20" src="{{url('/assets/images/ticket/anthropology.png')}}" alt="">
                                                        <div class="media-body">
                                                            <h6 class="f-w-600">
                                                                <a href="@if($ticket->ssp_ticket_status == 2) {{route('admin.ticketData.index', $ticket->id)}} @endif">{{$ticket->ssp_ticket_job_title}}</a>
                                                                <button type="button" class="btn btn-outline-danger pull-right" onclick="deleteTicketData({{$ticket->id}}, '{{$ticket->ssp_ticket_job_title}}')" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px;"><i class="fa fa-trash" style="font-size:20px;"></i></button>
                                                                @if($ticket->ssp_ticket_status == 1)
                                                                    <button type="button" class="btn btn-outline-primary pull-right" onclick="getTicketData({{$ticket->id}})" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px; margin-right:5px;"><i class="fa fa-edit" style="font-size:20px;"></i></button>
                                                                    <span class="badge badge-primary pull-right" style="padding-top: 8px;padding-bottom: 8px;margin-right: 5px;">Waiting CSV Data!</span>
                                                                @elseif($ticket->ssp_ticket_status == 2)
                                                                    <span class="badge badge-warning pull-right" style="padding-top: 8px;padding-bottom: 8px;margin-right: 5px;">Validation Process!</span>
                                                                @elseif($ticket->ssp_ticket_status == 3)
                                                                    <span class="badge badge-success pull-right" style="padding-top: 8px;padding-bottom: 8px;margin-right: 5px;">Validation Success!</span>
                                                                @endif
                                                                
                                                            </h6>
                                                            <i class="fa fa-map-marker" style="margin-right: 5px;"></i><p>{{$ticket->ssp_ticket_job_location}}</p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless table-sm">
                                                            <tbody>
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
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div style="height:360px;width:100%; margin-bottom:20px;" id="map-container">
                                                        <div style="height: 100%; width: 100%; position: relative;z-index: 0;" id="map-{{$i}}"></div>
                                                    </div>
                                                    
                                                    @if($ticket->ssp_ticket_status == 1)
                                                        <button type="button" class="btn btn-outline-primary" onclick="modalImportCSV({{$ticket->id}})"></i>Upload CSV Data</button>
                                                    @endif
                                                    @if($ticket->ssp_ticket_status != 1)
                                                        <a href="{{route('admin.ticketData.index', $ticket->id)}}"><button type="button" class="btn btn-outline-primary"></i>Show</button></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="job-pagination">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-primary">
                                            {{$tickets->links()}}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="float btn btn-add btn btn-outline-primary mt-1 mb-1" data-bs-toggle="modal" data-bs-target="#createTicketModal" data-tooltip="tooltip" data-placement="left" title="" data-original-title="">
                        <span class="btn-inner--icon"><i class="icon-plus" style="font-weight: bold;font-size: 20px;"></i></span>
                    </button>
                </div>
            </div>
            
            <!-- Container-fluid Ends-->
        </div>
    </div>
    <!-- footer start-->
    @include('layouts.footer')
    
</div> 

<!-- Modal Create Ticket-->
<div class="modal fade" id="createTicketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create Ticket</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="theme-form" id="dataCreateTicket" enctype="multipart/form-data" action="" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row" id="job-title-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Title</label>
                                <div class="col-xl-10 col-sm-9">
                                    <input type="text" class="form-control" id="job-title" name="job_title" placeholder="Title..." >
                                </div>
                            </div>
                            <div class="form-group row" id="job-date-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Date</label>
                                <div class="col-xl-10 col-sm-9">
                                    <input class="form-control digits" id="job-date" name="job_date" type="text">
                                </div>
                            </div>
                            <div class="form-group row" id="job-description-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Description</label>
                                <div class="col-xl-10 col-sm-9">
                                    <textarea class="form-control" id="job-description" name="job_description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row" id="job-location-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Location</label>
                                <div class="col-xl-10 col-sm-9">
                                <input type="text" class="form-control" id="job-location" name="job_location" placeholder="Location..." >
                                </div>
                            </div>
                            <div class="form-group row" id="job-lat-location-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Latitude Location</label>
                                <div class="col-xl-10 col-sm-9">
                                <input type="text" class="form-control" id="job-lat-location" name="job_lat_location" placeholder="Latitude Location..." >
                                </div>
                            </div>
                            <div class="form-group row" id="job-lng-location-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Longitude Location</label>
                                <div class="col-xl-10 col-sm-9">
                                <input type="text" class="form-control" id="job-lng-location" name="job_lng_location" placeholder="Longitude Location..." >
                                </div>
                            </div>
                            <div style="height:360px;width:100%;" id="map-container">
                                <div style="height: 100%; width: 100%; position: relative;z-index: 0;" id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-square btn-outline-light txt-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="createTicket()" class="btn btn-square btn-outline-secondary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Ticket-->
<div class="modal fade" id="editTicketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Ticket</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="theme-form" id="dataEditTicket" enctype="multipart/form-data" action="" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row" id="edit-job-title-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Title</label>
                                <div class="col-xl-10 col-sm-9">
                                    <input type="text" class="form-control" id="edit-job-title" name="edit_job_title" placeholder="Title..." value="">
                                </div>
                            </div>
                            <div class="form-group row" id="edit-job-date-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Date</label>
                                <div class="col-xl-10 col-sm-9">
                                    <input class="form-control digits" id="edit-job-date" name="edit_job_date" type="text">
                                </div>
                            </div>
                            <div class="form-group row" id="edit-job-description-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Description</label>
                                <div class="col-xl-10 col-sm-9">
                                    <textarea class="form-control" id="edit-job-description" name="edit_job_description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row" id="edit-job-location-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Location</label>
                                <div class="col-xl-10 col-sm-9">
                                <input type="text" class="form-control" id="edit-job-location" name="edit_job_location" placeholder="Location..." >
                                </div>
                            </div>
                            <div class="form-group row" id="edit-job-lat-location-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Latitude Location</label>
                                <div class="col-xl-10 col-sm-9">
                                <input type="text" class="form-control" id="edit-job-lat-location" name="edit_job_lat_location" placeholder="Latitude Location..." >
                                </div>
                            </div>
                            <div class="form-group row" id="edit-job-lng-location-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">Job Longitude Location</label>
                                <div class="col-xl-10 col-sm-9">
                                <input type="text" class="form-control" id="edit-job-lng-location" name="edit_job_lng_location" placeholder="Longitude Location..." >
                                </div>
                            </div>
                            <div style="height:360px;width:100%;" id="map-container">
                                <div style="height: 100%; width: 100%; position: relative;z-index: 0;" id="map-edit"></div>
                            </div>
                            <input type="hidden" id="ticket-id" name="ticket_id" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-square btn-outline-light txt-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="updateTicket()" class="btn btn-square btn-outline-secondary">Save</button>
                </div>
            </form>
        </div>
    </div>
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
                            <div class="form-group row" id="csv-file-div">
                                <label class="col-xl-2 col-sm-3 col-form-label">CSV file to Import</label>
                                <div class="col-xl-10 col-sm-9">
                                    <input type="file" class="form-control" name="csvFile" id="csv-file" aria-label="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-square btn-outline-light txt-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="parseCSVData()" class="btn btn-square btn-outline-secondary">Process CSV Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('plugin_js')
<!-- Plugins JS start-->
<script src="{{url('/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{url('/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{url('/assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{url('/assets/js/tooltip-init.js')}}"></script>
<script src="{{url('/assets/js/leaflet/leaflet.js')}}"></script>
<script src="{{url('/assets/js/leaflet/leaflet-gesture-handling.min.js')}}"></script>
<!-- Plugins JS Ends-->

<script>
    
    $(document).ready(function(){
        var tickets = {!! json_encode($tickets->toArray()) !!};
        tickets.data.forEach(function(item, index) {
            var map = L.map('map-'+index, {
                zoomControl:true,
                gestureHandling: true
            }).setView([item.ssp_ticket_job_lat_location, item.ssp_ticket_job_lng_location],17);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoieXVkaXByYXRpc3RoYSIsImEiOiJjbDJ6cHpsZ2owMzQ3M2JtcDQxdzFhdDd5In0.lPuxJO3S88Xy70aZfF4dLQ'
            }).addTo(map);

            L.DomEvent.on(map.getContainer(), 'focus', L.DomEvent.preventDefault)
            
            var latlng = L.latLng(item.ssp_ticket_job_lat_location, item.ssp_ticket_job_lng_location);
            currentMarker = L.marker(latlng, {
            }).addTo(map);
        });
        
        
        var latlngview = L.latLng($('#job-lat-location').val(), $('#job-lng-location').val());
        if(latlngview.lat == 0 && latlngview.lng == 0) latlngview = L.latLng('-8.660315332079342', '115.21636962890626');
        var map = L.map('map', {
            zoomControl:true,
            gestureHandling: true
        }).setView([latlngview.lat, latlngview.lng],12.5);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoieXVkaXByYXRpc3RoYSIsImEiOiJjbDJ6cHpsZ2owMzQ3M2JtcDQxdzFhdDd5In0.lPuxJO3S88Xy70aZfF4dLQ'
        }).addTo(map);

        var latlng = L.latLng($('#job-lat-location').val(), $('#job-lng-location').val());
        if(latlng != undefined){
            currentMarker = L.marker(latlng, {
                draggable: true
            }).addTo(map);
        }
        var currentMarker;
        map.on('click', function(e) {
            if (currentMarker != undefined) {
                map.removeLayer(currentMarker);
            };
            currentMarker = L.marker(e.latlng, {
                draggable: true
            }).addTo(map)
            latLngInput(e.latlng.lat, e.latlng.lng)
            currentMarker.on("dragend", function(ev) { 
                var chagedPos = ev.target.getLatLng();
                latLngInput(chagedPos.lat, chagedPos.lng)
            });
        });
        if(currentMarker != undefined){
            currentMarker.on("dragend", function(ev) { 
                var chagedPos = ev.target.getLatLng();
                latLngInput(chagedPos.lat, chagedPos.lng)
            });
        }
        function latLngInput(lat, lng){
            $('#job-lat-location').val(lat).trigger('change');
            $('#job-lng-location').val(lng).trigger('change');
        }

        // Restricts input for each element in the set of matched elements to the given inputFilter.
        (function($) {
            $.fn.inputFilter = function(inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu", function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = this.value;
                    }
                });
            };
        }(jQuery));

        $('#createTicketModal').on('shown.bs.modal', function(){
            setTimeout(function() {
                map.invalidateSize();
            }, 10);
        });

        $('#job-date').datepicker({
            language: 'en',
            dateFormat: 'dd-mm-yyyy',
            minDate: new Date() // Now can select only dates, which goes after today
        });

        $('#job-title').on("change", function(){ 
            $("#job-title").removeClass("is-invalid");
            $("#error-msg-job-title").remove();
            $("#job-title").addClass("is-valid");
        });

        $('#job-date').on("change", function(){ 
            $("#job-date").removeClass("is-invalid");
            $("#error-msg-job-date").remove();
            $("#job-date").addClass("is-valid");
        });

        $('#job-description').on("change", function(){ 
            $("#job-description").removeClass("is-invalid");
            $("#error-msg-job-description").remove();
            $("#job-description").addClass("is-valid");
        });

        $('#job-location').on("change", function(){ 
            $("#job-location").removeClass("is-invalid");
            $("#error-msg-job-location").remove();
            $("#job-location").addClass("is-valid");
        });

        $('#job-lat-location').on("change", function(){ 
            $("#job-lat-location").removeClass("is-invalid");
            $("#error-msg-job-lat-location").remove();
            $("#job-lat-location").addClass("is-valid");
        });

        $('#job-lng-location').on("change", function(){ 
            $("#job-lng-location").removeClass("is-invalid");
            $("#error-msg-job-lng-location").remove();
            $("#job-lng-location").addClass("is-valid");
        });

        $('#edit-job-title').on("change", function(){ 
            $("#edit-job-title").removeClass("is-invalid");
            $("#error-msg-edit-job-title").remove();
            $("#edit-job-title").addClass("is-valid");
        });

        $('#edit-job-date').on("change", function(){ 
            $("#edit-job-date").removeClass("is-invalid");
            $("#error-msg-edit-job-date").remove();
            $("#edit-job-date").addClass("is-valid");
        });

        $('#edit-job-description').on("change", function(){ 
            $("#edit-job-description").removeClass("is-invalid");
            $("#error-msg-edit-job-description").remove();
            $("#edit-job-description").addClass("is-valid");
        });

        $('#edit-job-location').on("change", function(){ 
            $("#edit-job-location").removeClass("is-invalid");
            $("#error-msg-edit-job-location").remove();
            $("#edit-job-location").addClass("is-valid");
        });

        $('#edit-job-lat-location').on("change", function(){ 
            $("#edit-job-lat-location").removeClass("is-invalid");
            $("#error-msg-edit-job-lat-location").remove();
            $("#edit-job-lat-location").addClass("is-valid");
        });

        $('#edit-job-lng-location').on("change", function(){ 
            $("#edit-job-lng-location").removeClass("is-invalid");
            $("#error-msg-edit-job-lng-location").remove();
            $("#edit-job-lng-location").addClass("is-valid");
        });

        $('#job-analyst').on("change", function(){ 
            $("#job-analyst").removeClass("is-invalid");
            $("#error-msg-job-analyst").remove();
            $("#job-analyst").addClass("is-valid");
        });

        $('#csv-file').on("change", function(){ 
            $("#csv-file").removeClass("is-invalid");
            $("#error-msg-csv-file").remove();
            $("#csv-file").addClass("is-valid");
        });
    });

    function createTicket(){
        swal.fire({
            title: "Create Ticket",
            text: "Add new Ticket data? ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Save",
            showLoaderOnConfirm: true,
            preConfirm: (login) => {  
                var form = $("#dataCreateTicket").get(0)
                return $.ajax({
                    type: "POST", 
                    url: "{{route('admin.ticketData.store')}}",
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
                                swal.fire({title:"Add Data Ticket Error!", text: "The given data was invalid!", icon:"error"});
                                var errorMsg = $('');
                                
                                $.each(xhr.responseJSON.errors, function (i, field) {
                                    if(i == "job_title"){
                                        $("#job-title").addClass("is-invalid");
                                        $('#job-title-div').append('<div id="error-msg-job-title" class="text-danger">The job title field is required.</div>');
                                    }else if(i == "job_analyst"){
                                        $("#job-analyst").addClass("is-invalid");
                                        $('#job-analyst-div').append('<div id="error-msg-job-analyst" class="text-danger">The job analyst field is required.</div>');
                                    }else if(i == "job_date"){
                                        $("#job-date").addClass("is-invalid");
                                        $('#job-date-div').append('<div id="error-msg-job-date" class="text-danger">The job date field is required.</div>');
                                    }else if(i == "job_description"){
                                        $("#job-description").addClass("is-invalid");
                                        $('#job-description-div').append('<div id="error-msg-job-description" class="text-danger">The job comments field is required.</div>'); 
                                    }else if(i == "job_location"){
                                        $("#job-location").addClass("is-invalid");
                                        $('#job-location-div').append('<div id="error-msg-job-location" class="text-danger">The job location field is required.</div>');
                                    }else if(i == "job_lat_location"){
                                        $("#job-lat-location").addClass("is-invalid");
                                        $('#job-lat-location-div').append('<div id="error-msg-job-lat-location" class="text-danger">The job latitude location field is required.</div>');
                                    }else if(i == "job_lng_location"){
                                        $("#job-lng-location").addClass("is-invalid");
                                        $('#job-lng-location-div').append('<div id="error-msg-job-lng-location" class="text-danger">The job longitude location field is required.</div>');
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
            swal.fire({title:"New Ticket Data Added", text:"Successfuly add new Ticket data!", icon:"success"})
            .then(function(){ 
                window.location.reload();
            });
            }
        })
    }

    function getTicketData(ticketId){
        // console.log()
        link = "{{route('admin.ticketData.getEdit', ':ticketId')}}";
        link = link.replace(":ticketId", ticketId);
        $.ajax({
            url: link,
            method: "GET",
			dataType: 'json',
			success: function(data){
                console.log(data.ssp_ticket_job_title)
                // console.log(data[])
                // data_token = jQuery.parseJSON(data.data_token);
                $('#edit-job-title').val(data.ssp_ticket_job_title).trigger('change');
                $('#edit-job-date').val(data.ssp_ticket_job_date).trigger('change');
                $('#edit-job-description').val(data.ssp_ticket_job_description).trigger('change');
                $('#edit-job-location').val(data.ssp_ticket_job_location).trigger('change');
                $('#edit-job-lat-location').val(data.ssp_ticket_job_lat_location).trigger('change');
                $('#edit-job-lng-location').val(data.ssp_ticket_job_lng_location).trigger('change');
                $('#editTicketModal').find('#ticket-id').val(data.id);
				$('#editTicketModal').modal('show');
                var latlngview = L.latLng($('#job-lat-location').val(), $('#job-lng-location').val());
                if(latlngview.lat == 0 && latlngview.lng == 0) latlngview = L.latLng(data.ssp_ticket_job_lat_location, data.ssp_ticket_job_lng_location);
                var map = L.map('map-edit', {
                    zoomControl:true,
                    gestureHandling: true
                }).setView([latlngview.lat, latlngview.lng],12.5);
                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    maxZoom: 18,
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1,
                    accessToken: 'pk.eyJ1IjoieXVkaXByYXRpc3RoYSIsImEiOiJjbDJ6cHpsZ2owMzQ3M2JtcDQxdzFhdDd5In0.lPuxJO3S88Xy70aZfF4dLQ'
                }).addTo(map);

                var latlng = L.latLng(data.ssp_ticket_job_lat_location, data.ssp_ticket_job_lng_location);
                if(latlng != undefined){
                    console.log("test")
                    currentMarker = L.marker(latlng, {
                        draggable: true
                    }).addTo(map);
                }
                var currentMarker;
                map.on('click', function(e) {
                    if (currentMarker != undefined) {
                        map.removeLayer(currentMarker);
                    };
                    currentMarker = L.marker(e.latlng, {
                        draggable: true
                    }).addTo(map)
                    latLngInput(e.latlng.lat, e.latlng.lng)
                    currentMarker.on("dragend", function(ev) { 
                        var chagedPos = ev.target.getLatLng();
                        latLngInput(chagedPos.lat, chagedPos.lng)
                    });
                });
                if(currentMarker != undefined){
                    currentMarker.on("dragend", function(ev) { 
                        var chagedPos = ev.target.getLatLng();
                        latLngInput(chagedPos.lat, chagedPos.lng)
                    });
                }
                function latLngInput(lat, lng){
                    $('#edit-job-lat-location').val(lat).trigger('change');
                    $('#edit-job-lng-location').val(lng).trigger('change');
                }
                $('#editTicketModal').on('shown.bs.modal', function(){
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 10);
                });
            },
            error: function(data){
                // data_token = jQuery.parseJSON(data);
                console.log("asdsad", data)
            }
        });
    }

    function updateTicket(){
        link = "{{route('admin.ticketData.update', ':ticketId')}}";
        link = link.replace(":ticketId", $("#editTicketModal").find("#ticket-id").val());
        swal.fire({
            title: "Update Ticket",
            text: "Do you will to update this ticket?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Save",
            showLoaderOnConfirm: true,
            preConfirm: (login) => {  
                var form = $("#dataEditTicket").get(0)
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
                                swal.fire({title:"Ticket failed Update!", text: "This ticket failed to updated!", icon:"error"});
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
            swal.fire({title:"Update Ticket Success!", text:"Successfully updated this ticket!", icon:"success"})
            .then(function(){ 
                window.location.reload();
            });
            }
        })
    }

    function deleteTicketData(ticketId, ticketTitle){
        link = "{{route('admin.ticketData.destroy', ':id')}}";
        link = link.replace(':id', ticketId);
        
		swal.fire({
			title: "Delete Ticket "+ticketTitle+"?",
			text: "Ticket "+ticketTitle+" will deleted on your tickets list!",
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
                    data:{id:ticketId, "_token": "{{ csrf_token() }}"},
                    success: function(data) {
                    
                    },
                    error: function(data){
                        swal.fire({title:"Ticket Failed to Deleted!", text:"This ticket was not deleted successfully", icon:"error"});
                    }
                }); 
            } 
		}).then((result) => {
            if(result.value){
                swal.fire({title:"Ticket Deleted!", text:"This ticket has been deleted on your tickets list", icon:"success"})
                .then(function(){ 
                    window.location.href = "{{ route('admin.ticketsList.index')}}";
                });
            }
        })
    }

    function modalImportCSV($ticketId){
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
                var form = $("#dataImportCSV").get(0)
                return $.ajax({
                    type: "POST", 
                    url: "{{route('admin.processingData.storeDataCSV')}}",
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
            swal.fire({title:"New CSV Data Added", text:"Successfuly add new CSV data!", icon:"success"})
            .then(function(){ 
                window.location.reload(true);
            });
            }
        })
    }
</script>
@endsection