<!-- begin:header -->
    <div id="header" class="header-slide">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGfQhIC7_QAkMKlYYrctdoQg78iQJIm6o&libraries=places&region=nl" async defer></script>
        <div class="container">
        <div class="row">
            <img src="{{ URL::asset('upload/search_logo.png') }}" style="width: 70%">
            <div class="col-md-12">
            <div class="quick-search">
              <div class="row">
                 {!! Form::open(array('url' => array('searchjobs'),'name'=>'search_form','id'=>'search_form','role'=>'form')) !!}
                  <div class="col-md-6 col-sm-6 col-xs-6">
                      <div class="form-group">
                          <label for="Educational Attainment">Wat voor baan zoek je?</label>
                          <input class="form-control" placeholder="Trefwoord, of functienaam" name="keyword" type="text">
                      </div>
                      <div class="form-group">
                          <label for="type">Type baan</label>
                          <select class="form-control" name="type">
                              <option value="" selected>Selecteer de type baan</option>
                          @foreach(\App\Types::orderBy('types')->get() as $type)
                                  <option value="{{$type->id}}">{{$type->types}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <!-- break -->
                   <div class="col-md-6 col-sm-6 col-xs-6">
                       <div class="form-group">
                           <label for="city">Waar zoek jij die baan?</label>
                           <div class="row">
                               <div class="col-sm-9">
                                   <input type="text" id="address-input" placeholder="Vul de plaats in" required name="address"  class="form-control map-input">
                                   <input type="hidden" required name="address_latitude" id="address-latitude" value="" />
                                   <input type="hidden" required name="address_longitude" id="address-longitude" value="" />
                                   <input type="hidden" required name="city_name" id="city_name" />
                               </div>
                               <div class="col-sm-3">
                                   <select type="text" name="radius" class="form-control" >
                                       <option value="0">+0 KM</option>
                                       <option value="1">+1 KM</option>
                                       <option value="3">+3 KM</option>
                                       <option value="5">+5 KM</option>
                                       <option value="10">+10 KM</option>
                                       <option value="20">+20 KM</option>
                                   </select>
                               </div>
                           </div>
                       </div>
                       <div class="form-group col-sm-3">
                           <label for="city">&nbsp</label>
                           <input type="submit" name="submit" value="Go" class="btn btn-warning btn-lg btn-block">
                       </div>
                       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="display:none;">
                           <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">
                               <div id="address-map-container" style="width:100%;height:400px; ">
                                   <div style="width: 100%; height: 100%" id="address-map"></div>
                               </div>
                           </div>
                       </div>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:header -->
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
