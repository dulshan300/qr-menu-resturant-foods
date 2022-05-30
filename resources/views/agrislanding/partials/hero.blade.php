<!-- -------- START HEADER 1 w/ text and image on right ------- -->
<header>
  <div class="page-header section-height-100">
    <div class="oblique position-absolute top-0 h-100 d-md-block d-none">
      <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url(https://i.imgur.com/jwSX6NL.jpg)"></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-7 d-flex justify-content-center flex-column">
          @if (session('status'))
            <script>
              function showModalPostRegister(){
               $('#modal-notification').modal('show');
              }
             </script>
          @else
            <script>
              function showModalPostRegister(){}
            </script>
          @endif
          
          @if(auth()->user()&&auth()->user()->hasRole('admin'))
            <h1 key="hero_title" id="hero_title" class="text-gradient text-success ckedit">{{ __('agrislanding.hero_title') }}</h1>
          @else
            <h1 class="text-gradient text-success">{{ __('agrislanding.hero_title') }}</h1>
          @endif
          @if(auth()->user()&&auth()->user()->hasRole('admin'))
            <h1 class="mb-4 ckedit" key="hero_subtitle" id="hero_subtitle">{{ __('agrislanding.hero_subtitle') }}</h1>
          @else
            <h1 class="mb-4">{{ __('agrislanding.hero_subtitle') }}</h1>
          @endif
          @if(auth()->user()&&auth()->user()->hasRole('admin'))
            <p class="lead pe-5 me-5 ckedit" key="hero_description" id="hero_description">{{ __('agrislanding.hero_description') }}</p>
          @else
            <p class="lead pe-5 me-5">{{ __('agrislanding.hero_description') }}</p>
          @endif
          <div class="buttons">
            <button onclick="$('#modal-register').modal('show')" type="button" class="btn bg-gradient-success mt-4">{{ __('agrislanding.hero_button1') }}</button>
            <a href="#product" type="button" class="btn text-success shadow-none mt-4">{{ __('agrislanding.hero_button2') }}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- -------- END HEADER 1 w/ text and image on right ------- -->