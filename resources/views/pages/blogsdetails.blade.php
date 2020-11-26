@extends("app")

@section('head_title', 'All Jobs | '.getcong('site_name') )
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
            <div class="page-title">
              <h2>All Blogs</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">All Blogs</li>
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
          <!-- begin:article -->
          <div class="col-md-12 col-sm-12">
            <!-- begin:product -->
            <div class="row container-realestate">
           	  @foreach($blogs as $i => $job)
             	 <div class="col-md-2 col-sm-6 col-xs-12">
                     <div class="job-container">
                         <a href="{{URL::to('blog/'.$job->id)}}">
                             <div class="job-image">
                                 @if(isset($job->image) && $job->image)
                                     <img src="{{ URL::asset('upload/blogs/'.$job->image.'.jpg') }}" alt="{{ $job->details }}">
                                 @else
                                     <img src="{{ URL::asset('upload/noImage.png') }}" alt="{{ $job->details }}">
                                 @endif
                             </div>
                         </a>
                         <div class="job-content">
                             <p>{{ Str::limit($job->details,20) }}</p>
                         </div>
                     </div>
                 </div>
              <!-- break -->
           	  @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:content -->
@endsection
