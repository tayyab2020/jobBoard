@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">

		<div class="pull-right">
			<a href="{{URL::to('admin/blogs/addblog')}}" class="btn btn-primary">Add Blog <i class="fa fa-plus"></i></a>
		</div>
		<h2>Cities</h2>
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
	                <th>text</th>
	                <th>Image</th>
	                <th class="text-center width-100">Action</th>
	            </tr>
            </thead>

            <tbody>
            @foreach($allblogs as $i => $blog)
         	   <tr>
                <td>{{ $blog->details }}</td>
                <td>
                    @if(isset($blog->image))
                        <img src="{{ URL::asset('upload/blogs/'.$blog->image.'.jpg') }}" style="padding-top: 5px; width: 50px; height: 50px" alt="{{ $blog->text }}">
                    @endif
                </td>
                <td class="text-center">
                <div class="btn-group">
								<button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									Actions <span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li>
										@if($blog->status==1)
					                	<a href="{{ url('admin/blogs/status/'.$blog->id) }}"><i class="md md-close"></i> Unpublish</a>
					                	@else
					                	<a href="{{ url('admin/blogs/status/'.$blog->id) }}"><i class="md md-check"></i> Publish</a>
					                	@endif
									</li>
									<li><a href="{{ url('admin/blogs/updateblog/'.$blog->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
									<li><a href="{{ url('admin/blogs/delete/'.$blog->id) }}"><i class="md md-delete"></i> Delete</a></li>
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
