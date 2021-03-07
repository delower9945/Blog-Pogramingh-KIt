<!DOCTYPE html>
<!--
Template Name: NewsPoratal 
Author: Dh Delower
Contact: delowerweb99@gmail.com
-->
<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title> @yield('title') </title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('admin_assets')}}/css/app.css" />
     

        <!-- toastr ad css link-->
        <link rel="stylesheet" href="{{ asset('admin_assets')}}/css/toastr.min.css" />
        {{-- <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> --}}
        <!-- END: CSS Assets-->
        @stack('css')
    </head>
    <!-- END: Head -->
    <body class="app">
        <!-- BEGIN: Mobile Menu -->
        @include('layouts.backend.partials.mobile-menu')
        <!-- END: Mobile Menu -->
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            @include('layouts.backend.partials.sidebar')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                @include('layouts.backend.partials.topbar')
                <!-- END: Top Bar -->
                @yield('content')
            </div>
            <!-- END: Content -->
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{asset('admin_assets')}}/js/app.js"></script>
        
        <!-- END: JS Assets-->

        
        <!-- toastr ad js link-->

        <script src="{{asset('admin_assets')}}/js/jquery.min.js"></script>
        <script src="{{asset('admin_assets')}}/js/toastr.min.js"></script> 

        {!! Toastr::message() !!}
        <script>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    toastr.error('{{$error }}', 'Error',{
                        closeButton:true,
                        progIsesBar:true,
                    });
                @endforeach
            @endif
        </script>

      
         @stack('js')
    </body>
</html>