<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <h1>Dashboard</h1>
@stop

@section('content')
    <div class="wrapper">
        <div id="body" class="active">
            <!-- end of navbar navigation -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        @foreach ($data as $card)
                            <div class="col-sm-6 col-md-6 col-lg-3 mt-3">
                                <div class="card {{ $card['bg_color'] }}">
                                    <div class="content">
                                        <div class="row p-2">
{{--                                            <div class="col-sm-4">--}}
{{--                                                <div class="icon-big text-center">--}}
{{--                                                    <i class="{{ $card['icon'] }}"></i>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="col-sm">
                                                <p class="text-center">{{ $card['subtitle'] }}</p>
                                                <p class="text-center">{{ $card['number'] }}</p>
                                            </div>
                                        </div>
{{--                                        <div class="footer pl-2 pb-2">--}}
{{--                                            <hr />--}}
{{--                                            <div class="stats">--}}
{{--                                                <i class="fas fa-calendar"></i> {{ $card['stats'] }}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card p-2">
                                        <div class="content">
                                            <div class="head">
                                                <h5 class="mb-0">Performance Overview</h5>
                                                <p class="text-muted">Current year performance data</p>
                                            </div>
                                            <div class="canvas-wrapper">
                                                <canvas class="chart" id="trafficflow"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card p-2">
                                        <div class="content">
                                            <div class="head">
                                                <h5 class="mb-0">Contribution</h5>
                                                <p class="text-muted">Current year contribution data</p>
                                            </div>
                                            <div class="canvas-wrapper">
                                                <canvas class="chart" id="sales"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-2">
                                <div class="content">
                                    <div class="head">
                                        <h5 class="mb-0">Top Contributors</h5>
                                        <p class="text-muted">Current year top contributors</p>
                                    </div>
                                    <div class="canvas-wrapper">
                                        <table class="table table-striped">
                                            <thead class="success">
                                                <tr>
                                                    <th>Name</th>
                                                    <th class="text-end">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($contributors as $contributor)
                                                    <tr>
                                                        <td>{{ $contributor['name']}}</td>
                                                        <td class="text-end">¥{{ $contributor['amount']}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-2">
                                <div class="content">
                                    <div class="head">
                                        <h5 class="mb-0">Most Visited Pages</h5>
                                        <p class="text-muted">Current year website visitor data</p>
                                    </div>
                                    <div class="canvas-wrapper">
                                        <table class="table table-striped">
                                            <thead class="success">
                                                <tr>
                                                    <th>Page Name</th>
                                                    <th class="text-end">Visitors</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pages as $page)
                                                    <tr>
                                                        <td><i class="fas fa-link text-primary"></i> {{ $page['page_name']}}</td>
                                                        <td class="text-end">{{ $page['visitors']}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/dashboard-charts.js') }}"></script>
@stop
