<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Jobhart.nl</title>


    <style>

        @media (max-width: 768px)
        {
            #res
            {
                width: 90% !important;
            }
        }

    </style>

</head>
<body>

<div style="background: #dce36d;width: 50%;padding: 20px;border-radius: 20px;" id="res">

    <div class="row container-realestate">
        @if(count($jobs))
            <p style="color: black;">Hi User, We have found following jobs for your Saved Job Alert</p>
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
            <p style="color: black;">Hi User, We couldn't found any job for your Saved Job Alert</p>
        @endif
    </div>

</div>


</body>
</html>
