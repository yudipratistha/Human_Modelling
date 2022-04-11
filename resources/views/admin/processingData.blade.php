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
                                <h5>Single File Upload</h5>
                            </div>
                            <div class="card-body">
                                <form class="dropzone digits" id="singleFileUpload" action="">
                                    <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                                        <h6>Drop files here or click to upload.</h6><span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                                    </div>
                                </form>
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