@extends("app")

@section('head_title', $agent->job_name .' | '.getcong('site_name') )
@section('head_description', substr(strip_tags($agent->description),0,200))
@section('head_image', asset('/upload/members/'.$agent->featured_image.'-b.jpg'))
@section('head_url', Request::url())

@section("content")
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
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
              <h2>{{$agent->job_name}}</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li><a href="{{ URL::to('jobs/') }}">User Details</a></li>
              <li class="active">{{$agent->fname.' '.$agent->lname}}</li>
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
                  <li class="active"><a href="#location" data-toggle="tab"><i class="fa fa-paper-plane-o"></i> Contact
                      </a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade in active" id="location">

                    <div class="row">
                      <div class="col-md-6">
                        <h3>Contact</h3>
                      </div>
                    <div class="col-md-6">
                        @if( isset(Auth::user()->usertype) && Auth::user()->usertype == 'employer')
                            {!! Form::open(array('url'=>'admin/savecandidate','method'=>'POST', 'id'=>'save_job_form')) !!}
                            <meta name="_token" content="{!! csrf_token() !!}"/>
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="candidate_id" value="{{$agent->id}}">
                            <input type="hidden" name="candidate_name" value="{{$agent->fname.' '.$agent->lname}}">
                            <button type="submit" title="Click To Save Candidate Information to your Profile" class="btn btn-success" id="saveJob">
                                <i class="fa fa-heart-o fa-1x"> &nbsp Save this Candidate</i>
                            </button>
                            {!! Form::close() !!}
                        @endif
                    </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="team-container team-dark">
                          <div class="team-image">
                            @if($agent->image_icon)
                            <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" alt="{{$agent->name}}">
                            @else
                            <img src="{{ URL::asset('upload/members/user-icon.webp') }}" alt="{{$agent->name}}">
                            @endif
                          </div>
                          <div class="team-description">
                           <input type="hidden" name="agent_latitude" id="agent_latitude" value="{{$agent->map_latitude}}">
                           <input type="hidden" name="agent_longitude" id="agent_longitude" value="{{$agent->map_longitude}}">
                           <input type="hidden" name="agent_city" id="agent_city" value="{{$agent->address}}">
                            <h3>{{$agent->fname.' '.$agent->lname}}</h3>
                            <p><i class="fa fa-phone"></i>&nbsp Phone : {{$agent->phone}}</p>
                            <p><i class="fa fa-envelope"></i>&nbsp Email : {{$agent->email}}</p>
                              @if(isset($agent->about) && $agent->about)
                                      <p><i class="fa fa-info-circle"></i>&nbsp<b> About: </b> {{$agent->about}}</p>
                              @endif
                            @if($agent->website)
                                <p><i class="fa fa-globe"></i>&nbsp<a style="color: white" href="https://{{$agent->website}}" target="_blank">See Website</a> </p>
                            @endif
                            @if($agent->created_jobs>0)
                              <p><a style="color: white" href="{{ URL::to('employer/'.$agent->id.'/jobs') }}" target="_blank">See {{$agent->created_jobs}}  {{$agent->created_jobs>1?'Jobs':'Job'}} of this Emloyer</a></p>
                            @endif
                            <div class="team-social">
                              @if($agent->twitter)
                                <span><a href="https://{{$agent->twitter}}" title="Twitter" rel="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a></span>
                              @endif
                              @if($agent->instagram)
                                <span><a href="https://{{$agent->instagram}}" title="Instagram" rel="tooltip" data-placement="top"><i class="fa fa-instagram"></i></a></span>
                              @endif
                              @if($agent->facebook)
                                <span><a href="https://{{$agent->facebook}}" title="Facebook" rel="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a></span>
                              @endif
                              @if($agent->gplus)
                                <span><a href="https://{{$agent->gplus}}" title="Google Plus" rel="tooltip" data-placement="top"><i class="fa fa-google-plus"></i></a></span>
                              @endif
                              @if($agent->youtube)
                                <span><a href="https://{{$agent->youtube}}" title="You Tube" rel="tooltip" data-placement="top"><i class="fa fa-youtube"></i></a></span>
                              @endif
                              @if($agent->linkedin)
                                <span><a href="https://{{$agent->linkedin}}" title="LinkedIn" rel="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a></span>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        {!! Form::open(array('url'=>'agentscontactpersonal','method'=>'POST', 'id'=>'agent_contact_form')) !!}
              			<meta name="_token" content="{!! csrf_token() !!}"/>
                          <input type="hidden" name="agent_email" id="agent_email" value="{{$agent->email}}">
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
                              <br>Location of {{$agent->usertype}} on Map:<br>
                          </label>
                      </div>
                      <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                          <div id="agent-map-container" style="width:100%;height:400px; ">
                              <div style="width: 100%; height: 100%" id="agent-map"></div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      @if(isset($agent->fname) || isset($agent->lname))
                        <h3 style="text-align: center">More Details of {{$agent->usertype}}</h3>
                      @endif
                      <table>
                          @if(isset($agent->fname) && $agent->fname)
                              <tr>
                                  <th>First Name</th>
                                  <th>{{$agent->fname}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->lname) && $agent->lname)
                              <tr>
                                  <th>Last Name</th>
                                  <th>{{$agent->lname}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->orgName) && $agent->orgName)
                              <tr>
                                  <th>Last Organization Name</th>
                                  <th>{{$agent->orgName}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->specialism) && $agent->specialism)
                              <tr>
                                  <th>Specialism</th>
                                  <th>{{$agent->specialism}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->zipCode) && $agent->zipCode)
                              <tr>
                                  <th>ZIP Code</th>
                                  <th>{{$agent->zipCode}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->parttime_available))
                              <tr>
                                  <th>Part Time Available</th>
                                  <th>{{$agent->parttime_available==1 || $agent->parttime_available=='on'?'Yes':'No'}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->parttime_available_input) && $agent->parttime_available_input)
                              <tr>
                                  <th>Part Time Availability Hours</th>
                                  <th>{{$agent->parttime_available_input}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->fulltime_Available))
                              <tr>
                                  <th>Availablity</th>
                                  <th>{{$agent->fulltime_available==1?'Full Time':'Part Time'}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->license) && $agent->license)
                              <tr>
                                  <th>License Available</th>
                                  <th>{{$agent->license==1?'Yes':'No'}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->salary) && $agent->salary)
                              <tr>
                                  <th>Last Salary</th>
                                  <th>{{number_format($agent->salary)}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->profession) && $agent->profession)
                              <tr>
                                  <th>Profession</th>
                                  <th>{{$agent->profession}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->career_level)&& $agent->career_level)
                              <tr>
                                  <th>Career Level</th>
                                  <th>{{$agent->career_level}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->experience) && $agent->experience)
                              <tr>
                                  <th>Experience</th>
                                  <th>{{$agent->experience}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->travel_distance) && $agent->travel_distance)
                              <tr>
                                  <th>Travel Distance</th>
                                  <th>{{$agent->travel_distance}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->travel_distance) && $agent->travel_distance)
                              <tr>
                                  <th>Travel Distance</th>
                                  <th>{{$agent->travel_distance}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->travel_city) && $agent->travel_city)
                              <tr>
                                  <th>Travel City</th>
                                  <th>{{$agent->travel_city}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->travel_city) && $agent->travel_city)
                              <tr>
                                  <th>Travel City</th>
                                  <th>{{$agent->travel_city}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->working_now))
                              <tr>
                                  <th>Currently Employed</th>
                                  <th>{{$agent->working_now=='on'||$agent->working_now==1?'Yes':'No'}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->working_now_date) && $agent->working_now_date)
                              <tr>
                                  <th>Joining Date of Current Job</th>
                                  <th>{{date($agent->working_now_date,'d-m-Y')}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->description_activity) && $agent->description_activity)
                              <tr>
                                  <th>Current Job Description</th>
                                  <th>{{$agent->description_activity}}</th>
                              </tr>
                          @endif
                          @if(isset($agent->last_employer_name) && $agent->last_employer_name)
                              <tr>
                                  <th>Last Employer Name</th>
                                  <th>{{$agent->last_employer_name}}</th>
                              </tr>
                          @endif
                      </table>
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
        function agent_initMap() {
            // Initialize variables
            bounds = new google.maps.LatLngBounds();
            infoWindow = new google.maps.InfoWindow;
            currentInfoWindow = infoWindow;
            /* TODO: Step 4A3: Add a generic sidebar */
            agent_handleLocationError(false, infoWindow,type);
        }
        agent_initMap();
        // Handle a geolocation error
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
