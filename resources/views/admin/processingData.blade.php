@extends('layouts.app')

@section('title', 'Processing Data')

@section('plugin_css')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/dropzone.css">
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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>Upload CSV File</h5>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" method="POST" action="{{ route('admin.processingData.parseDataCSV') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                    <label for="csv_file" class="col-md-4 control-label">CSV file to import</label>

                                    <div class="col-md-6">
                                        <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                                        @if ($errors->has('csv_file'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('csv_file') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="header" checked> File contains header row?
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Parse CSV
                                        </button>
                                    </div>
                                </div>
                            </form>
                                <!-- <form class="dropzone digits" id="singleFileUpload" action="{{route('admin.processingData.parseDataCSV')}}">
                                    <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                                        <h6>Drop files here or click to upload.</h6>
                                    </div>
                                </form> -->
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
<script src="../assets/js/dropzone/dropzone.js"></script>
<script src="../assets/js/dropzone/dropzone-script.js"></script>
<!-- Plugins JS Ends-->

<script>
    var DropzoneExample = function () {
    var DropzoneDemos = function () {
        Dropzone.options.singleFileUpload = {
            paramName: "file",
            maxFiles: 1,
            maxFilesize: 5,
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        };
    }
    return {
        init: function() {
            DropzoneDemos();
        }
    };
}();
DropzoneExample.init();
</script>
@endsection