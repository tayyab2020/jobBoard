<!-- begin:footer -->
    <div id="footer">
      <div class="container">
       <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
              {!!getcong('footer_widget1')!!}
            </div>
          </div>
          <!-- break -->

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
              <ul class="list-unstyled">
                <li><a href="{{ URL::to('about-us') }}">Over ons</a></li>
                <li><a href="{{ URL::to('contact-us') }}">Contact</a></li>

                <li><a href="{{ URL::to('careers-with-us')}}">Werken bij</a></li>
                <li><a href="{{ URL::to('terms-conditions')}}">Algemene voorwaarden</a></li>
                <li><a href="{{ URL::to('privacy-policy')}}">Privacy verklaring</a></li>
              </ul>
            </div>
          </div>
          <!-- break -->

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
              {!!getcong('footer_widget2')!!}
            </div>
          </div>
          <!-- break -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
              {!!getcong('footer_widget3')!!}

            </div>
          </div>
          <!-- break -->
        </div>
        <!-- break -->


        <!-- begin:copyright -->
        <div class="row">

          <div class="col-md-12 copyright">
          	<ul class="list-inline social-links">
              <li><a href="{{getcong('social_facebook')}}" class="icon-facebook" rel="tooltip" title="" data-placement="bottom" data-original-title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>

              <li><a href="{{getcong('social_twitter')}}" class="icon-instagram" rel="tooltip" title="" data-placement="bottom" data-original-title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>

            {{--  <li><a href="{{getcong('social_linkedin')}}" class="icon-gplus" rel="tooltip" title="" data-placement="bottom" data-original-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>

              <li><a href="{{getcong('social_gplus')}}" class="icon-gplus" rel="tooltip" title="" data-placement="bottom" data-original-title="Gplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
           --}}
            </ul>

            <p>{{getcong('site_copyright')}}</p>
            <a href="#top" class="btn btn-primary scroltop"><i class="fa fa-angle-up"></i></a>
            <!--<ul class="list-inline social-links">
              <li><a href="#" class="icon-instagram" rel="tooltip" title="" data-placement="bottom" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#" class="icon-facebook" rel="tooltip" title="" data-placement="bottom" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#" class="icon-gplus" rel="tooltip" title="" data-placement="bottom" data-original-title="Gplus"><i class="fa fa-google-plus"></i></a></li>
            </ul>-->
          </div>
        </div>
        <!-- end:copyright -->

      </div>
    </div>
    <!-- end:footer -->
