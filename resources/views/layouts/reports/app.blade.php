<!doctype html>
<html dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">

    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">

    <title>{{App\Models\Setting::getSetting('site_name')}}</title>

    <style>

        body{
        margin:0;
        padding:1cm 1cm;
        color: black;
        font-family: 'XBRiyaz', sans-serif;
        font-size: 12pt;
        direction: {{ (App::isLocale('ar') ? 'rtl' : 'ltr') }};
        }

        hr{ margin:1mm 0; }

        header{
        height:1cm;
        padding:0 5mm;
        }

        header hr{ margin:1cm 0 5mm 0; }

        header table {
            width: 100%;
            line-height: inherit;
            text-align: justify;
        }

        footer {
        margin: 0 ;
        padding:0 5mm;
        font-size: 10pt;
        text-align: center;
        color: #999;
        }

        .content {
            margin: 0 ;
            line-height: 1.5;
        }

        .ticket {
            max-width: 800px;
            margin: auto;
            padding: 10px;
            font-size: 12pt;
            line-height: 24px;
            color: #000;
        }

        .ticket table {
            border: 0px solid #f1f1f1;
            width: 100%;
        }

        .ticket table tr {
            background-color: #f1f1f1;
        }
        .ticket table tr td{
            padding: 5px 20px;
            font-size: 12pt;
        }
        .ticket table tr td.title {
            background-color: #ccc;
        }
        .ticket table tr td.total {
            border-top: 1px solid #ccc;
            font-weight: bold;
        }

        .note{
        padding: 22px;
        border: 1px solid #ddd;
        border-radius: 5px;
        }

        .float-left {float: left;}
        .float-right {float: right;}
        .bold{font-weight:bold;}
        .text-right{text-align: right;}
        .text-left{text-align: left;}
        .text-center{text-align: center;}
        .text-justify{text-align: justify;}
        .border{border: 1px solid #ddd;}

    </style>

</head>
<body >

    <div>
        <!-- Header -->
        @includeIf('layouts.reports.header')

        <div class="content">
            <!-- Content -->
            @yield('content')
        </div>

        <!-- Footer -->
        @includeIf('layouts.reports.footer')
    </div>

</body>
</html>