@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">

		<h2>Inquiries</h2>
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
	                <th>User ID</th>
	                <th>Creation Date</th>
	                <th class="text-center width-100">Action</th>
	            </tr>
            </thead>

            <tbody>
            @foreach($jobs as $i => $job)
         	   <tr>
                <td><a href="{{ URL::to('/jobs/'.$job->job_slug) }}">{{ $job->id }}</a></td>
                <td><a href="{{ URL::to('/jobs/'.$job->job_slug) }}">{{ $job->user_id }}</a></td>
                <td>{{ $job->created_at }}</td>
                <td class="text-center">
                	<a href="{{ url('admin/savedjobs/delete/'.$job->id.'/'.$job->job_slug) }}" class="btn btn-default btn-rounded"><i class="md md-delete"></i></a>
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
