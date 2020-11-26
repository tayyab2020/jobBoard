<!DOCTYPE html>
<html>
<head>
    <title>CV</title>

    <meta name="viewport" content="width=device-width"/>
    <meta name="description" content="The Curriculum Vitae of Joe Bloggs."/>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style type="text/css" media="all">

        .page-break {
            page-break-after: always;
        }

        html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video {
            border:0;
            font:inherit;
            font-size:100%;
            margin:0;
            padding:0;
            vertical-align:baseline;
        }

        article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section {
            display:block;
        }

        html, body {background: #4f4f4f; font-family: 'Lato', helvetica, arial, sans-serif; font-size: 16px; color: #222;border-radius: 5px;}

        .clear {clear: both;}

        p {
            font-size: 1em;
            line-height: 1.4em;
            margin-bottom: 20px;
            color: #444;
        }

        #cv {
            width: 98%;
            max-width: 800px;
            background: #f3f3f3;
            margin: 0px;
            height: 100%;
        }

        .mainDetails {
            padding: 25px 35px;
            border-bottom: 2px solid #cf8a05;
            background: #ededed;
        }

        #name h1 {
            font-size: 2.5em;
            font-weight: 700;
            font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
            margin-bottom: -6px;
        }

        #name h2 {
            font-size: 2em;
            margin-left: 2px;
            font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
        }

        #mainArea {
            padding: 0 40px;
        }

        #headshot {
            width: 15%;
            float: left;
            margin-right: 30px;
        }

        #headshot img {
            width: 100%;
            height: auto;
            -webkit-border-radius: 50px;
            border-radius: 5px;
        }

        #name {
            float: left;
        }

        #contactDetails {
            float: right;
        }

        #contactDetails ul {
            list-style-type: none;
            font-size: 0.9em;
            margin-top: 2px;
        }

        #contactDetails ul li {
            margin-bottom: 3px;
            color: #444;
        }

        #contactDetails ul li a, a[href^=tel] {
            color: #444;
            text-decoration: none;
            -webkit-transition: all .3s ease-in;
            -moz-transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -ms-transition: all .3s ease-in;
            transition: all .3s ease-in;
        }

        #contactDetails ul li a:hover {
            color: #cf8a05;
        }


        section {
            border-top: 1px solid #dedede;
            padding: 20px 0 0;
        }

        section:first-child {
            border-top: 0;
        }

        section:last-child {
            padding: 20px 0 10px;
        }

        .sectionTitle {
            float: left;
            width: 25%;
        }

        .sectionContent {
            float: right;
            width: 72.5%;
        }

        .sectionTitle h1 {
            font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
            font-style: italic;
            font-size: 1.5em;
            color: #cf8a05;
        }

        .sectionContent h2 {
            font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
            font-size: 1.5em;
            margin-bottom: -2px;
        }

        .subDetails {
            font-size: 0.8em;
            font-style: italic;
            margin-bottom: 3px;
        }

        .keySkills {
            list-style-type: none;
            -moz-column-count:3;
            -webkit-column-count:3;
            column-count:3;
            margin-bottom: 20px;
            font-size: 1em;
            color: #444;
        }

        .keySkills ul li {
            margin-bottom: 3px;
        }




    </style>

