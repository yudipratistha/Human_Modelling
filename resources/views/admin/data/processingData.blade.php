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
            <div class="container pt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5>Upload File</h5>
                            </div>

                            <div class="card-body">
                                <div id="upload-container" class="text-center">
                                <!-- <input type="file" class="form-control" name="video_simulation" id="browseFile" aria-label="file" > -->

                                    <button id="browseFile" class="btn btn-primary">Brows File</button>
                                </div>
                                <div  style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-info" aria-label="Start upload" id="start-upload-btn">
                <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Start upload
            </button>
                            <div class="card-footer p-4" style="display: none">
                                <video id="videoPreview" src="" controls style="width: 100%; height: auto"></video>
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
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
<!-- Plugins JS Ends-->

<script>

var form = $("#dataImportCSV").get(0)

                let browseFile = $('#browseFile');
                
                let resumable = new Resumable({
                    target: "{{ route('admin.processingData.uploadLargeFiles') }}",
                    query:{_token:'{{ csrf_token() }}'} ,// CSRF token
                    fileType: ['mp4'],
                    chunkSize: 10*1024*1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
                    headers: {
                        'Accept' : 'application/json'
                    },
                    testChunks: false,
                    throttleProgressCallbacks: 1,
                });
// console.log(resumable)
                resumable.assignBrowse(browseFile[0]);

                $('#start-upload-btn').click(function(){
                    resumable.upload();
                });

                // resumable.on('fileAdded', function (file) { // trigger when file picked
                    
                //     // showProgress();
                //     resumable.upload() // to actually start uploading.
                // });

                // resumable.on('fileProgress', function (file) { // trigger when file progress update
                //     updateProgress(Math.floor(file.progress() * 100));
                // });

                // resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
                //     response = JSON.parse(response)
                //     $('#videoPreview').attr('src', response.path);
                //     $('.card-footer').show();
                // });

                // resumable.on('fileError', function (file, response) { // trigger when there is any error
                //     alert('file uploading error.')
                // });


                // let progress = $('.progress');
                // function showProgress() {
                //     progress.find('.progress-bar').css('width', '0%');
                //     progress.find('.progress-bar').html('0%');
                //     progress.find('.progress-bar').removeClass('bg-success');
                //     progress.show();
                // }

                // function updateProgress(value) {
                //     progress.find('.progress-bar').css('width', `${value}%`)
                //     progress.find('.progress-bar').html(`${value}%`)
                // }

                // function hideProgress() {
                //     progress.hide();
                // }


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