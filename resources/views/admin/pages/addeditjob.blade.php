@extends("app")
@section('head_title', 'Add New Job | '.getcong('site_name') )
@section('head_url', Request::url())
@section("content")
    <script src="https://kit.fontawesome.com/29532268c4.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="page-title">
                        <h2>Add New Job</h2>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="active">Add New Job</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end:header -->
<div id="main" style="width: 60%;margin: auto;margin-top: 25px;">
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
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a class="persistant-disabled" data-content="stepper-step-1"  data-toggle="tab" aria-controls="stepper-step-1" role="tab" title="Step 1">
                        <span class="round-tab"><h2>@php if(isset($job)){ echo "Edit Job Details";}else{echo"Add Job Details";} @endphp</h2></span>
                    </a>
                </li>
            </ul>
            {!! Form::open(array('url' => array('admin/jobs/addjob'),'class'=>'form-horizontal padding-15','name'=>'job_form','id'=>'job_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
            <input type="hidden" required name="id" value="{{ isset($job->id) ? $job->id : null }}">
                <div class="tab-content">
                    <div class="fade in active">
                        <div class="form-group main-div" style="width: 90%;margin: auto;">
                            <label class="left-label" style="float: left;">Select Job type</label>
                            <select required name="job_type" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;font-weight: bold;">
                            @foreach($types as $type)
                                <option value={{$type->id}}  @php if(isset($job->job_type) && $job->job_type==$type->id){ echo "Selected";} @endphp>{{$type->types}}</option>
                            @endforeach
                            </select>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <label class="left-label" style="float: left;">Job Title</label>
                                <div  style="min-width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                    <input type="text" required name="title" value="{{ isset($job->job_name) ? $job->job_name : old('title') }}"  style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;font-weight: bold;">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <label class="left-label" style="float: left;">Job Description</label>
                                <div style="width: 100%;display: inline-block;margin: auto">
                                    <textarea required name="description" rows="10" class="form-control stepper-step-3-validate summernote">{{ isset($job->description) ? $job->description : old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                    <label class="left-label" style="float: left;">Specialism</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                        <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fa fa-star"></i></div>
                                        <input type="text"  value="{{ isset($job->specialism) ? $job->specialism : old('specialism') }}"  required name="specialism"  style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px; text-align: left;font-weight: bold;">
                                    </div>
                                </div>
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;">
                                    <label class="right-label" style="float: left;">Offered Salary</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                        <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fa fa-money" aria-hidden="true"></i></div>
                                        <input type="number" value="{{ isset($job->salary) ? $job->salary : old('salary') }}"  required name="salary"  style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                    <label class="left-label" style="float: left;">Branche</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                        <select required name="career" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;font-weight: bold;">
                                            <option value="" readonly >Select Career Level</option>
                                            <option value="starter" @php if(isset($job->career_level) && $job->career_level=='starter'){ echo "Selected";} @endphp>Starter</option>
                                            <option value="experienced" @php if(isset($job->career_level) && $job->career_level=='experienced'){ echo "Selected";} @endphp>experienced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;">
                                    <label class="right-label" style="float: left;">Experience</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                        <select required name="experience" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;font-weight: bold;">
                                            <option value="" readonly>Select Experience </option>
                                            <option value="1" @php if(isset($job->experience) && $job->experience==1){ echo "Selected";} @endphp>0-1</option>
                                            <option value="3" @php if(isset($job->experience) && $job->experience==3){ echo "Selected";} @endphp>1-3</option>
                                            <option value="5" @php if(isset($job->experience) && $job->experience==5){ echo "Selected";} @endphp>3-5</option>
                                            <option value="6" @php if(isset($job->experience) && $job->experience==6){ echo "Selected";} @endphp>5+</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block; left:0">
                                    <label class="left-label" style="float: left;">Qualification</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                        <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fa fa-graduation-cap"></i></div>
                                        <input type="text" value="{{ isset($job->qualification) ? $job->qualification : old('qualification')}}"  name="qualification"  style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px; text-align: left;font-weight: bold;">
                                    </div>
                                </div>
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;">
                                    <label class="right-label" style="float: left;">Educational Attainment</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                        <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fa fa-graduation-cap"></i></div>
                                        <input type="text" value="{{ isset($job->education_attainment) ? $job->education_attainment : old('education') }}"  required name="education"  style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px; text-align: left;font-weight: bold;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                    <label class="left-label" style="float: left;">Application Link</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                        <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fa fa-link"></i></div>
                                        <input type="text" value="{{ isset($job->link) ? $job->link : old('link')}}"  required name="link" title="Enter Link without https://www." placeholder="e.g Google.com" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px; text-align: left;font-weight: bold;">
                                    </div>
                                </div>
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;">
                                    <label class="right-label" style="float: left;">Application DeadLine Date</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                        <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fa fa-calendar"></i></div>
                                        <input type='text' value="{{ isset($job->deadlineDate) ? $job->deadlineDate : old('date')}}"  placeholder="Select Date" required name="date" style="box-shadow: none;border: 0;margin: 0;float: left;width: 80%;left: 0;height: 37.5px;text-align: left;padding-left: 0px;" class="form-control stepper-step-2-validate" id='datetimepicker4' />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                    <label class="left-label" style="float: left;">
                                        Urgent Required
                                    </label>
                                    <div style="width: 100%;display: inline-block;">
                                        <label class="switch">
                                            <input type="checkbox" name="urgent" @php if(isset($job->urgent) && $job->urgent=='on') echo "checked"; @endphp>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;">
                                    <label class="left-label" style="float: left;">
                                        CoffeeDate
                                    </label>
                                    <div style="width: 100%;display: inline-block;">
                                        <label class="switch">
                                            <input type="checkbox" name="coffeedate" @php if(isset($job->coffeedate) && $job->coffeedate=='on') echo "checked"; @endphp>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                    <label class="left-label" style="float: left;">
                                        Hours A Week
                                    </label>
                                    <div style="width: 100%;display: inline-block;">
                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                                            <input type="number" value="{{ isset($job->hours) ? $job->hours : old('hours') }}"  required name="hours"  style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;">
                                    <label class="left-label" style="float: left;">
                                        Work from Home
                                    </label>
                                    <div style="width: 100%;display: inline-block;">
                                        <label class="switch">
                                            <input type="checkbox" name="workfromhome" @php if(isset($job->workfromhome) && $job->workfromhome=='on') echo "checked"; @endphp>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                        <label class="left-label" style="float: left;">KEYWORDS/TAGS</label>
                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                            <input type="text" name="keywords"  value="{{ isset($job->keywords) ? $job->keywords : old('keywords') }}" placeholder="Keywords" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;" data-role="tagsinput tag-primary" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 40px;">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                    <label class="left-label" style="float: left;">Address</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                        <input type="text" id="address-input" placeholder="Enter Address" required name="address" value="{{ isset($job->address) ? $job->address : old('address') }}" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control map-input stepper-step-4-validate">
                                        <input type="hidden" required name="address_latitude" id="address-latitude" value="{{ isset($job->address_latitude) ? $job->address_latitude : old('address_latitude') }}" />
                                        <input type="hidden" required name="address_longitude" id="address-longitude" value="{{ isset($job->address_longitude) ? $job->address_longitude : old('address_longitude') }}" />

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                    <div id="address-map-container" style="width:100%;height:400px; ">
                                        <div style="width: 100%; height: 100%" id="address-map"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                    <label class="left-label" style="float: left;">City</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                        @if(isset($job->city_id))
                                            @foreach($city_list as $city)
                                                @if($job->city_id==$city->id)
                                                    <input type="text" value="{{isset($city->city_name)?$city->city_name:old('city')}}" readonly id="city_name" name="city" class="form-control stepper-step-4-validate" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;">
                                                    @endif
                                            @endforeach
                                        @else
                                            <input type="text" id="city_name" name="city" readonly class="form-control stepper-step-4-validate" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                                    <label class="left-label" style="float: left;">Job Image</label>
                                    <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">
                                        <div class="media">
                                            <div class="media-left">
                                                @if(isset($job->job_image) and $job->job_image!='')
                                                    <img src="{{ URL::asset('upload/members/'.$job->job_image.'-b.jpg') }}" width="150" alt="person">
                                                @endif
                                            </div>
                                            <div class="media-body media-middle">
                                                @if(isset($job->job_image) and $job->job_image='')
                                                    <div class="media-left"><a href="#" class="btn btn-default btn-rounded"><i class="md md-delete"></i></a></div><br />
                                                @endif
                                                <input type="file" required name="job_image" value="{{isset($city->job_image)?$city->job_image:old('job_image')}}" class="filestyle">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                        <hr>
                        <ul class="list-inline pull-right">
                            <li>
                                <button type="button" data-id="stepper-step-4" class="btn btn-primary submit-form">{{ isset($job) ? 'Update Job' : 'Add Job' }}</button>
                            </li>
                        </ul>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
	{{--<div class="page-header">
		<h2> {{ isset($job->job_name) ? 'Edit: '. $job->job_name : 'Add Job' }}</h2>
		<a href="{{ URL::to('admin/jobs') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>
	</div>--}}
</div>
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
        .validate-error
        {
            border: 1px solid #e02727 !important;
            border-right: 1px solid #e02727 !important;
        }

        .form-group{ width: 90%;margin: auto;}

        @media (max-width: 735px) {

            #main {
                width: 75% !important;
            }
        }


        @media (max-width: 767px) {

            .pp {

                margin-left: 0 !important;
            }
        }

        @media (max-width: 991px)
        {



            .right-label, .left-label, .right-content{
                float: none !important;
            }

            .left-div, .right-div, .main-div{

                text-align: center;

            }
        }

        input,
        textarea {
            border: 1px solid #eeeeee;
            box-sizing: border-box;
            margin: 0;
            outline: none;
            padding: 10px;
        }

        input[type="button"] {
            -webkit-appearance: button;
            cursor: pointer;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .input-group {
            clear: both;
            margin: 15px 0;
            position: relative;
        }

        .input-group input[type='button'] {
            background-color: #eeeeee;
            min-width: 38.5px;
            width: auto;
            transition: all 300ms ease;
        }

        .input-group .button-minus,
        .input-group .button-plus {
            font-weight: bold;
            height: 38.5px;
            padding: 0;
            width: 38px;
            position: relative;
        }

        .input-group .quantity-field {
            position: relative;
            height: 38px;
            left: -6px;
            text-align: center;
            width: 62px;
            display: inline-block;
            font-size: 13px;
            margin: 0 0 5px;
            resize: vertical;
        }


        input[type="number"] {
            -moz-appearance: textfield;
            -webkit-appearance: none;
        }

        .stepper .nav-tabs {
            position: relative;
        }
        .stepper .nav-tabs > li {
            width: 25%;
            position: relative;
        }
        .stepper .nav-tabs > li:after {
            content: '';
            position: absolute;
            background: #f1f1f1;
            display: block;
            width: 100%;
            height: 5px;
            top: 30px;
            left: 50%;
            z-index: 1;
        }
        .stepper .nav-tabs > li.completed::after {
            background: #34bc9b;
        }
        .stepper .nav-tabs > li:last-child::after {
            background: transparent;
        }
        .stepper .nav-tabs > li.active:last-child .round-tab {
            background: #34bc9b;
        }
        .stepper .nav-tabs > li.active:last-child .round-tab::after {
            content: '✔';
            color: #fff;
            position: absolute;
            left: 0;
            right: 0;
            margin: 0 auto;
            top: 0;
            display: block;
        }
        .stepper .nav-tabs [data-toggle='tab'] {
            width: 25px;
            height: 25px;
            margin: 20px auto;
            border-radius: 100%;
            border: none;
            padding: 0;
            color: #f1f1f1;
        }
        .stepper .nav-tabs [data-toggle='tab']:hover {
            background: transparent;
            border: none;
        }
        .stepper .nav-tabs > .active > [data-toggle='tab'], .stepper .nav-tabs > .active > [data-toggle='tab']:hover, .stepper .nav-tabs > .active > [data-toggle='tab']:focus {
            color: #34bc9b;
            cursor: default;
            border: none;
        }
        .stepper .tab-pane {
            position: relative;
            padding-top: 50px;
        }
        .stepper .round-tab {
            width: 25px;
            height: 25px;
            line-height: 22px;
            display: inline-block;
            border-radius: 25px;
            background: #fff;
            border: 2px solid #34bc9b;
            color: #34bc9b;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 14px;
        }
        .stepper .completed .round-tab {
            background: #34bc9b;
        }
        .stepper .completed .round-tab::after {
            content: '✔';
            color: #fff;
            position: absolute;
            left: 0;
            right: 0;
            margin: 0 auto;
            top: 0;
            display: block;
        }
        .stepper .active .round-tab {
            background: #fff;
            border: 2px solid #34bc9b;
        }
        .stepper .active .round-tab:hover {
            background: #fff;
            border: 2px solid #34bc9b;
        }
        .stepper .active .round-tab::after {
            display: none;
        }
        .stepper .disabled .round-tab {
            background: #fff;
            color: #f1f1f1;
            border-color: #f1f1f1;
        }
        .stepper .disabled .round-tab:hover {
            color: #4dd3b6;
            border: 2px solid #a6dfd3;
        }
        .stepper .disabled .round-tab::after {
            display: none;
        }

        ul.job-radios li{
            display: inline-block; margin: 0; padding: 0; vertical-align: top;
        }

        li{ list-style: none; }

        .type-holder-main{ position: relative; }

        ul.job-radios li input{ display: none; }

        ul.job-radios li label {  -webkit-transition: all .5s ease-in-out; transition: all .5s ease-in-out ;overflow: hidden; padding: 20px; cursor: pointer; border: solid 1px #dddddd; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; background-color: #fff;text-align: center; }

        .user-holder.create-job-holder ul.job-radios li label { display: block; min-height: 55px; }


        ul.job-radios li label span { padding-top: 15px;font-size: 13px; font-weight: 700; line-height: 19px; display: block; width: 100%; text-align: center; color: #5a2e8a !important; }


        li.active1 > div > label, label:hover{

            border-color: #5a2e8a !important;

        }

        .dropdown-menu{ position:absolute;top:100%;left:0;z-index:1000;display:none;
            float:left;min-width:160px;padding:5px 0;margin:2px 0 0;font-size:14px;
            text-align:left;list-style:none;background-color:#fff;-webkit-background-clip:padding-box;
            background-clip:padding-box;border:1px solid #ccc;border:1px solid rgba(0,0,0,.15);
            border-radius:4px;-webkit-box-shadow:0 6px 12px rgba(0,0,0,.175);
            box-shadow:0 6px 12px rgba(0,0,0,.175) }

        .bootstrap-tagsinput {
            display: inline-block;
            padding: 4px 6px;
            color: #555;
            vertical-align: middle;
            border-radius: 4px;
            max-width: 100%;
            line-height: 22px;
            cursor: text;
        }
        .bootstrap-tagsinput input {
            border: none;
            box-shadow: none;
            outline: none;
            background-color: transparent;
            padding: 0;
            margin: 0;
            width: auto !important;
            max-width: inherit;
            vertical-align: middle;
        }
        .bootstrap-tagsinput input:focus {
            border: none;
            box-shadow: none;
        }
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #fff;
        }
        .bootstrap-tagsinput .tag [data-role="remove"] {
            margin-left: 8px;
            cursor: pointer;
        }
        .bootstrap-tagsinput .tag [data-role="remove"]:after {
            content: "x";
        }
        .bootstrap-tagsinput .tag [data-role="remove"]:hover {
            box-shadow: none;
        }
        .bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
            box-shadow: none;
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
