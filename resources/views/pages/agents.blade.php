@extends("app")

@section('head_title', 'Agents | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<style>
.alphabet{
    background-color: white;
    color: black;
    border: 2px solid #e7e7e7;
}
</style>
<!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="page-title">
              <p>Members</p>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">Members</li>
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
          <div class="col-md-12">
            <div class="blog-container">
              <div class="blog-content">
                <!--<div class="the-team">-->
                  <div class="row">
                      @if($usertype=='candidate')
                      <div class="sidebar col-sm-9 col-md-3">
                          <div class="widget widget-white">
                              <div class="widget-header">
                                  <h3>Advance Search</h3>
                              </div>
                              {!! Form::open(array('url' => array('candidates/search'),'class'=>'advance-search','name'=>'search_form','id'=>'search_form','role'=>'form')) !!}
                              <div class="form-group">
                                  <label for="city">Where</label>
                                  <input type="text" id="address-input" placeholder="City, State, Country" name="address"  class="form-control map-input">
                                  <input type="hidden"  name="address_latitude" id="address-latitude" value="" />
                                  <input type="hidden"  name="address_longitude" id="address-longitude" value="" />
                              </div>
                              <div class="form-group">
                                  <label for="radius">Radius</label>
                                  <select type="text" name="radius" class="form-control" >
                                      <option value="0">+0 KM</option>
                                      <option value="1">+1 KM</option>
                                      <option value="3">+3 KM</option>
                                      <option value="5">+5 KM</option>
                                      <option value="10">+10 KM</option>
                                      <option value="20">+20 KM</option>
                                  </select>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="display:none;">
                                  <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                      <div id="address-map-container" style="width:100%;height:400px; ">
                                          <div style="width: 100%; height: 100%" id="address-map"></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="minprice">WHO</label>
                                  <input type="text" placeholder="By Name" name="name" class="form-control" >
                              </div>
                              <div class="form-group">
                                  <label for="type">Experience</label>
                                  <select class="form-control" name="experience">
                                      <option value="">Select Candidate Experience</option>
                                      <option value="1">0-1</option>
                                      <option value="3">1-3</option>
                                      <option value="5">3-5</option>
                                      <option value="6">5+</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for="type">Last Activity</label><br>
                                  <input type="checkbox" id="activity"  name="activity" value="1">
                                  <label for="activity"> Last 24 Hour</label><br>
                                  <input type="checkbox"  id="activity"   name="activity" value="7">
                                  <label for="activity"> Last 7 Days</label><br>
                                  <input type="checkbox"  id="activity"   name="activity" value="14">
                                  <label for="activity"> Last 14 Days</label><br>
                                  <input type="checkbox"  id="activity"   name="activity" value="30">
                                  <label for="activity"> Last 30 Days</label><br>
                                  <input type="checkbox" checked id="activity"   name="activity" value="31">
                                  <label for="activity"> All </label><br>
                              </div>
                              <input type="submit" name="submit" value="GO" class="btn btn-warning btn-block">
                              {!! Form::close() !!}
                          </div>
                          <!-- break -->
                      </div>
                      @endif
                      <div class="col-sm-12 col-md-9" style="background-color: whitesmoke;">
                          <div class="row" style="border-bottom: 1px grey;">
                              @if(count($agents)>0)
                                <p>{{count($agents)}} Members Found</p>
                              @endif
                              <p>FIND Job Employers</p>
                          </div>
                          <hr>
                          <div class="row" style="border-bottom: 1px grey;">
                              @if($usertype=='employer')
                              <div class="row">
                                  <div class="col-sm-12"><label>Sort By Alphabets</label></div>
                                  <div class="container">
                                      <div class="btn-toolbar">
                                          <div class="btn-group btn-group-sm">
                                              <a href="{{ URL::to('employers/filter/A') }}"class="btn btn-default">A</a>
                                              <a href="{{ URL::to('employers/filter/B') }}"class="btn btn-default">B</a>
                                              <a href="{{ URL::to('employers/filter/C') }}"class="btn btn-default">C</a>
                                              <a href="{{ URL::to('employers/filter/D') }}"class="btn btn-default">D</a>
                                              <a href="{{ URL::to('employers/filter/E') }}"class="btn btn-default">E</a>
                                              <a href="{{ URL::to('employers/filter/F') }}"class="btn btn-default">F</a>
                                              <a href="{{ URL::to('employers/filter/G') }}"class="btn btn-default">G</a>
                                              <a href="{{ URL::to('employers/filter/H') }}"class="btn btn-default">H</a>
                                              <a href="{{ URL::to('employers/filter/I') }}"class="btn btn-default">I</a>
                                              <a href="{{ URL::to('employers/filter/J') }}"class="btn btn-default">J</a>
                                              <a href="{{ URL::to('employers/filter/K') }}"class="btn btn-default">K</a>
                                              <a href="{{ URL::to('employers/filter/L') }}"class="btn btn-default">L</a>
                                              <a href="{{ URL::to('employers/filter/M') }}"class="btn btn-default">M</a>
                                              <a href="{{ URL::to('employers/filter/N') }}"class="btn btn-default">N</a>
                                              <a href="{{ URL::to('employers/filter/O') }}"class="btn btn-default">O</a>
                                              <a href="{{ URL::to('employers/filter/P') }}"class="btn btn-default">P</a>
                                              <a href="{{ URL::to('employers/filter/Q') }}"class="btn btn-default">Q</a>
                                              <a href="{{ URL::to('employers/filter/R') }}"class="btn btn-default">R</a>
                                              <a href="{{ URL::to('employers/filter/S') }}"class="btn btn-default">S</a>
                                              <a href="{{ URL::to('employers/filter/T') }}"class="btn btn-default">T</a>
                                              <a href="{{ URL::to('employers/filter/U') }}"class="btn btn-default">U</a>
                                              <a href="{{ URL::to('employers/filter/V') }}"class="btn btn-default">V</a>
                                              <a href="{{ URL::to('employers/filter/W') }}"class="btn btn-default">W</a>
                                              <a href="{{ URL::to('employers/filter/X') }}"class="btn btn-default">X</a>
                                              <a href="{{ URL::to('employers/filter/Y') }}"class="btn btn-default">Y</a>
                                              <a href="{{ URL::to('employers/filter/Z') }}"class="btn btn-default">Z</a>
                                              <a href="{{ URL::to('employers/filter/All') }}"class="btn btn-default">All</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">&nbsp</div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="col-sm-6">
                                          {!! Form::open(array('url' => array('employers/searchbyName'),'class'=>'form-horizontal padding-15','name'=>'job_form','id'=>'job_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                                          <div class="col-sm-8">
                                              <input name="employee_name" class="form-control" placeholder="Enter Employee Name" type="text" id="employee_name">
                                          </div>
                                          <div class="col-sm-4">
                                              <button type="submit">Search</button>
                                          </div>
                                          {!! Form::close()!!}
                                      </div>
                                      <div class="col-sm-6">
                                          {!! Form::open(array('url' => array('employers/searchbyCity'),'class'=>'form-horizontal padding-15','name'=>'job_form','id'=>'job_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                                          <div class="col-sm-8">
                                              <input name="employee_city" class="form-control" placeholder="Enter Employee City" type="text" id="employee_city">
                                          </div>
                                          <div class="col-sm-4">
                                              <button type="submit">Search</button>
                                          </div>
                                          {!! Form::close()!!}
                                      </div>
                                  </div>
                              </div>
                              @elseif($usertype=='candidate')
                                  <div class="row">
                                      <div class="col-sm-12"><label>Sort By Alphabets</label></div>
                                      <div class="container">
                                          <div class="btn-toolbar">
                                              <div class="btn-group btn-group-sm">
                                                  <a href="{{ URL::to('employers/filter/A') }}"class="btn btn-default">A</a>
                                                  <a href="{{ URL::to('employers/filter/B') }}"class="btn btn-default">B</a>
                                                  <a href="{{ URL::to('employers/filter/C') }}"class="btn btn-default">C</a>
                                                  <a href="{{ URL::to('employers/filter/D') }}"class="btn btn-default">D</a>
                                                  <a href="{{ URL::to('employers/filter/E') }}"class="btn btn-default">E</a>
                                                  <a href="{{ URL::to('employers/filter/F') }}"class="btn btn-default">F</a>
                                                  <a href="{{ URL::to('employers/filter/G') }}"class="btn btn-default">G</a>
                                                  <a href="{{ URL::to('employers/filter/H') }}"class="btn btn-default">H</a>
                                                  <a href="{{ URL::to('employers/filter/I') }}"class="btn btn-default">I</a>
                                                  <a href="{{ URL::to('employers/filter/J') }}"class="btn btn-default">J</a>
                                                  <a href="{{ URL::to('employers/filter/K') }}"class="btn btn-default">K</a>
                                                  <a href="{{ URL::to('employers/filter/L') }}"class="btn btn-default">L</a>
                                                  <a href="{{ URL::to('employers/filter/M') }}"class="btn btn-default">M</a>
                                                  <a href="{{ URL::to('employers/filter/N') }}"class="btn btn-default">N</a>
                                                  <a href="{{ URL::to('employers/filter/O') }}"class="btn btn-default">O</a>
                                                  <a href="{{ URL::to('employers/filter/P') }}"class="btn btn-default">P</a>
                                                  <a href="{{ URL::to('employers/filter/Q') }}"class="btn btn-default">Q</a>
                                                  <a href="{{ URL::to('employers/filter/R') }}"class="btn btn-default">R</a>
                                                  <a href="{{ URL::to('employers/filter/S') }}"class="btn btn-default">S</a>
                                                  <a href="{{ URL::to('employers/filter/T') }}"class="btn btn-default">T</a>
                                                  <a href="{{ URL::to('employers/filter/U') }}"class="btn btn-default">U</a>
                                                  <a href="{{ URL::to('employers/filter/V') }}"class="btn btn-default">V</a>
                                                  <a href="{{ URL::to('employers/filter/W') }}"class="btn btn-default">W</a>
                                                  <a href="{{ URL::to('employers/filter/X') }}"class="btn btn-default">X</a>
                                                  <a href="{{ URL::to('employers/filter/Y') }}"class="btn btn-default">Y</a>
                                                  <a href="{{ URL::to('employers/filter/Z') }}"class="btn btn-default">Z</a>
                                                  <a href="{{ URL::to('employers/filter/All') }}"class="btn btn-default">All</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              @endif
                          </div>
                          <hr>
                          @if(count($agents))
                              @foreach($agents as $i => $agent)
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="row" style="background-color: white; border-bottom: 1px grey;">
                                              <div class="col-sm-3">
                                                  <div class="team-image">
                                                      @if($agent->image_icon)
                                                          <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" style="padding-top: 5px" alt="{{ $agent->name }}">
                                                      @else
                                                          <img src="{{ URL::asset('upload/noImage.png') }}" style="padding-top: 5px" alt="{{ $agent->name }}">
                                                      @endif
                                                  </div>
                                              </div>
                                              <div class="col-sm-9">
                                                  <div class="team-description">
                                                      <div class="row">
                                                          <div class="col-sm-4">
                                                              <h3>
                                                                  <a href="{{ URL::to('/employer/details/'.$agent->id) }}">
                                                                    {{$agent->fname.' '.$agent->lname}}</h3>
                                                                  </a>
                                                          </div>
                                                          @if($usertype=='employer')
                                                          <div class="col-sm-5">
                                                          </div>
                                                          <div class="col-sm-3">
                                                              <a  href="{{ URL::to('/employer/'.$agent->id.'/jobs') }}">
                                                                  <p style="color: red">
                                                                    {{$agent->created_jobs}} Job(s)
                                                                  </p>
                                                              </a>
                                                          </div>
                                                          @endif
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-12">
                                                              @if(isset($agent->address) && $agent->address)
                                                                <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp{{$agent->city}}&nbsp:&nbsp{{$agent->address}}</p>
                                                              @endif
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-12">
                                                              @if(isset($agent->about) && $agent->about)
                                                                <p>{{substr($agent->about, 0, 50)}}</p>
                                                              @endif
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-sm-3">
                                                              @if(isset($agent->phone) && $agent->phone)
                                                                <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp&nbsp {{$agent->phone}}</p>
                                                              @endif
                                                          </div>
                                                          <div class="col-sm-5">
                                                              @if(isset($agent->email) && $agent->email)
                                                                <p><i class="fa fa-id-card" aria-hidden="true"></i>&nbsp&nbsp{{$agent->email}}</p>
                                                              @endif
                                                          </div>
                                                      </div>
                                                      <div class="team-social">
                                                          @if(isset($agent->twitter))
                                                              <span><a href="{{$agent->twitter}}" title="Twitter" rel="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a></span>
                                                          @endif
                                                          @if(isset($agent->facebook))
                                                              <span><a href="{{$agent->facebook}}" title="Facebook" rel="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a></span>
                                                          @endif
                                                          @if(isset($agent->instagram))
                                                              <span><a href="{{$agent->instagram}}" title="Instagram" rel="tooltip" data-placement="top"><i class="fa fa-instagram"></i></a></span>
                                                          @endif
                                                          @if(isset($agent->gplus))
                                                              <span><a href="{{$agent->gplus}}" title="Google Plus" rel="tooltip" data-placement="top"><i class="fa fa-google-plus"></i></a></span>
                                                          @endif
                                                          @if(isset($agent->linkedin))
                                                              <span><a href="{{$agent->linkedin}}" title="LinkedIn" rel="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a></span>
                                                          @endif
                                                          @if(isset($agent->youtube))
                                                              <span><a href="{{$agent->youtube}}" title="Youtube" rel="tooltip" data-placement="top"><i class="fa fa-youtube"></i></a></span>
                                                          @endif
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <hr>
                                  </div>
                                  <!-- break -->
                              @endforeach
                              @include('_particles.pagination', ['paginator' => $agents])
                          @else
                              <h3 style="text-align: center">Sorry, No Record Found </h3>
                          @endif
                      </div>
                  </div>
                <!--</div>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:content -->
@endsection
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $(".submit-form").on('click', function() {
            $("#job_form").submit();
        });
        var eltPrimary = $('[data-role="tagsinput tag-primary"]');
        eltPrimary.tagsinput({
            tagClass: 'label label-primary'
        });
        var eltDefault = $('[data-role="tagsinput tag-default"]');
        eltDefault.tagsinput({
            tagClass: 'label label-default'
        });
        var eltDanger = $('[data-role="tagsinput tag-danger"]');
        eltDanger.tagsinput({
            tagClass: 'label label-danger'
        });
        initialize();
        function initialize() {
            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
            const locationInputs = document.getElementsByClassName("map-input");
            var options = {
                componentRestrictions: {country: "nl"}
            };
            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;
            for (let i = 0; i < locationInputs.length; i++) {
                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';
                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || 52.3666969;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 4.8945398;
                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: latitude, lng: longitude},
                    draggable: true
                });
                google.maps.event.addListener(marker, 'dragend', function(marker) {
                    var latLng = marker.latLng;
                    document.getElementById('address-latitude').value = latLng.lat();
                    document.getElementById('address-longitude').value = latLng.lng();

                    geocoder.geocode({'latLng': this.getPosition()}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                $('#address-input').val(results[0].formatted_address);
                                for(var a=0; a < results[0]['address_components'].length; a++)
                                {
                                    if(results[0]['address_components'][a]['types'][0] == 'locality')
                                    {
                                        $('#city_name').val(results[0]['address_components'][a]['long_name']);
                                    }
                                }
                            }
                            else
                            {
                                $('#address-input').val();
                                $('#city_name').val();
                            }
                        }
                    });
                });
                marker.setVisible(isEdit);
                const autocomplete = new google.maps.places.Autocomplete(input,options);
                autocomplete.key = fieldKey;
                autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
            }
            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({'placeId': place.place_id}, function (results, status) {



                        if (status === google.maps.GeocoderStatus.OK) {

                            if (results[0]) {

                                const lat = results[0].geometry.location.lat();
                                const lng = results[0].geometry.location.lng();
                                setLocationCoordinates(autocomplete.key, lat, lng);


                                for(var x=0; x < results[0]['address_components'].length; x++)
                                {

                                    if(results[0]['address_components'][x]['types'][0] == 'locality')
                                    {

                                        $('#city_name').val(results[0]['address_components'][x]['long_name']);

                                    }
                                }
                            }
                            else
                            {
                                $('#city_name').val();
                            }
                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                });
            }
        }
        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-" + "latitude");
            const longitudeField = document.getElementById(key + "-" + "longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
        }
        $('.summernote').summernote({
            height: 250,   //set editable area's height
            codemirror: { // codemirror options
                theme: 'monokai'
            }
        });
        var backend_date = {{isset($job->deadlineDate)?$job->deadlineDate:Date(1)}};
        console.log(backend_date);
        var date = new Date(backend_date);
        $('#datetimepicker4').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: date
        });
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'LT'
        });
        function incrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[class=' + fieldName + ']').val(), 10);
            if (!isNaN(currentVal)) {
                parent.find('input[class=' + fieldName + ']').val(currentVal + 1);
            } else {
                parent.find('input[class=' + fieldName + ']').val(0);
            }
        }
        function decrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[class=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal) && currentVal > 0) {
                parent.find('input[class=' + fieldName + ']').val(currentVal - 1);
            } else {
                parent.find('input[class=' + fieldName + ']').val(0);
            }
        }
        $('.input-group').on('click', '.button-plus', function(e) {
            incrementValue(e);
        });
        $('.input-group').on('click', '.button-minus', function(e) {
            decrementValue(e);
        });
        $('input[name=job_purpose]').change(function(){
            $('.pp').removeClass('active1');
            $(this).parent().closest('li').addClass('active1');
        });
        $('input[name=job_type]').change(function(){
            $('.pt').removeClass('active1');
            $(this).parent().closest('li').addClass('active1');
        });
        var $global = 0;
        var $progressWizard = $('.stepper'),
            $tab_active,
            $tab_prev,
            $tab_next,
            $btn_prev = $progressWizard.find('.prev-step'),
            $btn_next = $progressWizard.find('.next-step'),
            $tab_toggle = $progressWizard.find('[data-toggle="tab"]'),
            $tooltips = $progressWizard.find('[data-toggle="tab"][title]');
        // To do:
        // Disable User select drop-down after first step.
        // Add support for payment type switching.
        //Initialize tooltips
        $tooltips.tooltip();
        //Wizard
        /*  $tab_toggle.on('show.bs.tab', function(e) {

              return false;


          });*/
        $tab_toggle.on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            return false;
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('input:checkbox').click(function() {
            $('input:checkbox').not(this).prop('checked', false);
        });
    });
</script>
