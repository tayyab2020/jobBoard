@extends("app")

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
                  <h3>Register an account for free</h3>

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
											    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                      {!! Form::open(array('url' => 'register','class'=>'','id'=>'registerform','role'=>'form')) !!}

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <label for="email">First Name</label>
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First name">
                        </div>
                        <div class="form-group">
                            <label for="email">Last Name</label>
                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last name">
                        </div>
                         <div class="form-group">
                            <label for="email">Mobile No</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Mobile No">
                        </div>
                        <div class="form-group">

		                    <label for="usertype">City</label>

		                        <select name="city" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
										@foreach($city_list as $city)
										<option value="{{$city->city_name}}">{{$city->city_name}}</option>

										@endforeach

								</select>

                		</div>
                        <div class="form-group checkbox">
                              <p style="margin-left: 3px;">Already have account ? <a href="{{ URL::to('login') }}">Sign in here.</a></p>



                            <a href="redirect/facebook">
                                <button type="button" class="loginBtn loginBtn--facebook">
                                Login with Facebook
                                    </button>
                            </a>


                            <a href="redirect/google">

                            <button type="button" class="loginBtn loginBtn--google" href="redirect/google">
                                Login with Google
                            </button>

                            </a>


                        </div>


                        <div class="form-group" style="margin-left: 3px;">
                          <button type="submit" name="submit" class="btn btn-warning"><i class="fa fa-lock"></i> Sign up</button>
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
            box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
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

@endsection
