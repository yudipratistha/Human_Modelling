@extends('layouts.app')

@section('title', 'Register')

@section('plugin_css')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/sweetalert2.css')}}">
<!-- Plugins css Ends-->
@endsection

@section('content')
<!-- page-wrapper Start-->
<section>         
  <div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
          <div id="video-viewport">
            <video playsinline autoplay preload muted loop width="1920" height="1080"> 
              <source src="../assets/images/login/media.mp4" type="video/mp4">
            </video>
          </div>
          <div class="login-card">
            <form id="form-register-user" class="theme-form login-form" method="POST">
              @csrf  
              <h4>Create your account</h4>
              <h6>Enter your personal details to create account</h6>
              <div class="form-group">
                <label>Your Name</label>
                <div class="form-group">
                  <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                    <input class="form-control" type="text" required="" name="name" placeholder="Full Name">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                  <input class="form-control" type="email" required="" name="email" placeholder="Test@gmail.com">
                </div>
              </div>
              <div class="form-group">
                <label>Password</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                  <input class="form-control" type="password" name="password" required="" placeholder="*********">
                  <div class="show-hide"><span class="show">                         </span></div>
                </div>
              </div>
              <!-- <div class="form-group">
                <div class="checkbox">
                  <input id="checkbox1" type="checkbox">
                  <label class="text-muted" for="checkbox1">Agree with <span>Privacy Policy                   </span></label>
                </div>
              </div> -->
              <div class="form-group">
                <button class="btn btn-primary btn-block" type="button" onclick="registerUser()">Create Account</button>
              </div>
              <!-- <div class="login-social-title">                
                <h5>signup with</h5>
              </div> -->
              <!-- <div class="form-group">
                <ul class="login-social">
                  <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="linkedin"></i></a></li>
                  <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="twitter"></i></a></li>
                  <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="facebook"></i></a></li>
                  <li><a href="https://www.instagram.com/login" target="_blank"><i data-feather="instagram">                  </i></a></li>
                </ul>
              </div> -->
              <p>Already have an account?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- page-wrapper end-->

@section('plugin_js')
<script src="{{url('/assets/js/sweet-alert/sweetalert.min.js')}}"></script>

<script>
  var min_w = 300; // minimum video width allowed
  var vid_w_orig;  // original video dimensions
  var vid_h_orig;

  jQuery(function() { // runs after DOM has loaded
      
      vid_w_orig = parseInt(jQuery('video').attr('width'));
      vid_h_orig = parseInt(jQuery('video').attr('height'));
      $('#debug').append("<p>DOM loaded</p>");
      
      jQuery(window).resize(function () { resizeToCover(); });
      jQuery(window).trigger('resize');
  });

  function resizeToCover() {
      
      // set the video viewport to the window size
      jQuery('#video-viewport').width(jQuery(window).width());
      jQuery('#video-viewport').height(jQuery(window).height());

      // use largest scale factor of horizontal/vertical
      var scale_h = jQuery(window).width() / vid_w_orig;
      var scale_v = jQuery(window).height() / vid_h_orig;
      var scale = scale_h > scale_v ? scale_h : scale_v;

      // don't allow scaled width < minimum video width
      if (scale * vid_w_orig < min_w) {scale = min_w / vid_w_orig;};

      // now scale the video
      jQuery('video').width(scale * vid_w_orig);
      jQuery('video').height(scale * vid_h_orig);
      // and center it by scrolling the video viewport
      jQuery('#video-viewport').scrollLeft((jQuery('video').width() - jQuery(window).width()) / 2);
      jQuery('#video-viewport').scrollTop((jQuery('video').height() - jQuery(window).height()) / 2);
  };

  function registerUser(){
      $.ajax({
          type: "POST",
          url: "{{route('register')}}",
          datatype : "json", 
          data: $("#form-register-user").serialize(), 
          success:function(data){
            swal.fire({
                title: "Register Account Success!",
                text: "You will be redirected to the login page",
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: "Ok",
                showLoaderOnConfirm: true                    
            })
            .then((result) => {
              window.location.href = "{{route('login')}}"
            })
          }
      });
  }
</script>

@endsection

@endsection
