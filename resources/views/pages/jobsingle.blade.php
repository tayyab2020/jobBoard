@extends("app")

@section('head_title', $job->job_name .' | '.getcong('site_name') )
@section('head_description', substr(strip_tags($job->description),0,200))
@section('head_image', asset('/upload/members/'.$job->featured_image.'-b.jpg'))
@section('head_url', Request::url())

@section("content")

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=220960685988040&autoLogAppEvents=1"></script>
    <script src="https://kit.fontawesome.com/29532268c4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">

<!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="page-title">
              <h2>{{$job->job_name}}</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li><a href="{{ URL::to('jobs/') }}">Jobs</a></li>
              <li class="active">{{$job->job_name}}</li>
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
          <div class="col-md-9 col-md-push-3">
            <div class="row">
              <div class="col-md-12 single-post">
                <ul id="myTab" class="nav nav-tabs nav-justified">
                  <li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-university"></i> Job Detail</a></li>
                  <li><a href="#location" data-toggle="tab"><i class="fa fa-paper-plane-o"></i> Contact</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade in active" id="detail">
                    <div class="row">
                      <div class="col-md-12">
                          <h3>
                              <left style="float: left">
                                  Job Overview
                              </left>
                          </h3> <br>
                          <h2>
                              <left style="float: left">
                                  {{$job->job_name}}
                              </left>
                              @php
                                  $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                  $actual_link_whatsapp="https://api.whatsapp.com/send?text=".$actual_link;
                              @endphp
                          </h2>
                          <br>
                          <div id="slider-job" class="carousel slide" data-ride="carousel">

                          <div class="carousel-inner">
                            @if($job->job_image)
                            <div class="item active">
                              <img src="{{ URL::asset('upload/members/'.$job->job_image.'-b.jpg') }}" alt="">
                            </div>
                            @else
                              <div class="item active">
                                  <img src="{{ URL::asset('upload/noImage.png') }}" alt="">
                              </div>
                            @endif

                            {{--@if($job->job_images1)
                            <div class="item">
                              <img src="{{ URL::asset('upload/members/'.$job->job_images1.'-b.jpg') }}" alt="">
                            </div>
                            @endif

                             @if($job->job_images2)
                            <div class="item">
                              <img src="{{ URL::asset('upload/members/'.$job->job_images2.'-b.jpg') }}" alt="">
                            </div>
                            @endif

                             @if($job->job_images3)
                            <div class="item">
                              <img src="{{ URL::asset('upload/members/'.$job->job_images3.'-b.jpg') }}" alt="">
                            </div>
                            @endif

                             @if($job->job_images4)
                            <div class="item">
                              <img src="{{ URL::asset('upload/members/'.$job->job_images4.'-b.jpg') }}" alt="">
                            </div>
                            @endif

                             @if($job->job_images5)
                            <div class="item">
                              <img src="{{ URL::asset('upload/members/'.$job->job_images5.'-b.jpg') }}" alt="">
                            </div>
                            @endif--}}



                          </div>
                          <a class="left carousel-control" href="#slider-job" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                          </a>
                          <a class="right carousel-control" href="#slider-job" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                          </a>
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 18px; padding: 10px 0px;">
                              <div class="col-sm-4 col-md-4 col-s=lg-4 col-xs-4">
                                  <span style="margin-right: 12px;" title="Views">
                                      {{$job->views}} <i class="fa fa-eye" aria-hidden="true" style="position: relative;top: 3px;" ></i>
                                  </span>
                              </div>
                              <div class="col-sm-4 col-md-4 col-s=lg-4 col-xs-4" style="text-align:center;">
                                @if( isset(Auth::user()->usertype) && Auth::user()->usertype == 'candidate')
                                      {!! Form::open(array('url'=>'admin/savejob','method'=>'POST', 'id'=>'save_job_form')) !!}
                                      <meta name="_token" content="{!! csrf_token() !!}"/>
                                      <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                      <input type="hidden" name="job_slug" value="{{$job->job_slug}}">
                                      <button type="submit" title="{{$job->saved_jobs}} jobs has been saved, Click To Save Job as well" style="margin-left: 30%" class="btn btn-success" id="saveJob">
                                          {{$job->saved_jobs}}&nbsp<i class="fa fa-heart-o" ></i>
                                      </button>
                                      {!! Form::close() !!}
                                  @else
                                      <a href="{{ URL::to('/login') }}" >
                                          @if($job->saved_jobs){{$job->saved_jobs}}&nbsp<i class="fa fa-heart" title="{{$job->saved_jobs}} has been saved by candidates, Click to Save job"></i>
                                          @else <i class="fa fa-heart" title="Be First to Save this job"></i>
                                          @endif
                                      </a>
                                  @endif
                              </div>
                              <div class="col-sm-4 col-md-4 col-s=lg-4 col-xs-4" style="text-align: right">
                                  <?php $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
                                  <span style="margin-left: 5%;"><a target="_blank" title="Share by Whatsapp" href="https://api.whatsapp.com/send?text={{$url}}"><i class="fa fa-whatsapp" aria-hidden="true" style="font-size: 16px;position: relative;top: 3px;"></i></a></span>
                                  <span style="margin-left: 5px;"><a target="_blank" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{$url}}"><i class="fa fa-facebook" aria-hidden="true" style="font-size: 16px;color: #7191d3;position: relative;top: 3px;"></i></a></span>
                                  <span style="margin-left: 5px;"><a target="_blank" title="Share by Email" href="mailto:?subject=I wanted you to see this Property AD I just Found on zoekjehuisje.nl&amp;body=Check out this link {{$url}}"><i class="far fa-envelope" aria-hidden="true" style="font-size: 16px;color:goldenrod;position: relative;top: 3px;"></i></a></span>
                              </div>
                          </div>
                        </div>
                        <table class="table table-bordered">
                          <tr>
                            <td width="20%"><strong>ID</strong></td>
                            <td>#{{$job->id}}</td>
                          </tr>
                          <tr>
                            <td><strong>Salary</strong></td>
                            <td>{{getcong('currency_sign')}}{{number_format($job->salary)}}</td>
                          </tr>
                          <tr>
                            <td><strong>Job Type</strong></td>
                            <td>{{ getJobTypeName($job->job_type)->types }}</td>
                          </tr>
                          <tr>
                            <td><strong>Minimum Experience</strong></td>
                            <td>
                                @if($job->experience==1)  0-1 Years
                                @elseif($job->experience==3) 1-3 Years
                                @elseif($job->experience==5) 3-5 Years
                                @elseif($job->experience>5) 5+ Years
                                @endif
                            </td>
                          </tr>
                          <tr>
                            <td><strong>Career Level</strong></td>
                            <td>{{$job->career_level}}</td>
                          </tr>
                          <tr>
                            <td><strong>Location</strong></td>
                            <td>{{$job->address}}</td>
                          </tr>
                          <tr>
                            <td><strong>Qualification</strong></td>
                            <td>{{$job->qualification}}</td>
                          </tr>
                          <tr>
                            <td><strong>Education Attainment</strong></td>
                            <td>{{$job->education_attainment}}</td>
                          </tr>
                          <tr>
                            <td><strong>Specialism</strong></td>
                            <td>{{$job->specialism}}</td>
                          </tr>
                          <tr>
                            <td><strong>Job Post Date</strong></td>
                            <td>{{date('F d, Y', strtotime($job->created_at))}}</td>
                          </tr>
                          <tr>
                            <td><strong>Dead Line for Application</strong></td>
                              @php
                              if(isset($job->deadlineDate)){
                                $deadline = strtotime($job->deadlineDate);
                                $date = new DateTime("now", new DateTimeZone('Europe/Amsterdam') );
                                $today_date = strtotime($date->format('Y-m-d'));
                                $secs = $deadline - $today_date;// == <seconds between the two times>
                                $days = $secs / 86400;
                                $hours = $days/24;
                                $mins = $hours/60;
                                if($days>0){
                                    $difference=$days.' Days Remaining';
                                }else if($days==0 && $hours>0){
                                    $difference=$hours.' Hours Remaining';
                                }else if($hours==0 && $mins>0){
                                    $difference=$mins.' Minutes Remaining';
                                }
                                else{
                                    $difference='Expired';
                                }
                            }
                            else{
                                $difference='Expired';
                            }
                              @endphp
                            <td title="{{$difference}}">
                                <span>
                                    {{$job->deadlineDate}}
                                </span>
                                <div id="candidate_div">
                                    <span style="float: right">
                                      @if($difference!='Expired')
                                          <a href="https://{{$job->link}}">
                                              <button class="btn btn-success">
                                                  Apply Now
                                              </button>
                                          </a>
                                      @else
                                        <button class="btn btn-success" >
                                            Expired
                                        </button>
                                      @endif
                                    </span>
                                </div>
                            </td>
                          </tr>
                        </table>
                          {{--@if($job->job_features)
                            <h3>Job Features</h3>
                            <div class="row">
                                <ul style="list-style: none;">
                                  @foreach(explode(',',$job->job_features) as $features)
                                  <li class="col-md-3 col-sm-3"><i class="fa fa-check"></i> {{$features}}</li>
                                  @endforeach
                                </ul>
                            </div>
                              @endif--}}
                        <h3>Job Description</h3>
                        {!!$job->description!!}
                          <input type="hidden" name="map_latitude" id="map_latitude" value="{{$job->map_latitude}}">
                          <input type="hidden" name="map_longitude" id="map_longitude" value="{{$job->map_longitude}}">
                          <input type="hidden" name="city" id="city" value="{{$job->address}}">
                          <input type="hidden" name="type" id="type" value="shopping_mall">
                          <div class="row" style="border-top:1px solid rgba(190, 190, 190, 0.6); margin-top: 40px;">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div style="padding: 20px;">
                                          <div class="row">
                                              <div class="col-sm-12">
                                                  {{--<div class="carousel box-carousel d-none d-sm-block" style="display: flex;">
                                                      <div class="box background-active" data-type="shopping_mall">
                                                          <a><i class="fas fa-shopping-cart" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Malls</a>
                                                      </div>
                                                      <div class="box" data-type="school">
                                                          <a><i class="fas fa-graduation-cap" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Schools</a>
                                                      </div>
                                                      <div class="box" data-type="bank">
                                                          <a><i class="fas fa-university" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Banks</a>
                                                      </div>
                                                      <div class="box" data-type="hospital">
                                                          <a><i class="fas fa-hospital" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Hospitals</a>
                                                      </div>
                                                      <div class="box" data-type="bakery">
                                                          <a><i class="fas fa-birthday-cake" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Bakery</a>
                                                      </div>
                                                  </div>--}}<!-- carousel-->
                                              </div><!--col-->
                                          </div><!--row-->
                                      <div style="height: 350px;">
                                          {{--<div id="panel" style="width: 30%;height: 100%;float: left;border: 1px solid rgba(190, 190, 190, 0.6);overflow-y: scroll;">
                                              <div style="padding: 10px;border-bottom: 1px solid rgba(190, 190, 190, 0.6);">
                                                  <span style="display: block;">Malls</span>
                                                  <span style="display: block;"></span>
                                              </div>
                                          </div>--}}
                                          <div style="width: 100%;height: 100%;float: left;">
                                              <div id="map"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <style>
                              #map {
                                  height: 100%;
                                  background-color: grey;
                              }

                              .box {
                                  width: 150px;
                                  height: 90px;
                                  background-color: transparent;
                              }
                              .box a {
                                  color: #461e52;
                                  display: block;
                                  width: 100%;
                                  height: 100%;
                                  font-size: 16px;
                                  font-weight: 700;
                                  padding: 10% 30px 0 30px;
                                  text-align: center;
                                  transition: none;
                                  line-height: 1;
                                  font-family: 'Open Sans Condensed', Arial, Verdana, sans-serif;
                                  outline: none;
                              }
                              .box:hover{
                                  background-color: #461e52;
                                  cursor: pointer;
                              }

                              .background-active{
                                  background-color: #461e52;
                              }

                              .background-active a{
                                  color:#fff;
                                  text-decoration:none;
                              }


                              .box:hover a{
                                  color:#fff;
                                  text-decoration:none;
                              }
                              .mission-next-arrow {
                                  position: absolute;
                                  background: url(https://raw.githubusercontent.com/solodev/icon-box-slider/master/nextarrow2.png) no-repeat center;
                                  background-size: contain;
                                  top: 50%;
                                  transform: translateY(-50%);
                                  right: -36px;
                                  height: 17px;
                                  width: 10px;
                                  border:none;
                                  outline: none;
                              }
                              .mission-next-arrow:hover {
                                  cursor: pointer;
                              }
                              .mission-prev-arrow {
                                  background: url(https://raw.githubusercontent.com/solodev/icon-box-slider/master/prevarrow2.png) no-repeat center;
                                  background-size: contain;
                                  position: absolute;
                                  top: 50%;
                                  transform: translateY(-50%);
                                  left: -36px;
                                  height: 17px;
                                  width: 10px;
                                  border:none;
                                  outline: none;
                              }
                              .mission-prev-arrow:hover {
                                  cursor: pointer;
                              }
                              .box a.more-links {
                                  color: #fff;
                                  padding: 70px 110px 0 20px;
                                  background: #a89269 url(https://raw.githubusercontent.com/solodev/icon-box-slider/master/rightarrow.png) no-repeat 155px 170px;
                              }



                          </style>

                          <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

                          <script>
                              $( document ).ready(function() {

                                  $(".box").on('click', function() {

                                      $(this).parent().find('.box').removeClass('background-active');

                                      $(this).addClass('background-active');

                                      var type = $(this).data('type');

                                      infoWindow = new google.maps.InfoWindow;

                                      handleLocationError(false, infoWindow,type);

                                  });



                                  let pos;
                                  let map;
                                  let bounds;
                                  let infoWindow;
                                  let currentInfoWindow;
                                  let service;
                                  let infoPane;
                                  var markers = new Array();
                                  var type = $('#type').val();


                                  function initMap() {
                                      // Initialize variables
                                      bounds = new google.maps.LatLngBounds();
                                      infoWindow = new google.maps.InfoWindow;
                                      currentInfoWindow = infoWindow;
                                      /* TODO: Step 4A3: Add a generic sidebar */
                                      infoPane = document.getElementById('panel');

                                      handleLocationError(false, infoWindow,type);

                                      // Try HTML5 geolocation
                                      /*if (navigator.geolocation) {
                                          navigator.geolocation.getCurrentPosition(position => {
                                              pos = {
                                                  lat: position.coords.latitude,
                                                  lng: position.coords.longitude
                                              };
                                              map = new google.maps.Map(document.getElementById('map'), {
                                                  center: pos,
                                                  zoom: 15
                                              });
                                              bounds.extend(pos);

                                              infoWindow.setPosition(pos);
                                              infoWindow.setContent('Location found.');
                                              infoWindow.open(map);
                                              map.setCenter(pos);

                                              // Call Places Nearby Search on user's location
                                              getNearbyPlaces(pos);
                                          }, () => {
                                              // Browser supports geolocation, but user has denied permission
                                              handleLocationError(true, infoWindow);
                                          });
                                      } else {
                                          // Browser doesn't support geolocation
                                          handleLocationError(false, infoWindow);
                                      }*/
                                  }
                                  function agent_initMap() {
                                      // Initialize variables
                                      bounds = new google.maps.LatLngBounds();
                                      infoWindow = new google.maps.InfoWindow;
                                      currentInfoWindow = infoWindow;
                                      /* TODO: Step 4A3: Add a generic sidebar */
                                      agent_handleLocationError(false, infoWindow,type);
                                  }

                                  initMap();
                                  agent_initMap();



                                  // Handle a geolocation error
                                  function handleLocationError(browserHasGeolocation, infoWindow, type) {


                                      var lat = parseFloat(document.getElementById('map_latitude').value);
                                      var lng = parseFloat(document.getElementById('map_longitude').value);

                                      pos = { lat: lat, lng: lng };

                                      map = new google.maps.Map(document.getElementById('map'), {
                                          center: pos,
                                          zoom: 15
                                      });

                                      const marker = new google.maps.Marker({
                                          map: map,
                                          position: {lat: lat, lng: lng},
                                          draggable: false
                                      });


                                      marker.addListener('click', function() {

                                          var location = $('#city').val();

                                          infoWindow.setContent(location);
                                          infoWindow.open(map, marker);
                                          map.setZoom(15);
                                          map.setCenter(marker.getPosition());

                                      });

                                      // Display an InfoWindow at the map center
                                      infoWindow.setPosition(pos);
                                      /*infoWindow.setContent(browserHasGeolocation ?
                                          'Geolocation permissions denied. Using default location.' :
                                          'Error: Your browser doesn\'t support geolocation.');
                                      infoWindow.open(map);*/
                                      currentInfoWindow = infoWindow;

                                      // Call Places Nearby Search on the default location
                                      // getNearbyPlaces(pos,type);
                                  }
                                  function agent_handleLocationError(browserHasGeolocation, infoWindow, type) {


                                      var lat = parseFloat(document.getElementById('agent_latitude').value);
                                      var lng = parseFloat(document.getElementById('agent_longitude').value);

                                      pos = { lat: lat, lng: lng };

                                      map = new google.maps.Map(document.getElementById('agent-map'), {
                                          center: pos,
                                          zoom: 15
                                      });

                                      const marker = new google.maps.Marker({
                                          map: map,
                                          position: {lat: lat, lng: lng},
                                          draggable: false
                                      });


                                      marker.addListener('click', function() {

                                          var location = $('#agent_city').val();

                                          infoWindow.setContent(location);
                                          infoWindow.open(map, marker);
                                          map.setZoom(15);
                                          map.setCenter(marker.getPosition());

                                      });

                                      // Display an InfoWindow at the map center
                                      infoWindow.setPosition(pos);
                                      /*infoWindow.setContent(browserHasGeolocation ?
                                          'Geolocation permissions denied. Using default location.' :
                                          'Error: Your browser doesn\'t support geolocation.');
                                      infoWindow.open(map);*/
                                      currentInfoWindow = infoWindow;

                                      // Call Places Nearby Search on the default location
                                      // getNearbyPlaces(pos,type);
                                  }

                                  // Perform a Places Nearby Search Request
                                  function getNearbyPlaces(position,type) {

                                      let request = {
                                          location: position,
                                          radius: '1000',
                                          type: [type]
                                      };

                                      var new_type = capitalizeFirstLetter(type);

                                      function capitalizeFirstLetter(string) {
                                          return string.charAt(0).toUpperCase() + string.slice(1);
                                      }

                                      if(new_type != 'Bakery')
                                      {

                                          if(new_type != 'Shopping_mall')
                                          {
                                              new_type = new_type + 's';
                                          }
                                          else{

                                              new_type = 'Shopping Malls';

                                          }


                                      }
                                      else
                                      {

                                          new_type = 'Bakeries';


                                      }

                                      $("#panel div:eq(0)").children().first().text(new_type);


                                      service = new google.maps.places.PlacesService(map);
                                      service.nearbySearch(request, nearbyCallback);
                                  }

                                  // Handle the results (up to 20) of the Nearby Search
                                  function nearbyCallback(results, status) {

                                      if (status == google.maps.places.PlacesServiceStatus.OK) {

                                          $("#panel div:eq(0)").children().eq(1).text(results.length + ' results found');

                                          /*createMarkers(results);*/

                                          createMarkersDetails(results,pos);
                                      }
                                  }

                                  // Set markers at the location of each place result

                                  /*function createMarkers(places) {



                                      markers = new Array();

                                      var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';



                                      places.forEach(place => {


                                          let marker = new google.maps.Marker({
                                              position: place.geometry.location,
                                              map: map,
                                              icon: image,
                                              title: place.name
                                          });



                                          markers.push(marker);

                                          /!* TODO: Step 4B: Add click listeners to the markers *!/
                                          // Add click listener to each marker
                                          google.maps.event.addListener(marker, 'click', () => {
                                              let request = {
                                                  placeId: place.place_id,
                                                  fields: ['name', 'formatted_address', 'geometry', 'rating',
                                                      'website', 'photos']
                                              };

                                              /!* Only fetch the details of a place when the user clicks on a marker.
                                               * If we fetch the details for all place results as soon as we get
                                               * the search response, we will hit API rate limits. *!/


                                              /!*service.getDetails(request, (placeResult, status) => {
                                                  showDetails(placeResult, marker, status)
                                              });*!/

                                              showDetails(place.name, marker);

                                          });

                                          // Adjust the map bounds to include the location of this marker
                                          bounds.extend(place.geometry.location);
                                      });
                                      /!* Once all the markers have been placed, adjust the bounds of the map to
                                       * show all the markers within the visible area. *!/
                                      map.fitBounds(bounds);
                                  }*/


                                  function createMarkersDetails(places,position) {


                                      var i = 0;

                                      var length = places.length;

                                      markers = new Array();

                                      var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';


                                      $("#panel div").not(':first').remove();

                                      places.forEach(place => {


                                          var origin1 = new google.maps.LatLng(position.lat, position.lng);

                                          var destinationA = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());


                                          var service = new google.maps.DistanceMatrixService();

                                          service.getDistanceMatrix(
                                              {
                                                  origins: [origin1],
                                                  destinations: [destinationA],
                                                  travelMode: 'DRIVING',
                                                  avoidHighways: false,
                                                  avoidTolls: false,
                                              }, callback);


                                          function callback(response, status) {


                                              let marker = new google.maps.Marker({
                                                  position: place.geometry.location,
                                                  map: map,
                                                  icon: image,
                                                  title: place.name
                                              });



                                              markers.push(marker);

                                              /* TODO: Step 4B: Add click listeners to the markers */
                                              // Add click listener to each marker
                                              google.maps.event.addListener(marker, 'click', () => {
                                                  let request = {
                                                      placeId: place.place_id,
                                                      fields: ['name', 'formatted_address', 'geometry', 'rating',
                                                          'website', 'photos']
                                                  };

                                                  /* Only fetch the details of a place when the user clicks on a marker.
                                                   * If we fetch the details for all place results as soon as we get
                                                   * the search response, we will hit API rate limits. */


                                                  /*service.getDetails(request, (placeResult, status) => {
                                                      showDetails(placeResult, marker, status)
                                                  });*/

                                                  showDetails(place.name, marker);

                                              });

                                              // Adjust the map bounds to include the location of this marker
                                              bounds.extend(place.geometry.location);



                                              $("#panel div:eq(0)").after('<a data-id="'+i+'" href="javascript:void(0);" class="trigger"><div style="padding: 10px 0px 0px 10px;border-bottom: 1px solid rgba(190, 190, 190, 0.6);">\n' +
                                                  '                                                  <span style="display: block;">'+place.name+'</span>\n' +
                                                  '                                                  <span style="display: inline-block;"><i class="fas fa-tachometer-alt" aria-hidden="true" style="font-size: 15px;margin: 10px;float: left;"></i><p style="float: left;margin-top: 6px;margin-bottom: 0;">'+response.rows[0].elements[0].distance.text+'</p></span>\n' +
                                                  '                                              </div></a>');


                                              i = i + 1;

                                          }


                                          $(document).on("click", "a.trigger" , function() {

                                              google.maps.event.trigger(markers[$(this).data('id')], 'click');

                                          });

                                      });

                                  }





                                  /* TODO: Step 4C: Show place details in an info window */
                                  // Builds an InfoWindow to display details above the marker


                                  /*function showDetails(placeResult, marker, status) {
                                      if (status == google.maps.places.PlacesServiceStatus.OK) {
                                          let placeInfowindow = new google.maps.InfoWindow();
                                          let rating = "None";
                                          if (placeResult.rating) rating = placeResult.rating;
                                          placeInfowindow.setContent('<div><strong>' + placeResult.name +
                                              '</strong><br>' + 'Rating: ' + rating + '</div>');
                                          placeInfowindow.open(marker.map, marker);
                                          currentInfoWindow.close();
                                          currentInfoWindow = placeInfowindow;
                                         /!* showPanel(placeResult);*!/
                                      } else {
                                          console.log('showDetails failed: ' + status);
                                      }
                                  }*/

                                  function showDetails(placeName,marker) {

                                      let placeInfowindow = new google.maps.InfoWindow();

                                      placeInfowindow.setContent('<div><strong>' + placeName + '</strong></div>');
                                      placeInfowindow.open(marker.map, marker);
                                      currentInfoWindow.close();
                                      currentInfoWindow = placeInfowindow;


                                  }

                                  /* TODO: Step 4D: Load place details in a sidebar */
                                  // Displays place details in a sidebar
                                  function showPanel(placeResult) {
                                      // If infoPane is already open, close it
                                      if (infoPane.classList.contains("open")) {
                                          infoPane.classList.remove("open");
                                      }

                                      // Clear the previous details
                                      while (infoPane.lastChild) {
                                          infoPane.removeChild(infoPane.lastChild);
                                      }

                                      /* TODO: Step 4E: Display a Place Photo with the Place Details */
                                      // Add the primary photo, if there is one
                                      if (placeResult.photos) {
                                          let firstPhoto = placeResult.photos[0];
                                          let photo = document.createElement('img');
                                          photo.classList.add('hero');
                                          photo.src = firstPhoto.getUrl();
                                          infoPane.appendChild(photo);
                                      }

                                      // Add place details with text formatting
                                      let name = document.createElement('h1');
                                      name.classList.add('place');
                                      name.textContent = placeResult.name;
                                      infoPane.appendChild(name);
                                      if (placeResult.rating) {
                                          let rating = document.createElement('p');
                                          rating.classList.add('details');
                                          rating.textContent = `Rating: ${placeResult.rating} \u272e`;
                                          infoPane.appendChild(rating);
                                      }
                                      let address = document.createElement('p');
                                      address.classList.add('details');
                                      address.textContent = placeResult.formatted_address;
                                      infoPane.appendChild(address);
                                      if (placeResult.website) {
                                          let websitePara = document.createElement('p');
                                          let websiteLink = document.createElement('a');
                                          let websiteUrl = document.createTextNode(placeResult.website);
                                          websiteLink.appendChild(websiteUrl);
                                          websiteLink.title = placeResult.website;
                                          websiteLink.href = placeResult.website;
                                          websitePara.appendChild(websiteLink);
                                          infoPane.appendChild(websitePara);
                                      }

                                      // Open the infoPane
                                      infoPane.classList.add("open");
                                  }



                                  $('.box-carousel').slick({
                                      dots: false,
                                      arrows: true,
                                      slidesToShow: 4,
                                      slidesToScroll: 1,
                                      prevArrow: "<button type='button' class='mission-prev-arrow'></button>",
                                      nextArrow: "<button type='button' class='mission-next-arrow'></button>"
                                  });

                              });
                              <!-- GetButton.io widget -->

                          <!-- /GetButton.io widget -->
                          </script>

                      </div>

                    </div>
					<br/>
                    {!! getcong('disqus_comment_code') !!}

                  </div>
                  <!-- break -->
                  <div class="tab-pane fade" id="location">

                    <div class="row">
                      <div class="col-md-12">
                        <h3>Contact </h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="team-container team-dark">
                          <div class="team-image">
                            @if($agent->image_icon)
                            <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" alt="{{$agent->name}}">
                            @else
                            <img src="{{ URL::asset('upload/members/user-icon.jpg') }}" alt="{{$agent->name}}">
                            @endif
                          </div>
                          <div class="team-description">
                           <input type="hidden" name="agent_latitude" id="agent_latitude" value="{{$agent->map_latitude}}">
                           <input type="hidden" name="agent_longitude" id="agent_longitude" value="{{$agent->map_longitude}}">
                           <input type="hidden" name="agent_city" id="agent_city" value="{{$agent->address}}">
                            <h3>{{$agent->name}}</h3>
                            <p><i class="fa fa-phone"></i>&nbsp Phone : {{$agent->phone}}</p>
                            <p><i class="fa fa-envelope"></i>&nbsp Email : {{$agent->email}}</p>
                            <p><i class="fa fa-globe"></i>&nbsp<a style="color: white" href="https://{{$agent->website}}" target="_blank">See Website</a> </p>
                            @if($jobs_count>1)
                              <p><a style="color: white" href="{{ URL::to('/jobs/user/'.$agent->id.'/'.$job->id) }}" target="_blank">See Other {{$jobs_count-1}} Jobs posted by this Emloyer</a></p>
                            @endif
                            <div class="team-social">
                              <span><a href="https://{{$agent->twitter}}" title="Twitter" rel="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a></span>
                              <span><a href="https://{{$agent->instagram}}" title="Instagram" rel="tooltip" data-placement="top"><i class="fa fa-instagram"></i></a></span>
                              <span><a href="https://{{$agent->facebook}}" title="Facebook" rel="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a></span>
                              <span><a href="https://{{$agent->gplus}}" title="Google Plus" rel="tooltip" data-placement="top"><i class="fa fa-google-plus"></i></a></span>
                              <span><a href="https://{{$agent->youtube}}" title="You Tube" rel="tooltip" data-placement="top"><i class="fa fa-youtube"></i></a></span>
                              <span><a href="https://{{$agent->linkedin}}" title="LinkedIn" rel="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a></span>
                            </div>
                          </div>
                        </div>
                          @if($agent->review1_name || $agent->review2_name || $agent->review3_name)
                          <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                              <label>This is What Employees Say About This Company</label>
                              @if($agent->review1_name)
                                  <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                      <label title="{{$agent->review1_function}}">{{$agent->review1_name}} ({{$agent->review1_function}}) Says About This Company</label>
                                      <input type="text" class="form-control input-lg" readonly value="{{$agent->review1_saying}}">
                                  </div>
                              @endif
                              @if($agent->review2_name)
                                  <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                      <label title="{{$agent->review2_function}}">{{$agent->review2_name}} ({{$agent->review2_function}}) Says About This Company</label>
                                      <input type="text" class="form-control input-lg" readonly value="{{$agent->review2_saying}}">
                                  </div>
                              @endif
                              @if($agent->review3_name)
                                  <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                      <label title="{{$agent->review3_function}}">{{$agent->review3_name}} ({{$agent->review3_function}}) Says About This Company</label>
                                      <input type="text" class="form-control input-lg" readonly value="{{$agent->review3_saying}}">
                                  </div>
                              @endif
                          </div>
                          @endif
                      </div>
                      <div class="col-md-6 col-sm-6">

                        {!! Form::open(array('url'=>'agentscontact','method'=>'POST', 'id'=>'agent_contact_form')) !!}
              			<meta name="_token" content="{!! csrf_token() !!}"/>

                         <input type="hidden" name="job_id" value="{{$job->id}}">
                          <input type="hidden" name="agent_email" id="agent_email" value="{{$agent->email}}">
                          <input type="hidden" name="job_name" value="{{$job->job_name}}">
                         <input type="hidden" name="job_slug" value="{{$job->job_slug}}">

                         <input type="hidden" name="agent_id" value="{{$agent->id}}">

                          <div id="ajax" style="color: #db2424"></div>

                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control input-lg" placeholder="Enter name : ">
                          </div>
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control input-lg" placeholder="Enter email : ">
                          </div>
                          <div class="form-group">
                            <label for="telp">Telp.</label>
                            <input type="text" name="phone" class="form-control input-lg" placeholder="Enter phone number : ">
                          </div>
                          <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" class="form-control input-lg" rows="7" placeholder="Type a message : "></textarea>
                          </div>
                          <div class="form-group">
                            <input type="submit" name="submit" value="VERSTUUR" class="btn btn-primary btn-lg">
                          </div>
                        {!! Form::close() !!}
                      </div>
                    </div>
                  <div class="row">
                      <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                          <label>
                              <br>Location of Employer on Map:<br>
                          </label>
                      </div>
                      <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                          <div id="agent-map-container" style="width:100%;height:400px; ">
                              <div style="width: 100%; height: 100%" id="agent-map"></div>
                          </div>
                      </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end:article -->

          <!-- begin:sidebar -->
          @include('_particles.sidebar')
          <!-- end:sidebar -->

        </div>
      </div>
    </div>
    <!-- end:content -->

     @if (count($errors) > 0 or Session::has('flash_message'))
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
     <script type="text/javascript">
	    $(window).load(function(){
	        $('#modal-error').modal('show');
	    });
	</script>
 	@endif
    <!-- begin:modal-message -->
    <div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="modal-signin" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom:none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

          </div>
          <div class="modal-body">
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
				        {{ Session::get('flash_message') }}
				    </div>
				@endif
          </div>

        </div>
      </div>
    </div>
    <!-- end:modal-message -->
@endsection
