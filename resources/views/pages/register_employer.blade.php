@extends("app")
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGfQhIC7_QAkMKlYYrctdoQg78iQJIm6o&libraries=places&region=nl" async defer></script>--}}
@section('head_title', 'Create a new account | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
    <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="page-title">
                        <h2>Sign up</h2>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="active">Sign up</li>
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
                <div class="col-md-12 col-md-offset-1">
                    <div class="blog-container">
                        <div class="blog-content" style="padding-top:0px;">
                            <div class="blog-title">
                                <h3>Register an Employer account for free</h3>

                            </div>

                            <div class="blog-text contact" style="margin-top: -40px;">
                                <div class="row">

                                    @if(Session::has('flash_message'))
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            {{ Session::get('flash_message') }}
                                        </div>
                                    @endif
                                    <div class="message">
                                    <!--{!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}-->
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="col-md-8 col-sm-7">
                                        {!! Form::open(array('url' => 'register_employer','class'=>'','id'=>'registerform','role'=>'form')) !!}
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email"required id="email"
                                                   placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password"required id="password"
                                                   placeholder="Enter password">
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                  required id="password_confirmation" placeholder="Confirm Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="fname">First Name</label>
                                            <input type="text" class="form-control" name="fname"required id="fname"
                                                   placeholder="Enter First Name Contact Person">
                                        </div>
                                        <div class="form-group">
                                            <label for="lname">Last Name</label>
                                            <input type="text" class="form-control" name="lname"required id="lname"
                                                   placeholder="Enter Last Name Contact Person">
                                        </div>
                                        <div class="form-group">
                                            <label for="orgname">Organization Name</label>
                                            <input type="text" class="form-control" name="orgname"required id="orgname"
                                                   placeholder="Organization Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Mobile No</label>
                                            <input type="text" class="form-control" name="phone"required id="phone"
                                                   placeholder="Enter Mobile No">
                                        </div>
                                        <div class="form-group">
                                            <label for="speciality">Specialism</label>
                                            <select name="speciality"required id="speciality" class="selectpicker show-tick form-control"
                                                    data-live-search="true">
                                                <option value="" readonly="">Please Select Specialism</option>
                                                @foreach($city_list as $city)
                                                    <option value="{{$city->city_name}}">{{$city->city_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kvk_no">KVK_Number</label>
                                            <input type="number" class="form-control" name="kvk_number"required id="kvk_number"
                                                   placeholder="Enter KVK No">
                                        </div>
                                        <div class="form-group">
                                            <label for="website_url">Website</label>
                                            <input type="text" class="form-control" name="website_url"required id="website_url"
                                                   placeholder="Enter Website URL">
                                        </div>
                                        <div class="form-group">
                                            <label for="zip_code">Zip Code</label>
                                            <input type="text" class="form-control" name="zip_code"required id="zip_code"
                                                   placeholder="Enter Zip Code">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class=" control-label">Address</label>
                                            <div>
                                                <input type="text" id="address-input" placeholder="Enter Address" required name="address" value="{{ isset(Auth::user()->address) ? Auth::user()->address : old('address') }}"  class="form-control map-input">
                                                <input type="hidden" required name="address_latitude" id="address-latitude" value="52.3666969" />
                                                <input type="hidden" required name="address_longitude" id="address-longitude" value="4.8945398" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                                <div id="address-map-container" style="width:100%;height:400px; ">
                                                    <div style="width: 100%; height: 100%" id="address-map"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" id="city_name" name="city" value="{{ isset(Auth::user()->city) ? Auth::user()->city : old('city')}}" readonly class="form-control ">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="zip_code">Are you Intermediary</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="radio"  value=1 name="intermediary"required id="intermediary">Yes
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="radio"  value=0 name="intermediary"required id="intermediary">No
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group checkbox">
                                            <p style="margin-left: 3px;">Already have account ? <a
                                                    href="{{ URL::to('login') }}">Sign in here.</a></p>
                                            <a href="redirect/facebook">
                                                <button type="button" class="loginBtn loginBtn--facebook">
                                                    Login with Facebook
                                                </button>
                                            </a>
                                            <a href="redirect/google">
                                                <button type="button" class="loginBtn loginBtn--google"
                                                        href="redirect/google">
                                                    Login with Google
                                                </button>
                                            </a>
                                        </div>
                                        <div class="form-group" style="margin-left: 3px;">
                                            <button type="submit" name="submit" class="btn btn-warning"><i
                                                    class="fa fa-lock"></i> Sign up
                                            </button>
                                        </div>
                                        {!! Form::close() !!} <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:content -->

    <style>

        /* Shared */
        .loginBtn {
            box-sizing: border-box;
            position: relative;
            /* width: 13em;  - apply for fixed size */
            margin: 0.2em;
            padding: 0 15px 0 46px;
            border: none;
            text-align: left;
            line-height: 34px;
            white-space: nowrap;
            border-radius: 0.2em;
            font-size: 16px;
            color: #FFF;
        }

        .loginBtn:before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            top: 0;
            left: 0;
            width: 34px;
            height: 100%;
        }

        .loginBtn:focus {
            outline: none;
        }

        .loginBtn:active {
            box-shadow: inset 0 0 0 32px rgba(0, 0, 0, 0.1);
        }


        /* Facebook */
        .loginBtn--facebook {
            background-color: #4C69BA;
            background-image: linear-gradient(#4C69BA, #3B55A0);
            /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
            text-shadow: 0 -1px 0 #354C8C;
        }

        .loginBtn--facebook:before {
            border-right: #364e92 1px solid;
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
        }

        .loginBtn--facebook:hover,
        .loginBtn--facebook:focus {
            background-color: #5B7BD5;
            background-image: linear-gradient(#5B7BD5, #4864B1);
        }


        /* Google */
        .loginBtn--google {
            /*font-family: "Roboto", Roboto, arial, sans-serif;*/
            background: #DD4B39;
        }

        .loginBtn--google:before {
            border-right: #BB3F30 1px solid;
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
        }

        .loginBtn--google:hover,
        .loginBtn--google:focus {
            background: #E74B37;
        }

    </style>
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
@endsection
