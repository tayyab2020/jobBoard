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
              <h2>Sinlge Blog Detail</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">Blog</li>
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
             	 <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="job-container">
                         <div class="job-image col-sm-3 col-xs-3 col-md-3" >
                             @if(isset($blog->image) && $blog->image)
                                 <img src="{{ URL::asset('upload/blogs/'.$blog->image.'.jpg') }}">
                             @else
                                 <img src="{{ URL::asset('upload/noImage.png') }}">
                             @endif
                         </div>
                         <div class="job-content  col-sm-9 col-xs-9 col-md-9">
                             <p>{{$blog->details}}</p>
                         </div>
                     </div>
                 </div>
              <!-- break -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:content -->
@endsection
