@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ isset($applicationtip->name) ? 'Edit: '. $applicationtip->name : 'Add applicationtip' }}</h2>

		<a href="{{ URL::to('admin/applicationtips') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

	</div>
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
	 @if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
	@endif

   	<div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('url' => array('admin/applicationtips/addapplicationtip'),'class'=>'form-horizontal padding-15','name'=>'addapplicationtip_form','id'=>'addapplicationtip_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                <input type="hidden" name="id" value="{{ isset($applicationtip->id) ? $applicationtip->id : null }}">


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" value="{{ isset($applicationtip->name) ? $applicationtip->name : null }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">applicationtip</label>
                    <div class="col-sm-9">

						<textarea name="applicationtip" class="form-control">{{ isset($applicationtip->testimonial) ? $applicationtip->testimonial : null }}</textarea>
                    </div>
                </div>

				<div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">Client Image</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(isset($applicationtip->t_user_image))
									<img src="{{ URL::asset('upload/applicationtip/'.$applicationtip->t_user_image.'.jpg') }}" width="100" alt="person">
								@endif

                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="t_user_image" class="filestyle">
                            </div>
                        </div>

                    </div>
                </div>



                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">{{ isset($applicationtip->name) ? 'Edit applicationtip' : 'Add applicationtip' }}</button>

                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


</div>

@endsection
