@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">


		<h2>Urgent Jobs</h2>
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
	                <th>Job Name</th>
					<th>Type</th>
					<th>Purpose</th>

	                <th class="text-center width-100">Action</th>
	            </tr>
            </thead>

            <tbody>
            @foreach($jobslist as $i => $job)
         	   <tr>

				<td>{{ $job->id }}</td>
                <td>{{ $job->job_name }}</td>
				<td>{{ $job->job_type }}</td>
				<td>{{ $job->job_purpose }}</td>

                <td class="text-center">
                <div class="btn-group">
								<button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									Actions <span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="{{ url('admin/jobs/addjob/'.$job->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
									<li>
										@if($job->featured_job==0)
					                	<a href="{{ url('admin/jobs/featuredjob/'.$job->id) }}"><i class="md md-star"></i> Set as Urgent</a>
					                	@else
					                	<a href="{{ url('admin/jobs/featuredjob/'.$job->id) }}"><i class="md md-check"></i> Unset from Urgent</a>
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
