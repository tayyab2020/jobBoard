@extends("app")
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGfQhIC7_QAkMKlYYrctdoQg78iQJIm6o&libraries=places&region=nl" async defer></script>--}}
@section('head_title', 'Create a new account | '.getcong('site_name') )
@section('head_url', Request::url())
@section("content")
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
        <div class="container">
            <div class="row">&nbsp</div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="page-title">
                        <h2>Create Your CV</h2>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="active">Create your CV</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<html><head>
 
    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="{{ URL::asset('assets/css/bootstrap-theme1.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">

    <link href="{{ URL::asset('assets/css/tabs.css') }}" rel="stylesheet">

    <!-- Optional theme -->
    <link href="{{ URL::asset('assets/css/magnific-popup.css') }}" rel="stylesheet">

    <!-- Latest compiled and minified JavaScript -->
    <script src="{{ URL::asset('assets/js/bootstrap1.min.js') }}" ></script>

    <script src="{{ URL::asset('assets/js/holder.js') }}" ></script>

    <script src="{{ URL::asset('assets/js/jquery.magnific-popup.min.js') }}" ></script>


    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <style>
        .form-label-doc { margin-right: 132px; margin-left: 5px; width:60px; margin-bottom: 15px; }
        #popup-form #button { margin-left: 5px; margin-top: 5px; width: 180px !important; }
        #popup-form textarea { height: 100px; width: 300px; }
        #popup-form input { width: 300px; }
        #popup-form .page-header { margin-top: -15px; margin-left: 5px; }
    </style>

    <style id="holderjs-style" type="text/css"></style></head>
<body style="">



