<!DOCTYPE html>

<head>

    <meta charset="UTF-8" />
    <!-- this line will appear only if the website is visited with an iPad -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

    <title>{{$title or 'Shop'}}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('pink')}}/images/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="{{asset('pink')}}/images/favicon.ico" />
    <!-- Touch icons more info: http://mathiasbynens.be/notes/touch-icons -->
    <!-- For iPad3 with retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('pink')}}/apple-touch-icon-144x.png" />
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('pink')}}/apple-touch-icon-114x.png" />
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('pink')}}/apple-touch-icon-72x.png" />
    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
    <link rel="apple-touch-icon-precomposed" href="{{asset('pink')}}/apple-touch-icon-57x.png" />
    <!-- [favicon] end -->

    <!-- CSSs -->
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('pink')}}/css/reset.css" /> <!-- RESET STYLESHEET -->
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('pink')}}/style.css" /> <!-- MAIN THEME STYLESHEET -->
    <link rel="stylesheet" id="max-width-1024-css" href="{{asset('pink')}}/css/max-width-1024.css" type="text/css" media="screen and (max-width: 1240px)" />
    <link rel="stylesheet" id="max-width-768-css" href="{{asset('pink')}}/css/max-width-768.css" type="text/css" media="screen and (max-width: 987px)" />
    <link rel="stylesheet" id="max-width-480-css" href="{{asset('pink')}}/css/max-width-480.css" type="text/css" media="screen and (max-width: 480px)" />
    <link rel="stylesheet" id="max-width-320-css" href="{{asset('pink')}}/css/max-width-320.css" type="text/css" media="screen and (max-width: 320px)" />

    <!-- CSSs Plugin -->
    <link rel="stylesheet" id="thickbox-css" href="{{asset('pink')}}/css/thickbox.css" type="text/css" media="all" />
    <link rel="stylesheet" id="styles-minified-css" href="{{asset('pink')}}/css/style-minifield.css" type="text/css" media="all" />
    <link rel="stylesheet" id="buttons" href="{{asset('pink')}}/css/buttons.css" type="text/css" media="all" />
    <link rel="stylesheet" id="cache-custom-css" href="{{asset('pink')}}/css/cache-custom.css" type="text/css" media="all" />
    <link rel="stylesheet" id="custom-css" href="{{asset('pink')}}/css/custom.css" type="text/css" media="all" />

    <!-- FONTs -->
    <link rel="stylesheet" id="google-fonts-css" href="http://fonts.googleapis.com/css?family=Oswald%7CDroid+Sans%7CPlayfair+Display%7COpen+Sans+Condensed%3A300%7CRokkitt%7CShadows+Into+Light%7CAbel%7CDamion%7CMontez&amp;ver=3.4.2" type="text/css" media="all" />
    <link rel='stylesheet' href="{{asset('pink')}}/css/font-awesome.css" type='text/css' media='all' />
    <link rel="stylesheet"  href="{{asset('pink')}}/bootstrap/css/bootstrap.min.css" type="text/css" media="all" />

    <!-- JAVASCRIPTs -->
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/comment-reply.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.quicksand.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.tipsy.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.cycle.min.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.anythingslider.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.eislideshow.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.easing.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.aw-showcase.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/layerslider.kreaturamedia.jquery-min.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/shortcodes.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.colorbox-min.js"></script> <!-- nav -->
    <script type="text/javascript" src="{{asset('pink')}}/js/jquery.tweetable.js"></script>
    <script type="text/javascript" src="{{asset('pink')}}/js/myscripts.js"></script>



</head>
<!-- END HEAD -->

<!-- START BODY -->
<body class="no_js responsive {{(Route::currentRouteName()=='home') ? 'page-template-home-php' : ''}} stretched">

<!-- START BG SHADOW -->
<div style="background-color: {{$style->site or '#fff'}}"  class="bg-shadow">

    <!-- START WRAPPER -->
    <div id="wrapper" class="group">

        <!-- START HEADER -->
        <div style="background-color: {{$style->header or '#fff'}}" id="header" class="group">

            <div class="group inner">

                <!-- START LOGO -->
                <div id="logo" class="group">
                    <a href="{{route('home')}}" title="Pink Rio"><img src="{{asset('pink')}}/images/logo.png" title="Pink Rio" alt="Pink Rio" /></a>
                </div>
                <!-- END LOGO -->

                <div id="sidebar-header" class="group">
                    <div class="widget-first widget yit_text_quote">
                        <blockquote class="text-quote-quote">&#8220;The caterpillar does all the work but the butterfly gets all the publicity.&#8221;</blockquote>
                        <cite class="text-quote-author">George Carlin</cite>
                    </div>
                </div>
                <div class="clearer"></div>

                <hr />

               {{ Breadcrumbs::render() }}
                <hr />
                <!-- START MAIN NAVIGATION -->
            @yield('navigation')
            <!-- END MAIN NAVIGATION -->
                <div id="header-shadow"></div>
                <div id="menu-shadow"></div>
            </div>

        </div>
        <!-- END HEADER -->

        <!-- START SLIDER -->
        @yield('slider')
        <div class="wrap_result"></div>
        <!-- START PRIMARY -->
        <div id="primary" class="sidebar-right">
            <div class="inner group">
                <!-- START CONTENT -->
            @yield('content')
            <!-- END CONTENT -->
            </div>
        </div>
        <!-- END PRIMARY -->

        <!-- START COPYRIGHT -->
    @yield('footer')
    <!-- END COPYRIGHT -->
    </div>
    <!-- END WRAPPER -->
</div>
<!-- END BG SHADOW -->
<script type="text/javascript" src="{{asset('pink')}}/js/jquery.custom.js"></script>
<script type="text/javascript" src="{{asset('pink')}}/js/contact.js"></script>
<script type="text/javascript" src="{{asset('pink')}}/js/jquery.mobilemenu.js"></script>
</body>
</html>