</head>
<body id="top">
<div id="cv">
    <div class="mainDetails">
        <div id="headshot">
            <img src="{{ public_path('upload/CV_images/'.$cv_image) }}"  />
        </div>

        <div id="name">

            <h2 class="quickFade delayTwo">{{$show->firstname}} {{$show->lastname}}</h2>
            <h3 class="quickFade delayThree">{{$show->job}}</h3>
        </div>

        <div id="contactDetails" class="quickFade delayFour">
            <ul>
                <li>e: <a href="mailto:joe@bloggs.com" target="_blank">{{$show->email}}</a></li>
                <li>w: <a href="http://www.bloggs.com">{{$show->pweb}}</a></li>
                <li>m: {{$show->mobile}}</li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>

    <div id="mainArea">

        <section style="margin-top: 10px;">
            <article>
                <div class="sectionTitle">
                    <h1>Personal Info</h1>
                </div>

                <div style="float: right;width: 72.5%;padding-bottom: 20px;padding-top: 5px;">
                   <label style="font-weight: bold;">Gender: </label>
                    <span>{{$show->sex}}</span>
                </div>

                <div class="clear"></div>

                <div style="float: right;width: 72.5%;padding-bottom: 20px;">
                    <label style="font-weight: bold;">Date of birth: </label>
                    <span>{{$show->birth}}</span>
                </div>

                <div class="clear"></div>

                <div style="float: right;width: 72.5%;padding-bottom: 20px;">
                    <label style="font-weight: bold;">Nationality: </label>
                    <span>{{$show->Nationality}}</span>
                </div>

                <div class="clear"></div>

                <div style="float: right;width: 72.5%;padding-bottom: 20px;">
                    <label style="font-weight: bold;">Address: </label>
                    <span>{{$show->housenumber}}</span>
                </div>

                <div class="clear"></div>

                <div style="float: right;width: 72.5%;padding-bottom: 20px;">
                    <label style="font-weight: bold;">City: </label>
                    <span>{{$show->city}}</span>
                </div>

                <div class="clear"></div>

                @if($show->pcode)

                    <div style="float: right;width: 72.5%;padding-bottom: 20px;">
                        <label style="font-weight: bold;">Postal Code: </label>
                        <span>{{$show->pcode}}</span>
                    </div>

                    <div class="clear"></div>

                    @endif

                <div style="float: right;width: 72.5%;padding-bottom: 20px;">
                    <label style="font-weight: bold;">Country: </label>
                    <span>{{$show->country}}</span>
                </div>

                <div class="clear"></div>

                @if($show->telephone)

                    <div style="float: right;width: 72.5%;padding-bottom: 20px;">
                        <label style="font-weight: bold;">Telephone: </label>
                        <span>{{$show->telephone}}</span>
                    </div>

                    <div class="clear"></div>

                @endif


            </article>

        </section>


            <section>
                <article>
                    <div class="sectionTitle">
                        <h1>Work Experience</h1>
                    </div>

                    @for($x=0; $x<count($show->exyears); $x++)

                        <div style="float: right;width: 72.5%;padding-bottom: 20px;padding-top: 5px;">
                            <article>
                                <h2 style="color:#575757;font-weight: bold;font-family: 'Rokkitt', Helvetica, Arial, sans-serif;font-size: 1.3em;">{{$show->occupation[$x]}}</h2>
                                <p class="subDetails">{{$show->exyears[$x]}}</p>
                                <p style="margin-top: 8px;font-family: sans-serif;font-size: 1em;line-height: 1.4em;margin-bottom: 20px;color: #737373;">{{$show->exp[$x]}}</p>


                            </article>
                        </div>

                        <div class="clear"></div>

                    @endfor



                </article>

            </section>


        @if($show->edyears[0])

            <section>
                <article>
                    <div class="sectionTitle">
                        <h1>Education</h1>
                    </div>

                    @for($x=0; $x<count($show->edyears); $x++)

                        <div style="float: right;width: 72.5%;padding-bottom: 20px;padding-top: 5px;">

                            <article>
                                <h2 style="color:#575757;font-weight: bold;font-family: 'Rokkitt', Helvetica, Arial, sans-serif;font-size: 1.3em;">{{$show->eqf[$x]}}</h2>
                                <p class="subDetails">{{$show->edyears[$x]}}</p>
                                <p style="margin-top: 8px;font-family: sans-serif;font-size: 1em;line-height: 1.4em;margin-bottom: 20px;color: #737373;">{{$show->qualific[$x]}}</p>

                            </article>

                        </div>

                        <div class="clear"></div>

                    @endfor



                </article>

            </section>

        @endif

        @if($skills[0])

            <section>
                <article>
                    <div class="sectionTitle">
                        <h1>Skills</h1>
                    </div>

                    <ul style="margin-left: 10px;">


                    @foreach($skills as $key => $value)

                        <li style="float: right;width: 72.5%;padding-bottom: 20px;padding-top: 5px;">

                            {{$value}}

                        </li>

                        <div class="clear"></div>

                    @endforeach

                    </ul>

                </article>

            </section>

            @endif


        @if($show->otherlang[0])

            <div class="page-break"></div>

            <section>
                <article>
                    <div class="sectionTitle">
                        <h1>Language Skills</h1>
                    </div>

                    @for($x=0; $x<count($show->otherlang); $x++)

                        <div style="float: right;width: 72.5%;padding-bottom: 20px;padding-top: 5px;">

                            <article style="padding-left: 20px;">
                                <h2 style="color:#575757;font-weight: bold;font-family: 'Rokkitt', Helvetica, Arial, sans-serif;font-size: 1.3em;">{{$show->otherlang[$x]}} ({{$show->certificate[$x]}})</h2>

                                <ul style="margin-left: 10px;">

                                    <li style="margin-top: 8px;font-family: sans-serif;font-size: 1em;line-height: 1.4em;margin-bottom: 20px;color: #737373;">Listening: {{$show->listening[$x]}}</li>
                                    <li style="margin-top: 8px;font-family: sans-serif;font-size: 1em;line-height: 1.4em;margin-bottom: 20px;color: #737373;">Reading: {{$show->reading[$x]}}</li>
                                    <li style="margin-top: 8px;font-family: sans-serif;font-size: 1em;line-height: 1.4em;margin-bottom: 20px;color: #737373;">Spoken Interaction: {{$show->spokeni[$x]}}</li>
                                    <li style="margin-top: 8px;font-family: sans-serif;font-size: 1em;line-height: 1.4em;margin-bottom: 20px;color: #737373;">Production: {{$show->production[$x]}}</li>
                                    <li style="margin-top: 8px;font-family: sans-serif;font-size: 1em;line-height: 1.4em;margin-bottom: 20px;color: #737373;">Writting: {{$show->writting[$x]}}</li>

                                </ul>


                            </article>

                        </div>

                        <div class="clear"></div>

                    @endfor



                </article>

            </section>


        @endif



    </div>
</div></body></html>
