
@if($sliders->isNotEmpty())


    <div id="slider-cycle" class="slider cycle no-responsive slider_cycle group" style="height:485px;">

        <ul class="slider">

            @foreach($sliders as $slider)

                <li>
                    <div class="slide-holder" style=" background:url({{asset(env('THEME'))}}/images/city2.jpg) no-repeat center center fixed; background-size: cover;height:483px; "  >


                        <div class="slide-content-holder inner" >

                            <div class="slide-content-holder-content" >
                                <div class="sale" style="background: url({{env('THEME').'/images/sale.png' }}) no-repeat center center;background-size: 100px;"><p class="price_sale" >{{$slider->second->first()->title}}</p></div>
                                <div class="slide-title">
                                    <img src="{{$slider->img->max}}">
                                    <div>
                                            <h1 style="margin: 0" >{!! $slider->title !!}</h1>
                                            <p  style="color:red; text-decoration:line-through ;font-size: 16px">{{$slider->price}}$</p>
                                            <p class="blink_me" style="color: red; text-decoration: underline;;font-size: 16px"> new price {{$slider->price - $slider->second->first()->sale}}$</p>
                                    </div>
                                </div>

                                <div class="slide-content" style="color:#fff">

                                    <h3>{!! str_limit($slider->desc,200) !!}</h3>


                                        {!! Html::link('/','More',['class' => 'btn btn-the-salmon-dance-3','style'=>'padding:5px 20px;margin:20px 0']) !!}


                                </div>
                            </div>
                        </div>

                    </div>



                </li>


            @endforeach
        </ul>

        </div>

    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($){

            var     yit_slider_cycle_fx = 'easing',
                yit_slider_cycle_speed = 800,
                yit_slider_cycle_timeout = 3000,
                yit_slider_cycle_directionNav = true,
                yit_slider_cycle_directionNavHide = true,
                yit_slider_cycle_autoplay = true;

            var yit_widget_area_position = function(){
                $('#yit-widget-area').css({ top: 33 - $('#yit-widget-area').height() });
            };
            $(window).resize(yit_widget_area_position);
            yit_widget_area_position();

            if( $.browser.msie && parseInt($.browser.version.substr(0,1),10) <= '8' ) {
                $('#slider-cycle ul.slider').anythingSlider({
                    expand              : true,
                    startStopped        : false,
                    buildArrows         : yit_slider_cycle_directionNav,
                    buildNavigation     : false,
                    buildStartStop      : false,
                    delay               : yit_slider_cycle_timeout,
                    animationTime       : yit_slider_cycle_speed,
                    easing              : yit_slider_cycle_fx,
                    autoPlay            : yit_slider_cycle_autoplay ? true : false,
                    pauseOnHover        : true,
                    toggleArrows        : false,
                    resizeContents      : true
                });
            } else {
                $('#slider-cycle ul.slider').anythingSlider({
                    expand              : true,
                    startStopped        : false,
                    buildArrows         : yit_slider_cycle_directionNav,
                    buildNavigation     : false,
                    buildStartStop      : false,
                    delay               : yit_slider_cycle_timeout,
                    animationTime       : yit_slider_cycle_speed,
                    easing              : yit_slider_cycle_fx,
                    autoPlay            : yit_slider_cycle_autoplay ? true : false,
                    pauseOnHover        : true,
                    toggleArrows        : yit_slider_cycle_directionNavHide ? true : false,
                    onSlideComplete     : function(slider){},
                    resizeContents      : true,
                    onSlideBegin        : function(slider) {},
                    onSlideComplete     : function(slider) {}
                });

            }
        });
    </script>

@endif