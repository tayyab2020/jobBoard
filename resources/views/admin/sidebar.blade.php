<!-- Sidebar Left -->
  <div class="sidebar left-side" id="sidebar-left">
	 <div class="sidebar-user">
		<div class="media sidebar-padding">
			<div class="media-left media-middle">

				@if(Auth::user()->image_icon)
                    <img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" width="60" alt="person" class="img-circle">
                @else
                    <img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person" class="img-circle" width="60"/>
                @endif
			</div>
			<div class="media-body media-middle">

				<a href="{{ URL::to('admin/profile') }}" class="h4 margin-none">{{ Auth::user()->fname }}</a>
				<ul class="list-unstyled list-inline margin-none">
					<li><a href="{{ URL::to('admin/profile') }}"><i class="md-person-outline"></i></a></li>
					@if(Auth::User()->usertype=="Admin")
					<li><a href="{{ URL::to('admin/settings') }}"><i class="md-settings"></i></a></li>
					@endif
					<li><a href="{{ URL::to('admin/logout') }}"><i class="md-exit-to-app"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Wrapper Reqired by Nicescroll (start scroll from here) -->
	<div class="nicescroll">
		<div class="wrapper" style="margin-bottom:90px">
			<ul class="nav nav-sidebar" id="sidebar-menu">

               @if(Auth::user()->usertype=='Admin')

               		<li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

	                <li class="{{classActivePath('types')}}"><a href="{{ URL::to('admin/types') }}"><i class="fa fa-tags"></i>Job Types</a></li>

	                <li class="{{classActivePath('jobs')}}"><a href="{{ URL::to('admin/jobs') }}"><i class="md md-pin-drop"></i>Jobs</a></li>

					<li class="{{classActivePath('urgentjobs')}}"><a href="{{ URL::to('admin/urgentjobs') }}"><i class="md md-star"></i>Urgent Required Jobs</a></li>

					<li class="{{classActivePath('inquiries')}}"><a href="{{ URL::to('admin/inquiries') }}"><i class="fa fa-send"></i>Inquiries</a></li>

	                <li class="{{classActivePath('slider')}}"><a href="{{ URL::to('admin/slider') }}"><i class="fa fa-sliders"></i>Home Slider</a></li>

					<li class="{{classActivePath('applicationtips')}}"><a href="{{ URL::to('admin/applicationtips') }}"><i class="fa fa-list"></i>Application Tips</a></li>


					<li class="{{classActivePath('partners')}}"><a href="{{ URL::to('admin/partners') }}"><i class="fa fa-bookmark-o"></i>Partners</a></li>


					<li class="{{classActivePath('subscriber')}}"><a href="{{ URL::to('admin/subscriber') }}"><i class="md md-email"></i>Subscribers</a></li>

					<li class="{{classActivePath('blogs')}}"><a href="{{ URL::to('admin/blogs') }}"><i class="fa fa-leanpub"></i>Blogs</a></li>

					<li class="{{classActivePath('users')}}"><a href="{{ URL::to('admin/users') }}"><i class="fa fa-users"></i>Users</a></li>


	                <li class="{{classActivePath('settings')}}"><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i>Settings</a></li>
                @elseif(Auth::user()->usertype=='employer')

                    <li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="{{classActivePath('admin')}}"><a href="{{ URL::to('admin/profile') }}"><i class="md md-person-outline"></i> Account</a></li>

                    <li class="{{classActivePath('jobs')}}"><a href="{{ URL::to('admin/jobs') }}"><i class="md md-pin-drop"></i>Manage Jobs</a></li>

                    <li class="{{classActivePath('resume')}}"><a href="{{ URL::to('admin/savedCandidates') }}"><i class="fa fa-file"></i>Manage Saved Candidates</a></li>

                    <li class="{{classActivePath('inquiries')}}"><a href="{{ URL::to('admin/inquiries') }}"><i class="md md-send"></i>Manage Inquiries</a></li>

                @elseif(Auth::user()->usertype=='candidate')

                    <li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="{{classActivePath('account')}}"><a href="{{ URL::to('admin/profile') }}"><i class="md md-person-outline"></i> Account</a></li>

                    <li class="{{classActivePath('savedjobs')}}"><a href="{{ URL::to('admin/savedjobs') }}"><i class="md md-pin-drop"></i>Saved Jobs</a></li>

                    <li class="{{classActivePath('CV')}}"><a href="{{ URL::to('cv/manage') }}"><i class="fa fa-file"></i>Manage CV</a></li>

                @endif


			</ul>


		</div>
	</div>
</div>
  <!-- // Sidebar -->

  <!-- Sidebar Right -->
  <div class="sidebar right-side" id="sidebar-right">
	<!-- Wrapper Reqired by Nicescroll -->
	<div class="nicescroll">
		<div class="wrapper">
			<div class="block-primary">
				<div class="media">
					<div class="media-left media-middle">
						<a href="#">
							 @if(Auth::user()->image_icon)
                                <img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" width="60" alt="person" class="img-circle border-white">
							@else
    							<img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person" class="img-circle border-white" width="60"/>
							@endif
						</a>
					</div>
					<div class="media-body media-middle">
						<a href="{{ URL::to('admin/profile') }}" class="h4">{{ Auth::user()->name }}</a>
						<a href="{{ URL::to('admin/logout') }}" class="logout pull-right"><i class="md md-exit-to-app"></i></a>
					</div>
				</div>
			</div>
			<ul class="nav nav-sidebar" id="sidebar-menu">
				<li><a href="{{ URL::to('admin/profile') }}"><i class="md md-person-outline"></i> Account</a></li>

				@if(Auth::user()->usertype=='Admin')

				<li><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i> Settings</a></li>

				@endif

				<li><a href="{{ URL::to('admin/logout') }}"><i class="md md-exit-to-app"></i> Logout</a></li>
			</ul>
		</div>
	</div>
</div>
  <!-- // Sidebar -->
