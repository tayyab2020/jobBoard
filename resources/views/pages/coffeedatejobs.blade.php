@extends("app")

@section('head_title', 'Jobs For Sale | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

 <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="page-title">
              <h2>Jobs For Sale</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">Jobs For Sale</li>
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
          <div class="col-md-9 col-md-push-3">

            <!-- begin:product -->
            <div class="row container-realestate">
           	  @foreach($jobs as $i => $job)
             	 <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="job-container">
              <div class="job-image">

                <img src="{{ URL::asset('upload/members/'.$job->featured_image.'-s.jpg') }}" alt="{{ $job->job_name }}">
                <div class="job-price">
                  <h4>{{ getJobTypeName($job->job_type)->types }}</h4>
                  <span>{{getcong('currency_sign')}}@if($job->sale_price) {{$job->sale_price}} @else {{$job->rent_price}} @endif</span>
                </div>
                <div class="job-status">
                  <span>For {{$job->job_purpose}}</span>
                </div>
              </div>
              <div class="job-features">
                <span><i class="fa fa-home"></i> {{$job->area}}</span>
                <span><i class="fa fa-hdd-o"></i> {{$job->bedrooms}}</span>
                <span><i class="fa fa-male"></i> {{$job->bathrooms}}</span>
              </div>
              <div class="job-content">
                <h3><a href="{{URL::to('jobs/'.$job->job_slug)}}">{{ Str::limit($job->job_name,35) }}</a> <small>{{ Str::limit($job->address,40) }}</small></h3>
              </div>
            </div>
          </div>
              <!-- break -->
           	  @endforeach


            </div>
            <!-- end:product -->

            <!-- begin:pagination -->
            @include('_particles.pagination', ['paginator' => $jobs])
            <!-- end:pagination -->
          </div>
          <!-- end:article -->

          <!-- begin:sidebar -->
          @include('_particles.sidebar')
          <!-- end:sidebar -->

        </div>
      </div>
    </div>
    <!-- end:content -->

@endsection
