@extends("app")

@section('head_title', 'All Jobs | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
    <style>
        .warning {background-color: #ff9800;}
    </style>
 <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="page-title">
              <h2>Application Tips</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">Application Tips</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end:header -->

    <!-- begin:content -->
    <div id="content">
      <div class="container">
        <div class="row">
          <!-- begin:article -->
          <div class="col-md-12 col-sm-12">
            <!-- begin:product -->
            <div class="row">
           	  @foreach($tips as $i => $job)
             	 <div class="row">
                     <div class="job-image col-sm-3">
                         @if(isset($job->t_user_image) && $job->t_user_image)
                             <img src="{{ URL::asset('upload/applicationtip/'.$job->t_user_image.'.jpg') }}" alt="{{ $job->details }}">
                         @else
                             <img src="{{ URL::asset('upload/noImage.png') }}" alt="{{ $job->name }}">
                         @endif
                     </div>
                     <div class="col-sm-9">
                         <h3>{{$job->name}}</h3>
                         <br>
                         <div class="job-content">
                             <p>{{ Str::limit($job->testimonial,50) }}</p>
                         </div>
                     </div>
                 </div>
              <!-- break -->
           	  @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:content -->
@endsection
