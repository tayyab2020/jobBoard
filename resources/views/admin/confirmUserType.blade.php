<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{getcong('site_name')}} Admin</title>

    <link href="{{ URL::asset('upload/'.getcong('site_favicon')) }}" rel="shortcut icon" type="image/x-icon" />

    <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/style.css') }}">

    <script src="{{ URL::asset('admin_assets/js/jquery.js') }}"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .panel-body {
            background-color: black;
            font-family: cursive;
        }

        .glow {
            font-size: 12px;
            color: #fff;
            text-align: center;
            -webkit-animation: glow 1s ease-in-out infinite alternate;
            -moz-animation: glow 1s ease-in-out infinite alternate;
            animation: glow 1s ease-in-out infinite alternate;
        }

        @-webkit-keyframes glow {
            from {
                text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
            }

            to {
                text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">

    <div id="main">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login">
                    <div class="logo" href="#" align="">
                        <img src="{{ URL::asset('upload/'.getcong('site_logo')) }}" width="100%" style="width: 100%" alt="logo">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="message">
                    <div class="panel panel-default panel-shadow">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6 col-sm-offset-3" style="text-align: center">
                                    <label class="glow"> Select your Account Type</label>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6" style="text-align: center">
                                    <div style="cursor: pointer" onclick="employer()">
                                        <div class="glow" title="By Employer means, You can post Job Ads and look for Candidates">
                                            <i class="fa fa-users fa-5x"></i><br>
                                            <span>Employer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6" style="text-align: center">
                                    <div style="cursor: pointer" onclick="candidate()">
                                        <div class="glow" title="By Candidtae means, You can Apply for Jobs & get hired">
                                            <i class="fa fa-user fa-5x"></i><br>
                                            <span>Candidate</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Plugins -->
<script src="{{ URL::asset('admin_assets/js/plugins.js') }}"></script>

<!-- App Scripts -->
<script src="{{ URL::asset('admin_assets/js/scripts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
    function candidate(){
        Swal.fire({
            title: 'Are you sure, You want to Continue as Candidate?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Done!',
                    'Your Candidate Account has been created Successfully',
                    'success'
                )

                setTimeout(function(){
                    location.replace("/admin/saveUserType/candidate");
                }, 3000)
            }
        })
    }
    function employer(){
        Swal.fire({
            title: 'Are you sure, You want to Continue as Employer?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Done!',
                    'Your Employer Account has been created Successfully',
                    'success'
                );
                setTimeout(function(){
                    location.replace("/admin/saveUserType/employer");
                }, 3000)
            }
        })
    }
</script>

</body>

</html>
