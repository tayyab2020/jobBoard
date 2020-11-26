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
              <h2>All Jobs</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">All Jobs</li>
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
                             @if(isset($job->job_image) && $job->job_image)
                                 <img src="{{ URL::asset('upload/members/'.$job->job_image.'-b.jpg') }}" alt="{{ $job->title }}">
                             @else
                                 <img src="{{ URL::asset('upload/noImage.png') }}" alt="{{ $job->title }}">
                             @endif
                             <div class="job-price">
                                 <h4>{{ getJobTypeName($job->job_type)->types }}</h4>
                                 @if($job->urgent=='on')
                                     <span class="label warning" title="Urgent Hiring">Priority</span>
                                 @endif
                             </div>
                             @php
                                 $job_post_date = strtotime($job->created_at->format('Y-m-d'));
                                 $date = new DateTime("now", new DateTimeZone('Europe/Amsterdam') );
                                 $today_date = strtotime($date->format('Y-m-d'));
                                 $secs = $today_date - $job_post_date ;// == <seconds between the two times>
                                 $days = $secs / 86400;
                             @endphp
                             <div class="job-status">
                                 <span>For {{$job->qualification}}</span>
                             </div>
                         </div>
                         <div class="job-features">
                             @if($days>0 && $days<7)
                                 <span class="label warning" title="Urgent Hiring" title="Job Posted {{$days}} Days Ago">New</span>
{{--                                 <img style="cursor: pointer" title="Job Posted {{$days}} Days Ago" src="{{ URL::asset('assets/img/new.png') }}" width="20%" alt="New-Job">--}}
                             @endif
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
