@extends('layouts.app')

@section('title', 'Processing Data')

@section('plugin_css')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../../assets/css/dropzone.css">
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
                                <span id="success-message"></span>
                                <form id="upload-csv" class="form-horizontal" method="POST" action="{{route('admin.processingData.storeDataCSV')}}" enctype="multipart/form-data">
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
                                        <div class="col-md-8 col-md-offset-4">
                                            <button id="btn-parse-csv" type="submit" class="btn btn-primary">
                                                Parse CSV
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group" id="process" style="display:none;">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style=""></div>
                                    </div>
                                </div>

                                <!-- <form class="dropzone digits" id="singleFileUpload" action="{{route('admin.processingData.storeDataCSV')}}">
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
<script src="../../assets/js/dropzone/dropzone.js"></script>
<script src="../../assets/js/dropzone/dropzone-script.js"></script>
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

// $(document).ready(function(){
  
//     $('#upload-csv').on('submit', function(event){
//         event.preventDefault();
//         var form = $("#upload-csv").get(0);
//         console.log(form)
//         $.ajax({
//             xhr: function() {
//                 var xhr = new window.XMLHttpRequest();
//                 xhr.upload.addEventListener("progress", function(evt) {
//                     if (evt.lengthComputable) {
//                         var percentComplete = (evt.loaded / evt.total) * 100;
//                         //Do something with upload progress here
//                         console.log("tes", percentComplete)
//                     }
//                 }, false);
//                 return xhr;
//             },
//             type:"POST",
//             url:"{{route('admin.processingData.storeDataCSV')}}",
//             processData: false,
//             contentType: false,
//             cache: false,
//             data: new FormData(form), 
//             beforeSend:function(){
//                 $('#btn-parse-csv').attr('disabled', 'disabled');
//                 $('#process').css('display', 'block');
//             },
//             // uploadProgress: function (event, position, total, percentComplete) {
//             //     console.log("tes")
//             //     var percentage = percentComplete;
//             //     $('.progress .progress-bar').css("width", percentage+'%', function() {
//             //         return $(this).attr("aria-valuenow", percentage) + "%";
//             //     })
//             // },
//             success:function(data){
//                 var percentage = 0;

//                 var timer = setInterval(function(){
//                 percentage = percentage + 20;
//                 progress_bar_process(percentage, timer);
//                 }, 1000);
//             }
//         })
//     });

//     function progress_bar_process(percentage, timer){
//         $('.progress-bar').css('width', percentage + '%');
//         if(percentage > 100){
//             clearInterval(timer);
//             $('#upload-csv')[0].reset();
//             $('#process').css('display', 'none');
//             $('.progress-bar').css('width', '0%');
//             $('#btn-parse-csv').attr('disabled', false);
//             $('#success_message').html("<div class='alert alert-success'>Data Saved</div>");
//             setTimeout(function(){
//                 $('#success_message').html('');
//             }, 5000);
//         }
//     }

// });


function processingCsvData(){
    swal.fire({
      title: "Create this form?",
      text: "Apakah ",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Process",
      showLoaderOnConfirm: true,
      preConfirm: (login) => {  
        let selected = $('#form-type :selected').val() !== '';
        var form = $("#tambahFormOption").get(0);

        if (!selected) {
            swal.showValidationMessage('Please select an option!');
        }else{
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
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
                  swal.fire({title:"Form Project Gagal Di Tambah!", text: xhr.responseText, type:"error"});
              }
          });
        }                
      }          
    }).then((result) => {
      console.log("sadsa ", result.value)
        if(result.value){
          swal.fire({title:"New Form Data Added!", text:"Successfuly add new Form data!", type:"success"})
          .then(function(){ 
              window.location.href = "/";
          });
        }
    })
}

</script>
@endsection