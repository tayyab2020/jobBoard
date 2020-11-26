@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ isset($blog->text) ? 'Edit Blog' : 'Add Blog' }}</h2>

		<a href="{{ URL::to('admin/blogs') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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
                <span aria-hidden="true">&times;</span>
           </button>
           {{ Session::get('flash_message') }}
        </div>
	@endif

   	<div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('url' => array('admin/blogs/saveblog'),'class'=>'form-horizontal padding-15','name'=>'blog_form','id'=>'blog_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                <input type="hidden" name="id" value="{{ isset($blog->id) ? $blog->id : null }}">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Blog Text</label>
                      <div class="col-sm-9">
                          <textarea type="text" name="text" class="form-control">
                              {{isset($blog->details) ? $blog->details : null}}
                          </textarea>
                      </div>
                    <br>
                    <br>
                    <label for="" class="col-sm-3 control-label">Blog Image</label>
                      <div class="col-sm-9">
                        <input type="file" name="image" class="form-control" accept="image/x-png,image/gif,image/jpeg" />
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">{{ isset($blog->id) ? 'Edit Blog ' : 'Add Blog' }}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


</div>

@endsection
