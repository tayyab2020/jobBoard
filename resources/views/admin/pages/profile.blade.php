@extends("admin.admin_app")
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGfQhIC7_QAkMKlYYrctdoQg78iQJIm6o&libraries=places&region=nl" async defer></script>
@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ Auth::user()->name }}</h2>
		<a href="{{ URL::to('admin/dashboard') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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
    <div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#account" aria-controls="account" role="tab" data-toggle="tab">Account</a>
        </li>
        <li role="presentation">
            <a href="#ac_password" aria-controls="ac_password" role="tab" data-toggle="tab">Password</a>
        </li>
        </li>
    </ul>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
    <!-- Tab panes -->
    <div class="tab-content tab-content-default">
        <div role="tabpanel" class="tab-pane active" id="account">
            {!! Form::open(array('url' => 'admin/profile','class'=>'form-horizontal padding-15','name'=>'account_form','id'=>'account_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">Profile Picture</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(Auth::user()->image_icon)

									<img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" width="80" alt="person">
								@endif

                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="user_icon" class="filestyle">
{{--                                <small class="text-muted bold">Size 80x80px</small>--}}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="fname" value="{{ isset(Auth::user()->fname) ? Auth::user()->fname : old('fname')}}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="lname" value="{{ isset(Auth::user()->lname) ? Auth::user()->lname : old('lname')}}" value="{{ Auth::user()->lname }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" value="{{ isset(Auth::user()->email) ? Auth::user()->email : old('email')}}"class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Linkedin</label>
                    <div class="col-sm-9">
                        <input type="text" name="linkedin" value="{{ Auth::user()->linkedin }}" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">About</label>
                    <div class="col-sm-9">
                        <textarea name="about" rows="5" class="form-control stepper-step-3-validate summernote">{{ isset(Auth::user()->about) ? Auth::user()->about  : old('about') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <input type="text" id="address-input" placeholder="Enter Address" required name="address" value="{{ isset(Auth::user()->address) ? Auth::user()->address : old('address') }}" class="form-control map-input">
                        <input type="hidden" required name="address_latitude" id="address-latitude" value="{{ isset(Auth::user()->map_latitude) ? Auth::user()->map_latitude : null }}" />
                        <input type="hidden" required name="address_longitude" id="address-longitude" value="{{ isset(Auth::user()->map_longitude) ? Auth::user()->map_longitude : null }}" />
                    </div>
                </div>

            <div class="form-group">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="float: right;">
                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                        <div id="address-map-container" style="width:100%;height:400px; ">
                            <div style="width: 100%; height: 100%" id="address-map"></div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input type="text" id="city_name" name="city" value="{{ isset(Auth::user()->city) ? Auth::user()->city : old('city')}}" readonly class="form-control ">
                    </div>
                </div>
            @if(isset(Auth::user()->usertype) && Auth::user()->usertype=='candidate')
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Specialism</label>
                    <div class="col-sm-9" class="form-control" >
                        <select name="specialism" required class="form-control">
                            <option value="" readonly>Select Specilism</option>
                            <option value="agricultural" @php if(isset(Auth::user()->specialism) && Auth::user()->specialism == 'agricultural' || old('specialism')=='agricultural'){ echo 'selected'; } @endphp>Agricultural Sciences</option>
                            <option value="astrology" @php if(isset(Auth::user()->specialism) && Auth::user()->specialism == 'astrology' || old('specialism')=='astrology'){ echo 'selected'; } @endphp>Astrology & Space Sciences</option>
                            <option value="culinary" @php if(isset(Auth::user()->specialism) && Auth::user()->specialism == 'culinary' || old('specialism')=='culinary'){ echo 'selected'; } @endphp>Culinary & restuarants</option>
                            <option value="gaming" @php if(isset(Auth::user()->specialism) && Auth::user()->specialism == 'gaming' || old('specialism')=='gaming') { echo 'selected'; } @endphp>Gaming & E.T.A Consols</option>
                            <option value="healthcare" @php if(isset(Auth::user()->specialism) && Auth::user()->specialism == 'healthcare' || old('specialism')=='healthcare') { echo 'selected'; } @endphp>HealthCare & Hospitals</option>
                            <option value="legal" @php if(isset(Auth::user()->specialism) && Auth::user()->specialism == 'legal' || old('specialism')=='legal') { echo 'selected'; } @endphp>Legal Jobs</option>
                            <option value="tourism" @php if(isset(Auth::user()->specialism) && Auth::user()->specialism == 'tourism' || old('specialism')=='tourism') { echo 'selected'; } @endphp>Leisure & Tourism jobs</option>
                            <option value="other" @php if(isset(Auth::user()->specialism) && Auth::user()->specialism == 'other' || old('specialism')=='other') {echo 'selected'; } @endphp>Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Salary Demand</label>
                    <div class="col-sm-9">
                        <input type="number" min="0" name="salary" value="{{ isset(Auth::user()->salary) ? Auth::user()->salary : old('salary')}}"class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Language</label>
                    <div class="col-sm-9">
                        <input type="text" name="language"  value="{{ isset(Auth::user()->language) ? Auth::user()->language : old('language') }}" placeholder="Press Enter to add more languages" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;" data-role="tagsinput tag-primary" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Education Attainment</label>
                    <div class="col-sm-9">
                        <input type="text" name="attainment" value="{{ isset(Auth::user()->attainment) ? Auth::user()->attainment : old('attainment')}}"class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Career Level</label>
                    <div class="col-sm-9">
                        <select class="form-group form-control" required name="career_level" style="margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;font-weight: bold;">
                            <option value="" readonly >Select Career Level</option>
                            <option value="starter" @php if(isset(Auth::user()->career_level) && Auth::user()->career_level=='starter'){ echo "Selected";} @endphp>Starter</option>
                            <option value="experienced" @php if(isset(Auth::user()->career_level) && Auth::user()->career_level=='experienced'){ echo "Selected";} @endphp>experienced</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Experience</label>
                    <div class="col-sm-9">
                        <select  class="form-group form-control" required name="experience" style="margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;font-weight: bold;">
                            <option value="" readonly>Select Experience </option>
                            <option value="1" @php if(isset(Auth::user()->experience) && Auth::user()->experience==1){ echo "Selected";} @endphp>0-1</option>
                            <option value="3" @php if(isset(Auth::user()->experience) && Auth::user()->experience==3){ echo "Selected";} @endphp>1-3</option>
                            <option value="5" @php if(isset(Auth::user()->experience) && Auth::user()->experience==5){ echo "Selected";} @endphp>3-5</option>
                            <option value="6" @php if(isset(Auth::user()->experience) && Auth::user()->experience==6){ echo "Selected";} @endphp>5+</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 40px;">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="float: right;">
                        <div class="input-group col-lg-6 col-md-6 col-sm-12 col-xs-12" style="display: inline-block;">
                            <label class="left-label" style="float: left;">
                                Driving License
                            </label>
                            <div style="width: 100%;display: inline-block;">
                                <label class="switch">
                                    <input type="checkbox" name="license" @php if(isset(Auth::user()->license) && Auth::user()->license=='on') echo "checked"; @endphp>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="input-group col-lg-6 col-md-6 col-sm-12 col-xs-12" style="display: inline-block;float: right;">
                            <label class="left-label" style="float: left;">
                                Profile Visible to Employers
                            </label>
                            <div style="width: 100%;display: inline-block;">
                                <label class="switch">
                                    <input type="checkbox" name="visible" @php if(isset(Auth::user()->visible) && Auth::user()->visible==1) echo "checked"; @endphp>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 40px;">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="float: right;">
                        <div class="input-group col-lg-6 col-md-6 col-sm-12 col-xs-12" style="display: inline-block;">
                            <label class="left-label" style="float: left;">
                                Available Part-Time
                            </label>
                            <div style="width: 100%;display: inline-block;">
                                <label class="switch">
                                    <input type="checkbox" id="parttime_available" name="parttime_available" @php if(isset(Auth::user()->parttime_available) && Auth::user()->parttime_available=='on') echo "checked"; @endphp>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            {{--<div style="width: 100%;display: inline-block;margin-top: 30px;">
                                Max <input type="number" min="0" max="48" value="{{ isset(Auth::user()->parttime_available_input) ? Auth::user()->parttime_available_input : old('parttime_available_input')}}" id="parttime_available_input" name="parttime_available_input" disabled> Hours per Week
                            </div>--}}
                        </div>
                        <div class="input-group col-lg-6 col-md-6 col-sm-12 col-xs-12" style="display: inline-block;float: right;">
                            <label class="left-label" style="float: left;">
                                Available Full-Time
                            </label>
                            <div style="width: 100%;display: inline-block;">
                                <label class="switch">
                                    <input type="checkbox" id="fulltime_available" name="fulltime_available" @php if(isset(Auth::user()->fulltime_available) && Auth::user()->fulltime_available=='on') echo "checked"; @endphp>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 25px;">
                    <label for="" class="col-sm-3 control-label">Preferred Profession</label>
                    <div class="col-sm-9">
                        <input  data-role="tagsinput tag-primary" type="text" placeholder="Press Enter to add more Professions" name="profession" value="{{ isset(Auth::user()->profession) ? Auth::user()->profession : old('profession')}}"class="form-control" >
                    </div>
                </div>
                <div class="form-group" style="margin-top: 30px;">

                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="float: right;">

                    <label>I'm Willing to Travel a Maximum of &nbsp</label><input min="0" max="30" type="number" name="travel_distance" value="{{ isset(Auth::user()->travel_distance) ? Auth::user()->travel_distance : old('travel_distance')}}">
                    <label>&nbsp From &nbsp</label>
                    <select name="travel_city">
                        <option value="" >Select City</option>
                        <option value="Amsterdam" @php if(isset(Auth::user()->travel_city) && Auth::user()->travel_city=='Amsterdam'){ echo "Selected";} @endphp>Amsterdam</option>
                        <option value="Utrecht" @php if(isset(Auth::user()->travel_city) && Auth::user()->travel_city=='Utrecht'){ echo "Selected";} @endphp>Utrecht</option>
                        <option value="Rotterdam" @php if(isset(Auth::user()->travel_city) && Auth::user()->travel_city=='Rotterdam'){ echo "Selected";} @endphp>Rotterdam</option>
                    </select>
                </div>

                </div>

                <div class="form-group" style="margin-top: 50px;">
                    <div class="row">

                        <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
                            <div class="row" style="display: block;text-align: center;">
                                <input type="checkbox" name="working_now" @php if(isset(Auth::user()->working_now) && Auth::user()->working_now=='on') echo "checked"; @endphp>
                                <label>I'm Working Right now</label>
                            </div>
                            <div class="row" style="display: block;margin-top: 30px;">
                                <div class="col-sm-4">
                                    Since
                                </div>
                                <div class="col-sm-8">
                                    <input style="margin: 0;" class="form-control form-group" type="date" name="working_now_date" value="{{ isset(Auth::user()->working_now_date) ? Auth::user()->working_now_date : old('working_now_date')}}">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-sm-4">
                                    In the Function of
                                </div>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="function_now"  value="{{ isset(Auth::user()->function_now) ? Auth::user()->function_now : old('function_now')}}">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-sm-4">
                                    Name of Employer
                                </div>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="employer_name" value="{{ isset(Auth::user()->employer_name) ? Auth::user()->employer_name : old('employer_name')}}">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-sm-12">
                                    Short Description of Activities
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea name="description_activity" rows="3" class="form-control ">{{ isset(Auth::user()->description_activity) ? Auth::user()->description_activity  : old('description_activity') }}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
                            <div class="row" style="display: block;text-align: center;">
                                <input type="checkbox" name="not_working_now" @php if(isset(Auth::user()->not_working_now) && Auth::user()->not_working_now=='on') echo "checked"; @endphp>
                                <label>I'm not Working at the Moment</label>
                            </div>
                            <div class="row" style="display: block;margin-top: 30px;">
                                <div class="col-sm-5">
                                    <b>Name</b> of Last Employer
                                </div>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="last_employer_name" value="{{ isset(Auth::user()->last_employer_name) ? Auth::user()->last_employer_name : old('last_employer_name')}}">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-sm-5">
                                    In the Function of
                                </div>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="function_not_now"  value="{{ isset(Auth::user()->function_not_now) ? Auth::user()->function_not_now : old('function_not_now')}}">
                                </div>
                            </div>
                            <div class="row" style="display: block;margin-top: 20px;">
                                <div class="col-sm-5">
                                    I worked Here  From
                                </div>
                                <div class="col-sm-3">
                                    <input style="margin: 0;" class="form-control form-group" type="date" name="working_now_start_date" value="{{ isset(Auth::user()->working_now_start_date) ? Auth::user()->working_now_start_date : old('working_now_start_date')}}">
                                </div>
                                <div class="col-sm-1" style="padding-top: 6px;">
                                    &nbspTo&nbsp
                                </div>
                                <div class="col-sm-3">
                                    <input style="margin: 0;" class="form-control form-group" type="date" name="working_now_end_date" value="{{ isset(Auth::user()->working_now_end_date) ? Auth::user()->working_now_end_date : old('working_now_end_date')}}">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-sm-12">
                                    Short Description of Activities
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea name="description_activity_old" rows="3" class="form-control ">{{ isset(Auth::user()->description_activity_old) ? Auth::user()->description_activity_old  : old('description_activity_old') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Website</label>
                    <div class="col-sm-9">
                        <input type="website" name="website" value="{{ isset(Auth::user()->website) ? Auth::user()->website : old('website')}}"class="form-control" >
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Phone</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" value="{{ isset(Auth::user()->phone) ? Auth::user()->phone : old('phone')}}" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">What do Employees Say about Company</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="" class="col-sm-12 control-label">Name</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" id="review1_name" name="review1_name" value="{{ isset(Auth::user()->review1_name) ? Auth::user()->review1_name : old('review1_name')}}" class="form-control ">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="" class="col-sm-12 control-label">Function</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" id="review1_function" name="review1_function" value="{{ isset(Auth::user()->review1_function) ? Auth::user()->review1_function : old('review1_function')}}" class="form-control ">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="" class="col-sm-12 control-label">Sayings</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea name="review1_saying" rows="3" class="form-control ">{{ isset(Auth::user()->review1_saying) ? Auth::user()->review1_saying  : old('review1_saying') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="" class="col-sm-12 control-label">Name</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" id="review2_name" name="review2_name" value="{{ isset(Auth::user()->review2_name) ? Auth::user()->review2_name : old('review2_name')}}" class="form-control ">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="" class="col-sm-12 control-label">Function</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" id="review2_function" name="review2_function" value="{{ isset(Auth::user()->review2_function) ? Auth::user()->review2_function : old('review2_function')}}" class="form-control ">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="" class="col-sm-12 control-label">Sayings</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea name="review2_saying" rows="3" class="form-control ">{{ isset(Auth::user()->review2_saying) ? Auth::user()->review2_saying  : old('review2_saying') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="" class="col-sm-12 control-label">Name</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" id="review3_name" name="review3_name" value="{{ isset(Auth::user()->review3_name) ? Auth::user()->review3_name : old('review3_name')}}" class="form-control ">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="" class="col-sm-12 control-label">Function</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" id="review3_function" name="review3_function" value="{{ isset(Auth::user()->review3_function) ? Auth::user()->review3_function : old('review3_function')}}" class="form-control ">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="" class="col-sm-12 control-label">Sayings</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea name="review3_saying" rows="3" class="form-control ">{{ isset(Auth::user()->review3_saying) ? Auth::user()->review3_saying  : old('review3_saying') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Youtube</label>
                    <div class="col-sm-9">
                        <input type="text" name="youtube" value="{{ Auth::user()->youtube }}" class="form-control" >
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Facebook</label>
                    <div class="col-sm-9">
                        <input type="text" name="facebook" value="{{ Auth::user()->facebook }}" class="form-control" >
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Instagram</label>
                    <div class="col-sm-9">
                        <input type="text" name="instagram" value="{{ Auth::user()->instagram }}" class="form-control" >
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Twitter</label>
                    <div class="col-sm-9">
                        <input type="text" name="twitter" value="{{ Auth::user()->twitter }}" class="form-control" >
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Google Plus</label>
                    <div class="col-sm-9">
                        <input type="text" name="gplus" value="{{ Auth::user()->gplus }}" class="form-control" >
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Linkedin</label>
                    <div class="col-sm-9">
                        <input type="text" name="linkedin" value="{{ Auth::user()->linkedin }}" class="form-control" >
                    </div>
                </div>
                <hr>
            @endif
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">Save Changes <i class="md md-lock-open"></i></button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
        <div role="tabpanel" class="tab-pane" id="ac_password">

            {!! Form::open(array('url' => 'admin/profile_pass','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">New Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password"  class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password_confirmation"  class="form-control" >
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">Save Changes <i class="md md-lock-open"></i></button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>
</div>
</div>

<style>

    .bootstrap-tagsinput
    {
        height: auto;

    }

</style>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        console.log($('#parttime_available').val());
        $('#parttime_available').on('change',function () {
            if($(this).prop("checked") == true){
                $('#parttime_available_input').removeAttr('disabled');
                $('#fulltime_available').attr('disabled','disabled');
            }
            else{
                console.log($('#parttime_available').val());
                $('#parttime_available_input').attr('disabled','disabled');
                $('#fulltime_available').removeAttr('disabled');
            }
        });
        $('#fulltime_available').on('change',function () {
            if($(this).prop("checked") == true){
                 $('#parttime_available_input').attr('disabled','disabled');
                $('#parttime_available').attr('disabled','disabled');
            }
            else{
                $('#parttime_available').removeAttr('disabled');
            }
        });
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
                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value);
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value);
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
        var backend_date = {{isset(Auth::user()->deadlineDate)?Auth::user()->deadlineDate:Date(1)}};
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
