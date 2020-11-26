@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">

		<div class="pull-right">
			<a href="{{URL::to('admin/jobs/addjob')}}" class="btn btn-primary">Add Job <i class="fa fa-plus"></i></a>
		</div>
		<h2>Jobs</h2>
	</div>
	@if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
	@endif

<div class="panel panel-default panel-shadow">
    <div class="panel-body">

        <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
            <thead>
	            <tr>
	                <th>Job ID</th>
{{--	                <th>Agent</th>--}}
	                <th>Job Name</th>
                    <th><i class="fa fa-eye"></i></th>
	                <th><i class="fa fa-heart-o"></i></th>
					<th>Type</th>
					<th>Posting Date</th>
{{--					<th>Total Inquiries</th>--}}
	                <th class="text-center">Status</th>
	                <th class="text-center width-100">Action</th>
	            </tr>
            </thead>

            <tbody>
            @php
                $jobslist=$data['Jobs'];
            $inquirieslist=$data['inquiries'];
            @endphp
            @foreach($jobslist as $i => $job)
                @php
                  $inquiries_job=0;
                foreach($inquirieslist as $j => $inquiry){
                    if($inquiry->job_id==$job->id){
                        $inquiries_job++;
                    }
                }
                @endphp

                <tr>
                    <td><a  style="cursor: pointer" href="{{ URL::to('/admin/inquiries') }}">{{ $job->id }}</a></td>
{{--				<td>{{ getUserInfo($job->user_id)->name }}</td>--}}
{{--                    <td><a  style="cursor: pointer" href="{{ URL::to('/admin/inquiries') }}">{{ Auth::user()->fname.' '.Auth::user()->lname }}</a></td>--}}
                <td>
                    <div class="row"><a  style="cursor: pointer" href="{{ URL::to('/admin/inquiries') }}">{{ $job->job_name }}</a></div>
                    @if($inquiries_job)
                        <div class="row">
                            <a  style="cursor: pointer; color: black" href="{{ URL::to('/admin/inquiries') }}"> Received Inquiries <span style="color: white;padding: 4px;border-radius:20%;font-size: 14px;text-decoration:none;font-family: Arial;background-color: #f44336;">{{$inquiries_job}}</span></a>
                        </div>
                    @endif
                </td>
				<td>{{ $job->views }}</td>
				<td>{{ $job->saved_jobs }}</td>
				<td>{{ getJobTypeName($job->job_type)->types }}</td>
				<td>{{ date_format($job->created_at,"d-M-Y") }}</td>
{{--                <td><a  style="cursor: pointer" href="{{ URL::to('/admin/inquiries') }}">{{$inquiries_job}}</a></td>--}}
				<td class="text-center">
                    @if($job->status==1)
                        <span class="icon-circle bg-green">
                            <i class="md md-check"></i>
                        </span>
                    @else
                        <span class="icon-circle bg-orange">
                            <i class="md md-close"></i>
                        </span>
                    @endif
            	</td>
                <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Actions <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href="{{ url('admin/jobs/addjob/'.$job->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                        <li>
                            @if($job->featured_job==0)
                            <a href="{{ url('admin/jobs/urgentjob/'.$job->id) }}"><i class="md md-star"></i> Set as Urgent</a>
                            @else
                            <a href="{{ url('admin/jobs/urgentjob/'.$job->id) }}"><i class="md md-check"></i> Unset from Urgent</a>
                            @endif
                        </li>
                        <li>
                            @if($job->status==1)
                            <a href="{{ url('admin/jobs/status/'.$job->id) }}"><i class="md md-close"></i> Unpublish</a>
                            @else
                            <a href="{{ url('admin/jobs/status/'.$job->id) }}"><i class="md md-check"></i> Publish</a>
                            @endif
                        </li>
                        <li><a href="{{ url('admin/jobs/delete/'.$job->id) }}" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="md md-delete"></i> Delete</a></li>
                    </ul>
                </div>
            </td>
            </tr>
           @endforeach
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
</div>

</div>



@endsection
