@extends("app")
@section("content")
@include("_particles.slidersearch")
<style>
    .warning {background-color: #ff9800;}
</style>
<!-- begin:content -->
    <div id="content">
      <div class="container">
        <!-- begin:latest -->
        <div class="row">
          <div class="col-sm-9">
            <div class="heading-title">
              <h2>Check ze allemaal hier!</h2>
            </div>
              @foreach($jobslist as $i => $job)
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
{{--                                  <img style="cursor: pointer" title="Job Posted {{$days}} Days Ago" src="{{ URL::asset('assets/img/new.png') }}" width="20%" alt="New-Job">--}}
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
          <div class="col-sm-3">
            <div class="heading-title">
              <h2>Top Members</h2>
            </div>
              @foreach($topemployers as $j => $agent)
                  <div class="col-md-12">
                      <div class="row" style="background-color: white; border-bottom: 1px grey;">
                          <a href="{{URL::to('employer/details/'.$agent->id)}}" style="cursor: pointer">
                              <div class="col-sm-6">
                                  <div class="team-image">
                                      @if($agent->image_icon)
                                          <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" style="padding-top: 5px" alt="{{ $agent->name }}">
                                      @else
                                          <img src="{{ URL::asset('upload/noImage.png') }}" style="padding-top: 5px" alt="{{ $agent->name }}">
                                      @endif
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="team-description">
                                      <div class="row">
                                          <h3>{{$agent->fname}}</h3>
                                      </div>
                                      <div class="row">
                                          <h3 style="color: darkgrey">{{$agent->created_jobs}} Job(s)</h3>
                                      </div>
                                  </div>
                              </div>
                          </a>
                      </div>
                  </div>
              @endforeach
          </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <div class="row">

                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">

                </div>
            </div>
        </div>
        <!-- end:latest -->
      </div>
    </div>
    <!-- end:content -->

    @include("_particles.testimonials")

    @include("_particles.partners")

{{--	@include("_particles.subscribe")--}}



@endsection
