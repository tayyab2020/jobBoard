@extends("app")

@section('head_title', 'Jobs | '.getcong('site_name') )
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
            <div class="row">&nbsp</div>
            <div class="row">&nbsp</div>
            <div class="row">&nbsp</div>
              <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">Search</li>
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
              <div class="col-md-3 col-sm-3 col-md-offset-4 col-xs-12" style="text-align:center">
                  @if(count($jobs))
                      <button type="button" class="btn btn-warning btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-bullhorn" aria-hidden="true"></i>&nbspCreate Job Alert for this Result</button>
                  @endif
              </div>
          </div>
          <br>
          {{--Modal COde here--}}
          <div class="container">
              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Job Alert Creation</h4>
                          </div>
                          <div class="modal-body">
                                  {!! Form::open(array('url' => array('savejobalert'),'class'=>'form-horizontal padding-15','name'=>'job_form','id'=>'job_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                                    <label>Email Address: </label>
                                    <input name="email" title="You will receive Emails on this Address" type="email" title="email" placeholder="Enter Email for Job Alert Receiving" value="{{isset(Auth::user()->email)?Auth::user()->email:''}}">
                                    <input name="keywords" title="Keywords" placeholder="Keywords" type="hidden" value="{{$inputs['keyword']}}">
                                    <input name="jobtype" placeholder="Job type" title="Job type" type="hidden" value="{{$inputs['type']}}">
                                    <input name="radius" placeholder="Radius" title="Radius" type="hidden" value="{{$inputs['radius']}}">
                                    <input name="address" placeholder="Address" title="Address" type="hidden" value="{{$inputs['address']}}" readonly>
                                    <input name="longitude" type="hidden" value="{{$inputs['address_longitude']}}">
                                    <input name="latitude" type="hidden" value="{{$inputs['address_latitude']}}">
                              <br>
                              <label>Job Alert Type: &nbsp</label>
                              <input type="radio" name="type" value="1">Weekly
                              <input type="radio" name="type" value="2">Monthly
                              <button type="submit" style="float: right">Create Job Alert</button>
                                  {!! Form::close() !!}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
{{--          End Modal Code--}}
        <div class="row">
          <!-- begin:article -->
          <div class="col-md-9 col-md-push-3">
            <!-- begin:product -->
            <div class="row container-realestate">
                @if(count($jobs))
                @foreach($jobs as $i => $job)
                <div class="col-md-6 col-sm-8 col-xs-12">
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
{{--                                <img style="cursor: pointer" title="Job Posted {{$days}} Days Ago" src="{{ URL::asset('assets/img/new.png') }}" width="20%" alt="New-Job">--}}
                            @endif
                        </div>
                        <div class="job-content">
                            <h3><a href="{{URL::to('jobs/'.$job->job_slug)}}">{{ Str::limit($job->job_name,35) }}</a> <small>{{ Str::limit($job->address,40) }}</small></h3>
                        </div>
                    </div>
                </div>
           	    @endforeach
                @else
                    <a href="{{ URL::to('/') }}" class="btn btn-default">Go to Home</a>
                    <label style="text-align: center">&nbspSorry No Job found...</label>
                @endif
            </div>
            <!-- end:product -->
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
