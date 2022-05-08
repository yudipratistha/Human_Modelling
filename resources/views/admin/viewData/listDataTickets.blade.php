@extends('layouts.app')

@section('title', 'List Data Ticket')

@section('plugin_css')
<!-- Plugins css start-->
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
                                    <h3>List Data Tickets</h3>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                                        <li class="breadcrumb-item">Data</li>
                                        <li class="breadcrumb-item active">List Data Tickets</li>
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
                                <div class="col-xl-12 xl-60 box-col-8">
                                    @if($tickets->count() == 0) <center>You have no ticket</center> @endif
                                    @foreach($tickets as $i => $ticket)	
                                        <div class="card">
                                            <div class="job-search">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h6 class="f-w-600">
                                                                <a href="job-details.html">{{$ticket->ssp_job_title}}</a>
                                                                <a href="#"><button type="button" class="btn btn-outline-danger pull-right" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px;"><i class="fa fa-trash" style="font-size:20px;"></i></button></a>
                                                                <a href="#"><button type="button" class="btn btn-outline-primary pull-right" style="width: 37px; padding-top: 2px; padding-left: 0px; padding-right: 0px; padding-bottom: 2px; margin-right:5px;"><i class="fa fa-edit" style="font-size:20px;"></i></button></a>
                                                            </h6>
                                                            <i class="fa fa-map-marker"></i><p>Kediri, Tabanan, Bali</p>
                                                            
                                                        </div>
                                                    </div>
                                                    <p>
                                                    We are looking for an experienced and viho designer and/or frontend engineer with expertise in accessibility to join our team ,
                                                    3+ years of experience working in as a Frontend Engineer or comparable role. You won’t be a team of one though — you’ll be collaborating closely with other...
                                                    </p>
                                                    <a href="{{route('admin.dataTicket.index', $ticket->id)}}"><button type="button" class="btn btn-outline-primary"></i>Show</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="job-pagination">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-primary">
                                            <li class="page-item disabled"><a class="page-link" href="javascript:void(0)">Previous</a></li>
                                            <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0)">Next</a></li>
                                        </ul>
                                    </nav>
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
@endsection

@section('plugin_js')
<!-- Plugins JS start-->
<!-- Plugins JS Ends-->

@endsection