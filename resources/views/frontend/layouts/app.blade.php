<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Testing') }}</title>
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery-ui.js')}}"></script>
    <link rel="stylesheet" href="{{asset('frontend/css/toastr.min.css')}}">
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet"/>
    <link href="{{ asset('frontend/css/daterangepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/b-print-1.5.1/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script>
          var baseurl ="<?= URL::to(''); ?>";
    </script>
</head>
  <body class="bg-white-light">
    <div class="wraper">
      <header class="inner-header">
        @include('frontend.layouts.header')  
      </header>
        @include('frontend.layouts.sidebar')  
      <div class="dashboard-content">
          @yield('content')
      </div>
    </div>
  </body>

    <script src="{{ asset('frontend/js/popper.min.js') }}" defer></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('frontend/js/select-drop.js') }}" defer></script>
    <script src="{{ asset('frontend/js/jqx-all.js') }}" defer></script>
    <script src="{{asset('frontend/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('frontend/js/additional-methods.min.js')}}"></script>
    <script src="{{asset('frontend/js/moment.min.js')}}"></script>
    <script src="{{asset('frontend/js/daterangepicker.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/b-print-1.5.1/datatables.min.js"></script>

    <script type="text/javascript" href="https://cdn.datatables.net/buttons/1.6.3/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" href="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
      $('input[name="daterange"]').daterangepicker({
          dateFormat: 'Y-m-d',
          opens: 'right'
        }, function(start, end, label) {
          console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
      $(document).on('click','.applyBtn',function(){
        $('.datesearch').submit();
      });
    </script>
    @toastr_js
    @toastr_render
    <style type="text/css">
      .site-loader { position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0,0,0,0.7);display: flex;align-items: center;justify-content: center;z-index: 9999; }
    </style>
  <div class="site-loader" style="display: none;">
    <img src="{{asset('spinning-circles.svg')}}">
  </div>
</html>
