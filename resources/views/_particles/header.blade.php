<!-- begin:navbar -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('/') }}" >
                @if(getcong('site_logo')) <img style="padding-left: -120px;" src="{{ URL::asset('upload/'.getcong('site_logo')) }}?{{date('m/d/Y h:i:s')}}"
                                               alt=""> @else {{getcong('site_name')}} @endif
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-top">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{classActivePathPublic('jobs')}}"><a href="{{ URL::to('jobs/') }}">Alle banen</a>
                </li>
                <li class="{{classActivePathPublic('agents')}}"><a href="{{ URL::to('employers/') }}">Workgevers</a></li>
                @if(isset(Auth::user()->usertype) && Auth::user()->usertype=='employer')
                    <li class="{{classActivePathPublic('candidates')}}">
                        <a href="{{ URL::to('candidates/') }}">Kandidaten</a></li>
                @else
                    <li class="{{classActivePathPublic('candidates')}}">
                        <a href="{{ URL::to('login') }}">Kandidaten</a></li>
                @endif
                <li class="{{classActivePathPublic('application_tips')}}"><a href="{{ URL::to('application_tips/') }}">Sollicitatietips</a></li>
                <li class="{{classActivePathPublic('blogs')}}"><a href="{{ URL::to('blogs/') }}">Blog</a></li>

                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ URL::to('admin/dashboard/') }}">Dashboard</a></li>
                            <li><a href="{{ URL::to('admin/profile/') }}">Profile</a></li>
                            <li><a href="{{ URL::to('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                    @if(Auth::user()->usertype=="Admin" || Auth::user()->usertype=="employer")
                        <li><a href="{{ URL::to('admin/jobs/addjob') }}" class="post_your_job">Zzzooo gepiept</a></li>
                    @elseif(Auth::user()->usertype=="candidate")
                        <li><a href="{{ URL::to('cv/create') }}" class="signup">Maak jouw digitale CV aan</a></li>
                        <br>
                        <li style="float: right"><a href="{{ URL::to('admin/savedjobs') }}">
                                <button title="Click to view your Saved Jobs">
                                    <b>{{Auth::user()->views}}&nbsp</b> <i class="fa fa-heart" ></i>
                                </button>
                            </a></li>
                    @endif
                @else
                    <li><a href="{{ URL::to('cv/create') }}" class="signup">Maak jouw digitale CV aan</a></li>
                    <li><a href="{{ URL::to('login') }}" class="post_your_job">Zzzooo gepiept</a></li>
                    <br>
                    <li  style="float: right" class="{{classActivePathPublic('register_employer')}} "><a href="{{ URL::to('register_employer') }}" title="SignUp for Employer" class="">Registreren</a></li>
                    <li style="float: right"><a href="{{ URL::to('login') }}" class="signin">Innloggen</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>
<!-- end:navbar -->
