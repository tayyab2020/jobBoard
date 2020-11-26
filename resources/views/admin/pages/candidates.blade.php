@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		<h2>Saved Candidates</h2>
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
	                <th>Candidate ID</th>
	                <th>Candidate Name</th>
					<th>Saving Date</th>
					<th>Action</th>
	            </tr>
            </thead>
            <tbody>
            @php
            @endphp
            @foreach($candidateslist as $i => $job)
                <tr>
                <td><a  style="cursor: pointer" href="{{ URL::to('employer/details/'.$job->id) }}">{{ $job->id }}</a></td>
                <td><div class="row"><a  style="cursor: pointer" href="{{ URL::to('employer/details/'.$job->id) }}">{{ $job->candidate_name }}</a></div></td>
				<td>{{ date_format($job->created_at,"d-M-Y") }}</td>
                <td class="text-center">
                    <a href="{{ url('admin/candidate/delete/'.$job->id.'/'.$job->candidate_id) }}" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="md md-delete"></i> Delete</a>
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