<div class="wblue">

    <div class="container wrapper">
        <div class="page-header" style="border:0;">
            <h1>Create Your CV</h1>
        </div>


        <div class="row">
            <div class="col-lg-11">
                <form action="{{ URL::to('save-cv') }}" name="formular" id="form" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{csrf_token()}}">


                    <div class="content">
                        <style>
                            td { padding: 15px; margin: 0 10px; width:100px; }
                            textarea { height: 150px !important; width: 450px !important;  }
                            .small { font-size: 10px; }
                        </style>
                        <script type="text/javascript">

                            var rowNum = 0;

                            function addRow(frm) {
                                rowNum ++;
                                var row = '<div id="rowNum'+rowNum+'"><br/><label>Jobs applied for: </label></label><input name="jobsapp[]" value="" /><br /><label>Position: </label> <input name="position[]" value="" style="margin-left: 18px;" /><br /><label>Preferred job: </label> <input name="prefjob[]" value="" style="margin-left: 18px;" /><br /><label>Studies applied job: </label> <input name="studiesappjob[]" value="" style="margin-left: 18px;" /><br /><label>Personal statement: </label> <input name="personstatement[]" value="" style="margin-left: 18px;" /><br /><input onclick="addRow(this.form);" type="button" value="Add job" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"></div>';
                                jQuery('#itemRows').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow2(frm) {
                                rowNum ++;
                                var row = '<div id="rowNum'+rowNum+'"><hr/><br/><label>Years (from - to): </label><input name="exyears[]" required value="" /><br /><label>Occupation or position held: </label><input name="occupation[]" required value="" /><br /><label style="display: block;float: left;padding-top: 15px;">Explain your work (2-3 lines): </label> <textarea name="exp[]" required style="margin-left: 18px;" ></textarea><br><br /><br /><input onclick="addRow2(this.form);" type="button" value="Add experience" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></div>';
                                jQuery('#itemRows2').append(row);
                                frm.add_name.value = '';
                            }
                            function addRow3(frm) {
                                rowNum ++;
                                var row = '<div id="rowNum'+rowNum+'"><hr/><br/><label>Years (from - to): </label><input name="edyears[]" value="" /><br /><label>Qualification awarded: </label><input name="qualific[]" value="" /><br /><label>Institute: </label> <input name="eqf[]" value="" style="margin-left: 18px;" /><br /><br /><br /><input onclick="addRow3(this.form);" type="button" value="Add education" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></div>';
                                jQuery('#itemRows3').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow4(frm) {
                                rowNum ++;
                                var row = '<br/><div id="rowNum'+rowNum+'"><li><small>One skill per line</small><br/><textarea name="skills[]"></textarea><br /><input onclick="addRow4(this.form);" type="button" value="Add skill" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></li></div>';
                                jQuery('#itemRows4').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow5(frm) {
                                rowNum ++;
                                var row = '<br/><div id="commskillsrowNum'+rowNum+'"><li><input name="commskills[]" value="" /><br /><input onclick="addRow5(this.form);" type="button" value="Add skill" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></li></div>';
                                jQuery('#itemRows5').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow6(frm) {
                                rowNum ++;
                                var row = '<br/><div id="orgskillsrowNum'+rowNum+'"><li><input name="orgskills[]" value="" /><br /><input onclick="addRow6(this.form);" type="button" value="Add skill" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></li></div>';
                                jQuery('#itemRows6').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow7(frm) {
                                rowNum ++;
                                var row = '<br/><div id="jobrelskillrowNum'+rowNum+'"><li><input name="jobrelskill[]" value="" /><br /><input onclick="addRow7(this.form);" type="button" value="Add skill" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></li></div>';
                                jQuery('#itemRows7').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow8(frm) {
                                rowNum ++;
                                var row = '<br/><div id="comprowNum'+rowNum+'"><li><input name="compskills[]" value="" /><br /><input onclick="addRow8(this.form);" type="button" value="Add skill" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></li></div>';
                                jQuery('#itemRows8').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow9(frm) {
                                rowNum ++;
                                var row = '<br/><div id="otherrowNum'+rowNum+'"><li><input name="otherskills[]" value="" /><br /><input onclick="addRow9(this.form);" type="button" value="Add skill" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></li></div>';
                                jQuery('#itemRows9').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow10(frm) {
                                rowNum ++;
                                var row = '<br/><div id="dlicencerowNum'+rowNum+'"><li><input name="dlicence[]" value="" /><br /><input onclick="addRow10(this.form);" type="button" value="Add licence" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></li></div>';
                                jQuery('#itemRows10').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow11(frm) {
                                rowNum ++;
                                var row = '<br/><div id="rowNum'+rowNum+'"><hr /><label>Language: </label><input name="otherlang[]" value="" /><br /><label>Certificate: </label><input name="certificate[]" value="" /><br /><table border="1" cols="5" width="100%"><tr><td colSpan="2">UNDERSTANDING</td><td colSpan="2">SPEAKING</td><td colSpan="1">WRITING</td></tr><tr><td >Listening </td><td >Reading </td><td>Spoken interaction</td><td>Spoken production</td><td></td></tr><tr><td><input name="listening[]" value="" width="100px;" /> </td><td ><input name="reading[]" value="" /> </td><td><input name="spokeni[]" value="" /></td><td><input name="production[]" value="" /></td><td><input name="writting[]" value="" /></td></tr></table><input onclick="addRow11(this.form);" type="button" value="Add language" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></div>';
                                jQuery('#itemRows11').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow12(frm) {
                                rowNum ++;
                                var row = '<br/><div id="rowNum'+rowNum+'"><input name="annexes[]" value="" /><br /><input onclick="addRow12(this.form);" type="button" value="Add annex" class="btn btn-primary" style="margin-left: 0;" /><input type="button" class="btn btn-primary" value="Remove" onclick="removeRow('+rowNum+');"/></div>';
                                jQuery('#itemRows12').append(row);
                                frm.add_name.value = '';
                            }

                            function addRow13(frm) {
                                rowNum ++;
                                var row = '<br/><div id="rowNum'+rowNum+'"><label>Select: </label><select name="addinfo[]" class="type form-control" style="width:19%; display: inline;" ><option value="Publications" >Publication</option><option value="Presentations" >Presentation</option><option value="Conferences" >Conference</option><option value="Seminars" >Seminar</option><option value="Honour or award" >Honour or award</option><option value="Memberships" >Membership</option><option value="References">Reference</option></select><br/><label>Name: </label><input name="addname[]" value="" style="margin-left: 6px;" /><input type="button" class="btn btn-primary" value="Remove" style="margin-top:17px; " onclick="removeRow('+rowNum+');"/><br/><input onclick="addRow13(this.form);" type="button" value="Add" class="btn btn-primary" style="margin-left: 0;" /></div>';
                                jQuery('#itemRows13').append(row);
                                frm.add_name.value = '';
                            }

                            function removeRow(rnum) {
                                jQuery('#rowNum'+rnum).remove();
                            }

                            var userid = 15;

                            $(document).ready(function () {

                                $("#uploadbutton").click(function () {

                                    var input = document.getElementById("myFile");
                                    var file = input.files[0];

                                    var fd = new FormData();
                                    fd.append("myFile", file);
                                    fd.append("id", userid);

                                    var xhr = new XMLHttpRequest();
                                    xhr.upload.onprogress = function(e) {
                                        var percent = (e.position/ e.totalSize);
                                        // Render a pretty progress bar
                                    };
                                    xhr.onreadystatechange = function(e) {
                                        if(this.readyState === 4) {
                                            // Handle file upload complete
                                            $("#photo").val(xhr.responseText);
                                            $("#form-logo").attr("src", "images/documents_photo/"+xhr.responseText);
                                            $("#upnote").html('<span style="color: green;">Image uploaded succesfuly.</span>');
                                        }
                                    };
                                    xhr.open('POST', 'upimage.php', true);
                                    xhr.send(fd);

                                });

                                $('#myTab a').click(function (e) {
                                    e.preventDefault()
                                    $(this).tab('show')
                                })

                            });


                        </script>

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#perosnal" data-toggle="tab">Perosnal Info</a></li>
                            <li><a href="#phototab" data-toggle="tab">Photo</a></li>
                            <li><a href="#work" data-toggle="tab">Work Experience</a></li>
                            <li><a href="#edu" data-toggle="tab">Education and training</a></li>
                            <li><a href="#perskills" data-toggle="tab">Personal Skills</a></li>

                        </ul>
                        <div class="tab-content" style="margin-top: 35px;">

                            <!-- Perosnal Info -->

                            <div class="tab-pane active" id="perosnal">

                                <h3>Personal Info</h3>

                                <label>Fist Name*: </label><input type="text" name="firstname" value="" required=""><br>
                                <label>Last Name*: </label><input type="text" name="lastname" value="" required=""><br>
                                <label>Job Title*: </label><input type="text" name="job" value="" required=""><br>
                                <label>Gender*: </label><input type="text" name="sex" value="" required=""><br>
                                <label>Date of birth*: </label><input type="date" name="birth" value="" required=""><br>
                                <label>Nationality*: </label><input type="text" name="Nationality" value="" required=""><br>
                                <label>House number*:</label><input type="text" name="housenumber" value="" required=""><br>
                                <label>City*: </label><input name="city" type="text" value="" required=""><br>
                                <label>Postal Code: </label><input  type="text" name="pcode" value=""><br>
                                <label>Country*: </label><input required type="text" name="country" value="" required=""><br>

                                <hr>

                                <label>Telephone number: </label><input  type="text" name="telephone" value=""><br>
                                <label>Mobile number*: </label><input required type="text" name="mobile" value=""><br>
                                <label>Email*: </label><input required type="email" name="email" value=""><br>
                                <label>Personal website: </label><input  type="text" name="pweb" value=""><br>


                            </div>

                            <!-- End Perosnal Info -->

                            <!-- Photo -->

                            <div class="tab-pane" id="phototab">
                                <h3>Photo</h3>
                                <input type="hidden" name="photo" value="" id="photo">
                                <label>Photo:</label><input type="file" name="myFile" id="myFile" required><br>
                                <span id="upnote">&nbsp;</span><br>

                            </div>

                            <!-- End Photo -->


                            <!-- Work Experience -->

                            <div class="tab-pane" id="work">

                                <h3>Work Experience</h3>

                                <label>Years (from - to): </label><input type="text" required name="exyears[]" value=""><br>
                                <label>Occupation or position held: </label><input type="text" required name="occupation[]" value=""><br>
                                <label style="display: block;float: left;padding-top: 15px;">Explain your work (2-3 lines): </label> <textarea name="exp[]" required style="margin-left: 18px;" ></textarea><br>


                                <div id="itemRows2">
                                    <input type="hidden" name="add_name"> <input onclick="addRow2(this.form, '#itemRows2');" type="button" value="Add experience" class="btn btn-primary" style="margin-left: 0;">
                                </div>

                            </div>

                            <!-- End Work Experience -->

                            <!-- Education and training -->

                            <div class="tab-pane" id="edu">

                                <h3>Education and training</h3>
                                <label>Years (from - to): </label><input type="text" name="edyears[]" value=""><br>
                                <label>Qualification awarded: </label><input type="text" name="qualific[]" value=""><br>
                                <label>Institute: </label> <input type="text" name="eqf[]" value="" style="margin-left: 18px;"><br>


                                <div id="itemRows3">
                                    <input type="hidden" name="add_name"> <input onclick="addRow3(this.form, '#itemRows3');" type="button" value="Add education" class="btn btn-primary" style="margin-left: 0;">
                                </div>


                            </div>

                            <!-- End Education and training -->

                            <!-- Personal Skills -->

                            <div class="tab-pane" id="perskills">

                                <h3>Personal Skills</h3>
                                <label>Skills: </label> <div style="width: 40%;display: inline-block;border: 1px solid #ccc;margin: 10px 0 20px 17px;box-shadow: inset 0 1px 1px rgba(0,0,0,.075);color: #555;height: auto;font-size: 14px;line-height: 1.42857143;border-radius: 4px;">

                                    <input type="text"  name="skills" value="" data-role="tagsinput tag-primary">

                                </div><br>


                                <h4>Other language(s)</h4>
                                <label>Language: </label><input type="text"  name="otherlang[]" value=""><br>
                                <label>Certificate: </label><input type="text"  name="certificate[]" value=""><br>
                                <label>Enter level: <small>(example: C1, B2)</small> </label>

                                <table border="1" cols="5" width="100%">

                                    <tbody><tr>

                                        <td colspan="2">UNDERSTANDING</td><td colspan="2">SPEAKING</td><td colspan="1">WRITING</td>

                                    </tr>
                                    <tr>

                                        <td>Listening </td><td>Reading </td><td>Spoken interaction</td><td>Spoken production</td><td></td>

                                    </tr>
                                    <tr>

                                        <td><input type="text"  name="listening[]" value="" width="100px;"> </td><td><input type="text"  name="reading[]" value=""> </td><td><input type="text" name="spokeni[]" value=""></td><td><input type="text" name="production[]" value=""></td><td><input type="text" name="writting[]" value=""></td>

                                    </tr>
                                    </tbody></table>

                                <div id="itemRows11">
                                    <input type="hidden" name="add_name"> <input onclick="addRow11(this.form);" type="button" value="Add language" class="btn btn-primary" style="margin-left: 0;">
                                </div>

                            </div>

                            <style>

                                .bootstrap-tagsinput {
                                    display: inline-block;
                                    padding: 0px 6px;
                                    color: #555;
                                    vertical-align: middle;
                                    border-radius: 4px;
                                    max-width: 100%;
                                    line-height: 22px;
                                    cursor: text;
                                    width: 100%;
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

                            <script>
                                $(document).ready(function() {

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

                                });

                            </script>

                            <!-- End Personal Skills -->



                        </div> <!-- End Tab Content -->


                        <input type="submit" value="Create PDF" class="btn btn-primary submit-button"  style="margin-left: 0;">


                    </div></form>
            </div>
        </div>
    </div>

</div><!--./container-->



</body></html>
@endsection
